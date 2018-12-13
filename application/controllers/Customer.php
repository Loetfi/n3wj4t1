<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
		$this->load->model('customer_model','customer');
	}

	public function index()
	{
		$data['title'] = 'Customer';

		$page = 'customer/v_customer';

		template($page,$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('phone', 'No Telp', 'trim|required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Customer';
			$page = 'customer/f_customer';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			// dd($_POST);
			$data_customer = [
				'name' => $this->input->post('name'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'organization' => $this->input->post('organization'),
				'created' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->login['username'],
			];

			$this->crud->create('customer',$data_customer);

			$this->session->set_flashdata(['type'=>'success','message'=>'Customer berhasil ditambahkan.!']);

			return redirect('customer');	
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('phone', 'No Telp', 'trim|required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Customer';
			$data['customer'] = $this->customer->get_by_id($id)->row_array();
			$page = 'customer/f_customer';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			// dd($_POST);
			$data_customer = [
				'name' => $this->input->post('name'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'organization' => $this->input->post('organization'),
				'updated' => date('Y-m-d H:i:s'),
				'updatedby' => $this->session->login['username'],
			];

			$this->crud->update('customer',$data_customer,['idcustomer'=>$id]);

			$this->session->set_flashdata(['type'=>'success','message'=>'Customer berhasil diperbaharui.!']);

			return redirect('customer');	
		}
	}

	public function delete($id)
	{
		$this->crud->delete('customer',['idcustomer'=>$id]);

		$this->session->set_flashdata(['type'=>'success','message'=>'Customer berhasil dihapus.!']);

		return redirect('customer');

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
		$total=$this->db->count_all_results("customer");

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
			$where = "c.name like '%$search%' or 
						c.address like '%$search%' or 
						c.phone like '%$search%' or 
						c.organization like '%$search%'";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('idcustomer','DESC');
		$query = $this->db->select('c.*')
				->from('customer as c')
				->get();

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "c.name like '%$search%' or 
						c.address like '%$search%' or 
						c.phone like '%$search%' or 
						c.organization like '%$search%'";
			$this->db->where($where);
			$jum= $this->db->select('c.*')
				->from('customer as c')
				->get();
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['name'] ,
				$value['gender'] ,
				$value['phone'] ,
				$value['address'] ,
				$value['organization'] ,
				"<a href='".site_url('customer/update/'.$value['idcustomer'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('customer/delete/'.$value['idcustomer'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	/*
	public function get_data(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");

		$offset = ($page - 1) * $limit;

		$this->db->order_by("name");
		if (strlen($q) > 0) {
			$this->db->like("name", $q);
		}
		$this->db->select("idcustomer as id, name as text");

		$data = $this->db->get("customer", $limit, $offset);

		if (strlen($q) > 0) {
			$this->db->like("name", $q);
		}
		$cdata = $this->db->get("customer");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}
	*/

}

/* End of file Customer.php */
/* Location: ./application/controllers/auth/Customer.php */
