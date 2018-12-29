<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ukuran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
	}

	public function index()
	{
		read_access();
		$data['title'] = 'Ukuran';

		$page = 'ukuran/v_ukuran';
		// dd($data);
		template($page,$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('namaukuran', 'Nama Ukuran', 'trim|required');
		$this->form_validation->set_rules('panjang', 'Panjang', 'trim|required|numeric');
		$this->form_validation->set_rules('lebar', 'Lebar', 'trim|required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Ukuran';
			$page = 'ukuran/f_ukuran';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			$data_ukuran = [
				'namaukuran' => $this->input->post('namaukuran'),
				'panjang' => $this->input->post('panjang'),
				'lebar' => $this->input->post('lebar'),
			];

			$this->crud->create('msukuran',$data_ukuran);

			$this->session->set_flashdata(['type'=>'success','message'=>'Ukuran berhasil ditambahkan.!']);

			return redirect('ukuran');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('namaukuran', 'Nama Ukuran', 'trim|required');
		$this->form_validation->set_rules('panjang', 'Panjang', 'trim|required|numeric');
		$this->form_validation->set_rules('lebar', 'Lebar', 'trim|required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Ukuran';
			$data['ukuran'] = $this->crud->get_by_cond('msukuran',['idukuran'=>$id])->row_array();
			$page = 'ukuran/f_ukuran';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);
		} else {
			$data_ukuran = [
				'namaukuran' => $this->input->post('namaukuran'),
				'panjang' => $this->input->post('panjang'),
				'lebar' => $this->input->post('lebar'),
			];

			$this->crud->update('msukuran',$data_ukuran,['idukuran'=>$id]);

			$this->session->set_flashdata(['type'=>'success','message'=>'Ukuran berhasil diperbaharui.!']);

			return redirect('ukuran');
		}
	}

	public function delete($id)
	{
		$this->crud->delete('msukuran',['idukuran'=>$id]);

		$this->session->set_flashdata(['type'=>'success','message'=>'Ukuran berhasil dihapus.!']);

		return redirect('ukuran');
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
		$total=$this->db->count_all_results("msukuran");

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
			$where = "namaukuran like '%$search%'  ";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('idukuran','DESC');
		$query = $this->db->select('*')
				->from('msukuran')
				->get();

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "namaukuran like '%$search%'  ";
			$this->db->where($where);
			$jum= $this->db->select('*')
				->from('msukuran')
				->get();
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['namaukuran'] ,
				$value['panjang'] ,
				$value['lebar'] ,
				"<a href='".site_url('ukuran/update/'.$value['idukuran'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('ukuran/delete/'.$value['idukuran'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Ukuran.php */
/* Location: ./application/controllers/Ukuran.php */