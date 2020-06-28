<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Image_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();        
    }
    
    function create_action($input)
    {
        $this->db->insert('image', $input);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    function update_action($input,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('image', $input);
    }
    
    function details_by_id($id){
        $this->db->select('image.*,image_category.name as imageCategoryName,image_category.icon as imageCategoryIcon ');
        $this->db->from('image');  
        $this->db->join('image_category', 'image.image_category_id = image_category.id'); 
        $this->db->where('image.id',$id);
        $query=$this->db->get();
        return $query->result_array();  
    }
    
    function list(){
        $this->db->select('image.*,image_category.name as imageCategoryName,image_category.icon as imageCategoryIcon ');
        $this->db->from('image');  
        $this->db->join('image_category', 'image.image_category_id = image_category.id');
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

    function list_by_image_category_id($imageCategoryId){
        $this->db->select('image.*,image_category.name as imageCategoryName,image_category.icon as imageCategoryIcon ');
        $this->db->from('image');  
        $this->db->join('image_category', 'image.image_category_id = image_category.id'); 
        $this->db->where('image_category_id',$imageCategoryId);
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
    
    function trending(){
        $this->db->select('image.*,image_category.name as imageCategoryName,image_category.icon as imageCategoryIcon ');
        $this->db->from('image');  
        $this->db->join('image_category', 'image.image_category_id = image_category.id'); 
        $this->db->where('is_trending',"1");
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
        $del=$this->db->delete('image');   
        return $del;
    }
    
}    