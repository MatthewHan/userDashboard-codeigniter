<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends CI_Controller {
	public function index()
	{
		$this->load->model('user');
		$view_data['user'] = $this->user->find_user_by_id($this->session->userdata('id'));
		$this->load->view('Profile', $view_data);
	}
	public function update_profile()
	{
		$this->load->model('user');

		if($this->user->validate_update($this->input->post())==FALSE)
		{
			$this->index();
		}
		else
		{
			$user = $this->user->find_user_dashboard($this->input->post());
			if($user)
			{
				$post = $this->input->post();
				unset($post['confirm_password']);
				$this->user->update_user($post);
				$this->session->set_userdata('name', $post['first_name'] . " " . $post['last_name']);
				$this->session->set_flashdata('update_success', 'You have successfully updated your profile');
			}
			else
			{
				$this->session->set_flashdata('update_error','Incorrect Password');
			}
			redirect("/profile");
		}
	}
	public function update_password()
	{
		$this->load->model('user');
		if($this->user->validate_update_password($this->input->post())==FALSE)
		{
			$this->index();
		}
		else
		{	
			$post = $this->input->post();
			$post['password'] = $post['current_password'];
			unset($post['confirm_new_password']);
			unset($post['confirm_current_password']);
			unset($post['current_password']);
			$user = $this->user->find_user_dashboard($post);
			if($user)
			{
				$this->user->update_password($post);
				$this->session->set_flashdata('update_success', 'You have successfully updated your password');
			}
			else
			{
				$this->session->set_flashdata('password_update_error','Incorrect Password');
			}
			redirect("/profile");
		}
	}
}
