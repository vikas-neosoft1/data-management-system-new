<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Real State Property</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?php /*<link href="<?php echo base_url(ASSETS)?>img/favicon.png" rel="icon"> */?>
  <link href="<?php echo base_url(ASSETS)?>img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(ASSETS)?>vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(ASSETS)?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(ASSETS)?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url(ASSETS)?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="<?php echo base_url(ASSETS);?>js/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

  <link href="<?php echo base_url(ASSETS)?>css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="<?php echo base_url(ASSETS);?>js/jquery.dataTables.min.js"></script>
  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(ASSETS)?>css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: EstateAgency - v4.7.0
  * Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
 
<body>
   
<?php $currentUrl = $this->uri->segment(1);?> 
<!-- ======= Header/Navbar ======= -->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="<?php echo base_url();?>">Real <span class="color-b">Sate</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item"> 
            <a class="nav-link <?php  echo ($currentUrl == 'home') ? 'active' : ''?>" href="<?php echo base_url();?>">Home  </a>
          </li>

          <?php if(  $this->session->isLogin &&  $this->session->user_type == ADMIN )  { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Properties</a>
            <div class="dropdown-menu">
              <a class="dropdown-item " href="<?php echo base_url("properties");?>">Property List</a>
              <a class="dropdown-item " href="<?php echo base_url("properties/property_messages");?>">Propery Messages</a>
            </div>
          </li>
          <?php } ?>

          
          <?php if($this->session->isLogin) { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
            <div class="dropdown-menu">
              <a class="dropdown-item " href="<?php echo base_url("user/profile");?>">My Profile</a>
              <a class="dropdown-item " href="<?php echo base_url("user/change_password");?>">Change Password</a>
              <a class="dropdown-item " href="<?php echo base_url("user/logout");?>">Logout</a>
  
              
            </div>
          </li>

          <?php  } else {  ?> 
          <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == "user" && $currentUrl == "" ) ? 'active' : '';  ?> " href="<?php echo base_url("user") ?>">Login</a>
          </li>
          <?php } ?>
        </ul>
      </div>

       

    </div>
  </nav><!-- End Header/Navbar -->      