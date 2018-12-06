<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// use Endroid\QrCode\QrCode;
require_once APPPATH.'../phpqrcode/qrlib.php';

class Qr extends CI_Controller {

	// require FCPATH . 'vendor/autoload.php';


	public function index()
	{
		// include('../lib/full/qrlib.php');
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../../qrcode'.DIRECTORY_SEPARATOR;
		// die();

    // outputs image directly into browser, as PNG stream
		$nama_file = rand(1,1111);
		echo $path = base_url('qrcode/'.$nama_file.'.png');
		$param = $this->input->get('param');
		QRcode::png($param, $PNG_TEMP_DIR.$nama_file.'.png', 'L', 4, 2);

		// $tempDir = APPPATH.'../qrcode';
		// file_get_contents('oke.png', QRcode::png('PHP QR Code :)'));

		die();

		$codeContents = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a'; 
		QRcode::png($codeContents, $tempDir.'006_L1.png', QR_ECLEVEL_L); 
		// require FCPATH . 'vendor/autoload.php';
		// include APPPATH.'../vendor/autoload.php';
		// die();
		// $params = $this->input->get('params') ? $this->input->get('params') : 0;
		// $qrCode = new QrCode($params);

		// header('Content-Type: '.$qrCode->getContentType());
		// echo $qrCode->writeString();
		
	}

}

/* End of file Qr.php */
/* Location: ./application/controllers/Qr.php */
