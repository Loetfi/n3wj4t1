<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// use Endroid\QrCode\ErrorCorrectionLevel;
// use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
// use Endroid\QrCode\Response\QrCodeResponse;

class Inv extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('crud_model','crud');
	}

	public function index()
	{
		
	}

	public function detail($trorderid)
	{
		$order = $this->crud->get_by_cond('trorder',['trorderid'=>$trorderid])->row_array();

		if($order['qrcode'] == NULL) {
			$qrCode = new QrCode($order['projectname'].' - '. $order['tipeorder']);
			
			$qrCode->writeFile(APPPATH. '../assets/qrcode/'.str_replace(' ', '_',$order["projectname"]). '.png');
			
			$url_qrcode = [
				'qrcode' => str_replace(' ', '_',$order["projectname"]). '.png'
			];

			$this->crud->update('trorder',$url_qrcode , ['trorderid'=>$trorderid]);
		}



		$data['inv'] = $this->db->query("
			SELECT * 
			FROM inv_list_view 
			WHERE trorderid = '".@$trorderid."'
		")->row_array();
		
		if ($data['inv']['tipeorder'] == 'card'){
			$namaTableView = "inv_kartunama_detail_view";
			
		}
		else if ($data['inv']['tipeorder'] == 'book'){
			$namaTableView = "inv_book_detail_view";
			
		}

		else if ($data['inv']['tipeorder'] == 'pod'){
			$namaTableView = "inv_pod_detail_view";
		}

		else if ($data['inv']['tipeorder'] == 'okl'){
			$namaTableView = "inv_book_detail_view";
		}
		
		$data['item'] = $this->db->query("
			SELECT * 
			FROM ".$namaTableView."
			WHERE trorderid = '".@$trorderid."'
		")->result_array();

		$data['qrcode'] = $order['qrcode'];

		$data['title'] = 'Detail Invoice';

		$page = 'invoice/d_invoice';
		// dd($data);
		template($page,$data);	
	}

}

/* End of file Inv.php */
/* Location: ./application/controllers/Inv.php */