<?php

Class User Extends CI_Model{
	

	function create_user($data){
		$this->db->insert('users',$data);
	}


	function login($nev,$jelszo,$user_type){
		$where = array(
			'nev' 		=> $nev,
			'jelszo' 	=> sha1($jelszo),
			'user_type' => $user_type
			);
		$this->db->select()->from('users')->where($where);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	function get_user($user_id){
		$this->db->select()->from('users')->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->first_row('array');
	}



}


?>