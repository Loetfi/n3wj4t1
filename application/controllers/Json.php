<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

	protected $table;

	public function __construct() {
		parent::__construct();
		$this->table = 'customer';
		// $this->load->helper("az_core");
		// az_check_login();
	}

	public function product(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");

		$offset = ($page - 1) * $limit;

		$this->db->order_by("name");
		if (strlen($q) > 0) {
			$this->db->like("name", $q);
		}
		$this->db->select("idproduct as id, name as text");

		$data = $this->db->get("product", $limit, $offset);

		if (strlen($q) > 0) {
			$this->db->like("name", $q);
		}
		$cdata = $this->db->get("product");
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

/* End of file Json.php */
/* Location: ./application/controllers/Json.php */
