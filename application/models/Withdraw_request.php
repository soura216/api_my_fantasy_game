<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Withdraw_request extends CI_Model
{
    function __construct() 
    {
        parent::__construct();        
    }
    
    function create_action($input)
    {
        $this->db->insert('withdraw_request', $input);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    function list()
    {
        $this->db->select('*');
        $this->db->from('withdraw_request');  
        $this->db->order_by("id", "asc");
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            return $query;            
        }
        else
        {
            return $query;
        }
    }

    function update_action($input,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('withdraw_request', $input);
    }
    
}    