<?php defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");

require_once APPPATH . 'controllers/Auth.php';

class Text extends Auth
{
    function  __construct() 
    {
        parent::__construct();
        $this->load->model('text_model');
        parent::authentication();
    }

    public function list()
    {
        if(!empty($this->input->post('text_category_id')) && !empty($this->input->post('language')) ){
            $query = $this->text_model->list_by_text_category_id_and_language($this->input->post('text_category_id'),$this->input->post('language'));
        } else {
            $query = $this->text_model->list();
        }
        $texts = $query->result_array();
        if(count($texts) > 0){
            $result['msg'] = "Text Found";
            $result['texts'] = $texts;
            $result['status'] = true;
        } else {
            $result['msg'] = "Not Found"; 
            $result['status'] = false;
        }
        echo json_encode($result);
    }

    public function details($id){
      if(count($this->text_model->details_by_id($id)) > 0){
          $result['details']=$this->text_model->details_by_id($id); 
          $result['msg'] = "Text Found";
          $result['status'] = true;
      } else {
          $result['msg'] = "Not Found"; 
          $result['status'] = false;
      }  
      echo json_encode($result);
    }

    public function create()
    {
         if(!empty($this->input->post('content'))){
            $input['content'] = $this->input->post('content');
            $input['user_id'] = $this->input->post('user_id');
            $input['text_category_id'] = $this->input->post('text_category_id');
            $input['is_trending'] = $this->input->post('is_trending');
            $input['language'] = $this->input->post('language');
            $input['point'] = $this->input->post('point');
            $input['created_at'] = date('Y-m-d h:i:s');
            if(!empty($_FILES['url'])){
                $bg_img_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['url']['name']);
                $config_bg_img['upload_path'] = './uploads/text_bg/';
                $config_bg_img['file_name'] = $bg_img_name;
                $config_bg_img['allowed_types'] = 'jpg|jpeg|png|gif';
                $config_bg_img['encrypt_name'] = TRUE;
                $this->load->library('upload', $config_bg_img);
                $this->upload->initialize($config_bg_img);
                if ( ! $this->upload->do_upload('url') ){
                    $json = array('status' => false, 'msg' => $this->upload->display_errors());
                    echo json_encode($json);exit();
                } else {
                    $input['url'] = $this->upload->file_name;
                }
            } 
            if($this->text_model->create_action($input)){
                $json['status'] = true;
                $json['msg'] = "Successfully submitted!";
            } else {
                $json['status'] = false;
                $json['msg'] = "Something went to wrong!";
            }
        } else {
            $json['status'] = false;
            $json['msg'] = "Content is required";
        }
        echo json_encode($json);exit();
    }

    public function update()
    {
        if(!empty($this->input->post('content'))){
            $input['content'] = $this->input->post('content');
            $input['user_id'] = $this->input->post('user_id');
            $input['text_category_id'] = $this->input->post('text_category_id');
            $input['is_trending'] = $this->input->post('is_trending');
             $input['language'] = $this->input->post('language');
            $input['point'] = $this->input->post('point');
            $input['created_at'] = date('Y-m-d h:i:s');
            if(!empty($_FILES['url'])){
                $bg_img_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['url']['name']);
                $config_bg_img['upload_path'] = './uploads/text_bg/';
                $config_bg_img['file_name'] = $bg_img_name;
                $config_bg_img['allowed_types'] = 'jpg|jpeg|png|gif';
                $config_bg_img['encrypt_name'] = TRUE;
                $this->load->library('upload', $config_bg_img);
                $this->upload->initialize($config_bg_img);
                if ( ! $this->upload->do_upload('url') ){
                    $json = array('status' => false, 'msg' => $this->upload->display_errors());
                    echo json_encode($json);exit();
                } else {
                    $input['url'] = $this->upload->file_name;
                }
            } 
            if($this->text_model->update_action($input,$this->input->post('id'))){
                $json['status'] = true;
                $json['msg'] = "Successfully updated!";
            } else {
                $json['status'] = false;
                $json['msg'] = "Something went to wrong!";
            }
        } else {
            $json['status'] = false;
            $json['msg'] = "Content is required";
        }
        echo json_encode($json);exit();
    }
    
    public function trending()
    {
        $query = $this->text_model->trending();
        $texts = $query->result_array();
        if(count($texts) > 0){
            $result['msg'] = "Text  Found";
            $result['texts'] = $texts;
            $result['status'] = true;
        } else {
            $result['msg'] = "Not Found"; 
            $result['status'] = false;
        }
        echo json_encode($result);
    }

    public function delete($id){
        $del=$this->text_model->delete($id);
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