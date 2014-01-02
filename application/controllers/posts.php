<?php

Class Posts extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('post');
		$this->load->model('comment');
	}

	function index($start=0){
		$data['errors'] = "";
		if($_POST){

			$config = array(

			array(
				'field'  => 'search',
				'label'	 => 'Search',
				'rules'  => 'required|min_length[3]'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			} else {

			$valami = $this->input->post('search',true);
			$search = $this->db->escape_like_str($valami);
			$data['search']=$this->input->post('search',true);
			$data['posts']=$this->post->search($search,5,$start);
			$data['count']=$this->post->get_posts_count_search($search);

			$this->load->library('pagination');
		
			$config['base_url'] = base_url().'posts/index/';
			$config['total_rows'] = $this->post->get_posts_count_search($search);
			$config['per_page'] = 5;

			
			$this->pagination->initialize($config);
			
			$data['pages']=$this->pagination->create_links();
			}
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
		$data['errors']=$this->session->flashdata('data');
		$data['post']=$this->post->get_post($post_id);
		$data['comment']=$this->comment->get_comment($post_id);

		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'posts/post/'.$post_id.'/';
		$config['total_rows'] = $this->comment->get_comments_count($post_id);
		$config['per_page'] = 3;
		$config['uri_segment'] = 4;
		
		$this->pagination->initialize($config);
		
		$data['pages']=$this->pagination->create_links();

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
			$status = $this->input->post('statusz',true);
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
			
			);
			

			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			$this->form_validation->set_rules('hashtag','Tags','min_length[3]|callback_hashtag_check');
			
			function hashtag_check(){
			$hashtag = $this->input->post('hashtag',true);
			$regex = '[a-z0-9A-Z,]';
			if(!preg_match($regex,$hashtag))
			{
				$this->form_validation->set_message('hashtag’, ‘Please enter a valid hashtag.');
				return FALSE;
			} else {
				return TRUE;
			}
			}
			if($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			} else {
			$data=array(
				'cim' 		  => htmlspecialchars($_POST['cim']),
				'post_szoveg' => htmlspecialchars($_POST['post_szoveg']),
				'felh_id'	  => $this->session->userdata('user_id'),
				'hashtag' 	  => htmlspecialchars($_POST['hashtag']),
				'statusz'	  => isset($status)?$status:"0"
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
		if($_POST){
			$status = $this->input->post('statusz',true);
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
				'statusz'	  => $status
				);

		$this->post->update_post($post_id,$data_post);
		redirect (base_url().'posts/');
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


	function posts_approve($start=0){
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
		$data['errors'] = "";
		if($_POST){

			$config = array(

			array(
				'field'  => 'search',
				'label'	 => 'Search',
				'rules'  => 'required|min_length[3]'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			} else {

			$valami = $this->input->post('search',true);
			$search = $this->db->escape_like_str($valami);
			$data['search']=$this->input->post('search',true);
			$data['posts']=$this->post->approve_search($search,5,$start);
			$data['count']=$this->post->get_approve_posts_count_search($search);

			$this->load->library('pagination');
		
			$config['base_url'] = base_url().'posts/posts_approve/';
			$config['total_rows'] = $this->post->get_approve_posts_count_search($search);
			$config['per_page'] = 5;

			
			$this->pagination->initialize($config);
			
			$data['pages']=$this->pagination->create_links();
			}
		} else {

			$data['posts']=$this->post->get_posts_approve(5,$start);
			
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'posts/posts_approve/';
			$config['total_rows'] = $this->post->get_approve_posts_count();
			$config['per_page'] = 5;
			
			$this->pagination->initialize($config);
			
			$data['pages']=$this->pagination->create_links();
		}

		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('post_approve_index',$data);
		$this->load->view('footer');
	}




	function approve_post($post_id){
		if(!$this->correct_permissions('author')){
			redirect(base_url().'users/login');
		}
		$data['errors']=$this->session->flashdata('data');
		$data['post']=$this->post->get_approve_post($post_id);

		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'posts/post/'.$post_id.'/';
		$config['total_rows'] = $this->comment->get_comments_count($post_id);
		$config['per_page'] = 3;
		$config['uri_segment'] = 4;
		
		$this->pagination->initialize($config);
		
		$data['pages']=$this->pagination->create_links();

		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('approve_post',$data);
		$this->load->view('footer');
	}



	function approve_edit_post($post_id){
		if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
		}
		$data['errors'] = "";
		if($_POST){
			$status = $this->input->post('statusz',true);
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
				'statusz'	  => $status
				);

		$this->post->approve_update_post($post_id,$data_post);
		redirect (base_url().'posts/posts_approve/');
		} 
		}
		$data['post']=$this->post->get_approve_post($post_id);
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('approve_edit_post',$data);
		$this->load->view('footer');

	
	}

	function hashtag_posts($hashtag,$start=0){
			
			$data['posts']=$this->post->hashtag_search($hashtag,5,$start);
			$data['count']=$this->post->hashtag_search_count($hashtag);
			$data['hashtag']=$hashtag;

			$this->load->library('pagination');
		
			$config['base_url'] = base_url().'posts/hashtag_posts/'.$hashtag;
			$config['total_rows'] = $this->post->hashtag_search_count($hashtag);
			$config['per_page'] = 5;
			$config['uri_segment'] = 4;

			
			$this->pagination->initialize($config);
			
			$data['pages']=$this->pagination->create_links();
	

		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('hashtag_search_index',$data);
		$this->load->view('footer');
	}



}

?>