<?php
class Comment extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function getcount($articleid){
		$sql="select count(*)  as total from comment where article_id={$articleid}";
		$query=$this->db->query($sql);
		$result=$query->result();
		$total=$result[0]->total;
		
		return $total;

	}

	function insert($data){
		$sql="insert into comment value('".$data['article_id'].
			"','".$data['parentid']."','','"
			.$data['body']."','".$data['author_id']."','".$data['time']."','"
			.$data['author']."')";

		$query=$this->db->query($sql);


	}

	function getcomment($articleid,$start,$end){
		$sql="select *from comment where article_id='$articleid' order by
		 time limit $start,$end";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}
	function getcontent($id){
		$sql="select content from comment where id='$id'";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;

	}
	function getusercount($userid){
		$sql="select count(*) as total from comment where author_id='$userid'";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result[0]->total;

	}
	function getinfo($userid){
		$sql="select * from  comment where author_id='$userid'";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}

	
}
?>