<main id="main">

    <!-- ======= Services Section ======= -->
    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box text-center">
                <h2 class="title-a">Login</h2>

    
                

              </div>
            </div>
          </div>
        </div>
        <div class="row">
        <form class="form-a" id="login-form" name="login-form" method="post" action="<?php echo base_url("user/validateLogin")?>" >
        <div class="row offset-3">
          
        <div class="col-md-9 mb-5">
                <?php if($this->session->flashdata('error')) { ?>
                    <span class="text-danger"><?php echo $this->session->flashdata('error'); ?></span> 
                <?php } ?>
            <div class="form-group">
              <label class="pb-2" for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control form-control-lg form-control" placeholder="Enter email">
            </div>
        </div>

        <div class="col-md-9 mb-5">
            <div class="form-group">
              <label class="pb-2" for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control form-control-lg form-control" placeholder="Enter password">
            </div>
        </div>
          
        <div class="col-md-8 text-center mb-5">
            <button type="submit" class="btn btn-success">Login</button>
            <span>Do'nt have account?</span> <a href="<?php echo base_url("user/signup");?>">Sign up</a>
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
        $("#login-form").validate({
            rules:{
                email:{
                    required:true,
                    email:true 
                },
                password:{
                    required: true
            }             
            },
            messages:{
                email:{
                    required:"Please enter email",
                    email:"Please enter valid email" 
                },
                password:{
                    required:"Please enter password"
                }    
            
            },
            submitHandler : function(form) {
            form.submit();
            }    
        }); 
        
        }); 

</script>
  </main>