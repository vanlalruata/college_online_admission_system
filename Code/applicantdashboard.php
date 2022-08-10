<?php
   if(!isset($_SESSION['$applicantid'])){
       die;
   }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Welcome <?php 
            $query = "select fullname from tbl_applicant where applicationid = " . $_SESSION['$applicantid'] . ";";
            
            $result = $mysqli->query($query);
            if($row = $result->fetch_row()){
                echo $row[0];
            }
            else{
                echo $_SESSION['$applicantid'];
            }            
             ?>,</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
              <li class="breadcrumb-item"><a href="logout.php"><i class="fas fa-sign-out text-danger"></i>&nbsp;Logout</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <script>document.getElementById("pagetitle").innerHTML = "Applicant Dashboard";</script>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">      

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Progress</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th style="width: 100px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Provisional Admission Form</td>                      
                      <td><span class="badge bg-success">Completed</span></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Education Qualification Details
                      <?php                             
                        //echo '<a href="?page=educationalqualification&applicantid=' . $_SESSION['$applicantid'].'">Education Qualification Details</a>';                            
                      ?>
                       </td>                      
                      <td>
                      <?php 
                            $query = "select * from tbl_applicant_qualification where applicationid = '" . $_SESSION['$applicantid'] . "';";
                            $result = $mysqli->query($query);
                            $count = 0;
                            while($row = $result->fetch_row()){
                                $count++;
                            }
                            if($count>=2){
                                echo '<span class="badge bg-success">Completed</span>';
                                $count=2;
                            }
                            else{
                                echo '<span class="badge bg-warning"><a href="?page=educationalqualification&applicantid=' . $_SESSION['$applicantid'].'">Incomplete : Click Here</a></span>';
                                $count=0;
                            }                                                      
                        ?>
                       </td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Core Subjects Combination<?php                             
                        //echo '<a href="?page=coresubjectcombination&applicantid=' . $_SESSION['$applicantid'].'">Core Combination Subject</a>';                            
                      ?></td>                      
                      <td>
                      <?php 
                            if($count==2){                              
                              $query = "select DISTINCT(applicationid) from tbl_applicant_subject_choice where applicationid = '" . $_SESSION['$applicantid'] . "';";
                              $result = $mysqli->query($query);                              
                              while($row = $result->fetch_row()){
                                  $count++;
                              }
                            }
                            if($count>=3){
                                echo '<span class="badge bg-success">Completed</span>';
                            }
                            else if($count == 0){
                                echo '<span class="badge bg-warning"><a href="?page=coresubjectcombination&applicantid=' . $_SESSION['$applicantid'].'">Incomplete : Click Here</a></span>';
                            }
                            else{
                                echo '<span class="badge bg-warning"><a href="?page=coresubjectcombination&applicantid=' . $_SESSION['$applicantid'].'">Incomplete : Click Here</a></span>';
                            }
                            //$count = 0;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Declaration</td>                      
                      <td>
                      <?php 
                            if($count>=3){                              
                              $query = "select aadhaar, voterid, bloodgroup from tbl_applicant where applicationid = " . $_SESSION['$applicantid'] . ";";
                              $result = $mysqli->query($query);
                              $count = 0;
                              while($row = $result->fetch_row()){
                                  if(($row[0]!= null) || ($row[1] != null) || ($row[2] != null)){
                                    $count += 1;
                                  } 
                                  else{
                                    $count--;
                                  }                                
                              }
                            }
                            else{
                              $count = 0;
                            }
                            if($count >= 1){
                                echo '<span class="badge bg-success">Completed</span>';
                            }
                            else if($count == 0){
                                echo '<span class="badge bg-warning"><a href="?page=additionalinfo&applicantid=' . $_SESSION['$applicantid'].'">Incomplete : Click Here</a></span>';
                            }
                            else{
                                echo '<span class="badge bg-warning"><a href="?page=additionalinfo&applicantid=' . $_SESSION['$applicantid'].'">Incomplete : Click Here</a></span>';
                            }
                            //$count = 0;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <?php
                          //When admin accept the application, he can enable payment from the admin dashboard
                          //Only the applicant_payment table will be affected and the applicantid and amount will be inserted
                          //Then the payment option will appear for that candidate
                          //Also each semester fee can be enable by the administrator just by adding fee entry with status = unpaid
                          $query = "select status from tbl_applicant_payment where applicationid = '" . $_SESSION['$applicantid'] . "';";
                          $result = $mysqli->query($query);
                          if($row = $result->fetch_row()){
                            if($row[0] === "unpaid"){
                              echo '<td>4.</td>';
                              echo '<td>Payment</td>';                     
                              echo '<td>';
                              $query = "select * from tbl_applicant_payment where applicationid = '" . $_SESSION['$applicantid'] . "' and status='unpaid'";
                              $result = $mysqli->query($query);
                              $count = 0;
                              while($row = $result->fetch_row()){
                                  $count++;
                              }
                              if($count>=1){
                                  echo '<span class="badge bg-warning"><a href="?page=payment&applicantid=' . $_SESSION['$applicantid'].'">Click Here to Pay</a></span>';
                                }
                              else if($count === 0){
                                  echo '<span class="badge bg-success">Completed</span>';
                              }
                              echo '</td>';
                            }
                            else if($row[0] === "paid"){
                              echo '<td>4.</td>';
                              echo '<td>Payment</td>';                     
                              echo '<td>';                              
                              echo '<span class="badge bg-success">Completed</span>';                              
                              echo '</td>';
                            }
                            else{                              
                              echo '<td colspan="3" align="center">If your application is approved, you will get payment link here. Stay tune and please check your email often.<br><br>Click on the incomplete status to process if there are any incomplete task.</td>';
                            }
                          }
                          else{
                            if($count != 0){
                              echo '<tr></tr><tr><td><code>**</code></td>';
                              echo '<td>Your application has been received and it will be reviewed soon, you will be contacted by our staff thorugh email or SMS if your application is approved. Kindly check your email or SMS frequently for this regard.</td>';                     
                              echo '<td><span class="badge bg-info">In Review</span>';
                              echo '</td></tr>';
                            }
                             
                          }
                      ?>
                    </tr><tr></tr>
                    <tr>
                    <?php
                          //When the applicant paid the fee, online or offline successfully
                          //They Should be able to download the complete application
                          //Or they can even pay offline in the office, for that they can printout and pay it offline in the office
                          //But there will be a text displaying fee unpaid
                          $query = "select status from tbl_applicant_payment where applicationid = '" . $_SESSION['$applicantid'] ."';";
                          $result = $mysqli->query($query);
                          if($row = $result->fetch_row()){
                            if($row[0] === "unpaid"){
                              echo '<td>5.</td>';
                              echo '<td>Download Application Form</td>';                     
                              echo '<td>';                              
                              echo '<a href="" data-toggle="modal" data-target="#modal-xl"><span class="badge bg-info">Download</span></a>';                              
                              echo '</td>';
                            }
                            else if($row[0] === "paid"){
                              echo '<td>5.</td>';
                              echo '<td>Download Filled Application</td>';                     
                              echo '<td>';                              
                              echo '<a href="" data-toggle="modal" data-target="#modal-xl"><span class="badge bg-info">Download</span></a>';                              
                              echo '</td>';
                              echo '<tr><td colspan="3" align="center"><div class="embed-responsive embed-responsive-16by9">
                              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/IXUKypMU5a8" allowfullscreen></iframe>
                            </div></td></tr>';
                            }
                            else{
                              echo '<td colspan="3" align="center">If your application is approved, you will get payment link here. Stay tune and please check your email often.<br><br>Click on the incomplete status to process if there are any incomplete task.</td>';
                            }
                          }
                      ?> 
                    </tr>
                  </tbody>
                </table>  

                <?php 
                    $query = "select logo, college_name, address, phone, email from tbl_general_settings where college_id = 1";
                    $result = $mysqli->query($query);
                    $row = $result->fetch_row();
                ?>
                <div class="modal fade" id="modal-xl">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
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
                          $query = "select status from tbl_applicant_payment where applicationid = '". $_SESSION['$applicantid'] . "';";
                          $result = $mysqli->query($query);
                          if($row = $result->fetch_row()){
                            if($row[0] === 'paid'){
                              $status = 'paid';
                            }
                          }

                          $query = "select program, fullname, dateofbirth, gender, category, mobile,
                          fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, note from tbl_applicant where applicationid = ". $_SESSION['$applicantid'];
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
                                echo '<h3 style="color:red";><strong>Click Here to Pay</strong></h3>';
                              }
                          ?>
                          <h5 style="color:red";><strong>Application ID:</strong> &emsp;<?php echo $_SESSION['$applicantid']; ?></h5> 
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
                                <td>Note</td>
                                <td>
                                  <b><?php echo $row[15];?></b>
                                </td>                                
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Educational Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
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
                                $query = "select examinationpassed, institute, board, yearofpassing, divisiongrade, percentage from tbl_applicant_qualification where applicationid = '". $_SESSION['$applicantid'] . "';";
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
                      <div class="card">
                          <div class="card-header float-left"> 
                          <h3 class="card-title">Core Subject Selection</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
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
                                $query = "select coresubject, electiveone, electivetwo, id from tbl_applicant_subject_choice where applicationid = '". $_SESSION['$applicantid'] . "' ORDER BY id ASC;";
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

                      <div class="modal-footer justify-content-between" id="editor">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <a href="printit.php?applicationid=<?php echo $_SESSION['$applicantid']; ?>" target="_blank" class="btn btn-primary">Print</a>                        
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->        
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->