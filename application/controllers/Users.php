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
			if($this->session->userdata('user_level')=='admin')
			{
				$post = $this->input->post();
				$this->user->admin_update_user($post);
				$this->session->set_flashdata('update_success', 'You have successfully updated the profile');
			}
			else
			{
				$this->session->set_flashdata('update_error','You do not have access');
			}
			redirect("/Users/edit/$id");
		}
	}
	public function update_password_admin($id)
	{
		$this->load->model('user');
		if($this->user->validate_admin_update_password($this->input->post())==FALSE)
		{
			$this->edit($id);
		}
		else
		{	
			$post = $this->input->post();
			unset($post['confirm_new_password']);
			if($this->session->userdata('user_level')=='admin')
			{
				$this->user->update_password($post);
				$this->session->set_flashdata('update_success', 'You have successfully updated the password');
			}
			else
			{
				$this->session->set_flashdata('password_update_error','You do not have access');
			}
			redirect("/Users/edit/$id");
		}
	}

	public function delete($id)
	{
		if($this->session->userdata('user_level')=='admin')
		{
			$this->load->model('user');
			$this->user->delete_user($id);
			$this->session->set_flashdata('delete_success', 'You have successfully deleted the user');
		}
		else
		{
			$this->session->set_flashdata('delete_user_error','You do not have access');
		}
		redirect('/Dashboards');
	}

	public function add_new_user()
	{
		if($this->session->userdata('user_level')=='admin')
		{
			$this->load->view('AddUser');
		}
		else
		{
			$this->session->set_flashdata('delete_user_error','You do not have access');
			redirect('/Dashboards');
		}
			
	}
	public function add_new_user_process()
	{
		$this->load->model('user');
		if($this->user->validate_reg($this->input->post())==FALSE)
		{
			$this->add_new_user();
		}
		else
		{
			$this->user->insert_user($this->input->post());
			$this->session->set_flashdata('update_success', 'User successfully added');
			redirect('/Dashboards');
		}
	}

}
