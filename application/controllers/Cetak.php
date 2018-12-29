<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../phpqrcode/qrlib.php';

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

	public function qr($trorderid = null)
	{
		
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../../qrcode'.DIRECTORY_SEPARATOR;
		// die();

    // outputs image directly into browser, as PNG stream
		$nama_file = $trorderid;
		$path = base_url('qrcode/'.$nama_file.'.png');
		$param = $nama_file;
		QRcode::png($param, $PNG_TEMP_DIR.$nama_file.'.png', 'L', 4, 2);

		// $tempDir = APPPATH.'../qrcode';
		// file_get_contents('oke.png', QRcode::png('PHP QR Code :)'));
		// die();
		$data['order'] = $this->crud->get_by_cond('trorder',['trorderid'=>$trorderid])->row_array();
		$data['detail_order'] = $this->crud->get_by_cond('trorderdetail',['trorderid'=>$trorderid])->result_array(); 
		$data['path'] = $path;
		$data['trorderid'] = $trorderid;

		$this->load->view('print/qr', $data, FALSE);
	}

}

/* End of file Print.php */
/* Location: ./application/controllers/Print.php */
