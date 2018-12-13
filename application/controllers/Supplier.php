<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
		$this->load->model('supplier_model','supplier');
	}

	public function index()
	{
		$data['title'] = 'Data Produk';

		$page = 'supplier/v_supplier';
		// dd($data);
		template($page,$data);	
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim');
		$this->form_validation->set_rules('phone', 'No. Telp', 'trim|required|numeric');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Supplier';
			$page = 'supplier/f_supplier';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			$data_supplier = [
				'name'	=> $this->input->post('name'),
				'address'	=> $this->input->post('address'),
				'phone'	=> $this->input->post('phone'),
				'description'	=> $this->input->post('description'),
			];

			$this->crud->create('supplier',$data_supplier);

			$this->session->set_flashdata(['type'=>'success','message'=>'Supplier berhasil ditambahkan.! ']);

			return redirect('supplier');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim');
		$this->form_validation->set_rules('phone', 'No. Telp', 'trim|required|numeric');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Supplier';
			$data['supplier'] = $this->supplier->get_by_id($id)->row_array();
			$page = 'supplier/f_supplier';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			$data_supplier = [
				'name'	=> $this->input->post('name'),
				'address'	=> $this->input->post('address'),
				'phone'	=> $this->input->post('phone'),
				'description'	=> $this->input->post('description'),
			];

			$this->crud->update('supplier',$data_supplier,['idsupplier'=>$id]);

			$this->session->set_flashdata(['type'=>'success','message'=>'Supplier berhasil diperbaharui.! ']);

			return redirect('supplier');
		}
	}

	public function delete($id)
	{
		$this->crud->delete('supplier',['idsupplier'=>$id]);

		$this->session->set_flashdata(['type'=>'success','message'=>'Supplier berhasil dihapus.!']);

		return redirect('supplier');
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
		$total=$this->db->count_all_results("supplier");

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
			$where = "name like '%$search%' or 
						address like '%$search%' or
						phone like '%$search%' or
						description like '%$search%' ";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('name','ASC');
		$query = $this->db->select('*')
				->from('supplier')
				->get();

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "name like '%$search%' or 
						address like '%$search%' or
						phone like '%$search%' or
						description like '%$search%' ";
			$this->db->where($where);
			$jum= $this->db->select('*')
				->from('supplier')
				->get();
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['name'] ,
				$value['phone'] ,
				$value['address'] ,
				$value['description'] ,
				"<a href='".site_url('supplier/update/'.$value['idsupplier'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('supplier/delete/'.$value['idsupplier'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */