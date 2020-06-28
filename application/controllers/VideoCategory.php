<?php defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");

require_once APPPATH . 'controllers/Auth.php';

class VideoCategory extends Auth
{
    function  __construct() 
    {
        parent::__construct();
        $this->load->model('video_category_model');
        parent::authentication();
    }
    
    public function list(){
        $query = $this->video_category_model->list();
        $video_categories = $query->result_array();
        if(count($video_categories) > 0){
            $result['msg'] = "Video Categories Found";
            $result['video_categories'] = $video_categories;
            $result['status'] = true;
        } else {
            $result['msg'] = "Not Found"; 
            $result['status'] = false;
        }
        echo json_encode($result);
    }
    
    public function details($id){
      if(count($this->video_category_model->details_by_id($id)) > 0){
          $result['details']=$this->video_category_model->details_by_id($id); 
          $result['msg'] = "Video Category Found";
          $result['status'] = true;
      } else {
          $result['msg'] = "Not Found"; 
          $result['status'] = false;
      }  
      echo json_encode($result);
    }
    
    public function create(){
        $json = array();
        
        if(!empty($this->input->post('name'))){
            if ( $this->video_category_model->is_name_exists($this->input->post('name')) == 'TRUE' ){
                $json['status'] = false;
                $json['msg'] = "Name is already exist!";
            } else {
                $input['name'] = $this->input->post('name');
                if(!empty($_FILES['icon'])){
                    
                    $icon_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['icon']['name']);
                    $config['upload_path'] = './uploads/video_category/';
                    $config['file_name'] = $icon_name;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ( ! $this->upload->do_upload('icon') ){
                        $json = array('status' => false, 'msg' => $this->upload->display_errors());
                    } else {
                    
                        $input['icon'] = $this->upload->file_name;
                        $input['created_at'] = date("Y-m-d h:i:s");
                        if($this->video_category_model->create_action($input)){
                            $json['status'] = true;
                            $json['msg'] = "Successfully submitted!";
                        } else {
                            $json['status'] = false;
                            $json['msg'] = "Something went to wrong!";
                        }
                        
                    }
                    
                } else {
                    $json['status'] = false;
                    $json['msg'] = "Icon is required";
                }
            }
        } else {
            $json['status'] = false;
            $json['msg'] = "Name is required";
        }  
        
        echo json_encode($json);
    }

    public function update()
    {
        $json = array();
        if(!empty($this->input->post('name'))){
            if ( $this->video_category_model->is_name_exists_by_id($this->input->post('name'),$this->input->post('id')) == 'TRUE' ){
                $json['status'] = false;
                $json['msg'] = "Name is already exist!";
            } else {
                $input['name'] = $this->input->post('name');
                if(!empty($_FILES['icon'])){
                    $icon_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['icon']['name']);
                    $config['upload_path'] = './uploads/video_category/';
                    $config['file_name'] = $icon_name;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ( ! $this->upload->do_upload('icon') ){
                        $json = array('status' => false, 'msg' => $this->upload->display_errors());
                        echo json_encode($json);exit();
                    } else {
                        $input['icon'] = $this->upload->file_name;
                    }
                }
                if( $this->video_category_model->update_action($input,$this->input->post('id')) ){
                    $json['status'] = true;
                    $json['msg'] = "Successfully updated!";
                } else {
                    $json['status'] = false;
                    $json['msg'] = "Something went to wrong!";
                }
            }    
        } else {
            $json['status'] = false;
            $json['msg'] = "Name is required";
            
        }     
        echo json_encode($json);
    }

    public function delete($id){
        $del=$this->video_category_model->delete($id);
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