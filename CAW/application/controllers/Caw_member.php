<?php
class Caw_member extends CI_Controller{
	function __construct(){
		parent::__construct();
		header("Content-Type:text/html;charset=utf-8"); 
		session_start();
		$this->load->database();
		$data['title']="用户注册";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('caw_model/user');
	
		$this->load->view('templates/header',$data);
	}
	function index(){
		//$this->load->view('templates/head1');
		if (empty($_POST['submit'])){
		$this->load->view('register/register');

	}else{
		try{
			$this->user->valid($_POST);
			$this->register($_POST);
			$_SESSION['valid_user']=$_POST['username'];
			$data['url']="caw_index/index";
			$data['time']=0;
			$this->load->view('templates/success',$data);


		}
		catch(Exception $e){
			//$this->index();
		}
		

		
	}

	}
	function register($user){
		$result=$this->user->insert($user);
		
	}

	
}
?>