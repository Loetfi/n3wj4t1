<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function get_menu($idgroup)
	{
		return $q = $this->db->select('m.*,
								ga.GroupId,ga.MenuDetailId,ga.CreateAccess,ga.ReadAccess,ga.UpdateAccess,ga.DeleteAccess')
							->from('Menu as m')
							->join('GroupsAccess as ga','m.MenuId = ga.MenuId')
							->where('ga.GroupId', $idgroup)
							->where('m.Status','1')
							->order_by('m.PositionNumber','ASC')
							->get();
	}

	public function get_menu_child($menu_id)
	{
		return $q = $this->db->select('*')
							->from('MenuDetail')
							->where('MenuId',$menu_id)
							->order_by('PositionNumber','ASC')
							->get();
	}
	

}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */
