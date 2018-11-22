<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// $this->load->helper("array");
		// $this->load->helper("az_core");
		// az_check_login();
	}

	public function index(){
		// redirect('pembayaran/dp');
		$data['list'] = $this->db->query("
			SELECT
				a.pembayaranid,
				a.customerid,
				a.tipebayar,
				a.carabayar,
				a.codekhusus,
				a.nominal,
				a.statusbayar,
				a.tglbayar,
				a.keterangan,
				b.`name`,
				b.phone,
				b.address
			FROM `pembayaran` a
			LEFT JOIN customer b
				ON a.customerid = b.idcustomer
			ORDER BY a.pembayaranid DESC
			")->result_array();

		$data['title'] = 'Pembayaran';
		// $this->load->view('order/headerbaru', @$data, FALSE);
		// $this->load->view('pembayaran/list', @$data, FALSE);

		$page = 'pembayaran/list';
		template($page , $data);

	}
	
	public function dp(){
		$data = array(
			'title'	=> 'Pembayaran DP'
		);
		// $this->load->view('order/headerbaru', @$data, FALSE);
		// $this->load->view('pembayaran/dp', @$data, FALSE);

		$page = 'pembayaran/dp';
		template($page , $data);

	}
	public function dpAct(){
		$idcustomer  = $_POST['idcustomer'];
		$tipebayar  = $_POST['tipebayar'];
		$carabayar  = $_POST['carabayar'];
		$codekhusus  = $_POST['codekhusus'];
		$keterangan  = $_POST['keterangan'];
		
		$trorderidArray = @$_POST['trorderid'];
		$pembayaranArray = @$_POST['pembayaran'];
		
		if (count($trorderidArray) > 0){
			// get new id pembayaran
			$sqlGetLastId = $this->db->query("SELECT max(pembayaranid) lastId from pembayaran")->row_array();
			$pembayaranid = (int)$sqlGetLastId['lastId'] + 1;
			
			// list pembayaran detail
			for($i=0; $i<count($trorderidArray); $i++){
				
				$trorderid = $trorderidArray[$i];
				$nominal = $pembayaranArray[$trorderid];
				
				$insertPembayaranDetail = array(
					'pembayaranid' => $pembayaranid,
					'trorderid' => $trorderid,
					'nominal' => $nominal,
				);
				
				@$totalNominal += $nominal;
				
				$this->db->insert('pembayarandetail', $insertPembayaranDetail);
			}
			
			$insertPembayaran = array(
				'pembayaranid' => $pembayaranid,
				'customerid' => $idcustomer,
				'tipebayar' => $tipebayar,
				'carabayar' => $carabayar,
				'codekhusus' => $codekhusus,
				'nominal' => $totalNominal,
				'keterangan' => $keterangan,
				'tglbayar' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('pembayaran', $insertPembayaran);
			
			redirect('pembayaran/detail/'.$pembayaranid);
			// echo 'berhasil';
		}
		else {
			echo 'salah';
		}
		
		
		
		// echo '<pre>';
		// print_r($insertPembayaranDetail);
		// print_r($_POST);
	}
	
	
	public function pelunasan(){
		$data = array(
			'title'	=> 'Pembayaran Pelunasan'
		);
		$this->load->view('order/headerbaru', @$data, FALSE);
		$this->load->view('pembayaran/pelunasan', @$data, FALSE);
	}
	
	public function detail($id){
		$pembayaran = $this->db->query("SELECT * FROM pembayaran WHERE pembayaranid = '$id'")->row_array();
		
		$pembayarandetail = $this->db->query("SELECT * FROM pembayaran_detail_view WHERE pembayaranid = '$id'")->result_array();
		
		$detailCustomer = $this->db->query("SELECT * FROM customer WHERE idcustomer = '".$pembayaran['customerid']."'")->row_array();
		$data['pembayaran'] = $pembayaran;
		$data['pembayarandetail'] = $pembayarandetail;
		$data['detailCustomer'] = $detailCustomer;
		// echo '<pre>';
		// print_r($pembayaran);
		// print_r($pembayarandetail);
		// print_r($detailCustomer);
		// print_r($pembayarandetail);
		$this->load->view('order/headerbaru', @$data, FALSE);
		$this->load->view('pembayaran/detail', @$data, FALSE);
	}
	
	public function bukti($trorderid){
		
	}
	
}
