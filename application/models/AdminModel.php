<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CyModel {

    protected $tableName = "admin";
    
    public function all()
    {
        $this->db->select(['id', 'email', 'nama']);
        return parent::all();
    }
    
    public function getById($id)
    {
        $this->db->select(['id', 'email', 'nama']);
        return parent::getById($id);
    }
    
}