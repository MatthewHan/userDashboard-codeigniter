<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function message()
	{
		$this->load->model('post');
		$post = $this->input->post();
		$wall_id = $post['wall_user_id'];
		if($this->post->validate_message($post)==FALSE)
		{
			$this->session->set_flashdata('message_error', 'Post is empty');
		}
		else
		{
			$this->post->insert_message($post);
		}
		redirect("Users/show/{$wall_id}");
	}
	public function comment()
	{
		$this->load->model('post');
		$post = $this->input->post();
		$wall_id = $post['wall_user_id'];
		if($this->post->validate_comment($post)==FALSE)
		{
			$this->session->set_flashdata('comment_error'.$post['message_id'], 'Post is empty');
		}
		else
		{
			$this->post->insert_comment($post);
		}
		redirect("Users/show/{$wall_id}");
	}
	public function delete_comment()
	{
		$this->load->model('post');
		$post = $this->input->post();
		$user_id_for_comment = $this->post->check_user_by_comment_id($post['comment_id']);
		$wall_id = $post['wall_user_id'];
		if($this->session->userdata('id')==$user_id_for_comment['user_id'])
		{
			$this->post->delete_comment($post['comment_id']);
		}
		redirect("Users/show/{$wall_id}");
	}
	public function delete_message()
	{
		$this->load->model('post');
		$post = $this->input->post();
		$user_id_for_message = $this->post->check_user_by_message_id($post['message_id']);
		$wall_id = $post['wall_user_id'];
		if($this->session->userdata('id')==$user_id_for_message['user_id'])
		{
			$this->post->delete_message($post['message_id']);
		}
		redirect("Users/show/{$wall_id}");
	}

}
