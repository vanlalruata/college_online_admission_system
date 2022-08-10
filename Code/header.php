<?php

require_once 'config/dbconfig.php';
$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

$query = "select college_name, site_title, logo, favicon from tbl_general_settings where college_id = 1";
$result = $mysqli->query($query);
$row = $result->fetch_row();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $row[0]?> : Online Admission Portal</title>
  <link rel="icon" 
      type="image/png" 
      href="<?php if($row[3]!= "") {echo $row[3];} else { echo 'dist/img/Logo.png';}?>">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script> 

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="header">    
      <div class="col-md-12">        
          <div style="margin-top: 15px;">
            <center><img src="<?php if($row[2] != "") {echo $row[2];} else {echo './dist/img/Logo.png'; } ?>" style="height:96px;"></center>            
          </div>
          <div style="text-align:center; vertical-align: middle;">
            <h2><?php echo $row[1]; ?></h2>
          </div> 
      </div>
    </div>

<hr style="border: 7px solid #52248f;"/>
<div class="wrapper">  
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <label id="pagetitle" name="pagetitle" class="pagetitle nav-link">Title</label>
      </li>     
    
</nav>
<!-- /.navbar -->
