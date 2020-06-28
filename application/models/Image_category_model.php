<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Image_category_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();        
    }
    
    function is_name_exists($name)
    {
        $query = $this->db->select('name')->where('name', $name)->get('image_category');
        if( $query->num_rows() > 0 ){
               return TRUE;                 
        } else { 
               return FALSE;                
        }
    }

    function is_name_exists_by_id($name,$id)
    {
        $query = $this->db->select('*')->where('name', $name)->where('id !=',$id)->get('image_category');
        if( $query->num_rows() > 0 ){
               return TRUE;                 
        } else { 
               return FALSE;                
        }
    }
    
    function create_action($input)
    {
        $this->db->insert('image_category', $input);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    function update_action($input,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('image_category', $input);
    }
    
    function details_by_id($id){
        $this->db->select('*');
        $this->db->from('image_category');
        $this->db->where('id',$id);
        $query=$this->db->get();
        if($query->num_rows()>0) {
            $row=$query->row();
            $query_data=array(
                'id' => $row->id,
                'name' => $row->name,
                'icon' => $row->icon
            );
        } else {
            $query_data = [];
        }   
         return $query_data;
    }
    
    function list(){
        $this->db->select('*');
        $this->db->from('image_category');   
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

    public function delete($id) {
        $this->db->where('id', $id);
        $del=$this->db->delete('image_category');   
        return $del;
    }
    
    
    
}    