<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
		$this->load->model('product_category_model','product_category');
	}

	public function index()
	{
		$data['title'] = 'Kategori Produk';

		$page = 'product/product_category/v_product_category';
		// dd($data);
		template($page,$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'Kategori', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Produk Kategori';
			$page = 'product/product_category/f_product_category';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			// dd($_POST);
			$data_category = [
				'name' => $this->input->post('name'),
				'created' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->login['username'],
			];

			$this->crud->create('product_category',$data_category);

			$this->session->set_flashdata(['type'=>'success','message'=>'Produk kategori berhasil ditambahkan.!']);

			return redirect('product_category');	
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('name', 'Kategori', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Produk Kategori';
			$data['product_category'] = $this->product_category->get_by_id($id)->row_array();
			$page = 'product/product_category/f_product_category';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			// dd($_POST);
			$data_category = [
				'name' => $this->input->post('name'),
				'updated' => date('Y-m-d H:i:s'),
				'updatedby' => $this->session->login['username'],
			];

			$this->crud->update('product_category',$data_category,['idproduct_category'=>$id]);

			$this->session->set_flashdata(['type'=>'success','message'=>'Produk kategori berhasil diperbaharui.!']);

			return redirect('product_category');	
		}
	}

	public function delete($id)
	{
		$this->crud->delete('product_category',['idproduct_category'=>$id]);

		$this->session->set_flashdata(['type'=>'success','message'=>'Produk kategori berhasil dihapus.!']);

		return redirect('product_category');
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
		$total=$this->db->count_all_results("product_category");

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
			$where = "pc.name like '%$search%'  ";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('idproduct_category','DESC');
		$query = $this->db->select('pc.*')
				->from('product_category as pc')
				->get();

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "pc.name like '%$search%'  ";
			$this->db->where($where);
			$jum= $this->db->select('pc.*')
				->from('product_category as pc')
				->get();
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['name'] ,
				"<a href='".site_url('product_category/update/'.$value['idproduct_category'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('product_category/delete/'.$value['idproduct_category'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Product_category.php */
/* Location: ./application/controllers/product/Product_category.php */