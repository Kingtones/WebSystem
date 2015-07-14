<?php
class Anonymous extends CI_Controller{
	function __construct(){
		parent::__construct();
		header("Content-Type:text/html;charset=utf-8"); 
		session_start();
		$data['title']="匿名聊天";
		
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('caw_model/user');
		$this->load->model('caw_model/anon_article');
		$this->load->model('caw_model/anonymity');
		$this->load->view('templates/header',$data);
		error_reporting(E_ALL || ~E_NOTICE);
	}
	function index($page=1){
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
			$anonymity=$this->anonymity->getanonymity();
			$_SESSION['anonymity']=$anonymity;
			$anondata['username']=$_SESSION['anonymity'];
			$getid=$this->user->getid($_SESSION['valid_user']);
			$_SESSION['userid']=$getid[0]->user_id;
			$anondata['url']="Anonymous/logout";
			$anondata['userid']=$_SESSION['userid'];
			$this->load->view('templates/head1',$anondata);
			

		}
		else{
			$this->load->view('index/head2');
		}
		


		$this->load->view('templates/lead');
		//  接下来 是获取数据的部分

		$total=$this->anon_article->getcount();//获取 帖子总数
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
		$anon_article=$this->anon_article->getlist($start,$offset);
		


		
		for($i=0;$i<$offset;$i++){
			//echo $article[$i]->time;
			//echo "</br>";
			$data['article_id']=$anon_article[$i]->anon_id;

			$data['article_author']=$anon_article[$i]->anon_author;
			$data['author']=$anon_article[$i]->anon_name;
			$data['time']=$anon_article[$i]->time;
			$data['anon_com_total']=$anon_article[$i]->count;
			
			$data['anon_com_time']=$anon_article[$i]->moti_time;
			$data['anon_com_user']=$anon_article[$i]->moti_user;

			$data['anon_id']=$i;
				if(mb_strlen($anon_article[$i]->anon_title)>15){
			$data['title']=mb_substr($anon_article[$i]->anon_title,0,15)."...";
		}else {
		$data['title']=$anon_article[$i]->anon_title;
	}
	$this->load->view('anonymous/anonmity',$data);



}		
		$fenye['url']="anonymous/index";
		$this->load->view('templates/fenye',$fenye);
		$con['con']="anonymous";
		$this->load->view('templates/create',$con);
		$this->load->view('templates/footer');
}
function create(){
	if(!isset($_SESSION['valid_user'])){
		$user['url']="anonymous/index";
	$user['time']=0;
	$this->load->view('templates/success',$user);

	}else{
	
	if(!isset($_POST['title'])&&!isset($_POST['content'])){
		echo "内容不能为空返回重新发帖";
		$data['url']="forum/index";
		$data['time']=1000;
		$this->load->view('templates/success',$data);


	}
	else{
		$data['username']=$_SESSION['valid_user'];
	date_default_timezone_set('PRC');
	$data['time']=date('Y-m-d H:i:s',time());
	$data['anonymity']=$_SESSION['anonymity'];
	$data['content']=$_POST['content'];
	$data['title']=$_POST['title'];
	$this->load->model('caw_model/article');
	try{
		$this->anon_article->insert($data);

	}
	catch(Exception $e){

	}
}

	$user['url']="anonymous/index";
	$user['time']=0;
	$this->load->view('templates/success',$user);
}

}


function logout(){
		session_destroy();
		$data['url']="Anonymous/index";
		$data['time']=0;
		$this->load->view('templates/success',$data);
		
		
	}


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
		$data['url']="anonymous/logout";
		$this->load->view('templates/head1',$data);
		$content=$this->anon_article->getanon($id);

		//$content
		//echo $content[0]->article_author;
		$authorid=$this->user->getid($content[0]->anon_author);
		$author=$this->user->getinfo($authorid[0]->user_id);

		$show['title']=$content[0]->anon_title;
		$show['article_id']=$content[0]->anon_id;
		$show['body']=$content[0]->anon_body;
		$show['time']=$content[0]->time;
		$show['moti_time']=$content[0]->moti_time;
		$show['author']=$content[0]->anon_name;
		$show['author_id']=$author[0]->user_id;
		$show['expe']=$author[0]->expe;

		$this->load->model('caw_model/anon_comment');

		$total=$this->anon_comment->getcount($id);
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

		$anon_comment=$this->anon_comment
		->getanon($id,$start,$offset);

		

		for($i=0;$i<$offset;$i++){
			$show['anon_com_body'][$i]=$anon_comment[$i]->content;
			$show['paid'][$i]=$anon_comment[$i]->parent_id;

			$pbody[$i]=$this->anon_comment->getcontent($show['paid'][$i]);
			if($pbody[$i][0]->content!=''){
			$show['anon_com_body'][$i]="引用：".$pbody[$i][0]->content.
			"<br><br>".$show['anon_com_body'][$i];

		}

		$show['com_time'][$i]=$anon_comment[$i]->time;
			$show['id'][$i]=$anon_comment[$i]->id;
			$show['com_id'][$i]=$anon_comment[$i]->author_id;
			$show['com_name'][$i]=$anon_comment[$i]->anon_name;



}












		$this->load->view('anonymous/article',$show);


		$this->load->view('anonymous/comment',$show);

		$data['article_id']=$id;

		$data['url']="anonymous";
		$this->load->view('templates/comment',$data);
		$this->load->view('templates/footer');
		








	}


}

function comment($com_body,$id,$parentid=-1){
	if(!isset($_SESSION['valid_user'])){
	

	}else{

	$com_data['author']=$_SESSION['anonymity'];//anon_name
	date_default_timezone_set('PRC');
	$com_data['time']=date('Y-m-d H:i:s',time());//time
	$com_data['body']=$com_body;//content
	$com_data['anon_id']=$id;//anon_id
	$com_data['parentid']=$parentid;//parentid
	$com_data['author_id']=$_SESSION['userid'];//authorid
	$this->load->model('caw_model/anon_comment');
	$this->anon_comment->insert($com_data);
	
	$this->anon_article->comment($id,$com_data['author'],$com_data['time']);
	}


}



}
?>