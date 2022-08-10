<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="?page=dashboard" class="nav-link nav-list">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="mailto:imvhnamte@gmail.com" class="nav-link nav-list">Contact</a>
      </li>
    </ul>   

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="../dist/img/Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">
      <?php

      require_once '../config/dbconfig.php';
      $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

      $query = "select college_name from tbl_general_settings where college_id = 1";
      $result = $mysqli->query($query);
      $row = $result->fetch_row();
      $words = explode(" ", $row[0]);
      $acronym = "";

      foreach ($words as $w) {
        $acronym .= $w[0];
      }
      echo $acronym;
      ?>
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php if(isset($_SESSION['$photo'])) {echo $_SESSION['$photo']; } else {echo '../dist/img/user2-160x160.jpg' ;} ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="?page=profile" class="d-block"><?php if(isset($_SESSION['$legitUser'])) {echo $_SESSION['$name'];} else {echo 'Administrator';}?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-side">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=dashboard" class="nav-link nav-list">
                  <i class="far fa-chart-bar nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-side">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
              APPLICATIONS
                <i class="fas fa-angle-left right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview"> 
              <!--
              <li class="nav-item">
                <a href="?page=addapplicant" class="nav-link nav-list">
                  <i class="far fa-graduation-cap nav-icon"></i>
                  <p>Add Applicant</p>
                </a>
              </li> --> 
              <li class="nav-item">
                <a href="?page=incomplete" class="nav-link nav-list">
                  <i class="far fa-user-tag nav-icon"></i>
                  <p>Incomplete Applications</p>
                </a>
              </li>           
              <li class="nav-item">
                <a href="?page=newapplication" class="nav-link nav-list">
                  <i class="far fa-user-tag nav-icon"></i>
                  <p>New Applications</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=monitor" class="nav-link nav-list">
                  <i class="far fa-user-clock nav-icon"></i>
                  <p>Verified Applications</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=admitted" class="nav-link nav-list">
                  <i class="far fa-user-check nav-icon"></i>
                  <p>Approved Applications</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="?page=feepaid" class="nav-link nav-list">
                  <i class="far fa-user-clock nav-icon"></i>
                  <p>Admitted Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=waiting" class="nav-link nav-list">
                  <i class="far fa-user-alt-slash nav-icon"></i>
                  <p>Waiting Applications</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=rejected" class="nav-link nav-list">
                  <i class="far fa-times-circle nav-icon"></i>
                  <p>Rejected Applications</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=exportapplicants" class="nav-link nav-list">
                  <i class="far fa-cloud-download nav-icon"></i>
                  <p>Export Applications</p>
                </a>
              </li>
            </ul>
          </li>        
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-side">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Admission Settings
                <i class="fas fa-angle-left right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=admissionlist" class="nav-link nav-list">
                  <i class="far fa-file-invoice nav-icon"></i>
                  <p>Admission(s)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=addadmission" class="nav-link nav-list">
                  <i class="far fa-file-medical nav-icon"></i>
                  <p>Add Admission</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=feestructure" class="nav-link nav-list">
                  <i class="far fa-money-bill nav-icon"></i>
                  <p>Fee Structure</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-side">
              <i class="nav-icon fas fa-rupee-sign"></i>
              <p>
                Payments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=paymentlist" class="nav-link nav-list">
                  <i class="far fa-money-check-alt nav-icon"></i>
                  <p>All Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=addpayment" class="nav-link nav-list">
                  <i class="far fa-file-invoice-dollar nav-icon"></i>
                  <p>Add Payment</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-side">
              <i class="nav-icon fas fa-university"></i>
              <p>
                University Students
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=studentlist" class="nav-link nav-list">
                  <i class="far fa-user-graduate nav-icon"></i>
                  <p>All Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=addstudent" class="nav-link nav-list">
                  <i class="far fa-graduation-cap nav-icon"></i>
                  <p>Add Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=importstudent" class="nav-link nav-list">
                  <i class="far fa-graduation-cap nav-icon"></i>
                  <p>Import Students</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-side">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=userlist" class="nav-link nav-list">
                  <i class="far fa-users-cog nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=useredit" class="nav-link nav-list">
                  <i class="far fa-user-plus nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=profile" class="nav-link nav-list">
                  <i class="far fa-user-tag nav-icon"></i>
                  <p>My Profile</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-side">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=pagelist" class="nav-link nav-list">
                  <i class="far fa-file-invoice nav-icon"></i>
                  <p>All Pages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=pageedit" class="nav-link nav-list">
                  <i class="far fa-file-plus nav-icon"></i>
                  <p>Add Page</p>
                </a>
              </li>             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-side">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                System Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=generalsetting" class="nav-link nav-list">
                  <i class="far fa-tasks nav-icon"></i>
                  <p>General Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=gateways" class="nav-link nav-list">
                  <i class="far fa-tools nav-icon"></i>
                  <p>Gateway Settings</p>
                </a>
              </li>              
            </ul>
          </li>
          <li class="nav-header">&nbsp;</li>                
          
          <li class="nav-item">
            <a href="logout.php" class="nav-link nav-list">
              <i class="nav-icon far fa-sign-out-alt text-danger"></i>
              <p class="text">Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>