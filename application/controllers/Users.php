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
}
