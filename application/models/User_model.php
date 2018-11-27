<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function get_by_id($id)
	{
		return $q = $this->db->select('u.*, ug.idgroup')
							->from('user as u')
							->join('user_group as ug','u.iduser = ug.iduser')
							->where('u.iduser',$id)
							->get();
	}
	

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */