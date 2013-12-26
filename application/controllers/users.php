<?php

Class Users Extends CI_Controller{
	

	function login(){
		$data['error']=0;
		if($_POST){
			$this->load->model('user');
			$nev = $this->input->post('nev',true);
			$jelszo = $this->input->post('jelszo',true);
			$user_type = $this->input->post('user_type',true);
			$user = $this->user->login($nev,$jelszo,$user_type);
			if(!$user){
				$data['error']=1;
			} else {
				$this->session->set_userdata('user_id',$user['user_id']);
				$this->session->set_userdata('user_type',$user['user_type']);
				$this->session->set_userdata('username',$user['nev']);
				redirect(base_url().'posts');
			}

		}
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('login',$data);
		$this->load->view('footer');
	}


	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'posts');
	}


	function register(){
		$data['success'] = 0;
		$data['errors'] = "";
		if($_POST){

			$config = array(

			array(
				'field'  => 'nev',
				'label'	 => 'Username',
				'rules'  => 'trim|required|min_lenght[3]|is_unique[users.nev]'
				),
			array(
				'field'  => 'jelszo',
				'label'	 => 'Password',
				'rules'  => 'trim|required|min_lenght[5]'
				),
			array(
				'field'  => 'jelszo2',
				'label'	 => 'Password confirmed',
				'rules'  => 'trim|required|min_lenght[5]|matches[jelszo]'
				),
			array(
				'field'  => 'user_type',
				'label'	 => 'User_type',
				'rules'  => 'required'
				)
			);

			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			} else {
			$data = array(
				'nev' => $_POST['nev'],
				'jelszo' => sha1($_POST['jelszo']),
				'user_type' => $_POST['user_type']
				);
			$this->load->model('user');
			$user_id = $this->user->create_user($data);
			$this->session->set_userdata('user_id',$user_id);
			$this->session->set_userdata('user_type',$_POST['user_type']);
			redirect(base_url().'users/login');
		}
		}
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('register_user',$data);
		$this->load->view('footer');

		
	}

}



?>