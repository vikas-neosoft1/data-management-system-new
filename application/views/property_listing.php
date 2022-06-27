<main id="main">

    <!-- ======= Services Section ======= -->
    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a"><?php echo $heading;?></h2>
              </div>
              <a class="btn btn-success btn-sm " href="<?php echo base_url("properties/add_edit")?>">Add Property</a>
            </div>
          </div>
        </div>
        <div class="row">

        <div class="table-responsive">
            <table id="property-table" class="table">
             <thead>
               <tr>
                <th style="width:7%">Sr. No</th>
                <th style="width:10%">Title</th>
                <th style="width:10%">Price</th>
                <th style="width:10%">Floor Area(Sq Feet)</th>
                <th style="width: 5%">Bedroom</th>
                <th style="width:5%">Bathroom</th>
                <th style="width:10%">city</th>
                <th style="width:10%">Address</th>
                <th style="width:10%">Description</th>
                <th style="width:10%">Featured Images</th>
                <th style="width:10%">Gallery Images</th>
                <th style="width:10%">Near By</th>
                <th style="width:10%">Action</th>
               </tr>
             </thead>
             <tbody> 
              <?php $i=0; 
               if(!empty($records)) {
                foreach($records as $record) { 
                  $i++;
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $record->title;?></td>
                    <td><?php echo $record->price;?></td>
                    <td><?php echo $record->floor_area;?></td>
                    <td><?php echo $record->bedroom;?></td>
                    <td><?php echo $record->bathroom;?></td>
                    <td><?php echo $record->city;?></td>
                    <td><?php echo $record->address;?></td>
                    <td><?php echo $record->description;?></td>
                    <td><a href="<?php echo base_url("properties/get_property_images?id=".$record->id."&image_type=".FEATURED_IMAGE);?>" class="property-images">Show Featured Image</a></td>
                    <td><a href="<?php echo base_url("properties/get_property_images?id=".$record->id."&image_type=".GALLERY_IMAGE);?>" class="property-images">Show Gallery Image</a></td>
                    <td><?php echo $record->near_by;?></td> 
                    <td><a href="<?php echo base_url("properties/add_edit/".$record->id);?>" class="text-success">Edit</a></td>
                </tr>

              <?php } } ?> 

             </tbody>
            </table>
        </div>


        </div>
      </div>
    </section><!-- End Services Section -->

<div class="modal" tabindex="-1" role="dialog" id="productImagesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content  ">
      <div class="modal-header">
        <h5 class="modal-title">Property images</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>

      <div class="modal-body product-image-content">
      </div>
     
     
    </div>
  </div>
</div>

  
  
 


</main><!-- End #main -->

<?php if($this->session->flashdata('success')) { ?>
        <script>toastr.success("<?php echo $this->session->flashdata('success');?>")</script>                
    <?php } ?>

    <?php if($this->session->flashdata('error')) { ?>
        <script>toastr.success("<?php echo  $this->session->flashdata('error');?>")</script>                
    <?php } ?>

    



<?php /* <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
 */?>
<script>
  $(document).ready(function(){
    $("#property-table").dataTable();
  })

  $('.property-images').on('click', function(e){
    e.preventDefault();
    $('#productImagesModal').modal('show').find('.product-image-content').load($(this).attr('href'));
}); 


</script>
  