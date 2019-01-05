<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('transaction_model','transaction');
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

	public function filter()
	{
		// dd($_GET);
		$id = $this->input->get('idcustomer');
		$start = date_format(date_create($this->input->get('transaction_date_1')),'Y-m-d');
		$end = date_format(date_create($this->input->get('transaction_date_2')), 'Y-m-d');

		$data['list_customer'] = $this->customer->get_all_select2();
		$data['filter'] = $this->transaction->get_by_filter($id, $start, $end)->result_array();
		$page = 'laporan/result_filter';

		template($page , $data);
	}
}
