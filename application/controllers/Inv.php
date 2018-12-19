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
		$data['title'] = 'Data Invoice';

		$page = 'invoice/v_invoice';
		// dd($data);
		template($page,$data);
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

		/*Menghitung total desa didalam database*/
		$total=$this->db->count_all_results("inv_list_view");

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
						name like '%$search%'  ";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('trorderid','DESC');
		$query = $this->db->get('inv_list_view');

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "projectname like '%$search%' or
						name like '%$search%'  ";
			$this->db->where($where);
			$jum= $this->db->get('inv_list_view');
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['name'] ,
				$value['projectname'] ,
				$value['totalharga'] ,
				$value['statusorder'] ,
				"<a href='".site_url('inv/update/'.$value['trorderid'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('inv/detail/'.$value['trorderid'])."' class='btn btn-xs btn-primary'> <span class='glyphicon glyphicon-eye-open'></span>  Detail</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}
}

/* End of file Inv.php */
/* Location: ./application/controllers/Inv.php */
