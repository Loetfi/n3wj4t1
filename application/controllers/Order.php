<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper("url");
		// $this->load->helper("az_core");
		// az_check_login();
	} 

	## card
	public function card()
	{  
		read_access();

		$data['title'] = 'Order Kartu Nama';
		// $data_header['subtitle'] = "";
		// $azapp->set_data_header($data_header);
		$data['sales'] = $this->db->query('select * from mssales where status = 1')->result_array();
		// lemparan  
		$data['cetak'] = $this->db->query('select * from msattrcetak where isoce = 0')->result_array();
		// print_r($data['cetak']);
		// exit();
		$data['finishing'] = $this->db->query('select * from msfinishing')->result_array();
		$data['laminating'] = $this->db->query('select * from mslaminating')->result_array();	


		// echo $azapp->render();
		

		// $data['item'] = $this->cart->contents();


		
		if (isset($_GET['reset'])) {
			$this->cart->destroy(); 
			redirect('order/card','refresh');
		}
		// $this->load->view('order/order', $data, FALSE);
		// $this->load->view('order/headerbaru', $data);
		$page = 'order/card';
		template($page , $data);

		// $this->load->view('order/card', $data);
		// $this->load->view('order/order', $data, FALSE);

		// echo "Halaman Order";
		
	}

	public function prosescard()
	{
		// echo "<pre>";
		if (isset($_POST)) { 
			// if (isset($_POST)) {  
			// $lemparan = array();

			// $_POST['order'] date("Y-m-d H:i:s" , strtotime($_POST['orderdate']))
 
			$lemparan = array( 
					'id'      => strtotime($this->input->post('orderdate')),
					'qty'     => $this->input->post('qty'),
					'price'   => 10,
					'idcustomer' => $this->input->post('idcustomer'),
					'name'    => $this->input->post('projectname'),
					'options' => array($_POST)
				);	
			// print_r($lemparan);
			$this->cart->insert($lemparan);   
			$array = array(
				'projectname' => $this->input->post('projectname'),
				'idcustomer' => $this->input->post('idcustomer')
			);
			
			$this->session->set_userdata( $array );

			redirect(site_url('order/card?tipeorder=').@$_POST['tipeorder'].'&deadline='.@$_POST['deadline'],'refresh');
 

		}
		else {
			redirect('order','refresh');
		}
	}

	// preview card 
	public function previewcard()
	{ 

		if (isset($_POST)) {	 

			$header = array(
				'customerid' 	=> $this->session->userdata('idcustomer'),//$items['options']['0']['idcustomer'], 
				'tipeorder' => 'card',
				'deadline' => @date('Y-m-d',strtotime($this->input->get('deadline'))),
				'projectname'	=> $this->session->userdata('projectname'),
				'tglorder'		=> date('Y-m-d H:i:s')
			);

			$array = array(
				'cardheader' => $header
			);
			
			$this->session->set_userdata( $array ); 

			$data = array(
				'title' => 'Preview Order Kartu Nama'
				);

			$page = 'order/previewcard';

			template($page , $data);
			
			// $this->load->view('order/headerbaru', $data, FALSE);
 
		} else {
			redirect('order','refresh');
		}
	}

	// save order 
	public function save()
	{
		// echo "<pre>";
		if (isset($_POST)) {	
			// print_r($this->cart->contents()); 
			// exit();

			// insert to table
			// insert header order 

			// echo date('Y-m-d H:i:s');

			$header = array(
				'customerid' 	=> $this->session->userdata('idcustomer'),//$items['options']['0']['idcustomer'], 
				'tipeorder' => 'card',
				'deadline' => @date('Y-m-d',strtotime($this->input->get('deadline'))),
				'projectname'	=> $this->session->userdata('projectname'),
				'sales'	=> $this->session->userdata('sales'),
				'tglorder'		=> date('Y-m-d H:i:s')
			);

			// print_r($header);
			// exit();
			$this->db->insert('trorder' , $header);
			$id = $this->db->insert_id();

			// print_r($header);
			// exit();

			foreach ($this->cart->contents() as $items): 

				$insert = array(
					'trorderid'		=> $id ,  
					'customerid' 	=> $items['options']['0']['idcustomer'], 
					'qty' => $items['options']['0']['qty'] , 
					'cetak' => $items['options']['0']['cetak'], 
					'kertas' => $items['options']['0']['productid'], 
					'laminating' => $items['options']['0']['laminating'] , 
					'finishing1' => implode(',', $items['options']['0']['finishing']) , 
					'finishing2' => "",//$items['options']['0']['finishing2'] , 
					'notes' => $items['options']['0']['notes'],
					'satuanproject' => $items['options']['0']['satuanproject']
				);

				// print_r($insert);
				$this->db->insert('trorderdetail' , $insert);

			endforeach;


			$this->session->set_flashdata('message_system', '<div class="alert alert-success"> Berhasil Menambah Orderan Baru</div>');

			// menghapus nama project 
			$this->session->unset_userdata('projectname');
			$this->session->unset_userdata('idcustomer');
			$this->session->unset_userdata('cardheader');
			// menghapus cart
			$this->cart->destroy();

			redirect('order/card','refresh');

			// exit();
		} else {
			redirect('order','refresh');
		}
	}
	## end card

	public function book()
	{ 
		// $data = array();
		read_access();

		$data['title'] = 'Order Buku';

		$data['ukuran'] = $this->db->query('select * from msukuran')->result_array();
		$data['cetak'] = $this->db->query('select * from msattrcetak where isoce = 0')->result_array();
		$data['cetak_oce'] = $this->db->query('select * from msattrcetak where isoce = 1')->result_array();
		$data['sales'] = $this->db->query('select * from mssales where status = 1')->result_array();
		$data['finishing'] = $this->db->query('select * from msfinishing')->result_array();
		$data['laminating'] = $this->db->query('select * from mslaminating')->result_array();	
		
		$data['mesin'] = $this->db->query("SELECT * from msmesin where status = 1 and book = 1")->result_array();
		// $this->load->view('order/headerbaru', $data, FALSE);
		// $this->load->view('order/book', $data, FALSE);

		if (isset($_GET['reset'])) {
			$this->cart->destroy(); 
			redirect('order/book','refresh');
		}

		$page = 'order/book';
		template($page , $data);


		// echo "Halaman Order";
		
	}


	public function prosesbook()
	{

		if (isset($_POST)) {
			// echo "<pre>";
			// print_r($_POST);
			// die();
 


			$data = array(
				'id'      => str_replace(' ', '', $this->input->post('orderdate')),
				'qty'     => 1,
				'price'   => '19.56',
				'name'    => 'sgsgsgs',
				'options' => $_POST
				//array('Size' => 'L', 'Color' => 'Red')
			);

			$this->cart->insert($data); 


			$array = array(
				'projectname' => $this->input->post('projectname'),
				'idcustomer' => $this->input->post('idcustomer'),
				'sales' => $this->input->post('sales'),
			);
			
			$this->session->set_userdata( $array );
			// print_r($data);
			// print_r($this->cart->contents());
			// exit();
			// redirect('order/card?tipeorder='.@$_POST['tipeorder'].'&deadline='.@$_POST['deadline'],'refresh');

			redirect('order/book?tipeorder='.@$_POST['tipeorder'].'&deadline='.@$_POST['deadline'],'refresh');

			// print_r($this->cart->contents());
		}
		else {
			redirect('order','refresh');
		}
	}

	// preview card 
	public function previewbook()
	{ 

		if (isset($_POST)) {

			$header = array(
				'customerid' 	=> $this->session->userdata('idcustomer'),//$items['options']['0']['idcustomer'], 
				'tipeorder' => 'card',
				'deadline' => @date('Y-m-d',strtotime($this->input->get('deadline'))),
				'projectname'	=> $this->session->userdata('projectname'),
				'tglorder'		=> date('Y-m-d H:i:s')
			);

			$array = array(
				'cardheader' => $header
			);
			
			$this->session->set_userdata( $array ); 

			$data = array(
				'title' => 'Preview Order Book'
				);

			$page = 'order/previewbook';

			template($page , $data);
			
			// $this->load->view('order/headerbaru', $data, FALSE);
 
		} else {
			redirect('order','refresh');
		}
	}

	public function savebook()
	{
		if (isset($_POST)) {	
			// print_r($this->session->all_userdata());
			$header = array(
				'customerid' 	=> $this->session->userdata('idcustomer'),//$items['options']['0']['idcustomer'], 
				'tipeorder' => 'book',
				'deadline' => @date('Y-m-d',strtotime($this->input->get('deadline'))),
				'projectname'	=> $this->session->userdata('projectname'),
				'tglorder'		=> date('Y-m-d H:i:s'),
				'sales'		=> $this->session->userdata('sales')
			);
		// print_r($header);
			$this->db->insert('trorder' , $header);
			$id = $this->db->insert_id();

			// print_r($header);
			// exit();

			// print_r($this->cart->contents());
			// exit();


			foreach ($this->cart->contents() as $items){

				$insert = array(
					'trorderid'		=> $id ,  
					// 'projectname' => $items['options']['projectname'],
					'sales' => $items['options']['sales'],
					// 'orderdate' => $items['options']['orderdate'],
					'customerid' => $items['options']['idcustomer'],
					'qty' => $items['options']['qty'],
					'ukurancover' => $items['options']['ukurancover'],
					'mesincover' => $items['options']['mesincover'],
					'cetakcover' => $items['options']['cetakcover'],
					'bahancover' => $items['options']['bahancover'],
					'laminatingcover' => $items['options']['laminatingcover'],
					'banyakhalamanisi' => $items['options']['banyakhalamanisi'],
					'cetakisi' => $items['options']['cetakisi'],
					'detailhalaman1' => $items['options']['detailhalaman1'],
					'mesinisi1' => $items['options']['mesinisi1'],
					'detailhalaman2' => $items['options']['detailhalaman2'],
					'mesinisi2' => $items['options']['mesinisi2'],
					'bahanisi' => $items['options']['bahanisi'],
					'finishing1' => implode(',', $items['options']['finishing']),
					'notes' => $items['options']['notes'] 
				);
				$this->db->insert('trorderdetail' , $insert);
			}

				// $insert = array(
				// 	'trorderid'		=> $id ,  
				// 	'customerid' 	=> $items['options']['0']['idcustomer'], 
				// 	'qty' => $items['options']['0']['qty'] , 
				// 	'cetak' => $items['options']['0']['cetak'], 
				// 	'kertas' => $items['options']['0']['productid'], 
				// 	'laminating' => $items['options']['0']['laminating'] , 
				// 	'finishing1' => implode(',', $items['options']['0']['finishing']) , 
				// 	'finishing2' => "",//$items['options']['0']['finishing2'] , 
				// 	'notes' => $items['options']['0']['notes'],
				// 	'satuanproject' => $items['options']['0']['satuanproject']
				// );

				// print_r($insert);
				$this->session->set_flashdata('message_system', '<div class="alert alert-success"> Berhasil Menambahkan Data </div>');

			// menghapus nama project 
				$this->session->unset_userdata('projectname');
				$this->session->unset_userdata('idcustomer');
				$this->session->unset_userdata('sales');
			// menghapus cart
				$this->cart->destroy();

				redirect('order/book','refresh');

			
		} else {
			echo "gagal !";
		}
	}


	public function removebook($rowid = '' , $projectname = '')
	{
		$data = array(
			'rowid' => $rowid,
			'qty'   => 0
		);

		$this->cart->update($data);
		$this->session->set_flashdata('message_system', '<div class="alert alert-success"> Berhasil Menghapus Orderan di Keranjang </div>');
		redirect('order/book?projectname='.$projectname,'refresh');
	}


	######################## BUKU ########################


	public function custom()
	{
		// $this->load->library('AZApp');
		// $azapp = $this->azapp; 
		// $data_header['title'] = 'ORDER';
		// $data_header['subtitle'] = "";
		// $azapp->set_data_header($data_header);

		// echo $azapp->render();
		$data = array();
		$this->load->view('order/headerbaru', $data, FALSE);
		$this->load->view('order/custom', $data, FALSE);
	}

	#### POD 
	public function pod()
	{	
		read_access();
		$data['title'] = "Order POD";

		$data['ukuran'] = $this->db->query('select * from msukuran')->result_array();
		$data['sales'] = $this->db->query('select * from mssales where status = 1')->result_array();
		$data['finishing'] = $this->db->query('select * from msfinishing')->result_array();
		
		$data['mesin'] = $this->db->query("SELECT * from msmesin where status = 1 and pod = 1")->result_array();

		// lemparan 
		$data['cetak'] = $this->db->query('select * from msattrcetak where isoce = 0')->result_array();
		// print_r($data['cetak']);
		// exit();
		$data['finishing'] = $this->db->query('select * from msfinishing')->result_array();
		$data['laminating'] = $this->db->query('select * from mslaminating')->result_array();	

		// print on demand 
		// $data = array();
		// $this->load->view('order/headerbaru', $data);
		// $this->load->view('order/pod', $data);
		if (isset($_GET['reset'])) {
			$this->cart->destroy(); 
			redirect('order/pod','refresh');
		}

		$page = 'order/pod';
		template($page , $data);


		// echo "Halaman Order";		
	}

	public function removepod($rowid = '' , $projectname = '')
	{
		$data = array(
			'rowid' => $rowid,
			'qty'   => 0
		);

		$this->cart->update($data);
		$this->session->set_flashdata('message_system', '<div class="alert alert-success"> Berhasil Menghapus Orderan di Keranjang </div>');
		redirect('order/pod?projectname='.$projectname,'refresh');
	}


	public function prosespod()
	{
		// echo "<pre>";
		if (isset($_POST)) { 
			// if (isset($_POST)) {  
			// $lemparan = array();

			// $_POST['order'] date("Y-m-d H:i:s" , strtotime($_POST['orderdate']))
 
			$lemparan = array( 
					'id'      => strtotime($this->input->post('orderdate')),
					'qty'     => $this->input->post('qty'),
					'price'   => 0,
					'idcustomer' => $this->input->post('idcustomer'),
					'name'    => $this->input->post('projectname'),
					'options' => array($_POST)
				);	
			// print_r($lemparan);
			$this->cart->insert($lemparan);   
			$array = array(
				'projectname' => $this->input->post('projectname'),
				'idcustomer' => $this->input->post('idcustomer')
			);
			
			$this->session->set_userdata( $array );

			redirect(site_url('order/pod?tipeorder=').@$_POST['tipeorder'].'&deadline='.@$_POST['deadline'],'refresh');
 

		}
		else {
			redirect('order','refresh');
		}
		/*
		// echo "<pre>";
		if (isset($_POST)) {  

			// print_r($_POST);
			// exit();

			$lemparan = array( 
					'id'      => str_replace(' ', '', $this->input->post('orderdate')), //str_replace(' ', '', $this->input->post('projectname')),
					'qty'     => $this->input->post('qty'),
					'price'   => 0,
					'idcustomer' => $this->input->post('idcustomer'),
					'name'    => $this->input->post('projectname'),
					'options' => array($_POST)
				);	

			$this->cart->insert($lemparan);  

			$array = array(
				'projectname' => $this->input->post('projectname'),
				'idcustomer' => $this->input->post('idcustomer'),
				'sales' => $this->input->post('sales'),
			);
			
			$this->session->set_userdata( $array );

			redirect('order/pod?tipeorder='.@$_POST['tipeorder'].'&deadline='.@$_POST['deadline'],'refresh');

		}

		else {
			redirect('order','refresh');
		}
		*/
	}

	public function previewpod()
	{
		if (isset($_POST)) {	 

			$header = array(
				'customerid' 	=> $this->session->userdata('idcustomer'),//$items['options']['0']['idcustomer'], 
				'tipeorder' => 'pod',
				'deadline' => @date('Y-m-d',strtotime($this->input->get('deadline'))),
				'projectname'	=> $this->session->userdata('projectname'),
				'tglorder'		=> date('Y-m-d H:i:s')
			);

			$array = array(
				'cardheader' => $header
			);
			
			$this->session->set_userdata( $array ); 

			$data = array(
				'title' => 'Preview POD'
				);

			$page = 'order/previewpod';

			template($page , $data);
			
			// $this->load->view('order/headerbaru', $data, FALSE);
 
		} else {
			redirect('order','refresh');
		}
	}

	public function savepod()
	{
		// echo "<pre>";
		if (isset($_POST)) {	 
			$header = array(
				'customerid' 	=> $this->session->userdata('idcustomer'),//$items['options']['0']['idcustomer'], 
				'tipeorder' 	=> 'pod',
				'deadline' 		=> @date('Y-m-d',strtotime($this->input->get('deadline'))),
				'projectname'	=> $this->session->userdata('projectname'),
				'tglorder'		=> date('Y-m-d H:i:s')
			); 

			$this->db->insert('trorder' , $header);
			$id = $this->db->insert_id();
 

			foreach ($this->cart->contents() as $items): 

				$insert = array(
					'trorderid'		=> $id ,  
					'customerid' 	=> $items['options']['0']['idcustomer'], 
					'qty' => $items['options']['0']['qty'] , 
					'cetak' => $items['options']['0']['cetak'], 
					'kertas' => $items['options']['0']['productid'], 
					'laminating' => $items['options']['0']['laminating'] , 
					'finishing1' => implode(',', $items['options']['0']['finishing']) , 
					'finishing2' => "",//$items['options']['0']['finishing2'] , 
					'notes' => $items['options']['0']['notes'],
					'satuanproject' => $items['options']['0']['satuanproject']
				);

				$this->db->insert('trorderdetail' , $insert);

			endforeach;


			$this->session->set_flashdata('message_system', '<div class="alert alert-success"> Berhasil Menambahkan Orderan Baru </div>');

			// menghapus nama project 
			$this->session->unset_userdata('projectname');
			$this->session->unset_userdata('idcustomer');
			$this->session->unset_userdata('sales');
			$this->session->unset_userdata('podheader');

			// menghapus cart
			$this->cart->destroy();

			redirect('order/pod','refresh');

			// exit();
		} else {
			redirect('order','refresh');
		}
	}
	## POD End

	## okl
	public function okl()
	{	
		read_access();
		$data['title'] = "Order OKL";

		$data['ukuran'] = $this->db->query('select * from msukuran')->result_array();
		$data['sales'] = $this->db->query('select * from mssales where status = 1')->result_array();
		$data['finishing'] = $this->db->query('select * from msfinishing')->result_array();
		
		$data['mesin'] = $this->db->query("SELECT * from msmesin where status = 1 and pod = 1")->result_array();

		// lemparan 
		$data['cetak'] = $this->db->query('select * from msattrcetak where isoce = 0')->result_array();
		// print_r($data['cetak']);
		// exit();
		$data['finishing'] = $this->db->query('select * from msfinishing')->result_array();
		$data['laminating'] = $this->db->query('select * from mslaminating')->result_array();	

		// print on demand 
		// $data = array();
		// $this->load->view('order/headerbaru', $data);
		// $this->load->view('order/pod', $data);
		if (isset($_GET['reset'])) {
			$this->cart->destroy(); 
			redirect('order/okl','refresh');
		}

		$page = 'order/okl';
		template($page , $data);


		// echo "Halaman Order";		
	}

	public function removeokl($rowid = '' , $projectname = '')
	{
		$data = array(
			'rowid' => $rowid,
			'qty'   => 0
		);

		$this->cart->update($data);
		$this->session->set_flashdata('message_system', '<div class="alert alert-success"> Berhasil Menghapus Orderan di Keranjang </div>');
		redirect('order/okl?projectname='.$projectname,'refresh');
	}


	public function prosesokl()
	{
		// echo "<pre>";
		if (isset($_POST)) { 
			// if (isset($_POST)) {  
			// $lemparan = array();

			// $_POST['order'] date("Y-m-d H:i:s" , strtotime($_POST['orderdate']))
 
			$lemparan = array( 
					'id'      => strtotime($this->input->post('orderdate')),
					'qty'     => $this->input->post('qty'),
					'price'   => 0,
					'idcustomer' => $this->input->post('idcustomer'),
					'name'    => $this->input->post('projectname'),
					'options' => array($_POST)
				);	
			// print_r($lemparan);
			$this->cart->insert($lemparan);   
			$array = array(
				'projectname' => $this->input->post('projectname'),
				'idcustomer' => $this->input->post('idcustomer')
			);
			
			$this->session->set_userdata( $array );

			redirect(site_url('order/okl?tipeorder=').@$_POST['tipeorder'].'&deadline='.@$_POST['deadline'],'refresh');
 

		}
		else {
			redirect('order','refresh');
		}
	}

	public function previewokl()
	{
		if (isset($_POST)) {	 

			$header = array(
				'customerid' 	=> $this->session->userdata('idcustomer'),//$items['options']['0']['idcustomer'], 
				'tipeorder' => 'okl',
				'deadline' => @date('Y-m-d',strtotime($this->input->get('deadline'))),
				'projectname'	=> $this->session->userdata('projectname'),
				'tglorder'		=> date('Y-m-d H:i:s')
			);

			$array = array(
				'cardheader' => $header
			);
			
			$this->session->set_userdata( $array ); 

			$data = array(
				'title' => 'Preview OKL'
				);

			$page = 'order/previewokl';

			template($page , $data);
			
			// $this->load->view('order/headerbaru', $data, FALSE);
 
		} else {
			redirect('order','refresh');
		}
	}

	public function saveokl()
	{
		// echo "<pre>";
		if (isset($_POST)) {	 
			$header = array(
				'customerid' 	=> $this->session->userdata('idcustomer'),//$items['options']['0']['idcustomer'], 
				'tipeorder' 	=> 'okl',
				'deadline' 		=> @date('Y-m-d',strtotime($this->input->get('deadline'))),
				'projectname'	=> $this->session->userdata('projectname'),
				'tglorder'		=> date('Y-m-d H:i:s')
			); 

			$this->db->insert('trorder' , $header);
			$id = $this->db->insert_id();
 

			foreach ($this->cart->contents() as $items): 

				$insert = array(
					'trorderid'		=> $id ,  
					'customerid' 	=> $items['options']['0']['idcustomer'], 
					'qty' => $items['options']['0']['qty'] , 
					'cetak' => $items['options']['0']['cetak'], 
					'kertas' => $items['options']['0']['productid'], 
					'laminating' => $items['options']['0']['laminating'] , 
					'finishing1' => implode(',', $items['options']['0']['finishing']) , 
					'finishing2' => "",//$items['options']['0']['finishing2'] , 
					'notes' => $items['options']['0']['notes'],
					'satuanproject' => $items['options']['0']['satuanproject']
				);

				$this->db->insert('trorderdetail' , $insert);

			endforeach;


			$this->session->set_flashdata('message_system', '<div class="alert alert-success"> Berhasil Menambahkan Orderan Baru </div>');

			// menghapus nama project 
			$this->session->unset_userdata('projectname');
			$this->session->unset_userdata('idcustomer');
			$this->session->unset_userdata('sales');
			$this->session->unset_userdata('podheader');

			// menghapus cart
			$this->cart->destroy();

			redirect('order/okl','refresh');

			// exit();
		} else {
			redirect('order','refresh');
		}
	}
	## end okl

	// remove item 
	public function remove($rowid = '' , $projectname = '')
	{
		$data = array(
			'rowid' => $rowid,
			'qty'   => 0
		);

		$this->cart->update($data);
		$this->session->set_flashdata('message_system', '<div class="alert alert-success"> Berhasil Menghapus Orderan di Keranjang </div>');
		redirect('order/card?projectname='.$projectname,'refresh');
	}

	// suvi edit
	public function saveHargaJual(){
		$dataUpdate = array(
			'hargaJual' => $_POST['hargaJual'],
		);
		$whereUpdate = array(
			'trorderdetailid' => $_POST['id'],
		);
		$this->db->where($whereUpdate);
		$updateHarga = $this->db->update('trorderdetail', $dataUpdate);
		if ($updateHarga) echo number_format($_POST['hargaJual'],2); else echo 'gagal';
		// print_r($_POST);
	}

}

/* End of file Order.php */
/* Location: ./application/azkasir/default/controllers/Order.php */
