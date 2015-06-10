<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logins extends CI_Controller {
	public function index()
	{
		$this->load->view('login');
	}
	public function login_process()
	{
		$this->load->model('user');
		if($this->user->validate_login($this->input->post())==FALSE)
		{
			$this->index();
		}
		else
		{
			$user = $this->user->find_user($this->input->post());
			if($user)
			{
				$this->session->set_userdata('id', $user['id']);
				$this->session->set_userdata('name', $user['first_name'] . " " . $user['last_name']);
				$this->session->set_userdata('logged_on',1);
				$this->session->set_userdata('user_level',$user['user_level']);
				$this->session->set_flashdata('success', 'You have successfully signed in');
				redirect("/Users/show/{$user['id']}");
			}
			else
			{
				$this->session->set_flashdata('login_error','Email/Password Combination Does Not Match');
				$this->index();
			}
		}
		$this->session->set_flashdata('login_errors','Email/Password does not match');
	}
	public function register_process()
	{
		$this->load->model('user');
		if($this->user->validate_reg($this->input->post())==FALSE)
		{
			$this->index();
		}
		else
		{
			$this->user->insert_user($this->input->post());
			$this->session->set_flashdata('registered', 'You have successfully registered. Please login to continue.');
			$this->index();
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
