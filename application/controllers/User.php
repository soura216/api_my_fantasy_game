<?php defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");

require_once APPPATH . 'controllers/Auth.php';

class User extends Auth
{
    function  __construct() 
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('user_point_history');
        $this->load->model('setting_model');
        $this->load->model('withdraw_request');
        parent::authentication();
    }

    public function list()
    {
        $query = $this->user_model->list();
        $users = $query->result_array();
        if(count($users) > 0){
            $result['msg'] = "User  Found";
            $result['users'] = $users;
            $result['status'] = true;
        } else {
            $result['msg'] = "Not Found"; 
            $result['status'] = false;
        }
        echo json_encode($result);
    }
    
    
    public function insertUserPoint(){
        $userID = $this->input->post('user_id');
        $type = $this->input->post('type');
        $point = $this->input->post('point');
        $itemID = $this->input->post('item_id');
        
        $input['user_id'] =  $userID;
        $input['type'] =  $type;
        $input['point'] =  $point;
        $input['item_id'] =  $itemID;
        
        $this->user_point_history->create_action($input);
        
        $user = $this->user_model->details_by_id($userID);
        $earning_point = $user['points'];
        $this->user_model->update_action([
                          'points'=>$point+$earning_point
                        ],$userID);
                        
        $result['msg'] = "Updated";
        $result['status'] = true;     
        echo json_encode($result);
    }
    
    public function requestWithdraw(){
        $userID = $this->input->post('user_id');
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $point_requested = $this->input->post('point_requested');
        $amount_requested = $this->input->post('amount_requested');
        
        $input['user_id'] =  $userID;
        $input['email'] =  $email;
        $input['name'] =  $name;
        $input['paytm_number'] =  $mobile;
        $input['point_requested'] =  $point_requested;
        $input['amount_requested'] =  $amount_requested;
        
        $this->withdraw_request->create_action($input);
        
        $user = $this->user_model->details_by_id($userID);
        $point = $user['points'];
        $this->user_model->update_action([
                          'points'=>$point-$point_requested
                        ],$userID);
                        
        $result['msg'] = "Updated";
        $result['status'] = true;     
        echo json_encode($result);
    }
    
    public function getUserDetails()
    {
        $userID = $this->input->post('user_id');
        $user = $this->user_model->details_by_id($userID);
        $setting_info = $this->setting_model->details_by_id(1);
        $result['msg'] = "Updated";
        $result['points'] = $user['points'];
        $result['point_conversion'] = $setting_info[0]['one_point_is_equal_to_how_much_rupees'];
        $result['min_witdraw_balance'] = $setting_info[0]['withdraw_money'];
        $result['refer_point'] = $setting_info[0]['referrer_earning_point'];
        $result['status'] = true;  
        echo json_encode($result);
    }
    
    public function changePassword()
    {
      $user_id = $this->input->post('user_id');
      $old_password = $this->input->post('old_password');
      $new_password = $this->input->post('new_password');
      if( $this->user_model->is_password_exists($old_password,$user_id) == 'TRUE'){
        $this->user_model->update_action(['password' => md5($new_password)],$user_id);
        $result['status'] = true;  
        $result['msg'] = "Your password successfully changed";
      } else {
        $result['status'] = false;  
        $result['msg'] = "Your old password is not match with our database";
      }
      echo json_encode($result);
    }
    
    public function withdraw_money_list()
    {
      $query = $this->withdraw_request->list();
      $lists = $query->result_array();
      if(count($lists) > 0){
          $result['msg'] = "Found";
          $result['lists'] = $lists;
          $result['status'] = true;
      } else {
          $result['msg'] = "Not Found"; 
          $result['status'] = false;
      }
      echo json_encode($result);
    }

    public function withdraw_money_update_status()
    {
      if($this->withdraw_request->update_action(['status'=>$this->input->post('status')],$this->input->post('id')) ){
        $result['msg'] = "Successfully updated"; 
        $result['status'] = true;
      } else {
        $result['msg'] = "Something went to wrong"; 
        $result['status'] = false;
      }
      echo json_encode($result);
    }
    
}   