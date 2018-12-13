<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_unit_model extends CI_Model {

	public function get_by_id($id)
	{
		return $q = $this->db->select('*')
							->from('product_unit')
							->where('idproduct_unit',$id)
							->get();
	}

	public function get_all()
	{
		$q = $this->db->select('idproduct_unit as id, name as text ')
			->from('product_unit')
			->order_by('idproduct_unit','ASC')
			->get()
			->result_array();
		return json_encode($q);
	}

}

/* End of file Product_unit_model.php */
/* Location: ./application/models/Product_unit_model.php */