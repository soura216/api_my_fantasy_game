<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();        
    }
    
    function is_email_exists($email)
    {
        $query = $this->db->select('email')->where('email', $email)->get('user');
        if( $query->num_rows() > 0 ){
               return TRUE;                 
        } else { 
               return FALSE;                
        }
    }

    function is_mobile_exists($mobile)
    {
        $query = $this->db->select('mobile')->where('mobile', $mobile)->get('user');
        if( $query->num_rows() > 0 ){
               return TRUE;                 
        } else { 
               return FALSE;                
        }
    }

    function is_installation_token_exists($installation_token){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('referrer_token',$installation_token);
        $query=$this->db->get();
        if($query->num_rows()>0) {
            $row=$query->row();
            $query_data=array('user_id' => $row->id,'points'=> $row->points);
        } else {
            $query_data = [];
        }   
         return $query_data;
    }

    function installation_token_count_row($installation_token){
        $query = $this->db->select('installation_token')->where('installation_token', $installation_token)->get('user');
        return $query->num_rows();
    }

    function is_device_token_exists($device_token)
    {
        $query = $this->db->select('device_token')->where('device_token', $device_token)->get('user');
        return $query->num_rows();
    }
    
    function create_action($input)
    {
        $this->db->insert('user', $input);
        $insert_id = $this->db->insert_id();
        return  $this->details_by_id($insert_id);
    }

    function update_action($input,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $input);
    }
    
    function details_by_id($id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id',$id);
        $query=$this->db->get();
        if($query->num_rows()>0) {
            $row=$query->row();
            $query_data=array('device_token'=> $row->device_token,'user_id' => $row->id,'user_type' =>  $row->user_type,'name' => $row->name,'email' => $row->email,'points'=> $row->points,'mobile' => $row->mobile,'referrer_token'=>$row->referrer_token);
        } else {
            $query_data = [];
        }   
         return $query_data;
    }
    
    function can_login($input)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email',$input['email']);
        $this->db->where('password',md5($input['password']));
        $query=$this->db->get();
        if($query->num_rows()>0) {
            $row=$query->row();
            $query_data=array('device_token'=> $row->device_token,'user_id' => $row->id,'user_type' =>  $row->user_type,'name' => $row->name,'email' => $row->email,'points'=> $row->points,'mobile' => $row->mobile,'referrer_token'=>$row->referrer_token);
        } else {
            $query_data = [];
            
        }
         return $query_data;
    }

    function can_mobile_login($input)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('mobile',$input['mobile']);
        $this->db->where('password',md5($input['password']));
        $query=$this->db->get();
        if($query->num_rows()>0) {
            $row=$query->row();
            $query_data=array('device_token'=> $row->device_token,'user_id' => $row->id,'user_type' =>  $row->user_type,'name' => $row->name,'email' => $row->email,'points'=> $row->points,'mobile' => $row->mobile,'referrer_token'=>$row->referrer_token);
        } else {
            $query_data = [];
            
        }
         return $query_data;
    }

    function list()
    {
        $this->db->select('*');
        $this->db->from('user');  
        $this->db->where('user_type',1);
        $this->db->order_by("id", "desc");
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

    function update_action_by_email($input,$email)
    {
        $this->db->where('email', $email);
        return $this->db->update('user', $input);
    }

    function is_password_exists($password,$user_id)
    {
        $query = $this->db->select('*')->where('password', md5($password) )->where('id', $user_id )->get('user');
        if( $query->num_rows() > 0 ){
               return TRUE;                 
        } else { 
               return FALSE;                
        }
    }
    
}    