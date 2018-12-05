<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Endroid\QrCode\QrCode;

class Qr extends CI_Controller {

	// require FCPATH . 'vendor/autoload.php';


	public function index()
	{
		// require FCPATH . 'vendor/autoload.php';
		// include APPPATH.'../vendor/autoload.php';
		// die();
		$params = $this->input->get('params') ? $this->input->get('params') : 0;
		$qrCode = new QrCode($params);

		header('Content-Type: '.$qrCode->getContentType());
		echo $qrCode->writeString();
		
	}

}

/* End of file Qr.php */
/* Location: ./application/controllers/Qr.php */
