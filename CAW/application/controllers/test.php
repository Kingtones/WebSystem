<?php
class Test extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		//session_start();
		//echo session_id();


		/*$this->load->database();
		//$mysqli=new mysqli('localhost','caw_user','caw_data_pw','caw_data');
		$query=$this->db->query('select count(*) as num from anonymity where anonymity_state=0');
		$result=$query->result();
		$max=$result[0]->num-1;
		echo $max;
		$start=rand(0,$max);
		$end=$start+1;
		$this->db->trans_begin();
		$sql="select anonymity_name from anonymity  where anonymity_state=0 limit $start,$end";
		$query=$this->db->query($sql);
		$result=$query->result();
		$name=$result[0]->anonymity_name;
		echo $name;

		$sql2="update anonymity set anonymity_state=1 where anonymity_name='$name'and anonymity_state=0";
		$query2=$this->db->query($sql2);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}
		else{
			$this->db->trans_commit();
		}
		//var_dump($result);
		//$a=$query->num_rows();
		
		
		//var_dump($query);*/


		$this->load->view('templates/fenye');
			

	}
}
?>