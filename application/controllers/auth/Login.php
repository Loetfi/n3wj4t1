<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		$this->load->library('form_validation');
		// insert title 
		$data['title']	= 'Login';

		// load view contents
		$view = 'auth/login';

		

		$this->form_validation->set_rules('username', 'User Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			validation_errors('<div class="alert alert-error">', '</div>');
		} else {
			
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			if ($this->auth_model->login($username , $password)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Berhasil Login </div> ');

				redirect('dashboard','refresh');
				
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Gagal Login </div> ');
			}


		}

		template($view, $data , true);
		
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/auth/Login.php */
