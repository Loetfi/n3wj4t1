<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

	public function get_all()
	{
		$q = $this->db->select('idgroup as id, description as text ')
			->from('group')
			->order_by('idgroup','ASC')
			->get()
			->result_array();
		return json_encode($q);
	}	

}

/* End of file Group_model.php */
/* Location: ./application/models/Group_model.php */