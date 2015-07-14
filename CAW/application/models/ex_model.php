<?php
class ex_model extends CI_Model{
	function __construct(){
		parent ::__construct();
	}
	function get_id($num,$offset){
		$query=$this->db->get('ex',$num,$offset);
		return $query;
	}
}
?>