
 <!-- ======= Intro Single ======= -->
 <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single">Filtered Properties</h1>
            </div>
          </div>
          
        </div>
      </div>
    </section><!-- End Intro Single-->


    <section class="property-grid grid">
      <div class="container">
        <div class="row">
          <?php if(!empty($records)) { 
            foreach($records as $record) {   
                $imgPath = "";
                if(!empty($record->images)) {
                    $imagesArr = $record->images[0];
                    $image_type = $imagesArr->image_type;
                    if($image_type == FEATURED_IMAGE) {
                        $imgPath = "/uploads/featured_images/".$imagesArr->image;
                    }else{
                        $imgPath = "/uploads/gallery_images/".$imagesArr->image;
                    }
                     
                }

            ?>
          <div class="col-md-4">
            <div class="card-box-a card-shadow">
              <div class="img-box-a">
                <img src="<?php echo base_url($imgPath);?>" alt="" class="img-a img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-overlay-a-content">
                  <div class="card-header-a">
                    <h2 class="card-title-a">
                      <a href="<?php echo base_url("properties/property_detail/".$record->id);?>"><?php echo $record->title?>
                        </a>
                    </h2>
                  </div>
                  <div class="card-body-a">
                    <div class="price-box d-flex">
                      <span class="price-a">Price |   <?php echo CURRENCY ." ". $record->price;?></span>
                    </div>
                    <a href="<?php echo base_url("properties/property_detail/".$record->id);?>" class="link-a">Click  to view detail
                      <span class="bi bi-chevron-right"></span>
                    </a>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <?php } }else{  ?>
            <div class="col-md-12 text-center"><h3>No record found</h3></div>
           <?php } ?> 
          
         
        </div>
        
    </section><!-- End Property Grid Single-->

