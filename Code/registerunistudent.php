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

<body class="hold-transition layout-top-nav">
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
<nav class="main-header navbar navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">      
      <li class="nav-item d-none d-sm-inline-block">
        <label id="pagetitle" name="pagetitle" class="pagetitle nav-link">Register with your details</label>
      </li>     
    
</nav>


<?php
    $prefix = '';
    require_once 'config/dbconfig.php';
    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);    
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div id="card" class="card card-warning">
                        <div class="card-header">
                            <h3 id="card-title" class="card-title">Fill the Registered Student Details</h3>
                        </div>
                        <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->
    
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <form action="ureg.php" role="form" method="post" enctype="multipart/form-data">

                                <!-- First Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Make Sure you enter a correct university roll no: </label><code>Eg: 2021BCOM001</code>                                         
                                    </div>
                                    </div>                                    
                                </div>



                                <!-- First Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Academic Session</label><code>*</code> 
                                        <select class="form-control" name="sessionyear" placeholder="Session Year" required>
                                           <option selected>Select Session</option>
                                            <?php 
                                                
                                                $year = date('Y');
                                                $year = $year - 4;
                                                while($year <= date('Y')){
                                                    echo '<option value="'. $year .' - ' . ($year + 3) . '">'. $year . ' - ' . ($year + 3) . '</option>'; 
                                                    $year++;
                                                }                                                
                                            ?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Programme</label><code>*</code><br>
                                            
                                            <select class="form-control" name="programme" placeholder="Course Programme" required>
                                            <?php
                                                $query = "select DISTINCT(programme) from tbl_fee_details ORDER BY programme ASC;";
                                                $result = $mysqli->query($query);
                                                echo '<option value="B.A.Geography" selected>B.A with Geography</option>';
                                                while($row = $result->fetch_row()){
                                                    echo '<option value="'. $row[0] .'">'. $row[0] .'</option>';
                                                }
                                                ?>
                                            </select>        
                                        </div>
                                    </div>
                                </div>

                                <!-- First Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Semester</label><code>*</code> 
                                        <select class="form-control" name="semester" placeholder="Session Year" required>
                                            <!--<option value="1st Sem">1st Sem</option>
                                            <option value="2nd Sem">2nd Sem</option>-->
                                            <option value="3rd Sem">3rd Sem</option>
                                            <!--<option value="4th Sem">4th Sem</option> -->
                                            <option value="5th Sem">5th Sem</option>
                                            <!--<option value="6th Sem">6th Sem</option> -->                                           
                                        </select>
                                    </div>
                                    </div>  
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name</label><code>*</code> 
                                        <input type="text" name="fullname" class="form-control" placeholder="Full Name - Eg: John Lalsiama Hnamte" required>
                                    </div>
                                    </div>                                    
                                </div>
    
                                <!-- Second Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>University RegNo.</label>
                                        <input type="text" name="uregno" class="form-control" placeholder="University Registration No" required>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>University RollNo.</label><code>*</code>
                                        <input type="text" name="urollno" class="form-control" placeholder="University Roll No" required>                                    
                                    </div>
                                    </div>
                                </div>

                                 
                                <!-- Eleventh Row -->
                                <?php
                                    $query = "select declaration from tbl_adm_application where status = 'active'";
                                    $result = $mysqli->query($query);
                                    $declaration = '';
                                    if($row = $result->fetch_row()){
                                        $declaration = $row[0];
                                    }
                                ?>

                                    <!--
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">                                    
                                        <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" required> 
                                            <label for="customCheckbox1" class="custom-control-label">Everything is correct.</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>   
                                    -->


                                
                                <!-- Third Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Core Subject</label>
                                            <select name="coresubject" class="form-control" required> 
                                            <?php                                                 
                                                    echo '<option value="Botany">Botany</option>';
                                                    echo '<option value="Chemistry">Chemistry</option>';
                                                    echo '<option value="Mathematics">Mathematics</option>';
                                                    echo '<option value="Physics">Physics</option>';
                                                    echo '<option value="Zoology">Zoology</option>';                                                
                                                    echo '<option value="English">English</option>';
                                                    echo '<option value="Mizo">Mizo</option>';
                                                    echo '<option value="Economics">Economics</option>';
                                                    echo '<option value="Education">Education</option>';
                                                    echo '<option value="History">History</option>';
                                                    echo '<option value="Political Sc">Political Sc</option>';   
                                                    echo '<option value="Geography">Geography</option>';
                                                    echo '<option value="Commerce">Commerce</option>';
                                                    echo '<option value="Computer Sc">Computer Sc</option>';
                                                
                                            ?>
                                            </select>  
                                        </div>                                                                
                                    </div>
                                </div>                  
                                
                                <!-- Thirteenth Row -->
                                <div class="row">
                                    <div class="col-sm-12">                                    
                                    <div class="form-group">  
                                        <input type="hidden" name="prefix" value="<?php echo $prefix; ?>"/>
                                        <input type="hidden" name="action" value="addunistudent"/>
    
                                        <center>        
                                        <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i>&nbsp;Reset</button>&emsp;                          
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Submit</button>
                                        </center>
                                    </div>
                                    </div>
                                </div>     
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
                
      </div>
    </section>
</div>

<!-- Main Footer -->
<footer class="main-footer">
    
    <!-- Default to the left -->
    <?php
        $query = "select copyright_text, smartchat from tbl_general_settings where college_id = 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        echo '<strong>' . $row[0] . '</strong>';  
        $smartchat = $row[1]; 

		//Menu
        echo '<div class="float-right d-none d-sm-inline-block">';
        echo '<strong><a href="https://gccadmission.online/?page=termandcondition">Term and Condition</a> | <a href="https://gccadmission.online/?page=privacypolicy">Privacy Policy</a> | <a href="https://gccadmission.online/?page=refundpolicy">Refund Policy</a> | <a href="https://gccadmission.online/?page=aboutus">About Us</a></strong>';     
        echo '</div>';
		
    ?>
    
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/<?php if(isset($smartchat)){echo $smartchat; } else {echo '5ead3f6510362a7578be4b22';} ?>/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Input Mask -->
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- script to change the selected active nav-link -->
<script>
$(document).ready(function () {
    $('.nav-link').click(function(e) {
        //$('.nav-link.active').removeClass('active');        
        //$(this).addClass("active");
    });

    //If check copy the permanent address to local address, else fill blank
    $("#sameaddress").on("click", function(){     
      
      if (this.checked) { 
          $("#localaddress").val($("#permanentaddress").val());                                       
      }
      else {
          $("#localaddress").val('');    
                       
      }
    });
});
</script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })    

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>