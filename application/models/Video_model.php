<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Video_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();        
    }
    
    function create_action($input)
    {
        $this->db->insert('video', $input);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    function update_action($input,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('video', $input);
    }
    
    function details_by_id($id){
        $this->db->select('video.*,video_category.name as videoCategoryName,video_category.icon as videoCategoryIcon ');
        $this->db->from('video');  
        $this->db->join('video_category', 'video.video_category_id = video_category.id'); 
        $this->db->where('video.id',$id);
        $query=$this->db->get();
        return $query->result_array();  
    }
    
    function list(){
        $this->db->select('video.*,video_category.name as videoCategoryName,video_category.icon as videoCategoryIcon ');
        $this->db->from('video');  
        $this->db->join('video_category', 'video.video_category_id = video_category.id'); 
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

    function list_by_video_category_id($videoCategoryId){
        $this->db->select('video.*,video_category.name as videoCategoryName,video_category.icon as videoCategoryIcon ');
        $this->db->from('video');  
        $this->db->join('video_category', 'video.video_category_id = video_category.id'); 
        $this->db->where('video_category_id',$videoCategoryId);
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
        $this->db->select('video.*,video_category.name as videoCategoryName,video_category.icon as videoCategoryIcon ');
        $this->db->from('video');  
        $this->db->join('video_category', 'video.video_category_id = video_category.id'); 
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
        $del=$this->db->delete('video');   
        return $del;
    }
    
}    