<?php
class Care extends CI_Model{
	function check($friendid,$selfid){
			$sql="select * from care where user_id='$selfid'and friend_id='$friendid'";
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				return true;
			}else {
				return false;
			}
	}
	function insert($friendid,$selfid,$time){



		$sql="insert into care value('$selfid','$friendid','$time')";
		$result=$this->db->query($sql);
		if(!$result){
			echo "注册失败，不能插入数据库";
			throw new Exception("注册失败，不能插入数据库", 1);
			
		}
	}

	function getlist($userid,$start,$end){
		$sql="select * from care where user_id='$userid' order by user_id desc limit $start,$end";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}
	function getusercount($userid){
		$sql="select count(*) as num from care where user_id='$userid'";
		$query=$this->db->query($sql);
		$result=$query->result();
		$num=$result[0]->num;
		return $num;

	}

}
?>