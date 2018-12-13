<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category_model extends CI_Model {

	public function get_by_id($id)
	{
		return $q = $this->db->select('*')
							->from('product_category')
							->where('idproduct_category',$id)
							->get();
	}

	public function get_all()
	{
		$q = $this->db->select('idproduct_category as id, name as text ')
			->from('product_category')
			->order_by('idproduct_category','ASC')
			->get()
			->result_array();
		return json_encode($q);
	}

}

/* End of file Product_category.php */
/* Location: ./application/models/Product_category.php */