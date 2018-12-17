<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work_order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
	}

	public function index()
	{
		$data['title'] = 'Work order';

		$page = 'work_order/v_work_order';
		// dd($data);
		template($page,$data);
	}

	public function detail($trorderid)
	{
		$data['title'] = 'Detail Work order';
		$data['order'] = $this->crud->get_by_cond('trorder',['trorderid'=>$trorderid])->row_array();
		$data['detail_order'] = $this->crud->get_by_cond('trorderdetail',['trorderid'=>$trorderid])->result_array(); 

		$page = 'work_order/d_work_order';
		// dd($data);
		template($page,$data);	
	}

	public function get_data()
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
			$where = "projectname like '%$search%' or 
						name like '%$search%' or
						tipeorder like '%$search%'  ";
			$this->db->where($where);
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
			$where = "projectname like '%$search%' or 
						name like '%$search%' or
						tipeorder like '%$search%' ";
			$this->db->where($where);
			$jum=$this->db->get('inv_list_view');
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;
		foreach ($query->result_array() as $desa) {
			$output['data'][]=array(
				$nomor_urut,
				$desa['name'] , 
				$desa['projectname'], 
				date('d F Y , H:i:s' , strtotime($desa['tglorder'])), 
				$desa['tipeorder'] , 
				$desa['totalharga'] != "" ?  number_format($desa['totalharga']) : '', 
				$desa['sisapembayaran'] != "" ?  number_format($desa['sisapembayaran']) : '',
					// $desa['sisapembayaran'] , 

				$desa['deadline'] ,
				"<a href='".site_url('work_order/detail/'.$desa['trorderid'])."' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-trashs'></span>  Detail</a>
				"
				// <a href='".site_url('transaksi/edit/'.$desa['trorderid'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Work_order.php */
/* Location: ./application/controllers/Work_order.php */