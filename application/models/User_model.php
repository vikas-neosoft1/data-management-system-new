<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    /*check  for rmail exist or not 
    if existreturn true else false
    */ 
    public function checkEmailExist($email) {
        $emailChckQuery = $this->db->where("email",$email)->get("tbl_users");
        return ($emailChckQuery->num_rows() >0 ) ? true : false;
    }

    /* Login 
      @params: post form data from login view
      @return array
    */
    public function validateLogin() {
        $email          = $this->input->post("email");
        $password       = $this->input->post("password");

        /* check  for email exist*/
        $emailExist     = $this->checkEmailExist($email);
        if(!$emailExist) {
            $responseArr   = ["status"=>300,"message"=>"Email not exist"];
            return $responseArr;
        }

        $doLogin = $this->db->select("id,name,email,user_type")->where( ["email"=>$email,"password"=>md5($password) ])->get("tbl_users");
        if($doLogin->num_rows() > 0 ) {
            $row = $doLogin->result_array();
            $this->session->set_userdata($row[0]);
            $this->session->set_userdata("isLogin",1); 
               
            $responseArr = ['status'=>200,"message"=>"Loged in successfully"];
            return $responseArr; 
              
       }else{
           $responseArr = ['status'=>400,"message"=>"Invalid password"];
            return $responseArr;
        }  
    }

    /*save sign up user data */
    public function saveUserRecord() {
        $name                   = $this->input->post("name");
        $email                  = $this->input->post("email");
        $password               = $this->input->post("password");
        $insertArr = [
            "name"      => $name,
            "email"     => $email,
            "user_type" => USER,
            "password"  => md5($password),
            "indate"    => date("Y-m-d H:i:s") 
        ];
        $inserQuery = $this->db->insert("tbl_users",$insertArr);
        if($inserQuery) {
            $data = ["status"=>200,"message"=>"Account created successfully. Login to continue"];
        }else {
            $data = ["status"=>500,"message"=>"Account not created. Something went wrong"];
        }

        return $data;
    }

    /* Get user data by id
        @Param user_id 
        @return user single row result set
    */

    public function getRecordById($user_id) {
        $getUserQuery = $this->db->where("id",$user_id)->get("tbl_users");
        return ($getUserQuery) ? $getUserQuery->row() : false;

    }
     
     
    /*chech email exist or not on edit profile */
    public function checkEmailById() {
       $id          =  $this->input->get("id");
       $email       =  $this->input->get("email");
        $userRow = $this->getRecordById($id); 
        //print_r($userRow);exit;  
        if($userRow->email != $email  ) {
                $emailValidate 		= $this->db->where("email",$email)->get("tbl_users");
                return ($emailValidate->num_rows() > 0) ? true : false ;
            } 
    }

    /* Update user profile with profile image */
    public function updateProfile() {
        $id         =  $this->input->post("id");
        $name       =  $this->input->post("name");
        $email      =  $this->input->post("email");


        if($_FILES['image']['error'] == 0) { 
            $config['upload_path']          = './uploads/profile_images/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size'] = 20000;
            $config['encrypt_name ']		= true; 
            $new_name = time()."-".$_FILES["image"]['name'];
            $new_name = str_replace(' ', '_', $new_name);  
            $config['file_name'] = $new_name;  


            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image'))
            {
                $error = $this->upload->display_errors();
                $resultData = ["status"=>300,"msg"=>$error];
                return $resultData; 
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $profile_image = $data['upload_data']['file_name'];
            } 
        }else{
            $profile_image =  $old_image;
        }	



        $update_arr = ["name"=>$name,"email"=>$email,"image"=>$profile_image];
        return $updated    =  $this->updateUserRecord($table = "tbl_users", $id, $update_arr);
    }


    /* use in models to updte query*/
    public function updateUserRecord($table, $id, $updArr) {
        $updQuery = $this->db->where("id",$id)->update($table, $updArr);
        //echo $this->db->last_query();exit;
        return ($updQuery) ? true : false; 
    }



    /* Validate current password (On change password)  */
    public function validateOldPassword($id, $password = "") {
        $validateQuery = $this->db->where(["id"=>$id, "password"=> md5($password)])->get("tbl_users");
        //echo $this->db->last_query();
        return ($validateQuery->num_rows() > 0) ? true : false; 
    }

    /* Update user profile */
    public function updatePassword() {
        $id         =  $this->input->post("id");
        $password       =  $this->input->post("password");

        $update_arr = ["password"=>md5($password)];
        return $updated    =  $this->updateUserRecord($table = "tbl_users", $id, $update_arr);
    }



}

?>