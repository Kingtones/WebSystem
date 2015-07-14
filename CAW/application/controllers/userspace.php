<?php
class Userspace extends CI_Controller{
	function __construct(){
		parent::__construct();
		session_start();
		$this->load->database();
		$this->load->model('caw_model/user');
		$this->load->model('caw_model/article');
		$this->load->model('caw_model/anon_article');
		$this->load->model('caw_model/comment');
		$this->load->model('caw_model/anon_article');
		$this->load->model('caw_model/care');
		$this->load->helper('url');
		error_reporting(E_ALL || ~E_NOTICE);
		$username=$_SESSION['valid_user'];
		$data['title']=$username."的用户空间";
		$this->load->view('templates/header',$data);
	}
	function index($userid,$display="article",$page=1){


	if(!isset($_SESSION['valid_user'])){
		$user['url']="forum/index";
	$user['time']=0;
	$this->load->view('templates/success',$user);

	}else{
		$data['url']="userspace/logout";
		$data['username']=$_SESSION['valid_user'];
		$data['userid']=$_SESSION['userid'];

		$this->load->view('templates/head1',$data);
		$this->load->view('templates/lead');
		//$this

		$name=$this->user->getname($userid);


		if($userid==$_SESSION['userid']){
			if($display=="article"){
				$total=$this->article->get_user_count($name);
				$pages=ceil($total/10);//页面总数
				$page=$page>$pages?$pages:$page;
				$start=($page-1)*10;
				
				if($total==0){
					$start=0;
					$offset=0;
					

				}
				elseif(($total%10)!=0){
					$offset=($page==$pages?($total %10):10);
						}
				else{
					$offset=10;

					}
					
				$list=$this->article->get_user_list($name,$start,$offset);
				//var_dump($list);
				$self['flag']="article";
				$self['num']=$offset;//该页显示的数目
				$self['page']=$page;//当前页
				$self['pages']=$pages;//总页数
				$self['total']=$total;//总数目
				$self['userid']=$userid;
				
				for($i=0;$i<$offset;$i++){
					$self['title'][$i]=$list[$i]->article_title;
					$self['articleid'][$i]=$list[$i]->article_id;
					$self['time'][$i]=$list[$i]->time;
					$self['moti_time'][$i]=$list[$i]->moti_time;
					$self['author'][$i]=$name;
				}
				//var_dump($self);

			}else if($display=="friend"){
				$self['flag']="friend";
				$self['userid']=$userid;


				$total=$this->care->getusercount($userid);
				$pages=ceil($total/10);//页面总数
				$page=$page>$pages?$pages:$page;
				$start=($page-1)*10;
				
				if($total==0){
					$start=0;
					$offset=0;
					

				}
				elseif(($total%10)!=0){
					$offset=($page==$pages?($total %10):10);
						}
				else{
					$offset=10;

					}
				$self['num']=$offset;//该页显示的数目
				$self['page']=$page;//当前页
				$self['pages']=$pages;//总页数
				$self['total']=$total;//总数目
				$self['userid']=$userid;

				$friend=$this->care->getlist($userid,$start,$offset);
				for($i=0;$i<$offset;$i++){

					$self['friendid'][$i]=$friend[$i]->friend_id;
					$self['friendname'][$i]=$this->user->getname($friend[$i]->friend_id);
					$self['time'][$i]=$friend[0]->time;
				}




			}
			else if($display=="reply"){
				$self['flag']="reply";
				$self['userid']=$userid;

			}else{
				$self['flag']="anonymity";
				$self['userid']=$userid;
				$total=$this->anon_article->get_user_count($name);
				$pages=ceil($total/10);//页面总数
				$page=$page>$pages?$pages:$page;
				$start=($page-1)*10;
				if($total==0){
					$start=0;
					$offset=0;
					

				}
				elseif(($total%10)!=0){
					$offset=($page==$pages?($total %10):10);
						}
				else{
					$offset=10;

					}
				$list=$this->anon_article->get_user_list($name,$start,$offset);
				//var_dump($list);
				
				$self['num']=$offset;//该页显示的数目
				$self['page']=$page;//当前页
				$self['pages']=$pages;//总页数
				$self['total']=$total;//总数目
				
				for($i=0;$i<$offset;$i++){
					$self['title'][$i]=$list[$i]->anon_title;
					$self['articleid'][$i]=$list[$i]->anon_id;
					$self['time'][$i]=$list[$i]->time;
					$self['moti_time'][$i]=$list[$i]->moti_time;
					$self['anonymous'][$i]=$list[$i]->anon_name;
					$self['author'][$i]=$name;

				}


			}
			$self['user']=$_SESSION['valid_user'];

			$self['anonymity']=$_SESSION['anonymity'];

		$this->load->view('userspace/self',$self);


		}
		else{

			if($display=="article"){
				$total=$this->article->get_user_count($name);



				$pages=ceil($total/10);//页面总数
				$page=$page>$pages?$pages:$page;
				$start=($page-1)*10;
				if(($total%10)!=0){
					$offset=($page==$pages?($total %10):10);
						}
				else{
					$offset=10;

					}

				$list=$this->article->get_user_list($name,$start,$offset);

				
				$other['flag']="article";
				$other['num']=$offset;//该页显示的数目
				$other['page']=$page;//当前页
				$other['pages']=$pages;//总页数
				$other['total']=$total;//总数目
				$other['user_id']=$userid;
				for($i=0;$i<$offset;$i++){
					$other['title'][$i]=$list[$i]->article_title;
					$other['articleid'][$i]=$list[$i]->article_id;
					$other['time'][$i]=$list[$i]->time;
					$other['moti_time'][$i]=$list[$i]->moti_time;
					$other['author'][$i]=$name;
				}
				//$data[]

			}else if($display=="reply"){
				$other['flag']="reply";
				$other['user_id']=$userid;
				$total=$this->comment->getusercount($userid);
				$pages=ceil($total/10);//页面总数
				$page=$page>$pages?$pages:$page;
				$start=($page-1)*10;
				
				if($total==0){
					$start=0;
					$offset=0;
					

				}
				elseif(($total%10)!=0){
					$offset=($page==$pages?($total %10):10);
						}
				else{
					$offset=10;

					}
				$other['num']=$offset;//该页显示的数目
				$other['page']=$page;//当前页
				$other['pages']=$pages;//总页数
				$other['total']=$total;//总数目
				
				$comment=$this->comment->getinfo($userid,$start,$offset);
				for($i=0;$i<$offset;$i++){
					$other['body'][$i]=$comment[$i]->content;
					$other['parentid'][$i]=$comment[$i]->parent_id;
					$other['time'][$i]=$comment[$i]->time;
					$other['article_id'][$i]=$comment[$i]->article_id;
					}





			}
			else{
				$other['flag']="friend";
				$other['user_id']=$userid;
				$total=$this->care->getusercount($userid);
				$pages=ceil($total/10);//页面总数
				$page=$page>$pages?$pages:$page;
				$start=($page-1)*10;
				
				if($total==0){
					$start=0;
					$offset=0;
					

				}
				elseif(($total%10)!=0){
					$offset=($page==$pages?($total %10):10);
						}
				else{
					$offset=10;

					}
				$other['num']=$offset;//该页显示的数目
				$other['page']=$page;//当前页
				$other['pages']=$pages;//总页数
				$other['total']=$total;//总数目
				

				$friend=$this->care->getlist($userid,$start,$offset);
				for($i=0;$i<$offset;$i++){

					$other['friendid'][$i]=$friend[$i]->friend_id;
					$other['friendname'][$i]=$this->user->getname($friend[$i]->friend_id);
					$other['time'][$i]=$friend[0]->time;
				}


			}
			$this->load->view('userspace/other',$other);

		}
		
		
	}
	$this->load->view('templates/footer');
}

	function logout(){
		session_destroy();
		$data['url']="caw_index/index";
		$data['time']=0;
		$this->load->view('templates/success',$data);
	}

	function care($friendid){
		//var_dump($_SESSION);
		$selfid=$_SESSION['userid'];

		$station=$this->care->check($friendid,$selfid);
		$name=$this->user->getname($friendid);

		
		if(!$station){

			date_default_timezone_set('PRC');
		$time=date('Y-m-d H:i:s',time());
		
		//echo $time;
		$this->care->insert($friendid,$selfid,$time);
		
		
		

		}
			$data['time']=1000;

			$data['error']="您已经关注".$name."!";
			

		
		$name=$this->user->getname($friendid);
		
		$preurl=$_SERVER['HTTP_REFERER'];

		$url=substr(strchr($preurl,"index.php"),10);
		
		
		$data['url']=$url;

		
		$this->load->view('templates/success',$data);
		
	
		



	}

	function change($userid){
		$this->load->model('caw_model/anonymity');
		$times=$this->user->gettimes($userid);
		$preurl=$_SERVER['HTTP_REFERER'];
		
		$data['url']=strchr($preurl,"userspace");
		if($times>0){

			$this->anonymity->destroyanonymity();
			$_SESSION['anonymity']=$this->anonymity->getanonymity($_SESSION['valid_user']);
			
		}
		$data['time']=0;
		$this->load->view('templates/success',$data);


	}

} 
?>