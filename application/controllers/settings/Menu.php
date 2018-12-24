<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model','menu');
		$this->load->model('crud_model','crud');
		$this->load->library('form_validation');
	}

	public function index()
	{
		read_access();
		$data['title'] = 'Setting Menu';

		$page = 'settings/menu/v_menu';
		// dd($data);
		template($page,$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('Name', 'Menu', 'trim|required');
		$this->form_validation->set_rules('Url', 'Url', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Menu';
			$data['list_menu'] = $this->menu->get_all();
			$page = 'settings/menu/f_menu';

			template($page, $data);
		} else {
			$this->db->trans_begin();

			$data_menu = [
				'Name' 			=> $this->input->post('Name'),
				'Url' 			=> $this->input->post('Url'),
				'ParentId' 		=> $this->input->post('ParentId'),
				'Icon' 			=> $this->input->post('Icon'),
				'PositionNumber' => $this->input->post('PositionNumber'),
				'Name' 			=> $this->input->post('Name'),
				'Status' 		=> 1,
				'WebsiteID'		=> 'newido'
			];
			
			$parent = $this->input->post('ParentId');

			if($parent == 0) {
				$data_menu['Level'] = 1;
			} else {
				$data_menu['Level'] = $this->menu->get_level_menu($parent);
			}

			$menu_id 	= $this->crud->create('Menu',$data_menu, TRUE);
			$group 		= $this->db->get('group')->result_array();

			$data_group_access = [];
			foreach ($group as $key => $value) {
				$rows['GroupId']	  = $value['idgroup'];
				$rows['MenuId']  	  = $menu_id;
				$rows['CreateAccess'] = ($value['idgroup'] == 1) ? 1 : 0;
				$rows['ReadAccess']   = ($value['idgroup'] == 1) ? 1 : 0;
				$rows['UpdateAccess'] = ($value['idgroup'] == 1) ? 1 : 0;
				$rows['DeleteAccess'] = ($value['idgroup'] == 1) ? 1 : 0;
				$rows['Status'] 	  = ($value['idgroup'] == 1) ? 1 : 0;
				
				$data_group_access[] = $rows;
			}

			$this->crud->create_batch('GroupsAccess',$data_group_access);

			if ($this->db->trans_status() === FALSE) {
	            $this->db->trans_rollback();
				
				$this->session->set_flashdata(['type'=>'success','message'=>'Menu gagal ditambahkan.!']);
	        } else {
	        	$this->db->trans_commit();
				
				$this->session->set_flashdata(['type'=>'success','message'=>'Menu berhasil ditambahkan.!']);
	        }

			return redirect('settings/menu');	
 
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('Name', 'Menu', 'trim|required');
		$this->form_validation->set_rules('Url', 'Url', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Menu';
			$data['list_menu'] = $this->menu->get_all();
			$data['menu'] = $this->crud->get_by_cond('Menu',['MenuId'=>$id])->row_array();
			$page = 'settings/menu/f_menu';

			$this->session->set_flashdata(['type'=>'error','message'=>validation_errors()]);

			template($page, $data);
		} else {
			$this->db->trans_begin();

			$data_menu = [
				'Name' 			=> $this->input->post('Name'),
				'Url' 			=> $this->input->post('Url'),
				'ParentId' 		=> $this->input->post('ParentId'),
				'Icon' 			=> $this->input->post('Icon'),
				'PositionNumber' => $this->input->post('PositionNumber'),
				'Name' 			=> $this->input->post('Name'),
				'Status' 		=> 1,
				'WebsiteID'		=> 'newido'
			];
			
			$parent = $this->input->post('ParentId');

			if($parent == 0) {
				$data_menu['Level'] = 1;
			} else {
				$data_menu['Level'] = $this->menu->get_level_menu($parent);
			}

			$this->crud->update('Menu',$data_menu,['MenuId'=>$id]);

			if ($this->db->trans_status() === FALSE) {
	            $this->db->trans_rollback();
				
				$this->session->set_flashdata(['type'=>'success','message'=>'Menu gagal diperbaharui.!']);
	        } else {
	        	$this->db->trans_commit();
				
				$this->session->set_flashdata(['type'=>'success','message'=>'Menu berhasil diperbaharui.!']);
	        }
			return redirect('settings/menu');
        }
	}

	public function delete($id)
	{
		$this->crud->delete('Menu',['MenuId'=>$id]);
		$this->crud->delete('GroupsAccess',['MenuId'=>$id]);

		$this->session->set_flashdata(['type'=>'success','message'=>'Menu berhasil dihapus.!']);
		
		return redirect('settings/menu');
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
		$total=$this->db->count_all_results("Menu");

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
			$this->db->like("Name",$search);
		}


		/*Lanjutkan pencarian ke database*/
		$this->db->limit($length,$start);
		/*Urutkan dari alphabet paling terkahir*/
		$this->db->order_by('PositionNumber','ASC');
		$query=$this->db->get('Menu');

		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
			$this->db->like("Name",$search);
			$jum=$this->db->get('Menu');
			$output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
		}

		$nomor_urut=$start+1;
		foreach ($query->result_array() as $key => $value) {
			$nbsp = '';
			switch ($value['Level']) {
                case '2':
                    $nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;';
                    break;
                case '3':
                    $nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;';
                    break;
                default:
                break;
            }
			$output['data'][]= array(
				// $nomor_urut,
				$nbsp.$value['Name'] ,
				$value['Url'] ,
				"<a href='".site_url('settings/menu/update/'.$value['MenuId'])."' class='btn btn-xs btn-default'> <span class='glyphicon glyphicon-pencil'></span>  Edit</a>
				<a href='".site_url('settings/menu/delete/'.$value['MenuId'])."' class='btn btn-xs btn-danger' 
					onclick='return confirm(\"Apakah anda yakin?\")'> <span class='glyphicon glyphicon-trash'></span>  Hapus</a>
				"
			);
			// $output['data'][]=array($nomor_urut,$desa['tglorder']);
			// $nomor_urut++;
		}

		echo json_encode($output);
	}

}

/* End of file Menu.php */
/* Location: ./application/controllers/setings/Menu.php */