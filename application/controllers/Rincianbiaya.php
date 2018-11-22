<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rincianbiaya extends CI_Controller {

	public function index()
	{
		$data = array();
		// $this->load->view('order/headerbaru', $data, FALSE);
		// $this->load->view('order/order', $data, FALSE);
		// echo "oke";		

		$id = $this->input->get('id');
		$orderid = $this->input->get('orderid');

		$data['project'] = $this->db->query("SELECT * from trorder where trorderid = $orderid ")->row_array();	

		$data['databiaya'] = $this->db->query("SELECT  * from  trorderrincianbiaya where trorderdetailid = $id ")->result_array();
		$data['ambildetail'] = $this->db->query("SELECT * from trorder a join trorderdetail b on a.trorderid = b.trorderid where b.trorderdetailid = $id ")->row_array();

		$page = 'rincianbiaya/perincian';
		template($page , $data);
	}

	public function removekeranjang($rowid = '' , $id = '' , $orderid = '')
	{
		// $id = $_GET['id'];

		// $data = array(
		// 	'rowid' => $rowid,
		// 	'qty'   => 0
		// );

		// $this->cart->update($data);

		//deltee 
		$query = $this->db->query("DELETE from trorderrincianbiaya where trorderrincianid = $rowid ");
		if ($query) {
			// save harga penjualan berdasarkan trorderdetailid
			$this->saveHargaJual($id);
			
			$this->session->set_flashdata('message_system', '<div class="alert alert-warning"> Berhasil Menghapus Item Rincian Biaya</div>');
			redirect('rincianbiaya/index?id='.$id.'&orderid='.$orderid , 'refresh');
		} else {

			$this->session->set_flashdata('message_system', '<div class="alert alert-info"> Upps ada kesalahan</div>');
			redirect('rincianbiaya/index?id='.$id.'&orderid='.$orderid , 'refresh');

		}
		exit();

	}

	public function save($value='')
	{
		echo "<pre>";
		print_r($this->cart->contents());
		// print_r($th 

		foreach ($this->cart->contents() as $items):  

			// id=49&orderid=39
			$insert = array(
				'trorderid'		=> $_GET['orderid'],
				'trorderdetailid'		=> $_GET['id'], 
				'koderincian' => $items['name'],  
				'qty' => $items['qty'] ,
				'uprice' => $items['price'] / $items['qty'],
				'jumlah' => $items['price'], 
				'createdate' => date('Y-m-d H:i:s'), 
				'byuser' => $this->session->userdata('iduser') ? $this->session->userdata('iduser') : 0  
			); 
			// print_r($insert);

			$this->db->insert('trorderrincianbiaya' , $insert);

		endforeach;	

		// save harga penjualan berdasarkan trorderdetailid
		$this->saveHargaJual($_GET['id']);
		
		$this->cart->destroy();

		// echo "berhasil ";
		$this->session->set_flashdata('message_system', '<div class="alert alert-warning"> Berhasil Menambahkan Rincian</div>');
		redirect('transaksi/detail/'.$orderid , 'refresh');
		// redirect('','refresh')

	}

	public function savekeranjang()
	{ 
		// print_r($_POST);

		$id = $this->input->get('id');
		$orderid = $this->input->get('orderid');


		// print_r($_POST);
		// print_r($_GET);
		// exit(); 

		$insert = array(
			'trorderid'		=> $orderid,
			'trorderdetailid'		=> $id,  
			'koderincian' => $this->input->post('koderincianbiaya'),
			'qty' => $this->input->post('qty'),
			'uprice' => $this->input->post('totalrincian') / $this->input->post('qty'), //$items['price'] / $items['qty'],
			'jumlah' => $this->input->post('totalrincian'), 
			'createdate' => date('Y-m-d H:i:s'), 
			'byuser' => $this->session->userdata('iduser') ? $this->session->userdata('iduser') : 0  
		); 

		$this->db->insert('trorderrincianbiaya' , $insert);
		// print_r($insert);
		// exit();
			// print_r($insert);


		// $data = array(
		// 	'id'      => $this->input->post('koderincianbiaya'),
		// 	'qty'     => $this->input->post('qty'),
		// 	'price'   => $this->input->post('totalrincian'),
		// 	'name'    => $this->input->post('koderincianbiaya'),
		// 	'options' => array()
		// );
		
		// $this->cart->insert($data);

		// print_r($this->cart->contents());
		
		
		// save harga penjualan berdasarkan trorderdetailid
		$this->saveHargaJual($_GET['id']);
		
		redirect('rincianbiaya/index?id='.$id.'&orderid='.$orderid ,'refresh');
	}



	public function get_data(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");

		$offset = ($page - 1) * $limit;

		$this->db->order_by("idrincianbiaya");
		if (strlen($q) > 0) {
			$this->db->or_like("koderincian", $q);
			$this->db->or_like("namarincian", $q);
			$this->db->or_like("harga", $q);
		}
		$this->db->select("idrincianbiaya as id, koderincian as text");

		$data = $this->db->get("rincianbiaya", $limit, $offset);

		if (strlen($q) > 0) {
			// $this->db->like("name", $q);
			$this->db->or_like("koderincian", $q);
			$this->db->or_like("namarincian", $q);
			$this->db->or_like("harga", $q);
		}
		$cdata = $this->db->get("rincianbiaya");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
			"results" => $data->result_array(),
			"pagination" => array(
				"more" => $morePages
			)
		);
		echo json_encode($results);
	}
	
	/* save harga setiap project item (trorderdetailid) berdasarkan bahan2-nya */
	public function saveHargaJual($trorderdetailid){
		
		$query = $this->db->query("select sum(jumlah) hargaJual from trorderrincianbiaya where trorderdetailid = '".$trorderdetailid."'")->row_array();
		
		$dataUpdate = array(
			'hargaJual' => $query['hargaJual'],
		);
		$whereUpdate = array(
			'trorderdetailid' => $trorderdetailid,
		);
		$this->db->where($whereUpdate);
		$updateHarga = $this->db->update('trorderdetail', $dataUpdate);
		// if ($updateHarga) echo number_format($_POST['hargaJual'],2); else echo 'gagal';
		// print_r($_POST);
	}
}

/* End of file Rincianbiaya.php */
/* Location: ./application/azkasir/default/controllers/Rincianbiaya.php */
