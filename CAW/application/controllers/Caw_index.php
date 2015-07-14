<?php
class Caw_index extends CI_Controller{
		function __construct(){
		parent::__construct();
		header("Content-Type:text/html;charset=utf-8"); 
		session_start();
		$this->load->database();
		$this->load->model('caw_model/article');
		$this->load->model('caw_model/anon_article');
		
		$data['title']="首页";
		$this->load->helper('form');
		$this->load->helper('url');
	
		$this->load->view('templates/header',$data);
		$this->load->model('caw_model/user');
		$this->load->model('caw_model/anonymity');
		error_reporting(E_ALL || ~E_NOTICE);




		
	}
	public function index(){
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

			$indexdata['username']=$_SESSION['valid_user'];
			$getid=$this->user->getid($_SESSION['valid_user']);
			$_SESSION['userid']=$getid[0]->user_id;
			
			$indexdata['url']="Caw_index/logout";
			$indexdata['userid']=$_SESSION['userid'];
			

			$this->load->view('templates/head1',$indexdata);
			$state['log']=1;
			$anonymity=$this->anonymity->getanonymity();
			$_SESSION['anonymity']=$anonymity;	
			
					



		}
		else{
			$this->load->view('index/head2');
			$state['log']=0;
			
		}
		


		$this->load->view('templates/lead');
		$newlist=$this->article->getnew();
		for($i=0;$i<10;$i++){
			$new['title'][$i]=mb_substr($newlist[$i]->article_title,0,6)."...";
			$new['author'][$i]=$newlist[$i]->article_author;
			$new['articleid'][$i]=$newlist[$i]->article_id;
		}
		$new['log']=$state['log'];

		$hotlist=$this->article->gethot();
		for($i=0;$i<10;$i++){
			$hot['title'][$i]=mb_substr($hotlist[$i]->article_title,0,6)."...";
			$hot['author'][$i]=$hotlist[$i]->article_author;
			$hot['articleid'][$i]=$hotlist[$i]->article_id;
		}
		$hot['log']=$state['log'];

		$anonhot=$this->anon_article->gethot();
		for($i=0;$i<10;$i++){
			$anonhot['title'][$i]=mb_substr($anonhot[$i]->anon_title,0,6)."...";
			$anonhot['author'][$i]=$anonhot[$i]->anon_name;
			$anonhot['articleid'][$i]=$anonhot[$i]->anon_id;
		}
		$anonhot['log']=$state['log'];

		$anonnew=$this->anon_article->getnew();
		for($i=0;$i<10;$i++){
			$anonnew['title'][$i]=mb_substr($anonnew[$i]->anon_title,0,6)."...";
			$anonnew['author'][$i]=$anonnew[$i]->anon_name;
			$anonnew['articleid'][$i]=$anonnew[$i]->anon_id;
		}
		$anonnew['log']=$state['log'];

		


		$this->load->view('index/index_show1',$anonhot);
		$this->load->view('index/index_show2',$anonnew);
		$this->load->view('index/index_show3',$hot);
		$this->load->view('index/index_show4',$new);

		$this->load->view('templates/footer',$state);


		
	
}
	function logout(){
		session_destroy();
		$data['url']="caw_index/index";
		$data['time']=0;
		$this->load->view('templates/success',$data);
	}


}