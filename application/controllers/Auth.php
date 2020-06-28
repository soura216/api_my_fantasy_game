<?php defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
class Auth extends CI_Controller
{
    function  __construct() 
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('setting_model');
        $this->load->model('user_point_history');
    }
  
    public function registration()
    {   
        $data = [];
        
        if(!empty($this->input->post('name'))){
          $input['name'] = $this->input->post('name');
            if(!empty($this->input->post('email'))){
              if($this->user_model->is_email_exists($this->input->post('email')) == 'TRUE'){
                $data['status'] = false;
                $data['msg'] = "Email is already exist!";  
              } 
              else {
                $input['email'] = $this->input->post('email');
                if(empty($this->input->post('mobile'))){
                  $data['status'] = false;
                  $data['msg'] = "Mobile is required!";
                  echo json_encode($data);exit();
                } 
                if($this->user_model->is_mobile_exists($this->input->post('mobile')) == 'TRUE'){
                  $data['status'] = false;
                  $data['msg'] = "Mobile is already exist!"; 
                  echo json_encode($data);exit();
                }  
                $input['mobile'] = $this->input->post('mobile');
                if(!empty($this->input->post('password'))){
                  $input['password'] = md5($this->input->post('password'));
                  $input['user_type'] = $this->input->post('user_type');
                  $input['login_type'] = $this->input->post('login_type');
                  $input['device_token'] = md5(date("Y-m-d_h:i:s").$input['email']);
                  $input['address'] = $this->input->post('address');
                  $input['referrer_token'] = $this->random_strings(8);
                  $input['created_at'] = date('Y-m-d h:i:s');
                  $setting_info = $this->setting_model->details_by_id(1);
                  $earning_point = $setting_info[0]['referrer_earning_point'];

                  if(!empty($this->input->post('installation_token'))){
                    $referrer_details = $this->user_model->is_installation_token_exists($this->input->post('installation_token'));
                    if(count($referrer_details) > 0){
                      if($this->user_model->installation_token_count_row($this->input->post('installation_token')) < 5){
                        $input['installation_token'] = $this->input->post('installation_token');
                        $input['points'] = 1000+$earning_point;
                      } else {
                        $input['installation_token'] = null;
                        $input['points'] = 1000;
                      }
                    } else {
                      $input['installation_token'] = null;
                      $input['points'] = 1000;
                    }
                  } else {
                    $input['installation_token'] = null;
                    $input['points'] = 1000;
                  }

                  $response = $this->user_model->create_action($input);
                    if(count($response) > 0){

                       if($input['points'] != 1000){
                        $this->user_point_history->create_action([
                          'user_id'=>$referrer_details['user_id'],
                          'type'=>'referrer',
                          'point'=>$input['points'],
                          'item_id'=>0
                        ]);
                        $this->user_model->update_action([
                          'points'=>$referrer_details['points']+$earning_point
                        ],$referrer_details['user_id']);
                        $this->user_point_history->create_action([
                          'user_id'=>$response['user_id'],
                          'type'=>'installation',
                          'point'=>$input['points'],
                          'item_id'=>0
                        ]);
                       }

                       $data['status'] = true;
                       $data['user_details'] = $response;
                       $data['msg'] = "Successfully registration!";

                    } else {
                       $data['status'] = false;
                       $data['msg'] = "Something went to wrong!";
                    }
                } else {
                  $data['status'] = false;
                  $data['msg'] = "Password is required!";
                }
                
              }
            } else {
              $data['status'] = false;
              $data['msg'] = "Email is required!";
            }
            
        } else {
          $data['status'] = false;
          $data['msg'] = "Name is required!";
        }
        
        echo json_encode($data);
    }
    
    public function login(){
        if(!empty($this->input->post('email'))){
            $input['email'] = $this->input->post('email');
            if(!empty($this->input->post('password'))){
                $input['password'] = $this->input->post('password');
                $response = $this->user_model->can_login($input);
                if(count($response) > 0){
                    $data['status'] = true;
                    $data['user_details'] = $response;
                    $data['msg'] = "Successfully login!";
                } else {
                    $data['status'] = false;
                    $data['msg'] = "Email and Password are not match with database!";
                }
            } else {
                $data['status'] = false;
                $data['msg'] = "Password is required!";
            }   
        } else {
            $data['status'] = false;
            $data['msg'] = "Email is required!";
        }       
        echo json_encode($data);
    }

    public function mobile_login(){
        if(!empty($this->input->post('mobile'))){
            $input['mobile'] = $this->input->post('mobile');
            if(!empty($this->input->post('password'))){
                $input['password'] = $this->input->post('password');
                $response = $this->user_model->can_mobile_login($input);
                if(count($response) > 0){
                    $data['status'] = true;
                    $data['user_details'] = $response;
                    $data['msg'] = "Successfully login!";
                } else {
                    $data['status'] = false;
                    $data['msg'] = "Mobile and Password are not match with database!";
                }
            } else {
                $data['status'] = false;
                $data['msg'] = "Password is required!";
            }   
        } else {
            $data['status'] = false;
            $data['msg'] = "Mobile is required!";
        }       
        echo json_encode($data);
    }

    public function authentication(){
      /*Admin Users Only */
        $headers = $this->input->request_headers();
        if(isset($headers['x-auth-role']) && $headers['x-auth-role'] == 0){
          if(empty($headers['x-auth-token'])){
            $json['msg'] = "Authentication error";
                http_response_code(401);
                echo json_encode($json);exit();
          } elseif (!empty($headers['x-auth-token'])) {
            if($this->user_model->is_device_token_exists($headers['x-auth-token']) == 0){
              $json['msg'] = "Authentication error";
                  http_response_code(401);
                  echo json_encode($json);exit();
            }
          }
        }
    }

    function random_strings($length_of_string) 
    { 
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
      return substr(str_shuffle($str_result),0, $length_of_string); 
    } 
  
    public function forgot_password()
    {
      $config['protocol'] = "smtp";
      $config['smtp_host'] = "ssl://smtp.gmail.com";
      $config['smtp_port'] = "465";
      $config['smtp_user'] = "sourasankar94@gmail.com";
      $config['smtp_pass'] = "kwocqnphrylkhyis";
      $config['mailtype'] = "html";
      $config['charset']    = 'utf-8';
      $config['newline']    = "\r\n";

      $this->load->library('email', $config);
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");

      $password = $this->random_strings(8);
      
      $message =  'Hi user,'.'<br><br>';
      $message .= 'Your new password '.'<b>'.$password.'</b><br><br>';
      $message .= 'After login you can change the password from <b> " Change Password " </b> option.';

      if($this->user_model->is_email_exists($this->input->post('email')) == 'TRUE'){
        $this->email->from("sourasankar94@gmail.com");
        $this->email->to($this->input->post('email'));
        $this->email->subject("Forgot Password");
        $this->email->message($message);
        $this->email->send();      
        $this->user_model->update_action_by_email(['password'=>md5($password)],$this->input->post('email'));
        $data['status'] = true;
        $data['msg'] = "Please check your email";
      } else {
        $data['status'] = false;
        $data['msg'] = "Email is not registered!";
      }
      echo json_encode($data);
      
    }
  
  
    
} 