<?php defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");

require_once APPPATH . 'controllers/Auth.php';

class Image extends Auth
{
    function  __construct() 
    {
        parent::__construct();
        $this->load->model('image_model');
        parent::authentication();
    }

    public function list()
    {
        if(!empty($this->input->post('image_category_id'))){
            $query = $this->image_model->list_by_image_category_id($this->input->post('image_category_id'));
        } else {
        	$query = $this->image_model->list();
        }
        $images = $query->result_array();
        if(count($images) > 0){
            $result['msg'] = "Image  Found";
            $result['images'] = $images;
            $result['status'] = true;
        } else {
            $result['msg'] = "Not Found"; 
            $result['status'] = false;
        }
        echo json_encode($result);
    }

    public function details($id){
      if(count($this->image_model->details_by_id($id)) > 0){
          $result['details']=$this->image_model->details_by_id($id); 
          $result['msg'] = "Video  Found";
          $result['status'] = true;
      } else {
          $result['msg'] = "Not Found"; 
          $result['status'] = false;
      }  
      echo json_encode($result);
    }

    public function create()
    {
    	if(!empty($_FILES['url'])){
            
            $image_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['url']['name']);
            $config_image['upload_path'] = './uploads/image/';
            $config_image['file_name'] = $image_name;
            $config_image['allowed_types'] = 'jpg|jpeg|png|gif';
            $config_image['encrypt_name'] = TRUE;
            $this->load->library('upload', $config_image);
            $this->upload->initialize($config_image);
            if ( ! $this->upload->do_upload('url') ){
                $json = array('status' => false, 'msg' => $this->upload->display_errors());
            } else {
                $input['url'] = $this->upload->file_name;
                $input['user_id'] = $this->input->post('user_id');
                $input['image_category_id'] = $this->input->post('image_category_id');
                $input['is_trending'] = $this->input->post('is_trending');
                $input['point'] = $this->input->post('point');
                $input['created_at'] = date('Y-m-d h:i:s');
                if($this->image_model->create_action($input)){
                    $json['status'] = true;
                    $json['msg'] = "Successfully submitted!";
                } else {
                    $json['status'] = false;
                    $json['msg'] = "Something went to wrong!";
                }
            }
        } else {
            $json['status'] = false;
            $json['msg'] = "Image is required";
        }
        echo json_encode($json);exit();
    }

    public function update()
	{
	    if(!empty($_FILES['url'])){
	        $image_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['url']['name']);
            $config_image['upload_path'] = './uploads/image/';
            $config_image['file_name'] = $image_name;
            $config_image['allowed_types'] = 'jpg|jpeg|png|gif';
            $config_image['encrypt_name'] = TRUE;
            $this->load->library('upload', $config_image);
            $this->upload->initialize($config_image);
	        if ( ! $this->upload->do_upload('url') ){
	            $json = array('status' => false, 'msg' => $this->upload->display_errors());
	            echo json_encode($json);exit();
	        } 
	        $input['url'] = $this->upload->file_name; 
	    }

	    $input['user_id'] = $this->input->post('user_id');
	    $input['image_category_id'] = $this->input->post('image_category_id');
	    $input['is_trending'] = $this->input->post('is_trending');
	    $input['point'] = $this->input->post('point');
	    if($this->image_model->update_action($input,$this->input->post('id'))){
	        $json['status'] = true;
	        $json['msg'] = "Successfully updated!";
	    } else {
	        $json['status'] = false;
	        $json['msg'] = "Something went to wrong!";
	    }
	    echo json_encode($json);
	}
	
	public function trending()
    {
        $query = $this->image_model->trending();
        $images = $query->result_array();
        if(count($images) > 0){
            $result['msg'] = "Image  Found";
            $result['images'] = $images;
            $result['status'] = true;
        } else {
            $result['msg'] = "Not Found"; 
            $result['status'] = false;
        }
        echo json_encode($result);
    }

    public function delete($id){
        $del=$this->image_model->delete($id);
        if($del){
            $json['status'] = true;
            $json['msg'] = "Successfully Deleted";
        } else {
            $json['status'] = false;
            $json['msg'] = "Something went to wrong!";
        }
        echo json_encode($json);
    }
}	