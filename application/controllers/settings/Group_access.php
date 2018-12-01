<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_access extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('group_model','group');
		$this->load->model('crud_model','crud');
	}

	public function index($idgroup = null)
	{
		$data['title'] 	= 'Setting Group Access';
		$data['group'] 	= $this->db->order_by('idgroup','ASC')->get('group')->result_array();
		$idgroup = $idgroup ? $idgroup : 1;
		$data['group_menu'] = $this->group->group_menu($idgroup)->result_array();
		$page = 'settings/group_access/v_group_access';
		template($page,$data);
	}

	public function update_access()
	{
		$id 		= $this->input->post('id');
		$access 	= $this->input->post('access'); // value 0,1
		$access_is 	= $this->input->post('access_is'); // value access_create, access_create, access_update, access_delete 

		if($access_is == 'CreateAccess') {
			$data_access = [
				'CreateAccess'	=> $access,
			];
		} elseif($access_is == 'ReadAccess') {
			$data_access = [
				'ReadAccess'	=> $access,
			];
		} elseif($access_is == 'UpdateAccess') {
			$data_access = [
				'UpdateAccess'	=> $access,
			];
		} else {
			$data_access = [
				'DeleteAccess'	=> $access,
			];
		}

		$this->crud->update('GroupsAccess', $data_access, ['GroupsAccessId' => $id]);

		$result['error'] 	= FALSE;
		$result['message']	= 'Update Group Access Success.!';

		echo json_encode($result);
	}

}

/* End of file Groups_access.php */
/* Location: ./application/controllers/settings/Groups_access.php */