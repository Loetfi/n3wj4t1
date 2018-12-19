<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// use Endroid\QrCode\ErrorCorrectionLevel;
// use Endroid\QrCode\LabelAlignment;
// use Endroid\QrCode\QrCode;
// use Endroid\QrCode\Response\QrCodeResponse;

require_once APPPATH.'../phpqrcode/qrlib.php';


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
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../../qrcode'.DIRECTORY_SEPARATOR;
		// die();

    // outputs image directly into browser, as PNG stream
		$nama_file = $trorderid;
		$path = base_url('qrcode/'.$nama_file.'.png');
		$param = @$trorderid;
		QRcode::png($param, $PNG_TEMP_DIR.$nama_file.'.png', 'L', 4, 2);

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

		$data['qrcode'] = base_url('qrcode/'.$nama_file.'.png');// $order['qrcode'];

		$data['title'] = 'Detail Invoice';

		$page = 'invoice/d_invoice';
		// dd($data);
		template($page,$data);	
	}

}

/* End of file Inv.php */
/* Location: ./application/controllers/Inv.php */
