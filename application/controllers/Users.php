<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function show($id)
	{
		$this->load->model('user');
		$this->load->model('post');
		$view_data['user'] = $this->user->find_user_by_id($id);
		$view_data['messages'] = $this->post->display_wall_messages($id);
		for($i=0;$i<count($view_data['messages']);$i++)
		{
			$view_data['messages'][$i]['comments'] = $this->post->display_comments($view_data['messages'][$i]['id']);
		}
		if($view_data['user'])
		{
			$this->load->view('User',$view_data);
		}
		else
		{
			show_404('Users/show/$id');
		}
	}

	public function edit($id)
	{
		$this->load->model('user');
		$view_data['user'] = $this->user->find_user_by_id($id);
		if($this->session->userdata('user_level') == 'admin')
		{
			if($view_data['user'])
			{
				$this->load->view('Edit',$view_data);
			}
			else
			{
				show_404('Users/edit/$id');
			}
		}
		else
		{
			$this->index();
		}
		
	}
	public function update_profile_admin($id)
	{
		$this->load->model('user');

		if($this->user->validate_admin_update($this->input->post())==FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$user = $this->user->find_user_dashboard($this->input->post());
			if($user)
			{
				$post = $this->input->post();
				$this->user->update_user($post);
				$this->session->set_userdata('name', $post['first_name'] . " " . $post['last_name']);
				$this->session->set_flashdata('update_success', 'You have successfully updated your profile');
			}
			else
			{
				$this->session->set_flashdata('update_error','Incorrect Password');
			}
			redirect("/Users/edit/$id")
		}
	}
	public function update_password_admin($id)
	{
		die('admin password update');
		$this->load->model('user');
		if($this->user->validate_admin_update_password($this->input->post())==FALSE)
		{
			$this->edit($id);
		}
		else
		{	
			$post = $this->input->post();
			$post['password'] = $post['current_password'];
			unset($post['confirm_new_password']);
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
			redirect("/Users/edit/$id")
		}
	}

}
