<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Controller {
	public function index()
	{
		$this->load->model('user');
		$view_data['users'] = $this->user->display_all_users();
		$this->load->view('Dashboard', $view_data);
	}
}
