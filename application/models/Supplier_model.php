<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

	public function get_by_id($id)
	{
		return $q = $this->db->select('*')
							->from('supplier')
							->where('idsupplier',$id)
							->get();
	}		

}

/* End of file Supplier_model.php */
/* Location: ./application/models/Supplier_model.php */