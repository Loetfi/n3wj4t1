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
		$this->table = "product";
	}

	public function index()
	{
		read_access();
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

	public function get() {
		$this->load->library('AZApp');
		$azapp = $this->azapp;
        $crud = $azapp->add_crud();

    	$crud->set_select('product.id'.$this->table.', product.barcode, product.name as product_name, product_category.name as product_category_name, product_unit.name as product_unit_name, product.price, product.stock');
    	$crud->set_select_table('product.barcode, product_name, product_unit_name, product_category_name, product.price, product.stock');
    	$crud->add_join("product_category", "left");
    	$crud->add_join("product_unit", "left");
    	$crud->set_order_by("product_name");
    	$crud->set_select_align(", , center, , right, center");
    	$crud->set_select_number("4, 5");
    	$crud->set_table($this->table);
    	$crud->set_sorting("product.barcode, product.name, product_unit_name, product_category_name, price, stock");
    	$crud->set_id($this->table);

		echo $crud->get_table();
	}

	public function get_info() {

		// echo "";

		// die();
		$this->load->library('AZApp');
		$azapp = $this->azapp;
        $crud = $azapp->add_crud();

		// $crud->set_edit(false);
		// $crud->set_delete(false);
		// $crud->set_custom_btn('btn_select');

    	$gtable = $this->table;
    	$crud->set_select('product.id'.$this->table.', product.barcode, product.name, product_unit.name as product_unit_name, product.price, product.stock');
    	$crud->set_select_table("barcode, name, product_unit_name, price, stock");
    	$crud->add_join("product_unit", "left");
    	$crud->set_order_by("product.name");
    	$crud->set_select_align(", , center, right, center");
    	$crud->set_select_number("3, 4");
    	$crud->set_filter('name');
    	$crud->set_table($this->table);
    	$crud->set_sorting('barcode, name, product_unit_name, price, stock');
    	$crud->set_id($this->table);

		echo $crud->get_table();
	}

	public function get_info_customer() {
		$this->load->library('AZApp');
		$azapp = $this->azapp;
        $crud = $azapp->add_crud();

		$crud->set_edit(false);
		$crud->set_delete(false);
		$crud->set_custom_btn('btn_select');

    	$gtable = $this->table;
    	$crud->set_select("product.id".$this->table.", product.barcode, product.name, product_unit.name as product_unit_name, product.price, '' as customer_price, product.stock");
    	$crud->set_select_table("barcode, name, product_unit_name, price, customer_price, stock");
    	$crud->add_join("product_unit", "left");
    	$crud->set_order_by("product.name");
    	$crud->set_select_align(", , center, right, right, center");
    	$crud->set_select_number("3, 4, 5");
    	$crud->set_filter('name');
    	$crud->set_table($this->table);
    	$crud->set_sorting('barcode, name, product_unit_name, price, stock');
    	$crud->set_id($this->table);
    	$crud->set_custom_style('custom_style_price');

		echo $crud->get_table();
	}

	public function custom_style_price($column, $value, $data) {
		if ($column == 'customer_price') {
			$data_declare = "
				<script>
					var selected_customer = jQuery('#idcustomer').val() || 0;
				</script>
			";
			return $data_declare;
		}
		return $value;
	}

	public function btn_select($data) {
		$this->load->helper("array");
		$idproduct = htmlentities(azarr($data, "idproduct"));
		$barcode = htmlentities(azarr($data, "barcode"));
		$name = htmlentities(azarr($data, "name"));
		$price = htmlentities(azarr($data, "price"));
		$stock = htmlentities(azarr($data, "stock"));

		$btn = '<button type="button" class="btn btn-info btn-xs btn-select-product" data-dismiss="modal" data-idproduct='.$idproduct.' data-barcode= '.$barcode.' data-name="'.$name.'" data-price="'.$price.'" data-stock="'.$stock.'"><span class="glyphicon glyphicon-arrow-down"></span> Pilih</button>';
		return $btn;
	}

	public function edit() {
		$id = $this->input->post("id");
		$this->db->select("product.id".$this->table.", product.idproduct_unit, idproduct_category, barcode, product.name, product.description, price, stock");
		$this->db->where("id".$this->table, $id);

		$rdata = $this->db->get($this->table)->result_array();
		echo json_encode($rdata);
	}

	public function save(){
		$data = array();
		$data["sMessage"] = "";
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$validation = 'barcode, name, price';
		$validation_text = 'Barcode/Kode Barang, Nama Produk, Harga';

		$this->form_validation->set_rules('barcode', azlang('Barcode'), 'required|trim|max_length[20]');
		$this->form_validation->set_rules('idproduct_category', azlang('Category'), 'trim|numeric');
		$this->form_validation->set_rules('name', azlang('Product Name'), 'required|trim|max_length[30]');
		$this->form_validation->set_rules('idproduct_unit', azlang('Unit'), 'trim|numeric');
		$this->form_validation->set_rules('price', azlang('Price'), 'required|trim|max_length[15]');
		$this->form_validation->set_rules('description', azlang('Description'), 'trim|max_length[100]');

		$data_post = $this->input->post();

		$err_code = '';
		$err_message = '';

		$str_price = azarr($data_post, "price");
		$str_price = str_replace(".", "", $str_price);

		if($this->form_validation->run() == TRUE){
			$idpost = azarr($data_post, 'id'.$this->table);
			$idproduct_unit = azarr($data_post, "idproduct_unit");
			$idproduct_category = azarr($data_post, "idproduct_category");
			if (strlen($idproduct_unit) == 0) {
				$idproduct_unit = NULL;
			}
			if (strlen($idproduct_category) == 0) {
				$idproduct_category = NULL;
			}
			
			if (!is_numeric($str_price)) {
				$err_code++;
				$err_message = azlang('Price not valid');
			}

			if ($err_code == 0) {
				$data_save = array(
					"name" => azarr($data_post, "name"),
					"idproduct_unit" => $idproduct_unit,
					"idproduct_category" => $idproduct_category,
					"barcode" => azarr($data_post, "barcode"),
					"price" => $str_price,
					"description" => azarr($data_post, "description"),
					"updated" => Date("Y-m-d H:i:s"),
					"updatedby" => $this->session->userdata("username")
				);

				if($idpost == ""){
					$data_save["created"] = Date("Y-m-d H:i:s");
					$data_save["createdby"] = $this->session->userdata("username");
					if(!$this->db->insert($this->table, $data_save)){
						$err = $this->db->error();
						$err_code = $err["code"];
						$err_message = $err["message"];
					}
				}
				else {
					$this->db->where("id".$this->table, $idpost);
					if (!$this->db->update($this->table, $data_save)) {
						$err = $this->db->error();
						$err_code = $err["code"];
						$err_message = $err["message"];
					}
				}
			}
		}

		if ($err_code == "1062") {
			$err_message = 	azlang('Barcode already used, please user another barcode');
		}

		$data["sMessage"] = validation_errors().$err_message;
		echo json_encode($data);
	}

	/*
	public function delete() {
		$id = $this->input->post("id");

		if (is_array($id)) {
			$this->db->where_in("id".$this->table, $id);
		}
		else {
			$this->db->where("id".$this->table, $id);
		}

		$this->db->delete($this->table);

		echo json_encode("SUCCESS");
	}
	*/

	public function generate_barcode() {
		$this->load->helper("az_config");
		$prefix = az_get_config('prefix_barcode');

		$this->db->where("substring(barcode, 5) REGEXP '^-?[0-9]+$'");
		$this->db->where("substring(barcode, 1, 4) = '".$prefix."-'");
		$this->db->order_by("substring(barcode, 5) + 0 desc");
		$data = $this->db->get("product", 1);

		if ($data->num_rows() == 0) {
			$return = $prefix."-001";
		}
		else {
			$data_barcode = $data->row()->barcode;
			$data_barcode = str_replace($prefix."-", "", $data_barcode);
			$data_barcode = $data_barcode + 1;
			$data_barcode = sprintf($prefix."-%03d", $data_barcode);
			$return = $data_barcode;
		}
		echo json_encode(array("return" => $return));
	}


	public function get_single_product() {
		$post = $this->input->post();
		$data = array();

		$barcode = azarr($post, "barcode");

		$this->db->where("barcode", $barcode);
		$data_db = $this->db->get("product");

		if ($data_db->num_rows() > 0) {
			$data["sMessage"] = "";
			$data["result"] = $data_db->result_array();
		}
		else {
			$data["sMessage"] = "Data tidak ditemukan";
		}

		echo json_encode($data);
	}
}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */