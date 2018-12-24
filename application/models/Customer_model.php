<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function get_all()
	{
		return $q = $this->db->select('*')
							->from('customer')
							->get();
	}

	public function get_by_id($id)
	{
		return $q = $this->db->select('*')
							->from('customer')
							->where('idcustomer',$id)
							->get();
	}

	public function get_all_select2()
	{
		$q = $this->db->select('idcustomer as id, name as text ')
			->from('customer')
			->order_by('idcustomer','ASC')
			->get()
			->result_array();
		return json_encode($q);
	}	

}

/* End of file Customer_model.php */
/* Location: ./application/models/Customer_model.php */