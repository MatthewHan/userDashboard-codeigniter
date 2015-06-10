<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function validate_reg($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name','First Name','required|trim|ucwords');
		$this->form_validation->set_rules('last_name','Last Name','required|trim|ucwords');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|strtolower');
		$this->form_validation->set_rules('password','Password','required|trim|min_length[6]|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function validate_update($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name','First Name','required|trim|ucwords');
		$this->form_validation->set_rules('last_name','Last Name','required|trim|ucwords');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|strtolower');
		$this->form_validation->set_rules('password','Password','required|trim|min_length[6]|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function validate_update_password($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]|matches[confirm_new_password]|md5');
		$this->form_validation->set_rules('confirm_new_password','Confirm New Password','required');
		$this->form_validation->set_rules('current_password','Password','required|trim|min_length[6]|matches[confirm_current_password]|md5');
		$this->form_validation->set_rules('confirm_current_password','Confirm Password','required');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function insert_user($post)
	{
		$query = "INSERT INTO users(first_name, last_name, email, password, created_at, updated_at)
				  VALUES (?,?,?,?,NOW(),NOW())";
		$values = array($post['first_name'],$post['last_name'],$post['email'],$post['password']);
		$this->db->query($query,$values);
	}

	public function update_user($post)
	{
		$query = "UPDATE users
				  SET first_name = ?,
				  	  last_name = ?,
				  	  email = ?,
				  	  description = ?,
				  	  updated_at = NOW()
				  WHERE id = {$post['user_id']}";
		$values = array($post['first_name'],$post['last_name'],$post['email'],$post['description']);
		$this->db->query($query,$values);
	}

	public function validate_login($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login_email', 'Email', 'required');
		$this->form_validation->set_rules('login_password','Password','required|trim|md5');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function find_user($post)
	{
		$query = 'SELECT * FROM Users WHERE email = ? AND password = ?';
		$values = array($post['login_email'], $post['login_password']);
		$result = $this->db->query($query, $values)->row_array();
		return $result;
	}

	public function find_user_dashboard($post)
	{
		$query = 'SELECT * FROM Users WHERE id = ? AND password = ?';
		$values = array($post['user_id'], $post['password']);
		$result = $this->db->query($query, $values)->row_array();
		return $result;
	}

	public function find_user_by_id($id)
	{
		$query = 'SELECT id, first_name, last_name, email, description, user_level, created_at, updated_at FROM Users WHERE id = ?';
		$values = array($id);
		$result = $this->db->query($query, $values)->row_array();
		return $result;
	}

	public function display_all_users()
	{
		$query = "SELECT id, CONCAT(first_name , ' ',last_name) as name, email, created_at,user_level
			      FROM users";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
}
