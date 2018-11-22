<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function get_data(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");

		$offset = ($page - 1) * $limit;

		$this->db->order_by("name");
		if (strlen($q) > 0) {
			$this->db->like("name", $q);
		}
		$this->db->select("idcustomer as id, name as text");

		$data = $this->db->get("customer", $limit, $offset);

		if (strlen($q) > 0) {
			$this->db->like("name", $q);
		}
		$cdata = $this->db->get("customer");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

}

/* End of file Customer.php */
/* Location: ./application/controllers/auth/Customer.php */
