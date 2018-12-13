<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_unit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
		$this->load->model('product_unit_model','product_unit');
	}

	public function index()
	{
		$data['title'] = 'Unit Produk';

		$page = 'product/product_unit/v_product_unit';
		// dd($data);
		template($page,$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'Unit', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Produk Unit';
			$page = 'product/product_unit/f_product_unit';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			// dd($_POST);
			$data_category = [
				'name' => $this->input->post('name'),
				'created' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->login['username'],
			];

			$this->crud->create('product_unit',$data_category);

			$this->session->set_flashdata(['type'=>'success','message'=>'Produk unit berhasil ditambahkan.!']);

			return redirect('product_unit');	
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('name', 'Unit', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Produk Unit';
			$data['product_unit'] = $this->product_unit->get_by_id($id)->row_array();
			$page = 'product/product_unit/f_product_unit';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			// dd($_POST);
			$data_category = [
				'name' => $this->input->post('name'),
				'updated' => date('Y-m-d H:i:s'),
				'updatedby' => $this->session->login['username'],
			];

			$this->crud->update('product_unit',$data_category,['idproduct_unit'=>$id]);

			$this->session->set_flashdata(['type'=>'success','message'=>'Produk unit berhasil diperbaharui.!']);

			return redirect('product_unit');	
		}
	}

	public function delete($id)
	{
		$this->crud->delete('product_unit',['idproduct_unit'=>$id]);

		$this->session->set_flashdata(['type'=>'success','message'=>'Produk Unit berhasil dihapus.!']);

		return redirect('product_unit');
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
		$total=$this->db->count_all_results("product_unit");

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
			$where = "pu.name like '%$search%'  ";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('idproduct_unit','DESC');
		$query = $this->db->select('pu.*')
				->from('product_unit as pu')
				->get();

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "p.name like '%$search%'  ";
			$this->db->where($where);
			$jum= $this->db->select('pc.*')
				->from('product_unit as pu')
				->get();
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['name'] ,
				"<a href='".site_url('product_unit/update/'.$value['idproduct_unit'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('product_unit/delete/'.$value['idproduct_unit'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Product_unit.php */
/* Location: ./application/controllers/Product_unit.php */