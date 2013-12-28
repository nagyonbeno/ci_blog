<?php 

Class Comments extends CI_Controller{

	function __construct(){
			parent::__construct();
			$this->load->model('comment');
		}


	function new_comment(){

				
			if($_POST){
				$config = array(
					array(
				'field'  => 'comment',
				'label'	 => 'Leave a comment',
				'rules'  => 'required|min_length[3]'
					)
			
				);

				$this->load->library('form_validation');
				$this->form_validation->set_rules($config);
				if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata('data', validation_errors());
					redirect(base_url().'posts/post/'.$_POST['post_id']);
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

				
	
		}
			
		
		

	function delete_comment($comment_id){
			if(!$this->correct_permissions('admin')){
			redirect(base_url().'users/login');
			}
			$this->comment->delete_comment($comment_id);
			redirect( $_SERVER["HTTP_REFERER"] );

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