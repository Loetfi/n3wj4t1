<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	public function get_by_filter($id, $start, $end)
	{
		$where = '';

		if($id != '') {
			$where .= "idcustomer = '$id'";
			if($start != '' and $end !='')
			{
				$where .= " and transaction_date BETWEEN '$start' AND '$end'";
			}
		} else {
			if($start != '' and $end !='')
			{
				$where .= " transaction_date BETWEEN '$start' AND '$end'";
			}
		}



		// $where = "idcustomer = '$id' and transaction_date BETWEEN '$start' AND '$end' ";
		$this->db->select('*')
					->from('transaction_group')
					->where($where)
					->order_by('idtransaction_group','DESC');

		return $this->db->get();
	}	

}

/* End of file Transaction_model.php */
/* Location: ./application/models/Transaction_model.php */