<?php
class Article extends CI_Model{
	function __construct(){
		parent::__construct();

	}
	function insert($data){

		
		$sql="insert into article value('',
			'".$data['title']."','".$data['username']."','".$data['content'].
			"','".$data['time']."','".$data['time']."','".$data['username']."','')";
		$result=$this->db->query($sql);
		if(!$result){
			echo "发表失败，不能插入数据库";
			throw new Exception("发表失败，不能插入数据库", 1);
			
		}

		return true;


	}

	function getcount(){
		$sql="select count(*)  as total from article";
		$query=$this->db->query($sql);
		$result=$query->result();
		$total=$result[0]->total;
		
		return $total;
	}
	function getlist($start,$end){
		$sql="select article_id,article_title,article_author,time,
		moti_time,moti_user,count from article  order by moti_time desc limit $start,$end";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}


	function  getarticle($article_id){
		$sql="select * from article where article_id=$article_id";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;

	}

	function get_user_list($username,$start,$end){
		//$sql="select * From article where article_author='$username' order by time desc limit $start,$end";
		$sql="select * From article where article_author='$username' order by time desc";

		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;

	}
	function get_user_count($username){
		$sql="select count(*) as num from article where 
		article_author='$username'";
		$query=$this->db->query($sql);
		$result=$query->result();
		$num=$result[0]->num;
		return $num;

	}


	function getnew(){
		$sql="select article_id,article_author,article_title
		 from article order by time desc limit 0,10";

		 $query=$this->db->query($sql);
		 $result=$query->result();
		 return $result;
	}
	function gethot(){
		$sql="select article_id,article_author,article_title
		 from article order by count desc limit 0,10";

		 $query=$this->db->query($sql);
		 $result=$query->result();
		 return $result;
	}

	function comment($articleid,$moti_user,$moti_time){
		$sql="update article set moti_time='$moti_time',
		moti_user='$moti_user',count=count+1 
		where article_id='$articleid'";

		$query=$this->db->query($sql);
	}

	
}
?>