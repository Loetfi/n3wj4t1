<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
	}

	public function wo($trorderid = null)
	{
		$data['order'] = $this->crud->get_by_cond('trorder',['trorderid'=>$trorderid])->row_array();
		$data['detail_order'] = $this->crud->get_by_cond('trorderdetail',['trorderid'=>$trorderid])->result_array(); 

		if ($data['order']['tipeorder'] == 'card') {
			$this->load->view('print/wo', $data, FALSE);
		}elseif($data['order']['tipeorder'] == 'book') {
			echo ' belum ada book format';
		}elseif($data['order']['tipeorder'] == 'pod') {
			echo ' belum ada pod format';
		}elseif($data['order']['tipeorder'] == 'okl') {
			echo ' belum ada okl format';
		} else {
			echo 'tidak ada jenis order format';
		}
		
	}

}

/* End of file Print.php */
/* Location: ./application/controllers/Print.php */
