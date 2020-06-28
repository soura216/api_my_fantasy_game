<?php defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");

require_once APPPATH . 'controllers/Auth.php';

class Setting extends Auth
{
    function  __construct() 
    {
        parent::__construct();
        $this->load->model('setting_model');
        parent::authentication();
    }

    public function details($id){
      if(count($this->setting_model->details_by_id($id)) > 0){
          $result['details']=$this->setting_model->details_by_id($id); 
          $result['msg'] = "Setting Found";
          $result['status'] = true;
      } else {
          $result['msg'] = "Not Found"; 
          $result['status'] = false;
      }  
      echo json_encode($result);
    }

    public function update()
    {
    	$input['withdraw_money'] = $this->input->post('withdraw_money');
	    $input['referrer_earning_point'] = $this->input->post('referrer_earning_point');
	    $input['one_point_is_equal_to_how_much_rupees'] = $this->input->post('one_point_is_equal_to_how_much_rupees');
	    if($this->setting_model->update_action($input,$this->input->post('id'))){
	        $json['status'] = true;
	        $json['msg'] = "Successfully updated!";
	    } else {
	        $json['status'] = false;
	        $json['msg'] = "Something went to wrong!";
	    }
	    echo json_encode($json);
    }
}    