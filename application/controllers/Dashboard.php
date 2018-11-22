<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller { 


	public function index()
	{ 
		$data['sesi'] = is_login();
		// print_r($this->session->all_userdata());
		$data['title']	= 'Dashboard';
		$page = 'contents/dashboard';

		template($page , $data);

		// print_r($data);
	}
}
