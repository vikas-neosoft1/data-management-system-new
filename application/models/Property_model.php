<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Property_model extends CI_Model {

    
    
    ##########
    # for web 
    ############


    /* return ditinct record by @column_name for home page */
    public function getProperyStats($column_name) {
        $this->db->select("DISTINCt($column_name)");
        $this->db->where("status !=", DELETED);
        $this->db->order_by($column_name, 'asc');
        $statQuery = $this->db->get("tbl_properties");
        return ($statQuery)  ? $statQuery->result() : false; 
    }

    /* show Property list after filetr form home page*/
    public function getPropertyRecordsBySeaach() {

        $title      =    $this->input->get("building_name");
        $city       =    $this->input->get("city");
        $bedroom    =    $this->input->get("bedroom");
        $price      =    $this->input->get("price");



        $data = [];

        if(!empty($title)) {
            $this->db->where("title like '%$title%' ");
        }

        if(!empty($city)) {
            $this->db->like("city", $city);
        }

        if(!empty($bedroom)) {
            $this->db->where("bedroom", $bedroom);
        }

        if(!empty($price)) {
            $this->db->where("price <= $price ");
        }

        $this->db->where("status != ", DELETED);
        $propertyRecord = $this->db->get("tbl_properties"); 
        //echo $this->db->last_query();exit;
        if($propertyRecord->num_rows() > 0  ) {
            foreach($propertyRecord->result() as $row ) {
                $row->images = $this->getProperyImages($row->id, 10);
                $data[] = $row;
            }
            return $data;
        }else{
            return false;
        }
    }

    /* Property detail by id 
    @param : id
    @return : row or false
    */
    public function getPropertyDetailById($id) {
        $data = [];
        $this->db->where("id", $id);
        $this->db->where("status != ", DELETED);
        $propertyRecord = $this->db->get("tbl_properties"); 
        if($propertyRecord->num_rows() > 0  ) {
            foreach($propertyRecord->result() as $row ) {
                $row->images = $this->getProperyImages($row->id, 10);
                $data[] = $row;
            }
            return $data;
        }else{
            return false;
        }
    }

    public function getProperyImages($pro_id, $limit) {
        $this->db->where("property_id",$pro_id);
        $this->db->limit($limit);
        $imgQuery = $this->db->get("tbl_images");
        return  ($imgQuery->num_rows() > 0 )  ? $imgQuery->result() : false;
    }

    /*Save message for property by user */
    public function saveUserMessage() {
        $name           = $this->input->post("name");
        $mobile         = $this->input->post("mobile");
        $property_id    = $this->input->post("property_id");
        $message        = $this->input->post("message");
        $user_id        = $this->input->post("user_id");


        /* check for duplicate message by same user for same property*/
        $validateDuplicate = $this->db->where(["user_id"=>$user_id, "property_id"=>$property_id])->get("tbl_messages");
        if($validateDuplicate->num_rows() > 0 ) {
            $data = ["status"=>300,"message"=>"Alredy, you have sent your message"];
            return $data;
        }

        $insertMessage = [
            "user_id"       =>  $user_id,
            "property_id"   =>  $property_id,
            "name"          =>  $name,
            "mobile"        =>  $mobile,
            "message"       =>  $message,
            "indate"        =>  date("Y-m-d H:i:s")
        ];

        $insertQuery = $this->db->insert("tbl_messages",$insertMessage);
        if($insertQuery) {
            $data = ["status"=>200,"message"=>"Message have sent succeffully"];
        }else{
            $data = ["status"=>200,"message"=>"Message not sent"];
        }
        return $data;
    }





    #################################################
    ### For Admin 
    #################################################

    /*For Admin use */


    public function getPropertyRecords() {
        $recordQuery = $this->db->where("status!= ", DELETED)->get("tbl_properties");
        return ($recordQuery->num_rows() > 0 ) ? $recordQuery->result() : false;
    }


    /*Save property data */
    public function saveProperty() {
        $title                  = $this->input->post("title");
        $price                  = $this->input->post("price");
        $floor_area               =    $this->input->post("floor_area");
        $bedroom       = $this->input->post("bedroom");
        $bathroom                  = $this->input->post("bathroom");
        $city                  = $this->input->post("city");
        $address               =    $this->input->post("address");
        $description       = $this->input->post("description");
        $near_by                  = $this->input->post("near_by");
    
        $id = $this->input->post("id");
         
        $propertyData = [
            "title"         =>  $title,
            "price"         =>  $price,
            "floor_area"    =>  $floor_area,
            "bedroom"       =>  $bedroom,
            "bathroom"      =>  $bathroom,
            "city"          =>  $city,
            "address"       =>  $address,
            "description"   =>  $description,
            "near_by"       =>  $near_by,
        ];

        if(empty($id)) {
            // featured_images 
            $propertyData['indate'] = date("Y-m-d H:i:s");
            $inserQuery = $this->db->insert("tbl_properties",$propertyData);
            $id = $this->db->insert_id();

            $data = ["status"=>200,"message","Property created successfully.","id"=>$id];

        }else{
            $propertyData['updated_at'] = date("Y-m-d H:i:s");
            $inserQuery = $this->db->where("id", $id)->update("tbl_properties",$propertyData);
            $data = ["status"=>200,"message","Property updated successfully.","id"=>$id];
        }
        

        

        return $data;
    }

    /* Get Property by id 
    @param : id
    #resturn : resutt set or false
    */
    public function getPropertyById($id) {
        $getPropertyQuery = $this->db->where("id",$id)->get("tbl_properties");
        return ($getPropertyQuery) ? $getPropertyQuery->row() : false;

    }
     
    /* Upload property images */     
    public function multiUpload($field_name, $property_id,$image_type, $uploadPath)  {

        $this->load->library('upload');
        $image = array();
        $ImageCount = count($_FILES[$field_name]['name']);
              for($i = 0; $i < $ImageCount; $i++) {
                  $_FILES['file']['name']       = $_FILES[$field_name]['name'][$i];
                  $_FILES['file']['type']       = $_FILES[$field_name]['type'][$i];
                  $_FILES['file']['tmp_name']   = $_FILES[$field_name]['tmp_name'][$i];
                  $_FILES['file']['error']      = $_FILES[$field_name]['error'][$i];
                  $_FILES['file']['size']       = $_FILES[$field_name]['size'][$i];
      
                  
                  $config['upload_path'] = $uploadPath;
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['min_width'] = 600;
                  $config['min_height'] = 800;

                  $config['max_width'] = 800;
                  $config['max_height'] = 1200;
      
                  $this->load->library('upload', $config);
                  $this->upload->initialize($config);
      
                  
                  if($this->upload->do_upload('file')){
                    $imageData = $this->upload->data();
                    $uploadImgData[$i]['image'] = $imageData['file_name'];
                    $uploadImgData[$i]['property_id'] = $property_id;
                    $uploadImgData[$i]['image_type'] = $image_type;
                    $uploadImgData[$i]['indate'] = date("Y-m-d H:i:s");
                  }else{
                    $error = $this->upload->display_errors();
                    $errorData = ["staus"=>300,"message"=>$error];
                    return $errorData; 
                  }
              }
               if(!empty($uploadImgData)){
                    
                    // Insert files data into the database
                    $this->db->insert_batch("tbl_images", $uploadImgData);
                    $errorData = ["staus"=>200,"message"=>"image uploded"];
                    return $errorData; 
              }
    }

    public function getPropertMessages() {
        $this->db->select("tbl_messages.*, tbl_users.name as user_name,tbl_users.email as user_email, tbl_properties.title as property_name");
        $this->db->join("tbl_users","tbl_users.id = tbl_messages.user_id","LEFT");
        $this->db->join("tbl_properties","tbl_properties.id = tbl_messages.property_id","LEFT");
        $messagesQuery = $this->db->get("tbl_messages");
        return ($messagesQuery->num_rows() > 0 ) ? $messagesQuery->result() : false; 
    }


    /* show prperty images  */
    public function getPropertyImages($proprtty_id, $image_type) {
        $imageQuery = $this->db->where(["property_id"=>$proprtty_id, "image_type"=>$image_type])->get("tbl_images");
        return ($imageQuery->num_rows() > 0) ? $imageQuery->result() : false;;
    }

}

?>