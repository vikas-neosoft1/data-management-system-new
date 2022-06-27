<main id="main"> 
<?php $rowData = $row[0];?>
<!-- ======= Intro Single ======= -->
  <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single"><?php echo $rowData->title?></h1>
              <span class="color-text-a"><?php echo $rowData->city;?></span>
            </div>
          </div>
         
        </div>
      </div>
    </section><!-- End Intro Single-->

    <!-- ======= Property Single ======= -->
    <section class="property-single nav-arrow-b">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div id="property-single-carousel" class="swiper">
              <div class="swiper-wrapper">
              <?php 
              $imagesArr = $rowData->images;
                foreach($imagesArr as $image_row)

              $image_type = $image_row->image_type;
              if($image_type == FEATURED_IMAGE) {
                  $imgPath = "/uploads/featured_images/".$image_row->image;
              }else{
                  $imgPath = "/uploads/gallery_images/".$image_row->image;
              }
              ?>
                <div class="carousel-item-b swiper-slide">
                  <img src="<?php echo base_url($imgPath);?>" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">

            <div class="row justify-content-between">
              <div class="col-md-5 col-lg-4">
                <div class="property-price d-flex justify-content-center foo">
                  <div class="card-header-c d-flex">
                    <div class="card-box-ico">
                      <span class="bi bi-cash"><?php echo CURRENCY?></span>
                    </div>
                    <div class="card-title-c align-self-center">
                      <h5 class="title-c"><?php echo $rowData->price;?></h5>
                    </div>
                  </div>
                </div>
                <div class="property-summary">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="title-box-d section-t4">
                        <h3 class="title-d">Quick Summary</h3>
                      </div>
                    </div>
                  </div>
                  <div class="summary-list">
                    <ul class="list">
                      
                      <li class="d-flex justify-content-between">
                        <strong>Location:</strong>
                        <span><?php echo $rowData->address,$rowData->city;?></span>
                      </li>
                      
                      <li class="d-flex justify-content-between">
                        <strong>Area:</strong>
                        <span><?php echo $rowData->floor_area;?>
                          (Square Feet)
                        </span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Bedrooms:</strong>
                        <span><?php echo $rowData->bedroom;?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Bathrooms:</strong>
                        <span><?php echo $rowData->bathroom;?></span>
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-7 col-lg-7 section-md-t3">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="title-box-d">
                      <h3 class="title-d">Property Description</h3>
                    </div>
                  </div>
                </div>
                <div class="property-description">
                  <p class="description color-text-a">
                    <?php echo $rowData->description;?>
                  </p>
                  
                </div>
                
              </div>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="row section-t3">
              <div class="col-sm-12">
                <div class="title-box-d">
                  <h3 class="title-d">Send a message</h3>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-4">
                <img src="assets/img/agent-4.jpg" alt="" class="img-fluid">
              </div>
              
              <div class="col-md-12 col-lg-4">
                <div class="property-contact">
                  <form class="form-a" id="message-form" name="message-form" action="<?php echo base_url("properties/saveUserMessage")?>" method="post"  >

                  <?php 
                  // get id from session loged in user 
                  $user_id =  $name = "";
                  if($this->session->id) {
                      $user_id  = $this->session->id;
                      $name     = $this->session->name;
                  }
                  
                  ?>
                    <div class="row">
                      <div class="col-md-12 mb-1">
                        <div class="form-group">
                          <input type="text" class="form-control form-control-lg form-control-a" name="name" id="name" placeholder="Name *" value="<?php echo $name;?>" required>
                          <input type="hidden" name="property_id" id="property_id" value="<?php echo $rowData->id;?>" />
                          <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />

                        </div>
                      </div>
                      <div class="col-md-12 mb-1">
                        <div class="form-group">
                          <input type="text" class="form-control form-control-lg" id="mobile" name="mobile" placeholder="Mobile *" required>
                        </div>
                      </div>
                      <div class="col-md-12 mb-1">
                        <div class="form-group">
                          <textarea id="textMessage" class="form-control" placeholder="Message *" id="message" name="message" cols="45"  rows="8" required></textarea>
                        </div>
                      </div>
                      <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-a">Send Message</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Property Single-->
    </main>
    <?php if($this->session->flashdata('success')) { ?>
        <script>toastr.success("<?php echo $this->session->flashdata('success');?>")</script>                
    <?php } ?>

    <?php if($this->session->flashdata('error')) { ?>
        <script>toastr.error("<?php echo  $this->session->flashdata('error');?>")</script>                
    <?php } ?>

    <script src="<?php echo base_url(ASSETS);?>js/jquery.validate.js"></script>
   <script>
    
      
    $(document).ready(function(){ 
        $("#message-form").validate({
            rules:{
                mobile:{
                    required:true,
                    digits:true,
                    maxlength:10,
                    minlength:10,
                },
                name:{
                    required: true
                },
                message:{
                    required: true
                }             
            },
            messages:{
                name:{
                    required:"Please enter name"
                },
                mobile:{
                    required:"Please enter mobile",
                    digits:"Please enter number only" 
                },
                message:{
                    required:"Please enter message"
                }    
            
            },
            submitHandler : function(form) {
            form.submit();
            }    
        }); 
        
        }); 

</script>
