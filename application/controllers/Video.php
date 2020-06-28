<?php defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");

require_once APPPATH . 'controllers/Auth.php';

class Video extends Auth
{
    function  __construct() 
    {
        parent::__construct();
        $this->load->model('video_model');
        parent::authentication();
    }

    public function list()
    {
        if(!empty($this->input->post('video_category_id'))){
            $query = $this->video_model->list_by_video_category_id($this->input->post('video_category_id'));
        } else {
            $query = $this->video_model->list();
        }
        $videos = $query->result_array();
        if(count($videos) > 0){
            $result['msg'] = "Video  Found";
            $result['videos'] = $videos;
            $result['status'] = true;
        } else {
            $result['msg'] = "Not Found"; 
            $result['status'] = false;
        }
        echo json_encode($result);
    }

    public function details($id){
      if(count($this->video_model->details_by_id($id)) > 0){
          $result['details']=$this->video_model->details_by_id($id); 
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
            if(!empty($_FILES['thumbnail_img'])){
                $thumbnail_img_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['thumbnail_img']['name']);
                $config_thumbnail_img['upload_path'] = './uploads/thumbnail_img/';
                $config_thumbnail_img['file_name'] = $thumbnail_img_name;
                $config_thumbnail_img['allowed_types'] = 'jpg|jpeg|png|gif';
                $config_thumbnail_img['encrypt_name'] = TRUE;
                $this->load->library('upload', $config_thumbnail_img);
                $this->upload->initialize($config_thumbnail_img);
                if ( ! $this->upload->do_upload('thumbnail_img') ){
                    $json = array('status' => false, 'msg' => $this->upload->display_errors());
                    echo json_encode($json);exit();
                } else {
                    $input['thumbnail_img'] = $this->upload->file_name;
                }
            } 
            $video_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['url']['name']);
            $config_video['upload_path'] = './uploads/video/';
            $config_video['file_name'] = $video_name;
            $config_video['allowed_types'] = 'avi|mp4|3gp|mpeg|mpg|mov|mp3|flv|wmv';
            $config_video['encrypt_name'] = TRUE;
            $this->load->library('upload', $config_video);
            $this->upload->initialize($config_video);
            if ( ! $this->upload->do_upload('url') ){
                $json = array('status' => false, 'msg' => $this->upload->display_errors());
            } else {
                $input['url'] = $this->upload->file_name;
                $input['user_id'] = $this->input->post('user_id');
                $input['name'] = $this->input->post('name');
                $input['time'] = $this->input->post('time');
                $input['video_category_id'] = $this->input->post('video_category_id');
                $input['is_trending'] = $this->input->post('is_trending');
                $input['point'] = $this->input->post('point');
                $input['created_at'] = date('Y-m-d h:i:s');
                if($this->video_model->create_action($input)){
                    $json['status'] = true;
                    $json['msg'] = "Successfully submitted!";
                } else {
                    $json['status'] = false;
                    $json['msg'] = "Something went to wrong!";
                }
            }
        } else {
            $json['status'] = false;
            $json['msg'] = "Video is required";
        }
        echo json_encode($json);exit();
    }

    public function update()
    {
        if(!empty($_FILES['thumbnail_img'])){
            $thumbnail_img_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['thumbnail_img']['name']);
            $config_thumbnail_img['upload_path'] = './uploads/thumbnail_img/';
            $config_thumbnail_img['file_name'] = $thumbnail_img_name;
            $config_thumbnail_img['allowed_types'] = 'jpg|jpeg|png|gif';
            $config_thumbnail_img['encrypt_name'] = TRUE;
            $this->load->library('upload', $config_thumbnail_img);
            $this->upload->initialize($config_thumbnail_img);
            if ( ! $this->upload->do_upload('thumbnail_img') ){
                $json = array('status' => false, 'msg' => $this->upload->display_errors());
                echo json_encode($json);exit();
            } 
            $input['thumbnail_img'] = $this->upload->file_name;
        } 

        if(!empty($_FILES['url'])){
            $video_name = date("Y-m-d_h:i:s")."-".str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['url']['name']);
            $config_video['upload_path'] = './uploads/video/';
            $config_video['file_name'] = $video_name;
            $config_video['allowed_types'] = 'avi|mp4|3gp|mpeg|mpg|mov|mp3|flv|wmv';
            $config_video['encrypt_name'] = TRUE;
            $this->load->library('upload', $config_video);
            $this->upload->initialize($config_video);
            if ( ! $this->upload->do_upload('url') ){
                $json = array('status' => false, 'msg' => $this->upload->display_errors());
                echo json_encode($json);exit();
            } 
            $input['url'] = $this->upload->file_name; 
        }

        $input['user_id'] = $this->input->post('user_id');
        $input['name'] = $this->input->post('name');
        $input['time'] = $this->input->post('time');
        $input['video_category_id'] = $this->input->post('video_category_id');
        $input['is_trending'] = $this->input->post('is_trending');
        $input['point'] = $this->input->post('point');
        if($this->video_model->update_action($input,$this->input->post('id'))){
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
        $query = $this->video_model->trending();
        $videos = $query->result_array();
        if(count($videos) > 0){
            $result['msg'] = "Video  Found";
            $result['videos'] = $videos;
            $result['status'] = true;
        } else {
            $result['msg'] = "Not Found"; 
            $result['status'] = false;
        }
        echo json_encode($result);
    }

    public function delete($id){
        $del=$this->video_model->delete($id);
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