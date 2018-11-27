<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {


	public function get_by_cond($table, $cond)
	{
		$this->db->select('*');
		$this->db->from($table);
		foreach ($cond as $key => $value) {
			$this->db->where("`$key`", $value);
		}
		return $this->db->get();
	}

	/**
	* create new data
	* @param table, name table from db
	* @param data, data array  for a new row to insert
	* @param last_id, default false if need last record id set TRUE
	* @return create a new data
	*/
	public function create($table, $data, $last_id = FALSE) 
	{
		$this->db->insert($table, $data);
		
		if(!FALSE) {
			return $this->db->insert_id();
		} else {
			return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
		}

	}

	/**
	* create new multiple data
	* @param table, name table from db
	* @param data, data array  for a multiple row to insert
	* @return create a new multiple data
	*/
	public function create_batch($table, $data)
	{
		$this->db->insert_batch($table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	/**
	* update spesific data
	* @param table, name table from db
	* @param data, data array  for a update row to insert
	* @param id, array for update spesific data
	* @return update spesific data
	*/
	public function update($table, $data, $id)
	{
		$this->db->update($table, $data, $id);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	/**
	* delete spesific data
	* @param table, name table from db
	* @param id, array for delete spesific data
	* @return delete spesific data
	*/
	public function delete($table, $id)
	{
		$this->db->delete($table, $id);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}

/* End of file Crud_model.php */
/* Location: ./application/models/Crud_model.php */