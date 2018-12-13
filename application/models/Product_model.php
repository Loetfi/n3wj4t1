<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function get_by_id($id)
	{
		return $q = $this->db->select('*')
							->from('product')
							->where('idproduct',$id)
							->get();
	}	

}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */