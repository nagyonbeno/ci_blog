<?php 

Class Comments extends CI_Controller{

	function __construct(){
			parent::__construct();
			$this->load->model('comment');
		}


	function new_comment(){

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
					'post_id' => $_POST['post_id'],
	 				'comment_statusz' => 1
					);
			
			$this->comment->insert_comment($data);
			redirect(base_url().'posts/post/'.$_POST['post_id']);
						} 

					}

				$this->load->helper('form');
				$this->load->view('new_comment',$data);
				
	
		}
			
		
		

	function delete_comment($comment_id){
			$this->load->model('post');
			$data['post']=$this->post->get_post($post_id);
			$data['comment']=$this->comment->get_comment($post_id);
			$this->comment->delete_comment($comment_id);
			redirect(base_url().'posts/post/'.$post['post_id']);

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
}
?>