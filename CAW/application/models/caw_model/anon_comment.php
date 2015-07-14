<?php
class Anon_comment extends CI_Model{
	function __construct(){
		parent::__construct();
	} 

	function getcount($anon_id){
		$sql="select count(*) as num from anon_comment 
		where anon_id='$anon_id'";
		$query=$this->db->query($sql);
		$result=$query->result();
		$num=$result[0]->num;
		return $num;

	}
	function insert($data){
		$sql="insert into anon_comment value('".
			$data['anon_id']."','".$data['parentid'].
			"','','".$data['author_id']."','".$data['author'].
			"','".$data['body']."','".$data['time']."')";

		$query=$this->db->query($sql);

	}
	function getanon($anon_id,$start,$end){
		$sql="select * from anon_comment where 
		anon_id='$anon_id' order by time limit $start,$end";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;


	}

	function getcontent($id){
		$sql="select content from anon_comment where id='$id'";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}


}

?>