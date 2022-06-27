<?php
if(!empty($records)) { ?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    
  <?php 
            foreach($records as $key => $image_row) {
              $image_type = $image_row->image_type;
              if($image_type == FEATURED_IMAGE) {
                  $imgPath = "/uploads/featured_images/".$image_row->image;
              }else{
                  $imgPath = "/uploads/gallery_images/".$image_row->image;
              }
              ?>
  
            <div class="carousel-item <?php echo ($key==0) ? 'active' : false; ?> " >
              <img class="d-block w-100" src="<?php echo base_url($imgPath);?>" alt="">
            </div>
    <?php } ?>
  </div>

    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<?php }else{  ?>

 <?php } ?> 


 
  

   