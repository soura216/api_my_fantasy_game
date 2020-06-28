<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_point_history extends CI_Model
{
    function __construct() 
    {
        parent::__construct();        
    }
    
    function create_action($input)
    {
        $this->db->insert('user_point_history', $input);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
}    