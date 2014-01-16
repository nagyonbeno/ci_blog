<?php

Class Users Extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('user');
		$this->load->model('post');
	}


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
				'field'  => 'email',
				'label'	 => 'Email',
				'rules'  => 'valid_email|is_unique[users.email]'
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
				'nev' 		=> $_POST['nev'],
				'jelszo' 	=> sha1($_POST['jelszo']),
				'email' 	=> $_POST['email'],
				'user_type' => $_POST['user_type'],
				'reg_ideje'	=> date("y-m-d"),
				'kep'		=> $kep
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

	function user($user_id){

		$this->load->library('pagination');

		$config['base_url'] = base_url().'users/user/'.$user_id.'/';
		$config['total_rows'] = $this->post->get_user_posts_count($user_id);
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);

		$data['user_details']=$this->user->get_user($user_id);
		$data['user_posts'] = $this->post->get_user_posts($user_id);
		$data['posts_number'] = $this->post->get_user_posts_count($user_id);
		$data['pages'] = $this->pagination->create_links();

		$this->load->view('header');
		$this->load->view('user_page',$data);
		$this->load->view('footer');
	}








}



?>