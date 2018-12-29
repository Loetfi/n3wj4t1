<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('customer_model','customer');
		$this->load->model('crud_model','crud');
	}

	public function index()
	{
		// read_access();
		$data['title'] = 'Laporan';
		$data['list_customer'] = $this->customer->get_all_select2();
		$page = 'laporan/v_list';

		template($page , $data);
	}
}
