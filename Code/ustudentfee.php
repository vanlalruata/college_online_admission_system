<?php
    session_start();
    
    require('vendor/razorpay-php/Razorpay.php');
    date_default_timezone_set('Asia/Kolkata');

    use Razorpay\Api\Api;
    use Razorpay\Api\Errors\SignatureVerificationError;

    require_once 'config/dbconfig.php';
    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

        $apikey = '';
        $secret = '';
        $query ="select apikey, secret from tbl_payment_gateway where status = 'active'";
        $result = $mysqli->query($query);    
        if($row = $result->fetch_row()){
          //RazorPay Payment Gateway
          $apikey = $row[0];
          $secret = $row[1];
        }

    $api = new Api($apikey, $secret);


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
        <label id="pagetitle" name="pagetitle" class="pagetitle nav-link">Search your details</label>
      </li>     
    
</nav>
<!-- /.navbar -->



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
                            <h3 id="card-title" class="card-title">Fill the University Registration or University Roll No</h3>
                        </div>
                        <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->
    
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <form action="ustudentfee.php" role="form" method="post" enctype="multipart/form-data">
                                
                                <!-- Second Row -->
                                <div class="row">                                    
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Enter your University RollNo.</label>
                                        <input type="text" name="urollno" class="form-control" placeholder="Eg: 1915BA001" required>                                    
                                    </div>
                                    </div>
                                </div>
                                                              
                                
                                <!-- Thirteenth Row -->
                                <div class="row">
                                    <div class="col-sm-12">                                    
                                    <div class="form-group">  
                                        <input type="hidden" name="prefix" value="<?php echo $prefix; ?>"/>
                                        <input type="hidden" name="action" value="searchunistudent"/>
    
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

            <?php

                $requestType = $_SERVER['REQUEST_METHOD'];
                if($requestType == 'POST'){
                    if(isset($_POST['action'])){
                        if($_POST['action'] === "payfee"){
                            //get pay fee page
                            $_SESSION['$universityreg'] = $_POST['urollno'];

                            require 'unipayment.php';
                        }
                        else if($_POST['action'] === "searchunistudent"){
                            $query = "SELECT * FROM `tbl_applicant_payment` WHERE applicationid = '" . $mysqli -> real_escape_string($_POST['urollno']) . "';"; 
                            $result = $mysqli->query($query);
							$row = $result->num_rows;
                            
                            if($row > 0){
                                //Already Made payment
                                 //Display Table
                                 $fullname = $program = $semester = $feeamount = $paymentid = $paymentdatetime = '';
                                 $row = $result->fetch_row();
                                 $feeamount = $row[1];
                                 $paymentid = $row[2];
                                 $paymentdatetime = $row[4] . ' - ' . $row[5];;

                                 $query = "SELECT * FROM `tbl_university_students` WHERE universityroll = '" . $mysqli -> real_escape_string($_POST['urollno']) . "';"; 
                                 $result = $mysqli->query($query);

                                 if($row = $result->fetch_row()){
                                    $fullname = $row[3];
                                    $program = $row[0];
                                    $semester = $row[2];
                                 }
                                 ?>
                                 <div class="row">
                                     <div class="col-md-12">
                                         <!-- general form elements disabled -->
                                         <div id="card" class="card card-info">
                                             <div class="card-header">
                                                 <h3 id="card-title" class="card-title">Student Detail</h3>
                                             </div>
                                             <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->

                                             <!-- /.card-header -->
                                             <div class="card-body">   
                                                     <!-- First Row -->
                                                     <div class="row">
                                                         <div class="col-sm-6">
                                                             <div class="form-group">
                                                                 <label>Full Name</label>
                                                                 <input type="text" name="fullname" value="<?php echo $fullname; ?>" class="form-control" readonly>
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                             <div class="form-group">
                                                             <label>Program</label>
                                                             <input type="text" name="program" value="<?php echo $program;  ?>" class="form-control" readonly>                                    
                                                             </div>
                                                         </div>
                                                     </div>

                                                     <!-- Second Row -->
                                                     <div class="row">
                                                         <div class="col-sm-6">
                                                         <div class="form-group">
                                                             <label>Semester</label>
                                                             <input type="text" name="semester" value="<?php echo $semester; ?>" class="form-control" readonly>
                                                         </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                         <div class="form-group">
                                                             <label>Fee Amount</label>
                                                             <input type="text" name="feeamount" value="<?php echo $feeamount; ?>" class="form-control" readonly>                                    
                                                         </div>
                                                         </div>
                                                     </div>

                                                     <!-- Second Row -->
                                                     <div class="row">
                                                         <div class="col-sm-6">
                                                         <div class="form-group">
                                                             <label>Payment ID</label>
                                                             <input type="text" name="paymentid" value="<?php echo $paymentid; ?>" class="form-control" readonly>
                                                         </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                         <div class="form-group">
                                                             <label>Date - Time</label>
                                                             <input type="text" name="dateandtime" value="<?php echo $paymentdatetime; ?>" class="form-control" readonly>                                    
                                                         </div>
                                                         </div>
                                                     </div>


                                                     <!-- Third Row -->
                                                     <div class="row">
                                                         <div class="col-sm-12">                                    
                                                         <div class="form-group">                                                                 

                                                             <center>        
                                                             <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i>&nbsp;Reset</button>&emsp;                          

                                                             <?php                                                                     
                                                                 //Show the submit Button
                                                                 echo '<a href="feereceipt.php?applicationid='.$_POST['urollno'].'" target="_blank" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Download Receipt</a>';                                                                                                                                   
                                                             ?>  
                                                             
                                                             </center>
                                                         </div>
                                                         </div>
                                                     </div>     
                                                 
                                             </div>
                                         </div>
                                     </div>
                                 </div>  

                             <?php
                            }
                            else{
                                //Payment to be made
                                if(isset($_POST['urollno'])){
                                    $query = "SELECT * FROM tbl_university_students WHERE universityroll = '" . $mysqli -> real_escape_string($_POST['urollno']) . "';";                                
                                }
                            
                                $fullname = $program = $semester = $feeamount = $uniroll = $unireg = 'Not Found';
                            
                                $result = $mysqli->query($query);
                                while($row=$result->fetch_row()){
                                    $program = $row[0];
                                    $semester = $row[2];
                                    $fullname = $row[3];
                                    $unireg = $row[4];
                                    $uniroll = $row[5];
                                }                                 
                                    
                                if($fullname != 'Not Found'){
                                    $query = "SELECT totalfee FROM tbl_fee_details WHERE programme = '". $program ."'  AND year = '".$semester."';";
                                    if($program === 'B.A.Geography'){
                                        $query = "SELECT totalfee FROM tbl_fee_details WHERE programme = 'B.A';";
                                    }                                    
                                    $result = $mysqli->query($query);
                                    while($row=$result->fetch_row()){
                                        $feeamount = (double)$row[0];
                                    }
                                    if($program === 'B.A.Geography'){
                                        //$feeamount += 110;
                                    }
                                }  
        
                                ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- general form elements disabled -->
                                                <div id="card" class="card card-info">
                                                    <div class="card-header">
                                                        <h3 id="card-title" class="card-title">Student Detail</h3>
                                                    </div>
                                                    <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->
    
                                                    <!-- /.card-header -->
                                                    <div class="card-body">  
                                                        <form action="" role="form" method="post" enctype="multipart/form-data">
    
                                                            <!-- First Row -->
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Full Name</label>
                                                                        <input type="text" name="fullname" value="<?php echo $fullname; ?>" class="form-control" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                    <label>Program</label>
                                                                    <input type="text" name="program" value="<?php echo $program; ?>" class="form-control" readonly>                                    
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <!-- Second Row -->
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Semester</label>
                                                                    <input type="text" name="semester" value="<?php echo $semester; ?>" class="form-control" readonly>
                                                                </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Fee Amount</label>
                                                                    <input type="text" name="feeamount" value="<?php if($program === 'B.A.Geography'){ echo round((110 + $feeamount), 2); } else {echo round($feeamount, 2);} ?>" class="form-control" readonly>                                    
                                                                </div>
                                                                </div>
                                                            </div>
    
                                                            <!-- Third Row -->
                                                            <div class="row">
                                                                <div class="col-sm-12">                                    
                                                                <div class="form-group">  
                                                                    <input type="hidden" name="prefix" value="<?php echo $prefix; ?>"/>
                                                                    <input type="hidden" name="action" value="payfee"/>
                                                                    <input type="hidden" name="urollno" value="<?php echo $_POST['urollno']; ?>"/>
    
                                                                    <center>        
                                                                    <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i>&nbsp;Reset</button>&emsp;                          
    
                                                                    <?php 
                                                                        if($feeamount != 'Not Found'){
                                                                            //Show the Payment Button    
                                                                            echo '<button type="submit" class="btn btn-success"><i class="fas fa-money-check-alt"></i>&nbsp;Pay Fee</button>';                                                                                                                   
                                                                        }
                                                                        else {
                                                                            //Show the submit Button
                                                                            echo '<a href="registerunistudent.php" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Register Yourself</a>';                                                            
                                                                        }                                                                
                                                                    ?>  
                                                                    
                                                                    </center>
                                                                </div>
                                                                </div>
                                                            </div>     
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                            <?php            
                            }                           
                        }
                        else if($_POST['action'] === "postpayment"){
                            //Insert in the payment table if payment success!
                            $success = true;
				            $error = "Payment Failed";    
				            if (empty($_POST['razorpay_payment_id']) === false){
				            	$api = new Api($apikey, $secret);      
                            
				            	try{            
				            		$attributes = array(
				            			'razorpay_order_id' => $_SESSION['razorpay_order_id'],
				            			'razorpay_payment_id' => $_POST['razorpay_payment_id'],
				            			'razorpay_signature' => $_POST['razorpay_signature']
				            		);
                                
				            		$api->utility->verifyPaymentSignature($attributes);
				            	}
				            	catch(SignatureVerificationError $e){
				            		$success = false;
				            		$error = 'Razorpay Error : ' . $e->getMessage();
				            	}
				            }

                            if ($success === true){
                                 //Insert in the payment table
                                 $query = "INSERT INTO tbl_applicant_payment VALUES('".$_SESSION['$universityreg']."', '".$_POST['feeamount']."', '" . $_POST['razorpay_payment_id'] . "', 'paid', '".date("Y-m-d")."', '".date("H:i:s")."');";
                                 $stmt = $mysqli->prepare($query);
					             $stmt->execute();
					
					             if($stmt->affected_rows > 0){
						            echo "<script>toastr.info('Your payment was successful! Payment ID: { " . $_POST['razorpay_payment_id'] . "}.');</script>";
					             }

                                //Display Table
                                ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- general form elements disabled -->
                                            <div id="card" class="card card-info">
                                                <div class="card-header">
                                                    <h3 id="card-title" class="card-title">Student Detail</h3>
                                                </div>
                                                <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->

                                                <!-- /.card-header -->
                                                <div class="card-body">                                                      

                                                        <!-- First Row -->
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input type="text" name="fullname" value="<?php $_POST['fullname']; ?>" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                <label>Program</label>
                                                                <input type="text" name="program" value="<?php echo $_POST['program'];  ?>" class="form-control" readonly>                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Second Row -->
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Semester</label>
                                                                <input type="text" name="semester" value="<?php echo $_POST['semester']; ?>" class="form-control" readonly>
                                                            </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Fee Amount</label>
                                                                <input type="text" name="feeamount" value="<?php echo $_POST['feeamount']; ?>" class="form-control" readonly>                                    
                                                            </div>
                                                            </div>
                                                        </div>

                                                        <!-- Second Row -->
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Payment ID</label>
                                                                <input type="text" name="paymentid" value="<?php echo $_POST['razorpay_payment_id']; ?>" class="form-control" readonly>
                                                            </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Date - Time</label>
                                                                <input type="text" name="dateandtime" value="<?php echo date("Y-m-d H:i:s"); ?>" class="form-control" readonly>                                    
                                                            </div>
                                                            </div>
                                                        </div>


                                                        <!-- Third Row -->
                                                        <div class="row">
                                                            <div class="col-sm-12">                                    
                                                            <div class="form-group">                                                                 

                                                                <center>        
                                                                <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i>&nbsp;Reset</button>&emsp;                          

                                                                <?php                                                                     
                                                                    //Show the submit Button
                                                                    echo '<a href="feereceipt.php?applicationid='.$_SESSION['$universityreg'].'" target="_blank" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Download Receipt</a>';                                                                                                                                   
                                                                ?>  
                                                                
                                                                </center>
                                                            </div>
                                                            </div>
                                                        </div>     
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>  

                                <?php

                            }
                            else{
                                echo "<script>toastr.warn('Your payment was not successful! ". $error ."');</script>";					             
                            }


                        }
                    } 
                }               

            ?>               
                
      </div>
    </section>
</div>


  <!-- Main Footer -->
  <footer class="main-footer footer-not-fixed">
    
    <!-- Default to the left -->
    <?php
        $query = "select copyright_text, smartchat from tbl_general_settings where college_id = 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        echo '<strong>' . $row[0] . '</strong>';  
        $smartchat = $row[1];               
        
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
s1.src='https://embed.tawk.to/<?php if(isset($smartchat)){echo $smartchat; } else {echo '5e8f41a569e9320caac1fb10';} ?>/default';
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

  })
</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>