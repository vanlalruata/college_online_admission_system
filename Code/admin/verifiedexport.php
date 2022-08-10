<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin : College Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" 
      type="image/png" 
      href="../dist/img/Logo.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> 

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css"> 
  
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script> 

</head>

<body class="hold-transition .layout-top-nav sidebar-collapse">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 id="pagetitle">Applicants</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Applicants</li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=<?php echo $_GET['page']; ?>&program=B.A">B.A</a></li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=<?php echo $_GET['page']; ?>&program=B.Com">B.Com</a></li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=<?php echo $_GET['page']; ?>&program=BCA">BCA</a></li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=<?php echo $_GET['page']; ?>&program=B.Sc">B.Sc</a></li>
              
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=feepaid&program=<?php echo $_GET['program']; ?>">Admitted</a></li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=monitor&program=<?php echo $_GET['program']; ?>">Monitor</a></li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=waiting&program=<?php echo $_GET['program']; ?>">Waiting</a></li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=approved&program=<?php echo $_GET['program']; ?>">Approved</a></li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=rejected&program=<?php echo $_GET['program']; ?>">Rejected</a></li>
              <li class="breadcrumb-item"><a href="verifiedexport.php?page=phyapplication&program=<?php echo $_GET['program']; ?>">Quota</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" id="pagetitle">Applicant List</h3>              
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table id="applicant" class="table table-hover">
                <thead>
                <tr>
                    <th>Application #</th>
                    <th>Full Name</th>
                    <th>Father Name</th>
                    <th>Course</th>
                    <th>Mobile No</th>
                    <th>Core</th>
                    <th>Second Choice</th>
                    <th>Third Choice</th>                    
                    <th>HSLC</th>
                    <th>HSSLC</th>
                    <th>Sport Quota</th>
                    <th>Date of Birth</th>
                    <th>Aadhaar</th>
                    <th>Address</th>   
                </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                    if(isset($_GET['page']))
                    {
                        $query = "";
                        //Get only new application
                        if($_GET['page'] === "newapplication"){
                            $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile from tbl_applicant as ta where ta.bloodgroup IS NOT null AND ta.remark is null;";
                            echo '<script>document.getElementById("pagetitle").innerHTML = "New Applications";</script>';
                        }
                        //Get only Incomplete application
                        else if($_GET['page'] === "incomplete"){
                          $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile from tbl_applicant as ta where ta.remark <> 'monitor' AND ta.remark <> 'feepaid' AND ta.remark <> 'waiting' AND ta.remark <> 'approve' AND ta.remark <> 'rejected' OR ta.remark is null AND ta.bloodgroup is null;";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Incomplete Applications";</script>';
                        }
                        //Get only Admitted
                        else if($_GET['page'] === "admitted"){
                            $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile from tbl_applicant as ta LEFT JOIN tbl_applicant_payment as tp ON ta.applicationid = tp.applicationid where ta.remark = 'approved' AND tp.status is null;";
                            echo '<script>document.getElementById("pagetitle").innerHTML = "Admitted Applications";</script>';
                        }
                        else if($_GET['page'] === "monitor"){
                            $query = "select applicationid, fullname, fathername, program, mobile, sportquota, dateofbirth, aadhaar, permanentaddress from tbl_applicant where remark = 'monitor' and program = '".$_GET['program']."' ORDER BY applicationid ASC;";
                            echo '<script>document.getElementById("pagetitle").innerHTML = "Verified Applications";</script>';
                        }
                        //Admission Confirmed with Fee Paid
                        else if($_GET['page'] === "feepaid"){
                          $query = "select applicationid, fullname, fathername, program, mobile, sportquota, dateofbirth, aadhaar, permanentaddress from tbl_applicant where remark = 'feepaid' and program = '".$_GET['program']."' ORDER BY applicationid ASC;";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Admitted Applications";</script>';
                        }
                        else if($_GET['page'] === "rejected"){
                            $query = "select applicationid, fullname, fathername, program, mobile, sportquota, dateofbirth, aadhaar, permanentaddress from tbl_applicant where remark = 'rejected' and program = '".$_GET['program']."' ORDER BY applicationid ASC;";
                            echo '<script>document.getElementById("pagetitle").innerHTML = "Rejected Applications";</script>';
                        }
                        else if($_GET['page'] === "waiting"){
                          $query = "select applicationid, fullname, fathername, program, mobile, sportquota, dateofbirth, aadhaar, permanentaddress from tbl_applicant where remark = 'waiting' and program = '".$_GET['program']."' ORDER BY applicationid ASC;";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Awaiting Applications";</script>';
                        }
                        else if($_GET['page'] === "approved"){
                          $query = "select applicationid, fullname, fathername, program, mobile, sportquota, dateofbirth, aadhaar, permanentaddress from tbl_applicant where remark = 'approved' and program = '".$_GET['program']."' ORDER BY applicationid ASC;";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Approved Applications";</script>';
                        }
                        else if($_GET['page'] === "allapp"){
                          $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile from tbl_applicant as ta  ORDER BY applicationid ASC;";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "All Applications";</script>';
                        }
                        else if($_GET['page'] === "phyapplication"){
                          $query = "select applicationid, fullname, fathername, program, mobile, sportquota, dateofbirth, aadhaar, permanentaddress from tbl_applicant where program = '".$_GET['program']."' AND disableperson = 'Yes' OR sportquota = 'Yes' ORDER BY applicationid ASC;";
                          echo '<script>document.getElementById("pagetitle").innerHTML = "Quota Applications";</script>';
                        }

                        $result = $mysqli->query($query);
                        while($row=$result->fetch_row()){
                            echo '<tr>';
                                
                                echo '<td>'. $row[0].'</td>';
                                echo '<td>'. $row[1] .'</td>';
                                echo '<td>'. $row[2] .'</td>';
                                echo '<td>'. $row[3] .'</td>';
                                echo '<td>'. $row[4] .'</td>';

                                //Subject Choice
                                $eq = 0;
                                $qr = "SELECT coresubject,electiveone,electivetwo FROM `tbl_applicant_subject_choice` WHERE `applicationid` = '".$row[0]."';";
                                $rs = $mysqli->query($qr);                                
                                while($rw=$rs->fetch_row()){
                                  if($eq < 3){
                                    echo '<td>'. $rw[0] . '</td>';
                                    echo '<td>'. $rw[1] . '</td>';
                                    echo '<td>'. $rw[2] . '</td>';
                                  }                                  
                                  $eq++;
                                }
                                //If no Education, leave blank
                                if($eq === 0){
                                  echo '<td>&nbsp;</td>';
                                  echo '<td>&nbsp;</td>';
                                  echo '<td>&nbsp;</td>';
                                }                                

                                
                                //Educational Qualification
                                $eq = 0;
                                $qr = "SELECT `percentage` FROM `tbl_applicant_qualification` WHERE `applicationid` = '".$row[0]."';";
                                $rs = $mysqli->query($qr);
                                $st = 0;
                                while($rw=$rs->fetch_row()){
                                  echo '<td>'. $rw[0] . '%</td>';
                                  $eq++;
                                }
                                //If no Education, leave blank
                                if($eq < 2){
                                  echo '<td>&nbsp;</td>';
                                  echo '<td>&nbsp;</td>';
                                }

                                
                                echo '<td>'. $row[5] .'</td>';                                
                                echo '<td>'. $row[6] .'</td>';
                                echo '<td>'. $row[7] .'</td>';
                                echo '<td>'. $row[8] .'</td>';

                                


                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>                  
                  <th>Application #</th>
                  <th>Full Name</th>
                  <th>Father Name</th>
                  <th>Course</th>
                  <th>Mobile No</th>
                  <th>Core</th>
                  <th>Second Choice</th>
                  <th>Third Choice</th>                    
                  <th>HSLC</th>
                  <th>HSSLC</th>
                  <th>Sport Quota</th>
                  <th>Date of Birth</th>
                  <th>Aadhaar</th>
                  <th>Address</th>               
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <?php
        require_once '../config/dbconfig.php';
        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
        $query = "select copyright_text from tbl_general_settings where college_id = 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        echo '<strong>' . $row[0] . '</strong>';        
    ?>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.1.2 | <span><strong>Developed by:</strong> Vanlalruata Hnamte</span>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>



<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Input Mask -->
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<!-- page script -->
<script>
  $(function () {
    $("#applicant").DataTable({
      "responsive": true,
      "autoWidth": false,
	  dom: 'Bfrtip',
    lengthMenu: [[10, 25, 50,100,200,300,400, 1000], [10, 25, 50,100,200,300,400, 1000]],
		buttons: [{
                extend:    'copyHtml5',
                text:      '<i class="fa fa-copy"></i>&nbsp;Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel"></i>&nbsp;Excel',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-csv"></i>&nbsp;CSV',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf"></i>&nbsp;PDF',
                titleAttr: 'PDF'
            },
			{
                extend:    'print',
                text:      '<i class="fa fa-print"></i>&nbsp;Print',
                titleAttr: 'Print'
            }
        ]
    });
  
  });
  
</script>

</body>
</html>