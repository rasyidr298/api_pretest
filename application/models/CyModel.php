<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CyModel extends CI_Model {

    protected $tableName;
    
    public function all()
    {
        $query = $this->db->get($this->tableName);
        return $query->result();
    }
    
    public function getById($id)
    {
        $query = $this->db->get_where($this->tableName, ['id' => $id]);
        return $query->row();
    }

    public function getWhere($data) {
        $query = $this->db->get_where($this->tableName, $data);
        return $query->row_array();
    }

    public function singleWhere($data) {
        $query = $this->db->get_where($this->tableName, $data);
        return $query->row();
    }
    
    public function create($data)
    {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->tableName, $data);
        return $this->getById($id);
    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->tableName);
    }
    
    public function deleteWhere($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->delete($this->tableName);
    }
    
}
