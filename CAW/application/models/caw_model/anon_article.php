<?php
class Anon_article extends CI_Model{
	function __construt(){
		parent::__construt();
	}
	function insert($data){
		$sql="insert into anon_article value('',
			'".$data['title']."','".$data['username']."','".$data['anonymity'].
			"','".$data['content']."','".$data['time']."','"
			.$data['time']."','".$data['anonymity']."','')";
		$result=$this->db->query($sql);
		if(!$result){
			echo "发表失败，不能插入数据库";
			throw new Exception("发表失败，不能插入数据库", 1);
			
		}

		return true;
	}

	function getcount(){
		$sql="select count(*)  as total from anon_article";
		$query=$this->db->query($sql);
		$result=$query->result();
		$total=$result[0]->total;
		
		return $total;
	}
	function getlist($start,$end){
		$sql="select anon_id,anon_title,anon_author,anon_name,time,
		moti_time ,moti_user,count from anon_article  order by moti_time desc limit $start,$end";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}

	function get_user_list($username,$start,$end){
		$sql="select * From anon_article where anon_author='$username'order by time desc limit $start,$end";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;

	}
	function get_user_count($username){
		$sql="select count(*) as num from anon_article where anon_author='$username'";
		$query=$this->db->query($sql);
		$result=$query->result();
		$num=$result[0]->num;
		return $num;

	}

	function gethot(){
		$sql="select anon_id,anon_name,anon_title
		 from anon_article order by count desc limit 0,10";

		 $query=$this->db->query($sql);
		 $result=$query->result();
		 return $result;

	}
	function getnew(){
		$sql="select anon_id,anon_name,anon_title
		 from anon_article order by time desc limit 0,10";

		 $query=$this->db->query($sql);
		 $result=$query->result();
		 return $result;

	}

	function getanon($anonid){
		$sql="select * from anon_article where anon_id='$anonid'";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;

	}

	function comment($anon_id,$moti_user,$moti_time){
		$sql="update anon_article set moti_user='$moti_user',
		moti_time='$moti_time',count=count+1 where anon_id='$anon_id'";
		$query=$this->db->query($sql);

	}
}


?>