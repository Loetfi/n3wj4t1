<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function login($username = '' , $password = '')
	{
		$query = $this->db->select('username , password')
		->from('user')
		->where('username' ,$username)
		->where('password' , $password)
		->get()->row_array();

		if ($query > 0) {
			$this->_set_session($username);
			return true;
		} else {
			return false;
		}
	}


	private function _set_session($username)
	{
		$query = $this->db->query("SELECT a.username , a.name ,  b.idgroup , c.group_name   from user a
			inner join user_group b on a.iduser = b.iduser
			inner join `group` c on b.idgroup = c.idgroup
			where a.username = '$username' ")->row_array();

		$array = array(
			'login' => $query
		);
		
		$this->session->set_userdata( $array );
	}

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */
