<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// $this->load->helper("array");
		// $this->load->helper("az_core");
		// az_check_login();
	}

	public function ambildata()
	{
		/*Menagkap semua data yang dikirimkan oleh client*/

		/*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
		server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
		sesuai dengan urutan yang sebenarnya */
		$draw=@$_REQUEST['draw'];

		/*Jumlah baris yang akan ditampilkan pada setiap page*/
		$length=@$_REQUEST['length'];

		/*Offset yang akan digunakan untuk memberitahu database
		dari baris mana data yang harus ditampilkan untuk masing masing page
		*/
		$start=@$_REQUEST['start'];

		/*Keyword yang diketikan oleh user pada field pencarian*/
		$search=@$_REQUEST['search']["value"];
		
		/*Id Customer yang dilipih pada combobox*/
		$idcustomer=@$_REQUEST['idcustomer'];


		/*Menghitung total desa didalam database*/
		$total=$this->db->count_all_results("trorder");

		/*Mempersiapkan array tempat kita akan menampung semua data
		yang nantinya akan server kirimkan ke client*/
		$output=array();

		/*Token yang dikrimkan client, akan dikirim balik ke client*/
		$output['draw']=$draw;

		/*
		$output['recordsTotal'] adalah total data sebelum difilter
		$output['recordsFiltered'] adalah total data ketika difilter
		Biasanya kedua duanya bernilai sama, maka kita assignment 
		keduaduanya dengan nilai dari $total
		*/
		$output['recordsTotal']=$output['recordsFiltered']=$total;

		/*disini nantinya akan memuat data yang akan kita tampilkan 
		pada table client*/
		$output['data']=array();


		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
			$this->db->like("projectname",$search);
		}


		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('trorderid','DESC');
		$query=$this->db->get('inv_list_view');


		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$this->db->like("projectname",$search);
			$jum=$this->db->get('inv_list_view');
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;
		foreach ($query->result_array() as $desa) {
			$output['data'][]=array(
				$nomor_urut,
				$desa['name'] , 
				$desa['projectname'].'|'.@$idcustomer, 
				date('d F Y , H:i:s' , strtotime($desa['tglorder'])), 
				$desa['tipeorder'] , 
				$desa['totalharga'] != "" ?  number_format($desa['totalharga']) : '', 
				$desa['sisapembayaran'] != "" ?  number_format($desa['sisapembayaran']) : '',
					// $desa['sisapembayaran'] , 

				$desa['deadline'] ,
				"<a href='".site_url('transaksi/detail/'.$desa['trorderid'])."' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-trashs'></span>  Detail</a>
				<a href='".site_url('transaksi/edit/'.$desa['trorderid'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	public function index()
	{
		read_access();
		$data['title'] = "List Order";
		// $this->load->library('AZApp');
		// $azapp = $this->azapp; 
		// $data_header['title'] = 'ORDER';
		// $data_header['subtitle'] = "";
		// $azapp->set_data_header($data_header);

		$orderan = $this->db->query("SELECT a.* , b.name from trorder a 
			inner join customer b on a.customerid = b.idcustomer
			order by tglorder desc")->result();
		$data['orderan'] = $orderan;

		// echo $azapp->render();
		// $data = array();
		// $this->load->view('order/headerbaru', $data, FALSE);
		// $this->load->view('transaksi/list', $data, FALSE);

		$page = 'transaksi/lists';
		template($page , $data);

		// echo "Halaman Order";
		
	}


	public function detail($idorder )
	{

		$data['title'] = 'Detail Order';
		$header = $this->db->query("SELECT * from trorder where trorderid = $idorder ")->row();	

		$orderan = $this->db->query("SELECT * from trorder a inner join trorderdetail b on a.trorderid = b.trorderid where a.trorderid = $idorder ")->result();
		$data['detail'] = $orderan;
		$data['header'] = $header;
		// $page = 'order/headerbaru', $data, FALSE);

		// cek tipe order
		$querycek = $this->db->query("SELECT tipeorder from trorder where trorderid = '$idorder' ")->row_array();
		
		if ($querycek['tipeorder'] == "card") {
			$page = 'transaksi/detail';
		} elseif ($querycek['tipeorder']== "book") {
			$page = 'transaksi/detailbook';
		} elseif ($querycek['tipeorder'] == "pod") {
			$page = 'transaksi/detailpod';
		} elseif ($querycek['tipeorder'] == "okl") {
			$page = 'transaksi/detailokl';
		} else {
			echo "Tipe order tidak ada";
			die();
		}

		template($page , $data);


	}

	public function customer(){
		
		$idcustomer = $_REQUEST['idcustomer'];
		
		$this->db->where('customerid',$idcustomer);
		$this->db->order_by('trorderid','DESC');
		$query=$this->db->get('inv_list_view');
		
		foreach ($query->result_array() as $desa) {
			$output['data'][]=array(
				$nomor_urut,
				$desa['projectname'], 
				date('d F Y , H:i:s' , strtotime($desa['tglorder'])), 
				$desa['tipeorder'] , 
				$desa['totalharga'] != "" ?  number_format($desa['totalharga']) : '', 
				$desa['sisapembayaran'] != "" ?  number_format($desa['sisapembayaran']) : '',
					// $desa['sisapembayaran'] , 

				$desa['deadline'] ,
				"<a href='".site_url('transaksi/detail/'.$desa['trorderid'])."' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-trashs'></span>  Detail</a>
				<a href='".site_url('transaksi/edit/'.$desa['trorderid'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}
		echo json_encode($output);
	}

}

/* End of file Order.php */
/* Location: ./application/azkasir/default/controllers/Order.php */
