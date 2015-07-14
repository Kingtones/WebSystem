<?php
class Anonymity extends CI_Model{
	function __construct(){
		parent::__construct();

	}
	function getanonymity($username){
		$username=$_SESSION['valid_user'];
		$sql4="select  anonymity from user where user_name='$username'";
		$query=$this->db->query($sql4);
		$result=$query->result();
		$name=$result[0]->anonymity;

		if($name==null){
			$state=FALSE;

		}
		else{
			$state=TRUE;
			
		}

		
		while (!$state){
			$query=$this->db->query('select count(*) as num from anonymity where anonymity_state=0');
		$result=$query->result();
		$max=$result[0]->num-1;
		//echo $max;
		$start=rand(0,$max);
		$end=$start+1;
		$this->db->trans_begin();
		$sql="select anonymity_name from anonymity  where anonymity_state=0 limit $start,$end";
		$query=$this->db->query($sql);
		$result=$query->result();
		$name=$result[0]->anonymity_name;
		//echo $name;

		$sql2="update anonymity set anonymity_state=1 where anonymity_name='$name'and anonymity_state=0";
		$query2=$this->db->query($sql2);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$state=FALSE;
		}
		else{
			$this->db->trans_commit();
			$state=TRUE;
			$sql3="update user set anonymity='$name',times=times-1 where user_name='$username'";
			$query=$this->db->query($sql3);
		}

		}
		return $name;
		
		

		

	}
	function destroyanonymity(){
		$anonymity=$_SESSION['anonymity'];
		$sql="update anonymity set  anonymity_state=0 where anonymity_name='$anonymity'";

		$query=$this->db->query($sql);
		$sql="update user set anonymity=null where anonymity='$anonymity'";
		$query=$this->db->query($sql);
		if(!$query){
			return true;
		}

	}
}
?>