<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$data['title'] = 'Manajemen Group';

		$page = 'manajemen/group/v_group';
		// dd($data);
		template($page,$data);	
	}

	public function create()
	{
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');

		$this->form_validation->set_rules('group_name', 'Nama Group', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Group';
			$page = 'manajemen/group/f_group';

			template($page, $data);
		} else {
			$data = [
				'group_name'	=> strtolower($this->input->post('group_name')),
				'description'	=> ucwords($this->input->post('group_name')),
				'created'		=> date('Y-m-d H:i:s'),
				'createdby'		=> 'System'
			];

			$this->crud->create('group',$data);

			$this->session->set_flashdata(['type'=>'success','message'=>'Group berhasil ditambahkan.!']);

			return redirect('manajemen/group');	
		}
	}

	public function update($id)
	{
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');

		$this->form_validation->set_rules('group_name', 'Nama Group', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Group';
			$data['group'] = $this->crud->get_by_cond('group',['idgroup'=>$id])->row_array();
			$page = 'manajemen/group/f_group';

			template($page, $data);
		} else {
			$data = [
				'group_name'	=> strtolower($this->input->post('group_name')),
				'description'	=> ucwords($this->input->post('group_name')),
				'updated'		=> date('Y-m-d H:i:s'),
				'updatedby'		=> $this->session->username ? $this->session->username : null,
			];

			$this->crud->update('group',$data,['idgroup'=>$id]);

			$this->session->set_flashdata(['type'=>'success','message'=>'Group berhasil diperbaharui.!']);

			return redirect('manajemen/group');	
		}
	}

	public function delete($id)
	{
		$this->load->model('crud_model','crud');

		$this->crud->delete('group',['idgroup'=>$id]);
		$this->session->set_flashdata(['type'=>'danger','message'=>'Group berhasil dihapus.!']);

		return redirect('manajemen/group');	
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
		$total=$this->db->count_all_results("group");

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
			$this->db->like("group_name",$search);
		}


		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('idgroup','DESC');
		$query=$this->db->get('group');

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$this->db->like("group_name",$search);
			$jum=$this->db->get('group');
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['description'] ,
				"<a href='".site_url('manajemen/group/update/'.$value['idgroup'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('manajemen/group/delete/'.$value['idgroup'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Group.php */
/* Location: ./application/controllers/manajemen/Group.php */