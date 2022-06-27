<main id="main">

    <!-- ======= Services Section ======= -->
    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box text-center">
                <h2 class="title-a"><?php echo $heading;?></h2> 
                  <?php if($this->session->flashdata('success')) { ?>
                      <span class="text-success"><?php echo $this->session->flashdata('success'); ?></sapn> 
                  <?php } ?>
      
                <?php if($this->session->flashdata('error')) { ?>
                    <span class="text-danger"><?php echo $this->session->flashdata('error'); ?></sapn> 
                <?php } ?> 

              </div>
              <a class="btn btn-secondary btn-sm " href="<?php echo base_url("properties/")?>">Back</a>
            </div>
          </div>
        </div>
        <div class="row">
      <form class="form-a" enctype="multipart/form-data" id="property-form" name="property-form" method="post" action="<?php echo base_url("properties/save");?>" >
      <div class="row">
      <?php 

      $id = $title = $price = $floor_area = $bedroom = $bathroom = $city = $address = $description = $near_by = "";
      if( !empty($row) ) { 
        $id       =     $row->id;
        $title       =     $row->title;
        $price       =     $row->price;
        $floor_area       =     $row->floor_area;
        $bedroom       =     $row->bedroom;
        $bathroom       =     $row->bathroom;
        $city       =     $row->city;
        $address       =     $row->address;
        $description       =     $row->description;
        $near_by       =     $row->near_by;





      }      
      ?>
      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="title">Title</label>
              <input type="text" id="title" name="title" value="<?php echo $title;?>" class="form-control form-control-lg" placeholder="Enter title">
              <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
            </div>
      </div>
      
      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="price">Price</label>
              <input type="text" id="price" name="price" value="<?php echo $price;?>" class="form-control form-control-lg" placeholder="Enter price">
            </div>
      </div>

      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="floor_area">Floor Area</label>
              <input type="text" id="floor_area" name="floor_area" value="<?php echo $floor_area;?>" class="form-control form-control-lg" placeholder="Enter floor area">
            </div>
      </div>


      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="bedroom">Bedroom</label>
              <input type="text" id="bedroom" name="bedroom" value="<?php echo $bedroom;?>" class="form-control form-control-lg" placeholder="Enter bedroom">
            </div>
      </div>

      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="bathroom">Bathroom</label>
              <input type="text" id="bathroom" name="bathroom" value="<?php echo $bathroom;?>" class="form-control form-control-lg" placeholder="Enter bathroom">
            </div>
      </div>

      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="city">City</label>
              <input type="text" id="city" name="city" value="<?php echo $city;?>" class="form-control form-control-lg" placeholder="Enter city">
            </div>
      </div>

      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="address">Address</label>
              <input type="text" id="address" name="address" value="<?php echo $address;?>" class="form-control form-control-lg" placeholder="Enter address">
            </div>
      </div>


      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="description">Near By</label>  
              <input type="text" id="near_by" name="near_by" value="<?php echo $near_by;?>" class="form-control form-control-lg" placeholder="Enter near by">
            </div>
      </div>

      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="feature_images">Featured images (width:600px , height: 800px), Allowed Type(jpg,jpeg,png)</label>
              <input type="file" id="featured_images" name="featured_images[]" class="form-control form-control-lg">
            </div>
      </div>

      <div class="col-md-6 mb-4">
            <div class="form-group">
              <label class="pb-2" for="address">Gallery Images(width:600px , height: 800px),Allowed Type(jpg,jpeg,png)</label>
              <input type="file" id="gallery_images" name="gallery_images[]" class="form-control form-control-lg">
            </div>
      </div>

      <div class="col-md-12 mb-4">
            <div class="form-group">
              <label class="pb-2" for="description">Description</label>  
              <textarea name="description" id="description" class="form-control form-control-lg" pleaceholder="Enter description" ><?php echo $description;?></textarea>
            </div>
      </div>



        <div class="col-md-12 text-center mb-5">
            <button type="submit" class="btn btn-success"><?php echo (empty($id)) ? "Add Property" : "Update Property";  ?></button>
          </div>
        </div>

      </form>
         
        </div>
      </div>
    </section><!-- End Services Section -->

   
   
   <script src="<?php echo base_url(ASSETS);?>js/jquery.validate.js"></script>
   <script>
    
      
    $(document).ready(function(){ 
        $("#property-form").validate({
            rules:{
                title:{
                    required:true
                },
                price:{
                    required:true
                },
                floor_area:{
                    required:true
                },
                bedroom:{
                    required:true,
                    digits:true
                },
                bathroom:{
                    required:true,
                    digits:true
                },
                city:{
                    required:true
                },
                address:{
                    required:true
                },
                description:{
                    required:true
                },
                near_by:{
                    required:true
                },
                "featured_images[]":{
                  required: function () {
                    return $('#id').val().length == 0;
                  } 
                },
                "gallery_images[]":{
                  required: function () {
                    return $('#id').val().length == 0;
                  } 
                }            
            },
            messages:{
                title:{
                    required:"Please enter title"
                },
                price:{
                    required:"Please enter price"
                },
                floor_area:{
                    required:"Please enter floor area"
                },
                bedrrom:{
                    required:"Please enter bedroom"
                },
                bathroom:{
                    required:"Please enter bathroom"
                },
                city:{
                    required:"Please enter city"
                },
                address:{
                    required:"Please enter address"
                },
                description:{
                    required:"Please enter description"
                },
                near_by:{
                    required:"Pleas enter near by"
                },
                "featured_images[]":"Please choose featured images",
                "gllery_images[]":"Please choose gallery images",

                    
            
            },
            submitHandler : function(form) {
            form.submit();
            }    
        }); 
        
        }); 

</script>
  </main>