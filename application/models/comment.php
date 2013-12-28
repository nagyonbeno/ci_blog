<?php

class Comment extends CI_Model{



	function get_comment($post_id,$num=20,$start=0){
		$this->db->select()->from ('comments')->join('users','comments.comment_felh_id = users.user_id')->where(array('comment_statusz'=>1,'post_id'=>$post_id))->order_by('comments.comment_datum','desc')->limit($num,$start);
		$query = $this->db->get();
		return $query->result_array();
	}



	function insert_comment($data){
		$this->db->insert('comments',$data);
		return $this->db->insert_id();
	}


	function delete_comment($comment_id){
		$this->db->where('comment_id',$comment_id);
		$this->db->delete('comments');
	}

	function get_comments_count($post_id){
		$this->db->select('comment_id')->from('comments')->where(array('comment_statusz'=>1,'post_id'=>$post_id));
		$query = $this->db->get();
		return $query->num_rows();
	}

}

?>