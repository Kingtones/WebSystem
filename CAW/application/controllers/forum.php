<?php
class Forum extends CI_Controller{
	function __construct(){
		parent::__construct();
		header("Content-Type:text/html;charset=utf-8"); 
		session_start();
		$data['title']="日常聊天";
		
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('caw_model/user');
		$this->load->model('caw_model/article');
		$this->load->model('caw_model/comment');
		$this->load->model('caw_model/anonymity');
		$this->load->view('templates/header',$data);

		error_reporting(E_ALL || ~E_NOTICE);
	}
	function index($page=1){//  页面分页显示，默认为第一页
	$username=$_POST['username'];
		$password=$_POST['password'];
		if($username&&$password){
			try{
				$this->user->login($username,$password);
				$_SESSION['valid_user']=$username;
				
			}
			catch(Exception $e){
				echo "登陆失败";
				//echo anchor('Caw_index', '返回首页');
				exit;
			}
			
			//$this->login($username,$password);


		}


		
		if(isset($_SESSION['valid_user'])){
			$forumdata['username']=$_SESSION['valid_user'];
			$getid=$this->user->getid($_SESSION['valid_user']);
			$_SESSION['userid']=$getid[0]->user_id;
			$forumdata['url']="forum/logout";
			$forumdata['userid']=$_SESSION['userid'];
			$this->load->view('templates/head1',$forumdata);
			$anonymity=$this->anonymity->getanonymity();
			$_SESSION['anonymity']=$anonymity;
			

		}
		else{
			$this->load->view('index/head2');
		}
		


		$this->load->view('templates/lead');
		//  接下来是 获取页面内容部分

		$total=$this->article->getcount();//获取 帖子总数
		$pages=ceil($total/20);//页面总数
		$page=$page>$pages?$pages:$page;
		$fenye['page']=$page;
		$fenye['pages']=$pages;
		$fenye['total']=$total;
		
		
		$start=($page-1)*20;
		if($total==0){
			$start=0;
			$offset=0;
		}
		
		elseif(($total%20)!=0){
			$offset=($page==$pages?($total %20):20);
		}
		else{
			$offset=20;

		}
		
		
		$article=$this->article->getlist($start,$offset);
		//$comment_total=$this->comment->getcount();//获取评论数
		//$comment=$this->comment->get_user_time();//获取最近评论人和最近评论时间
		//echo $total;

		
		
		for($i=0;$i<$offset;$i++){
			//echo $article[$i]->time;
			//echo "</br>";
			$data['article_id']=$article[$i]->article_id;

			$data['author']=$article[$i]->article_author;

			$getid=$this->user->getid($data['author']);

			$data['user_id']=$getid[0]->user_id;
			$data['time']=$article[$i]->time;
			$data['com_total']=$article[$i]->count;
			$data['com_time']=$article[$i]->moti_time;
			$data['com_user']=$article[$i]->moti_user;
			$com_id=$this->user->getid($data['com_user']);

			$data['com_id']=$com_id[0]->user_id;

			$data['id']=$i;
				if(mb_strlen($article[$i]->article_title)>15){
			$data['title']=mb_substr($article[$i]->article_title,0,15)."...";
		}else {
		$data['title']=$article[$i]->article_title;
	}

			$this->load->view('forum/forum',$data);

		}
		$fenye['url']="forum/index";
		$this->load->view('templates/fenye',$fenye);
		$con['con']="forum";
		$this->load->view('templates/create',$con);
		$foot['log']=8;
		$this->load->view('templates/footer',$foot);


		
	
}
// 完成发帖功能
function create(){
	

	if(!isset($_SESSION['valid_user'])){
		$user['url']="forum/index";
	$user['time']=0;
	$this->load->view('templates/success',$user);

	}else{
	if(($_POST['title']=='')||($_POST['content']=='')){
		echo "内容不能为空返回重新发帖";
		$data['url']="forum/index";
		$data['time']=5000;
		$this->load->view('templates/success',$data);


	}
	else{
		$data['username']=$_SESSION['valid_user'];
	date_default_timezone_set('PRC');
	$data['time']=date('Y-m-d H:i:s',time());
	$data['content']=$_POST['content'];
	$data['title']=$_POST['title'];

	$this->load->model('caw_model/article');
	try{
		$this->article->insert($data);

	}
	catch(Exception $e){

	}
}



	$user['url']="forum/index";
	$user['time']=0;
	$this->load->view('templates/success',$user);
}




}


//完成退出功能
function logout(){
		session_destroy();
		$data['url']="forum/index";
		$data['time']=0;
		$this->load->view('templates/success',$data);
		

	
	
}

//具体帖子页面，参数为帖子ID

function show ($id=1,$page=1){
	//var_dump($_SESSION);
	if(empty($_SESSION['valid_user'])){//如果未登陆，则返回匿名区
		$data['url']=strchr(strrchr($_SERVER['HTTP_REFERER'], "index.php/"),"/");
		//echo $_SERVER['HTTP_REFERER'];
		$data['time']=0;
		echo $data['url'];
		$this->load->view('templates/success',$data);
		
		
		
		//$this->load->view('login/login');
	}else{


		if($_POST['content']!=''&&$_POST['submit']!=''){
			
			$this->comment($_POST['content'],$id,$_POST['pid']);
		
		}

		$data['parentid']=$_POST['parentid'];
		$this->load->view('templates/lead');
		$data['username']=$_SESSION['valid_user'];
		$getid=$this->user->getid($_SESSION['valid_user']);
		$_SESSION['userid']=$getid[0]->user_id;
		$data['userid']=$_SESSION['userid'];
		$data['url']="forum/logout";
		$this->load->view('templates/head1',$data);
		$content=$this->article->getarticle($id);
		//$content
		//echo $content[0]->article_author;
		$authorid=$this->user->getid($content[0]->article_author);
		$author=$this->user->getinfo($authorid[0]->user_id);

		$show['title']=$content[0]->article_title;
		$show['article_id']=$content[0]->article_id;
		$show['body']=$content[0]->article_body;
		$show['time']=$content[0]->time;
		//$show['moti_time']=$content[0]->moti_time;
		$show['author']=$content[0]->article_author;
		$show['author_id']=$author[0]->user_id;
		$show['expe']=$author[0]->expe;

		$this->load->model('caw_model/comment');

		$total=$this->comment->getcount($id);
		$pages=ceil($total/20);//页面总数
		$page=$page>$pages?$pages:$page;
		$start=($page-1)*20;
		

		if($total==0){
					$start=0;
					$offset=0;
					

				}
				elseif(($total%20)!=0){
					$offset=($page==$pages?($total %20):20);
						}
				else{
					$offset=20;

					}
				

		$show['num']=$offset;
		$show['page']=$page;//当前页
		$show['pages']=$pages;//总页数
		$show['total']=$total;//总数目$
		$comment=$this->comment->getcomment($id,$start,$offset);
		for($i=0;$i<$offset;$i++){
			$show['com_body'][$i]=$comment[$i]->content;
			$show['paid'][$i]=$comment[$i]->parent_id;
			

			$pbody[$i]=$this->comment->getcontent($show['paid'][$i]);

			if($pbody[$i][0]->content!=''){
			$show['com_body'][$i]="引用：".$pbody[$i][0]->content.
			"<br><br>".$show['com_body'][$i];
		}



			$show['com_time'][$i]=$comment[$i]->time;
			$show['id'][$i]=$comment[$i]->id;
			$show['com_id'][$i]=$comment[$i]->author_id;
			$show['com_name'][$i]=$comment[$i]->author;

		}	
		













		$this->load->view('forum/article',$show);


		$this->load->view('forum/comment',$show);

		$data['article_id']=$id;
		$data['url']="forum";
		$this->load->view('templates/comment',$data);
		$this->load->view('templates/footer');
		








	}


}

function comment($com_body,$id,$parentid=-1){



	if(!isset($_SESSION['valid_user'])){
	

	}else{
	$com_data['author']=$_SESSION['valid_user'];
	date_default_timezone_set('PRC');
	$com_data['time']=date('Y-m-d H:i:s',time());
	$com_data['body']=$com_body;
	$com_data['article_id']=$id;
	$com_data['parentid']=$parentid;
	$com_data['author_id']=$_SESSION['userid'];
	$this->load->model('caw_model/comment');
	$this->comment->insert($com_data);
	$this->article->comment($id,$com_data['author'],$com_data['time']);
	


	


	}

}


}
?>