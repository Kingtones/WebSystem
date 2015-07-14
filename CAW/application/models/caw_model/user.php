<?php
class User extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function insert($data){
		$query="select * from user where user_name='".$data['username']."'";
		$result=$this->db->query($query);
		if(!$result){
			return false;
		}
		if($result->num_rows()>0){
			echo "用户已存在";
			throw new Exception("用户名已存在", 1);
			
		}
		$sql="insert into user value('','".$data['username']
			."',sha1('".$data['password1']."'),'".$data['email']."','',3,'','')";
		$result=$this->db->query($sql);
		if(!$result){
			echo "注册失败，不能插入数据库";
			throw new Exception("注册失败，不能插入数据库", 1);
			
		}

		return true;


	}

	function valid($data){
		
		foreach ($data as $key=>$value){
			if (!isset($key)||($value=='')){
				echo "表单不完整";
			throw new Exception("表单不完整", 1);
			
			}


		}

		
		if(strlen($data['username'])<6||strlen($data['username'])>12){
			echo "用户名长度应该为6-12";
			throw new Exception('用户名长度为6-12');
		}
		if (!$this->email($data['email'])){
			echo "请输入正确的邮箱名";
			throw new Exception("请输入正确的邮箱名", 1);
			

		}
		
		if(strlen($data['password1'])<8||strlen($data['password1'])>12){
			echo "密码长度应该为8至12位";
			throw new Exception('密码长度应该为8至12位');
		}
		if($data['password2']!=$data['password1']){
			echo"两次密码不一致请检查并重新填写";
			throw new Exception("两次密码不一致请检查并重新填写",1);
		}



	}
	function email($email){
		preg_match("/^[0-9a-z]+@(([0-9a-z]+)[.]){1,2}[a-z]{2,3}$/",$email,$re);
		if($re[0]){
			return true;
		}
			else{
				return false;
			}
		}



	function login($username,$password){
	 	
	 	
	 	
	 	//$result=$this->db->query($query);
	 	$query="select * from user where user_name='".$username."' and password=sha1('".$password."')";
	 	//$query="select * from user where user_name='".$username."' and password=sha1('".$password."')";
		$result=$this->db->query($query);
		//var_dump($result);

	
		if(!$result){
			echo "用户不存在";
			throw new Exception('用户不存在');
		
		}
		if($result->num_rows()>0){
			return true;
		}
		else{
			throw new Exception('登陆失败');
		
		}


	 	
	}
	function getid($username){
		$sql="select user_id from user where user_name='$username'";
		$query=$this->db->query($sql);
		$result=$query->result();

		return $result;
	}



	function getinfo($userid){
		$sql="select * from user where user_id='$userid'";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;

	}

	function getname($userid){
		$sql="select user_name from user where user_id='$userid'";
		$query=$this->db->query($sql);
		$result=$query->result();
		$name=$result[0]->user_name;
		return $name;

		
		
	}

	function gettimes($userid){
		$sql="select times from user where user_id='$userid'";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result[0]->times;

	}


}
?>