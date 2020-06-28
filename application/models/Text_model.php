<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Text_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();        
    }
    
    function create_action($input)
    {
        $this->db->insert('text', $input);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    function update_action($input,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('text', $input);
    }
    
    function details_by_id($id){
        $this->db->select('text.*,text_category.name as textCategoryName,text_category.icon as textCategoryIcon ');
        $this->db->from('text');  
        $this->db->join('text_category', 'text.text_category_id = text_category.id'); 
        $this->db->where('text.id',$id);
        $query=$this->db->get();
        return $query->result_array();  
    }
    
    function list(){
        $this->db->select('text.*,text_category.name as textCategoryName,text_category.icon as textCategoryIcon ');
        $this->db->from('text');  
        $this->db->join('text_category', 'text.text_category_id = text_category.id'); 
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

    function list_by_text_category_id($textCategoryId){
        $this->db->select('text.*,text_category.name as textCategoryName,text_category.icon as textCategoryIcon ');
        $this->db->from('text');  
        $this->db->join('text_category', 'text.text_category_id = text_category.id'); 
        $this->db->where('text_category_id',$textCategoryId);
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

    function list_by_text_category_id_and_language($textCategoryId,$language){
        $this->db->select('text.*,text_category.name as textCategoryName,text_category.icon as textCategoryIcon ');
        $this->db->from('text');  
        $this->db->join('text_category', 'text.text_category_id = text_category.id'); 
        $this->db->where('text_category_id',$textCategoryId);
        $this->db->where('language',$language);
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
        $this->db->select('text.*,text_category.name as textCategoryName,text_category.icon as textCategoryIcon ');
        $this->db->from('text');  
        $this->db->join('text_category', 'text.text_category_id = text_category.id'); 
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
        $del=$this->db->delete('text');   
        return $del;
    }
    
}    