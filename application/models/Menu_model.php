<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function get_menu($idgroup, $level = null, $parent = null)
	{
		$this->db->select('m.*')
				->from('Menu as m')
				->join('GroupsAccess as ga','m.MenuId = ga.MenuId')
				->where('ga.GroupId', $idgroup)
				->where('ga.ReadAccess','1')
				->where('m.Status','1')
				->order_by('m.PositionNumber','ASC');

		if($level !== null)
            $this->db->where('m.Level', $level);

        if($parent !== null)
            $this->db->where('m.ParentId', $parent);
        
        $query = $this->db->get();

        return $query;
	}
}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */
