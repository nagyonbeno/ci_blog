<?php

Class Posts extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('post');
		$this->load->model('comment');
	}

	function index($start=0){
		if($_POST){

			$search = $this->input->post('search',true);
			$data['posts']=$this->post->search($search,5,$start);

			$this->load->library('pagination');
		
			$config['base_url'] = base_url().'posts/index/';
			$config['total_rows'] = $this->post->get_posts_count_search($search);
			$config['per_page'] = 5;
			
			$this->pagination->initialize($config);
			
			$data['pages']=$this->pagination->create_links();

		} else {

			$data['posts']=$this->post->get_posts(5,$start);
			
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'posts/index/';
			$config['total_rows'] = $this->post->get_posts_count();
			$config['per_page'] = 5;
			
			$this->pagination->initialize($config);
			
			$data['pages']=$this->pagination->create_links();
		}

		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('post_index',$data);
		$this->load->view('footer');
	}

	function post($post_id){
		$data['post']=$this->post->get_post($post_id);
		$data['comment']=$this->comment->get_comment($post_id);
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('post',$data);
		$this->load->view('new_comment',$data);
		$this->load->view('comments',$data);
		$this->load->view('footer');
	}

	function new_post(){
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
			$data['errors'] = "";
		if($_POST){

			$config = array(

			array(
				'field'  => 'cim',
				'label'	 => 'Title',
				'rules'  => 'required|min_length[3]|max_length[256]'
				),
			array(
				'field'  => 'post_szoveg',
				'label'	 => 'Post text',
				'rules'  => 'required|min_length[10]'
				),
			array(
				'field'  => 'hashtag',
				'label'  => 'Tags',
				'rules'  => 'min_length[3]'
				)
			);

			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			} else {
			$data=array(
				'cim' 		  => htmlspecialchars($_POST['cim']),
				'post_szoveg' => htmlspecialchars($_POST['post_szoveg']),
				'felh_id'	  => $this->session->userdata('user_id'),
				'hashtag' 	  => htmlspecialchars($_POST['hashtag']),
				'statusz'	  => 1
				);
		
		$this->post->insert_post($data);
		redirect(base_url().'posts/');
	} 
	}
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('new_post',$data);
		$this->load->view('footer');
	
	}

	function correct_permissions($required){
		$user_type = $this->session->userdata('user_type');
		if($required=="user"){
			if($user_type){
				return true;
			}
		}
		elseif($required=="author"){
			if($user_type=="admin" || $user_type=="author"){
				return true;
			}
		}
		elseif($required=="admin"){
			if($user_type=="admin"){
				return true;
			}
		}
	}

	function edit_post($post_id){
		if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
		}
		$data['errors'] = "";
		$data['success']=0;
		if($_POST){
			$config = array(

			array(
				'field'  => 'cim',
				'label'	 => 'Title',
				'rules'  => 'required|min_length[3]|max_length[256]'
				),
			array(
				'field'  => 'post_szoveg',
				'label'	 => 'Post text',
				'rules'  => 'required|min_length[10]'
				),
			array(
				'field'  => 'hashtag',
				'label'  => 'Tags',
				'rules'  => 'min_length[3]'
				)
			);

			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			} else {
			$data_post=array(
				'cim' 		  => htmlspecialchars($_POST['cim']),
				'post_szoveg' => htmlspecialchars($_POST['post_szoveg']),
				'hashtag' 	  => htmlspecialchars($_POST['hashtag']),
				'statusz'	  => 1
				);

		$this->post->update_post($post_id,$data_post);
		$data['success']=1;
		} 
		}
		$data['post']=$this->post->get_post($post_id);
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('edit_post',$data);
		$this->load->view('footer');

	
	}

	function delete_post($post_id){
		if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
		}
		$this->post->delete_post($post_id);
		redirect(base_url().'posts');

	}




}

?>