<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
		$this->load->model('product_model','product');
		$this->load->model('product_category_model','product_category');
		$this->load->model('product_unit_model','product_unit');
	}

	public function index()
	{
		$data['title'] = 'Data Produk';

		$page = 'product/product_data/v_product_data';
		// dd($data);
		template($page,$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('idproduct_category', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('idproduct_unit', 'Unit', 'trim|required');
		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|numeric');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|numeric');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah User';
			$data['list_category'] = $this->product_category->get_all();
			$data['list_unit'] = $this->product_unit->get_all();
			$page = 'product/product_data/f_product_data';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			$data_product_unit = [
				'idproduct_category'	=> $this->input->post('idproduct_category'),
				'idproduct_unit'	=> $this->input->post('idproduct_unit'),
				'barcode'	=> $this->input->post('barcode'),
				'name'	=> $this->input->post('name'),
				'price'	=> $this->input->post('price'),
				'stock'	=> $this->input->post('stock'),
				'description'	=> $this->input->post('description'),
				'created' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->login['username'],
			];

			$this->crud->create('product',$data_product_unit);

			$this->session->set_flashdata(['type'=>'success','message'=>'Data Produk berhasil ditambahkan.! ']);

			return redirect('product');

		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('idproduct_category', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('idproduct_unit', 'Unit', 'trim|required');
		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|numeric');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|numeric');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah User';
			$data['list_category'] = $this->product_category->get_all();
			$data['list_unit'] = $this->product_unit->get_all();
			$data['product'] = $this->product->get_by_id($id)->row_array();
			$page = 'product/product_data/f_product_data';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			$data_product_unit = [
				'idproduct_category'	=> $this->input->post('idproduct_category'),
				'idproduct_unit'	=> $this->input->post('idproduct_unit'),
				'barcode'	=> $this->input->post('barcode'),
				'name'	=> $this->input->post('name'),
				'price'	=> $this->input->post('price'),
				'stock'	=> $this->input->post('stock'),
				'description'	=> $this->input->post('description'),
				'updated' => date('Y-m-d H:i:s'),
				'updatedby' => $this->session->login['username'],
			];

			$this->crud->update('product',$data_product_unit,['idproduct'=>$id]);

			$this->session->set_flashdata(['type'=>'success','message'=>'Data Produk berhasil perbaharui.! ']);

			return redirect('product');

		}
	}

	public function delete($id)
	{
		$this->crud->delete('product',['idproduct'=>$id]);

		$this->session->set_flashdata(['type'=>'success','message'=>'Data produk berhasil dihapus.!']);

		return redirect('product');	
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
		$total=$this->db->count_all_results("product");

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
			$where = "p.name like '%$search%' or 
						p.barcode like '%$search%' or
						pc.name like '%$search%' or
						pu.name like '%$search%' ";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('name','ASC');
		$query = $this->db->select('p.*,pc.name as kategori, pu.name as unit')
				->from('product as p')
				->join('product_category as pc','pc.idproduct_category = p.idproduct_category')
				->join('product_unit as pu','pu.idproduct_unit = p.idproduct_unit')
				->get();

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "p.name like '%$search%' or 
						p.barcode like '%$search%' or
						pc.name like '%$search%' or
						pu.name like '%$search%' ";
			$this->db->where($where);
			$jum= $this->db->select('p.*,pc.name as kategori, pu.name as unit')
				->from('product as p')
				->join('product_category as pc','pc.idproduct_category = p.idproduct_category')
				->join('product_unit as pu','pu.idproduct_unit = p.idproduct_unit')
				->get();
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['barcode'] ,
				$value['name'] ,
				$value['unit'] ,
				$value['kategori'] ,
				"<a href='".site_url('product/update/'.$value['idproduct'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('product/delete/'.$value['idproduct'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */