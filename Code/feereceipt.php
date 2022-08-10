<?php 

        if(!isset($_GET['applicationid'])){
            die;
        }
        else if(!isset($_SESSION['$applicantid'])){
          //die;
        }
        else if(!isset($_SESSION['$legitUser'])){
          //die;
        }

        require_once 'config/dbconfig.php';
        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

        $query = "select logo, college_name, address, phone, email from tbl_general_settings where college_id = 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $row[1]?> : Online Admission Portal</title>
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">   
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="pdfdownload">

<div class="wrapper">

                <div class="" id="modal-xl">
                  <div class="content">
                    <div class="card">
                    <div class="header">    
                        <div class="col-md-12">        
                            <div style="margin-top: 15px;">
                              <center><img src="<?php if($row[0] != "") {echo $row[0];} else {echo './dist/img/Logo.png'; } ?>" style="height:96px;"></center>             
                            </div>
                            <div style="text-align:center; vertical-align: middle;">
                              <h2><?php echo $row[1]; ?></h2>
                            </div> 
                            <div style="text-align:center; vertical-align: middle;">
                              <h5><?php echo $row[2]; ?></h5>
                              <div><h5><span class="float-left"><i class="fas fa-phone"></i>&emsp;<?php echo $row[3]; ?></span></h5></div>
                              <div><h5><span class="float-right"><i class="fas fa-envelope"></i>&emsp;<?php echo $row[4]; ?></span></h5></div>
                              <br><hr style="border: 4px solid #52248f;"/>
                            </div>
                        </div>
                      <!-- <div class="modal-header modal-title">
                      
                      </div> -->
                      </div>
                      <?php
                          $status = 'unpaid';
                          $query = "select status from tbl_applicant_payment where applicationid = '". $_GET['applicationid'] . "';";
                          $result = $mysqli->query($query);
                          if($row = $result->fetch_row()){
                            if($row[0] === 'paid'){
                              $status = 'paid';
                            }
                          }
                          $fullname = $program = $semester = $feeamount = $paymentid = $paymentdatetime = '';
                          $query = "SELECT * FROM `tbl_university_students` WHERE universityroll = '" . $_GET['applicationid'] . "';"; 
                                 
                          //$query = "select tp.applicationid, tp.feeamount, tp.transactionid, tp.status, tp.paymentdate, tp.paymenttime, ts.fullname, ts.programme, ts.universityroll from tbl_applicant_payment as tp INNER JOIN tbl_university_students as ts ON tp.applicationid = ts.universityroll where tp.applicationid = '". $_GET['applicationid'] ."'";
                          $result = $mysqli->query($query);
                          if($row = $result->fetch_row()){
                            $fullname = $row[3];
                            $program = $row[0];
                            $semester = $row[2];
                          }

                          $query = "SELECT * FROM `tbl_applicant_payment` WHERE applicationid = '" . $_GET['applicationid'] . "';"; 
                          $result = $mysqli->query($query);
                          if($row = $result->fetch_row()){
                            $feeamount = $row[1];
                            $paymentid = $row[2];
                            $paymentdatetime = $row[4] . ' - ' . $row[5];;
                          }

                          if($paymentid !== 'CASH : Principal'){
                            $paymentid = 'Razorpay: ' . $paymentid;
                          }



                      ?>
                      <div class="modal-body">
                        
                        
                                           
                        <div class="card-header float-left">
                          <?php
                              if($status === 'paid'){
                                echo '<h3 style="color:green";><strong>FEE PAID - APPROVED</strong></h3>';
                              }
                              else{
                                echo '<h3 style="color:red";><strong>FEE UNPAID</strong></h3>';
                              }
                          ?>
                          <h5 style="color:red";><strong>Application ID:</strong> &emsp;<?php echo $_GET['applicationid']; ?></h5> 
                          <h3 class="card-title">Personal Details</h3>
                        </div>
                        <div class="card-body p-0">
                          <table class="table">
                            <thead>
                              <!--<tr>
                                <th style="width: 10px">#</th>
                                <th>Task</th>
                                <th>Progress</th>                                
                              </tr>-->
                            </thead>
                            <tbody>                              
                              <tr>
                                <td>1.</td>
                                <td>Full Name</td>
                                <td>
                                  <b><?php echo $fullname;?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>2.</td>
                                <td>Programme</td>
                                <td>
                                  <b><?php echo $program;?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>3.</td>
                                <td>University Roll No</td>
                                <td>
                                  <b><?php echo $_GET['applicationid'];?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>4.</td>
                                <td>Fee Amount</td>
                                <td>
                                  <b><?php echo $feeamount;?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>5.</td>
                                <td>Payment Data / Time</td>
                                <td>
                                  <b><?php echo $paymentdatetime;?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>6.</td>
                                <td>Transaction ID</td>
                                <td>
                                  <b><?php echo $paymentid;?></b>
                                </td>                                
                              </tr>                              
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->                      
                      <br><br>
                      <div class="card">                          
                        <div class="card-body">                          
                              <?php
                                $query = "select aa.declaration, ta.signature from tbl_adm_application aa inner join tbl_applicant ta on ta.sessionyear = aa.sessionyear where ta.applicationid = '". $_GET['applicationid'] . "';";
                                $result = $mysqli->query($query);
                                $counter = 1;
                                if($row = $result->fetch_row()){
                                  echo '<p>' . $row[0] . '</p>';;                                  
                                }
                              ?>  
                              <br><br>
                               <img src="<?php echo $row[1]; ?>" class="float-right" width="150px"><br><br><br>
                              <p class="float-left">Dated:___/___/_______</p>
                              <p class="float-right">Signature</p><br><br>
                              <hr style="border: 1px solid #1A1E17;"/>
                              <center><h3><u><strong>FOR OFFICIAL USE ONLY</strong></u></h3></center>
                              <p class="float-left">Dated:___/___/_______</p><br><br>

                              <p class="float-left">Remark:</p> <br><br><br><br><br><br>
                              <p class="float-right">Name & Signature</p><br><br>
                              <p class="float-right">Seal</p>
                        </div>
                      </div>  
                      </div> 
                    </div>                   
                  </div>                  
                </div>
                 
 
</div>
<!-- ./wrapper -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>



<script type="text/javascript"> 
   window.print();
   window.onfocus=function(){ window.close();} 
</script>

</body>
</html>