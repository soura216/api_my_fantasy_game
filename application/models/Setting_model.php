<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();        
    }

    function create_action($input)
    {
        $this->db->insert('setting', $input);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    function update_action($input,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('setting', $input);
    }

    function details_by_id($id){
        $this->db->select('setting.*');
        $this->db->from('setting');
        $this->db->where('setting.id',$id);
        $query=$this->db->get();
        return $query->result_array();  
    }
}    