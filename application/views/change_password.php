<main id="main">

    <!-- ======= Services Section ======= -->

    <?php $id  =   $this->session->id; ?>

    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box text-center">
                <h2 class="title-a"><?php echo $heading;?></h2> 
               
                 <?php if($this->session->flashdata('form_error')) { ?>
                    <span class="text-danger"><?php echo $this->session->flashdata('form_error'); ?></sapn> 
                <?php } ?> 
              </div>
            </div>
          </div>
        </div>
        <div class="row">
        <form class="form-a" id="password-form" name="password-form" method="post" action="<?php echo base_url("user/updatePassword");?>" >
        <div class="row offset-3">
      

      <div class="col-md-9 mb-4">
          <div class="form-group">
              <label class="pb-2" for="password"> Current Password*</label>
              <input type="password" id="current_password" name="current_password" class="form-control form-control-lg" placeholder="Enter current password">
          </div>
      </div>

        <div class="col-md-9 mb-4">
            <div class="form-group">
              <label class="pb-2" for="password">New Password*</label>
              <input type="password" id="password" name="password" class="form-control form-control-lg " placeholder="Enter new password">
            </div>
        </div>

        <div class="col-md-9 mb-5">
            <div class="form-group">
              <label class="pb-2" for="confirm_password">Confirm New Password*</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg" placeholder="Enter confirm new password">
            </div>
        </div>

        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
          
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
        <script>toastr.success("<?php echo  $this->session->flashdata('error');?>")</script>                
    <?php } ?>
   <script>
    $(document).ready(function(){ 
        $("#password-form").validate({
            rules:{
                name:{
                    required:true
                },
                current_password:{
                    required:true,
                    minlength:8,
                    maxlength:20,
                    remote:{
                            url:"<?php echo base_url("user/validateOldPassword")?>",
                            type:"get",
                            data:{
                                id:function() 
                                { 
                                    return $("#id").val();
                                }
                            }
                        }
                }, 
                password:{
                    required: true,
                    minlength:8,
                    maxlength:20
                },
                confirm_password:{
                    required:true,
                    equalTo:"#password"
                }             
            },
            messages:{
                
                current_password:{
                    required:"Please enter old password",
                    remote:"Incorrect password",
                    minlenth:"Enter minimum 8 characters",
                    maxlength:"Enter maximum 20 characters" 
                },
                password:{
                    required:"Please enter password",
                    minlenth:"Enter minimum 8 characters",
                    maxlength:"Enter maximum 20 characters"
                },
                confirm_password:{
                    required:"Plese enter confirm password",
                    equalTo:"Password and confirm password should be same"
                }    
            
            },
            submitHandler : function(form) {
            form.submit();
            }    
        }); 
        
        }); 

</script>
  </main>