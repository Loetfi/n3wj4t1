<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('crud_model','crud');
		$this->load->model('group_model','group');
		$this->load->model('user_model','user');
	}

	public function index()
	{
		$data['title'] = 'Manajemen Pengguna';

		$page = 'manajemen/user/v_user';
		// dd($data);
		template($page,$data);		
	}

	public function create()
	{
		$username = $this->input->post('username');
		$username_exist = $this->db->where('username', $username)
							->count_all_results('user');

		if($username_exist > 0) {
			$is_unique =  '|is_unique[user.username]';
		} else {
		   	$is_unique =  '';
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim'.$is_unique);
		$this->form_validation->set_rules('idgroup', 'Group', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah User';
			$data['list_group'] = $this->group->get_all();
			$page = 'manajemen/user/f_user';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);

		} else {
			// dd($_POST);
			$this->db->trans_begin();

			$data_user = [
				'username'		=> $username,
				'name'			=> $this->input->post('name'),
				'password'		=> md5($this->input->post('password')),
				'created'		=> date('Y-m-d H:i:s'),
				'createdby'		=> $this->session->login['username'],
			];

			$iduser = $this->crud->create('user',$data_user, TRUE);
			// dd($iduser);
			$data_user_group = [
				'iduser'		=> $iduser,
				'idgroup'		=> $this->input->post('idgroup'),
				'created'		=> date('Y-m-d H:i:s'),
				'createdby'		=> $this->session->login['username'],
			];

			$this->crud->create('user_group',$data_user_group);

			if ($this->db->trans_status() === FALSE) {
	            $this->db->trans_rollback();
				
				$this->session->set_flashdata(['type'=>'error','message'=>'Pengguna gagal ditambahkan.!']);

				return redirect('manajemen/user');	
	        } else {
	        	$this->db->trans_commit();
				$this->session->set_flashdata(['type'=>'success','message'=>'Pengguna berhasil ditambahkan.!']);

				return redirect('manajemen/user');	
	        }

		}
	}

	public function update($id)
	{
		// $username = $this->input->post('username');
		// $username_exist = $this->db->where('username', $username)
		// 					->count_all_results('user');

		// if($username_exist > 0) {
		// 	$is_unique =  '|is_unique[user.username]';
		// } else {
		//    	$is_unique =  '';
		// }

		// $this->form_validation->set_rules('username', 'Username', 'required|trim'.$is_unique);
		$this->form_validation->set_rules('idgroup', 'Group', 'trim|required');
		// if($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
		// }
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit User';
			$data['user'] = $this->user->get_by_id($id)->row_array();
			$data['list_group'] = $this->group->get_all();
			$page = 'manajemen/user/f_user';
			
			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);
			
			template($page, $data);

		} else {
			// dd($_POST);
			$this->db->trans_begin();

			$data_user = [
				'username'		=> $this->input->post('username'),
				'name'			=> $this->input->post('name'),
				'password'		=> md5($this->input->post('password')),
				'updated'		=> date('Y-m-d H:i:s'),
				'updatedby'		=> $this->session->login['username'] ? $this->session->login['username'] : null,
			];

			$this->crud->update('user',$data_user,['iduser'=>$id]);
			// dd($iduser);
			$data_user_group = [
				'iduser'		=> $id,
				'idgroup'		=> $this->input->post('idgroup'),
				'updated'		=> date('Y-m-d H:i:s'),
				'updatedby'		=> $this->session->login['username'] ? $this->session->login['username'] : null,
			];

			$this->crud->update('user_group',$data_user_group,['iduser'=>$id]);

			if ($this->db->trans_status() === FALSE) {
	            $this->db->trans_rollback();
				
				$this->session->set_flashdata(['type'=>'error','message'=>'Pengguna gagal ditambahkan.!']);

				return redirect('manajemen/user');	
	        } else {
	        	$this->db->trans_commit();
				$this->session->set_flashdata(['type'=>'success','message'=>'Pengguna berhasil ditambahkan.!']);

				return redirect('manajemen/user');	
	        }

		}
	}

	public function delete($id)
	{
		$this->db->trans_begin();
		$this->crud->delete('user',['iduser'=>$id]);
		$this->crud->delete('user_group',['iduser'=>$id]);

		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			
			$this->session->set_flashdata(['type'=>'error','message'=>'Pengguna gagal dihapus.!']);

			return redirect('manajemen/user');	
        } else {
        	$this->db->trans_commit();
			$this->session->set_flashdata(['type'=>'success','message'=>'Pengguna berhasil dihapus.!']);

			return redirect('manajemen/user');	
        }
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
		$total=$this->db->count_all_results("user");

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
			$where = "u.username like '%$search%' or u.name like '%$search%' or g.description like '%$search%' ";
			$this->db->where($where);
		}

		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('iduser','DESC');
		$query = $this->db->select('u.*, g.description')
				->from('user as u')
				->join('user_group as us','u.iduser = us.iduser')
				->join('group as g','us.idgroup = g.idgroup')
				->get();

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$where = "u.username like '%$search%' or u.name like '%$search%' or g.description like '%$search%' ";
			$this->db->where($where);
			$jum= $this->db->select('u.*, g.description')
				->from('user as u')
				->join('user_group as us','u.iduser = us.iduser')
				->join('group as g','us.idgroup = g.idgroup')
				->get();
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$output['data'][]=array(
				$nomor_urut,
				$value['username'] ,
				$value['name'] ,
				$value['description'] ,
				"<a href='".site_url('manajemen/user/update/'.$value['iduser'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('manajemen/user/delete/'.$value['iduser'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			$nomor_urut++;
		}

		echo json_encode($output);
	}
}

/* End of file User.php */
/* Location: ./application/controllers/manajemen/User.php */