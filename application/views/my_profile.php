<main id="main">

    <!-- ======= Services Section ======= -->
    <?php 
    $name       = $row->name;
    $email      = $row->email;
    $image      = $row->image;
    $id         =   $row->id;

    ?>

    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box text-center">
                <h2 class="title-a">My Profile</h2> 
                

              </div>
            </div>
          </div>
        </div>
        <div class="row">
        <form class="form-a" id="signup-form" name="signup-form" method="post" action="<?php echo base_url("user/updateProfile");?>" enctype="multipart/form-data" >
        <div class="row offset-3">
        
        <div class="col-md-9 mb-4">
            <div class="form-group">
              <label class="pb-2" for="name">Name*</label>
              <input type="text" id="name" name="name" class="form-control form-control-lg" value="<?php echo $name;?>" placeholder="Enter name">
              <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
            </div>
        </div>  

        <div class="col-md-9 mb-4">
            <div class="form-group">
              <label class="pb-2" for="email">Email*</label>
              <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?php echo $email;?>" placeholder="Enter email">
            </div>
        </div>

        <div class="col-md-12 mb-4">
                <div class="form-group">
                <label for="image">Image (Maxsize:2mb,Allowed file type: jpeg, jpg, png )</label>
                <input type="file"  class="form-control" id="image" name="image"  value="<?php echo $image; ?>" >
                <input type="hidden" name="old_image" id="old_image" value="<?php echo $image; ?>"> 
         </div>
         
         <?php if(!empty($image) && ($image) != 'null' ) { ?>
          <img src="<?php echo base_url("uploads/profile_images/".$image)?>" class="mb-4 mt-4" height="200" width ="300"/>
          <?php } ?>
         </div> 


        


          
        <div class="col-md-8 text-center mb-5">
            <button type="submit" class="btn btn-success">Update</button>
            
          </div>
        </div>

      </form>
         
        </div>
      </div>
    </section><!-- End Services Section -->

   
   
   <script src="<?php echo base_url(ASSETS);?>js/jquery.validate.js"></script>


    <?php if($this->session->flashdata('success')) { ?>
        <script>toastr.success("<?php echo $this->session->flashdata('success');?>")</script>                
    <?php } ?>

    <?php if($this->session->flashdata('error')) { ?>
        <script>toastr.error("<?php echo  $this->session->flashdata('error');?>")</script>                
    <?php } ?>

   <script>
    $(document).ready(function(){ 
        
        
        $("#signup-form").validate({
            rules:{
                name:{
                    required:true
                },
                email:{
                    required:true,
                    email:true,
                    remote:{
                            url:"<?php echo base_url("user/checkEmailOnEdit")?>",
                            type:"get",
                            data:{
                                id:function() 
                                { 
                                    return $("#id").val();
                                }
                            }
                        }
                },

                            
            },
            messages:{
                name:{
                    required:"Pleas enter name"
                },
                email:{
                    required:"Please enter email",
                    email:"Please enter valid email",
                    remote:"Email already exist" 
                }    
            
            },
            submitHandler : function(form) {
            form.submit();
            }    
        }); 
        
        }); 

</script>
  </main>