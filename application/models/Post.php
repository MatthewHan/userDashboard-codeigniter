<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Model {
	public function __construct()
	{
		$this->load->library('form_validation');
	}


	public function validate_message($post)
	{
		$this->form_validation->set_rules('message','Message','required|trim');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function validate_comment($post)
	{
		$this->form_validation->set_rules('comment','Comment','required|trim');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function insert_message($post)
	{
		$query = "INSERT INTO messages(user_id, wall_user_id, message, created_at,updated_at)
				  VALUES (?,?,?,NOW(),NOW())";
		$values = array($post['user_id'],$post['wall_user_id'],$post['message']);
		$this->db->query($query,$values);
	}

	public function insert_comment($post)
	{
		$query = "INSERT INTO comments(message_id, user_id, comment, created_at,updated_at)
				  VALUES (?,?,?,NOW(),NOW())";
		$values = array($post['message_id'],$post['user_id'],$post['comment']);
		$this->db->query($query,$values);
	}

	public function display_wall_messages($userid)
	{
		$query = "SELECT CONCAT(users.first_name ,' ', users.last_name) as poster_name,messages.*
				  FROM messages JOIN users on messages.user_id = users.id
				  WHERE messages.wall_user_id = ?
				  ORDER BY messages.created_at DESC";
		$values = array($userid);
		$result = $this->db->query($query,$values)->result_array();
		return $result;
	}

	public function display_comments($messageid)
	{
		$query = "SELECT CONCAT(users.first_name ,' ', users.last_name) as poster_name,comments.*
				  FROM comments JOIN users on comments.user_id = users.id
				  JOIN messages on comments.message_id = messages.id
				  WHERE messages.id= ?
				  ORDER BY comments.created_at DESC";
		$values = array($messageid);
		$result = $this->db->query($query,$values)->result_array();
		return $result;
	}
	public function check_user_by_comment_id($id)
	{
		$query = "SELECT comments.user_id FROM comments WHERE comments.id = ?";
		$values = array($id);
		$result = $this->db->query($query,$values)->row_array();
		return $result;
	}

	public function check_user_by_message_id($id)
	{
		$query = "SELECT messages.user_id FROM messages WHERE messages.id = ?";
		$values = array($id);
		$result = $this->db->query($query,$values)->row_array();
		return $result;
	}
	public function delete_comment($commentid)
	{
		$query = "DELETE FROM comments WHERE id = ?";
		$values = array($commentid);
		$this->db->query($query,$values);
	}
	public function delete_message($messageid)
	{
		$query = "DELETE FROM messages WHERE id = ?";
		$values = array($messageid);
		$this->db->query($query,$values);
	}
}
