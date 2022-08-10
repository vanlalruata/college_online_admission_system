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

                          $query = "select program, fullname, dateofbirth, gender, category, mobile,
                          fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, note, bloodgroup, aadhaar, voterid, disableperson, disablecertificate, sportquota from tbl_applicant where applicationid = ". $_GET['applicationid'];
                          $result = $mysqli->query($query);
                          $row = $result->fetch_row();
                      ?>
                      <div class="modal-body">
                        
                        <div class="float-right">
                          <img src="<?php echo $row[14]; ?>" style="" class="profile-user-img img-fluid">
                        </div>
                                           
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
                                <td>Apply for the Course Programme:</td>
                                <td>
                                   <b><?php echo $row[0];?></b>
                                </td>                            
                              </tr>
                              <tr>
                                <td>2.</td>
                                <td>Full Name</td>
                                <td>
                                  <b><?php echo strtoupper($row[1]);?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>3.</td>
                                <td>Date of Birth</td>
                                <td>
                                  <b><?php echo date('d-m-Y', strtotime($row[2]));?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>4.</td>
                                <td>Gender</td>
                                <td>
                                  <b><?php echo $row[3];?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>5.</td>
                                <td>Blood Group</td>
                                <td>
                                  <b><?php echo $row[16];?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>6.</td>
                                <td>Aadhaar #</td>
                                <td>
                                  <b><?php echo $row[17];?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>7.</td>
                                <td>Voter ID</td>
                                <td>
                                  <b><?php echo $row[18];?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>5.</td>
                                <td>Category</td>
                                <td>
                                  <b><?php echo $row[4];?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>6.</td>
                                <td>Mobile</td>
                                <td>
                                  <b><?php echo $row[5];?></b>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>7.</td>
                                <td>Father's Name</td>
                                <td>
                                  <b><?php echo $row[6];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>8.</td>
                                <td>Father's Mobile</td>
                                <td>
                                  <b><?php echo $row[7];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>9.</td>
                                <td>Mother's Name</td>
                                <td>
                                  <b><?php echo $row[8];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>10.</td>
                                <td>Mother's Mobile</td>
                                <td>
                                  <b><?php echo $row[9];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>11.</td>
                                <td>Permanent Address</td>
                                <td>
                                  <b><?php echo $row[10];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>12.</td>
                                <td>Guardian's Name</td>
                                <td>
                                  <b><?php echo $row[11];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>12.</td>
                                <td>Guardian's Mobile</td>
                                <td>
                                  <b><?php echo $row[12];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>13.</td>
                                <td>Local Address</td>
                                <td>
                                  <b><?php echo $row[13];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>14.</td>
                                <td>Physically Handicap</td>
                                <td>
                                  <b><?php echo $row[19];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>15.</td>
                                <td>Any achievement(s) in Sports</td>
                                <td>
                                  <b><?php echo $row[15];?></b>
                                </td>                                
                              </tr>
                              <tr>
                                <td>17.</td>
                                <td>Seeking Sport Quota</td>
                                <td>
                                  <b><?php echo $row[21];?></b>
                                </td>                                
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                      <br>&nbsp;<br>&nbsp;<br>&nbsp;<br><br><br><br><br><br><br> <br><br><br><br>
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Educational Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>EXAMINATION</th>
                                <th>INSTITUTE</th>
                                <th>BOARD</th>
                                <th>YEAR</th>
                                <th>DIVISION</th>
                                <th>PERCENTAGE</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "select examinationpassed, institute, board, yearofpassing, divisiongrade, percentage from tbl_applicant_qualification where applicationid = '". $_GET['applicationid']."';";
                                $result = $mysqli->query($query);
                                $counter = 1;
                                while($row = $result->fetch_row()){
                                    ?>
                                    <tr>
                                      <td><?php echo $counter++; ?>.</td>
                                      <td><?php echo $row[0]; ?></td>
                                      <td>
                                        <?php                                            
                                            echo strtoupper($row[1]);
                                        ?>
                                      </td>
                                      <td>
                                        <?php                                            
                                            echo strtoupper($row[2]);
                                        ?>
                                      </td>
                                      <td><?php echo $row[3]; ?></td>
                                      <td><?php echo $row[4]; ?></td>
                                      <td><?php echo $row[5]; ?><sup>%</sup></td>
                                    </tr>
                                    <?php
                                }
                            ?>                             
                            </tbody>
                          </table>                          
                        </div>
                        <!-- /.card-body -->  
                      </div>
                      <br><br><br>
                      <div class="card">
                          <div class="card-header float-left"> 
                          <h3 class="card-title">Core Subject Selection</h3>
                        </div>
                        <div class="card-body p-0">
                          <table class="table">
                            <thead>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>Core Subject</th>
                                <th>Elective 1</th>    
                                <th>Elective 2</th>                              
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $query = "select coresubject, electiveone, electivetwo, id from tbl_applicant_subject_choice where applicationid = '". $_GET['applicationid'] . "' ORDER BY id ASC;";
                                $result = $mysqli->query($query);
                                $counter = 1;
                                while($row = $result->fetch_row()){
                                  echo '<tr>';
                                  echo '<td>' . $counter++ . '.</td>';
                                  echo '<td>'. $row[0] .'</td>';
                                  echo '<td>'. $row[1] .'</td>';
                                  echo '<td>'. $row[2] .'</td>';                     
                                  echo '</tr>';
                                }
                              ?>                              
                            </tbody>
                          </table>
                        </div>
                      </div> 
                      <br><br>
                      <div class="card">
                          <div class="card-header float-left"> 
                          <h3 class="card-title">Declaration</h3>
                        </div>
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

                      <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br&nbsp;><br>&nbsp;<br>                           
                      <?php 
                      $query = "select disableperson, disablecertificate from tbl_applicant where applicationid = ". $_GET['applicationid'];
                      $result = $mysqli->query($query);
                      $row = $result->fetch_row();
                      if($row[0] === "Yes"){ ?>
                        <!-- Sport Certificate -->
                        <div class="card">
                                     <div class="card-header float-left"> 
                                       <h3 class="card-title">Disability Certificate</h3>
                                     </div>
                                     <div class="card-body table-responsive p-0">
                                       <?php
                                         echo '<center><img src="'.$row[1].'" width="80%"></center><br>';                                         
                                       ?>
                                     </div>
                         </div>                        
                      <br><br> <br><br><br><br>
                      <?php 
                      }
                      $query = "select sportquota, sportcertificate from tbl_applicant where applicationid = ". $_GET['applicationid'];
                      $result = $mysqli->query($query);
                      $row = $result->fetch_row();
                      if($row[0] === "Yes"){ ?>
                        <!-- Sport Certificate -->
                        <div class="card">
                                     <div class="card-header float-left"> 
                                       <h3 class="card-title">Sport Certificate</h3>
                                     </div>
                                     <div class="card-body table-responsive p-0">
                                       <?php
                                         echo '<center><img src="'.$row[1].'" width="80%"></center><br>';                                         
                                       ?>
                                     </div>
                         </div>  
                      <?php                        
                      }                     
                      ?>
                      <br><br><br><br><br><br>
                       <!-- Marksheet -->
                       <div class="card">
                                    
                                    <div class="card-header float-left"> 
                                      <h3 class="card-title">Marksheet</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                      <?php
                                        $query = "select examinationpassed, scanimage from tbl_applicant_qualification where applicationid = '". $_GET['applicationid'] . "' ORDER BY applicationid ASC;";
                                        $result = $mysqli->query($query);
                                        
                                        while($row = $result->fetch_row()){
                                            //echo '<strong>'. $row[0] . '</strong><br>'; 
                                            echo '<center><img src="'.$row[1].'" width="80%"></center><br>';
                                        }
                                      ?>
                                    </div>
                        </div>  
                        <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                        <!-- ID Card -->
                       <div class="card">
                                    <div class="card-header float-left"> 
                                      <h3 class="card-title">ID Card</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                      <?php
                                        $query = "select aadhaarscanned, aadhaarbackscanned, voteridscanned, voteridbackscanned from tbl_applicant where applicationid = ". $_GET['applicationid'] . ";";
                                        $result = $mysqli->query($query);
                                        
                                        if($row = $result->fetch_row()){
                                            //echo '<strong>'. $row[0] . '</strong><br>'; 
                                            if($row[0] !== ""){
                                              echo '<center><img src="'.$row[0].'" width="40%">&emsp;<img src="'.$row[1].'" width="40%"></center><br><br><br><br>';
                                            }
                                            if($row[2] !== ""){
                                              echo '<center><img src="'.$row[2].'" width="40%">&emsp;<img src="'.$row[3].'" width="40%"></center>';
                                            }
                                        }
                                      ?>
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