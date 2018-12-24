<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan_qr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
		$this->load->model('customer_model','customer');
	}

	public function index()
	{
		read_access();
		$data['title'] = 'Scan QR';

		$page = 'scan/qr';

		if ($this->input->post('qr')) {
			$qr = $this->input->post('qr');
			$res = $this->db->query("SELECT * from inv_list_view a inner join customer b on a.customerid = b.idcustomer where a.trorderid = $qr ")->row_array();

			if ($res>0) {
				$data['data'] = $res;
			} else {
				$data['data'] = [];
			}


		}

		template($page,$data);
	} 

}

/* End of file Customer.php */
/* Location: ./application/controllers/auth/Customer.php */
