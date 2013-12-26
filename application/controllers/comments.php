<?php 

Class Comments extends CI_Controller{

function __construct(){
		parent::__construct();
		$this->load->model('comment');
	}


function new_comment($post_id){

			$data['errors'] = "";
		if($_POST){

			$config = array(

			'field'  => 'comment',
			'label'	 => 'Leave a comment',
			'rules'  => 'required|min_length[3]'
				
		
			);

			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			} else {
			$data=array(
				'comment_szoveg'  => htmlspecialchars($_POST['comment']),
				'comment_felh_id' => $this->session->userdata('user_id'),
				'comment_post_id' => $post_id,
 				'comment_statusz' => 1
				);
		
		$this->comment->insert_comment($data);
		redirect(base_url().'posts/post');
	} 
	}
		
	
	}

}
?>