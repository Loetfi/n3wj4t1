<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
	}

	public function index()
	{
		read_access();
		$data['title'] = 'Sales';

		$page = 'sales/v_sales';
		// dd($data);
		template($page,$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('namasales', 'Nama Sales', 'trim|required');
		$this->form_validation->set_rules('namajabatan', 'Jabatan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Sales';
			$page = 'sales/f_sales';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			$data_sales = [
				'namasales' => $this->input->post('namasales'),
				'namajabatan' => $this->input->post('namajabatan'),
				'status' => 1,
			];

			$this->crud->create('mssales',$data_sales);

			$this->session->set_flashdata(['type'=>'success','message'=>'Sales berhasil ditambahkan.!']);

			return redirect('sales');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('namasales', 'Nama Sales', 'trim|required');
		$this->form_validation->set_rules('namajabatan', 'Jabatan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Update Sales';
			$data['sales'] = $this->crud->get_by_cond('mssales',['idsales'=>$id])->row_array();
			$page = 'sales/f_sales';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			$data_sales = [
				'namasales' => $this->input->post('namasales'),
				'namajabatan' => $this->input->post('namajabatan'),
				'status' => 1,
			];

			$this->crud->update('mssales',$data_sales,['idsales'=>$id]);

			$this->session->set_flashdata(['type'=>'success','message'=>'Sales berhasil diperbaharui.!']);

			return redirect('sales');
		}
	}

	public function delete($id)
	{
		$data_sales = [
				'status' => 0,
			];

		$this->crud->update('mssales',$data_sales,['idsales'=>$id]);

		$this->session->set_flashdata(['type'=>'success','message'=>'Sales berhasil dihapus.!']);

		return redirect('sales');
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
		$this->db->select('*');
		$this->db->from('mssales');
		$this->db->where('status = 1');
		$total=$this->db->count_all_results();

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
			$where = "namasales like '%$search%'  ";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('idsales','DESC');
		$query = $this->db->select('*')
				->from('mssales')
				->where('status = 1')
				->get();

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "namasales like '%$search%'  ";
			$this->db->where($where);
			$jum= $this->db->select('*')
				->from('mssales')
				->where('status = 1')
				->get();
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['namasales'] ,
				$value['namajabatan'] ,
				"<a href='".site_url('sales/update/'.$value['idsales'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('sales/delete/'.$value['idsales'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Sales.php */
/* Location: ./application/controllers/Sales.php */