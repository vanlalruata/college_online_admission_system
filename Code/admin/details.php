  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Applicant Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Applicant Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <?php
     $mobile = '';
     require_once '../config/dbconfig.php';
     $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

     if(isset($_GET['page'])){
        if($_GET['page'] === 'details'){ 
            
            $counter = 0;
            $query = "select COUNT(*) from tbl_applicant_subject_choice where applicationid = " . $_GET['applicationid'];
            $result = $mysqli->query($query);
            if($row = $result->fetch_row()){
                $counter += 3;
            }

            $query = "select COUNT(*) from tbl_applicant_qualification where applicationid = " . $_GET['applicationid'];
            $result = $mysqli->query($query);
            if($row = $result->fetch_row()){
                $counter += 1;
            }

            $query = "select fullname, photo, program, dateofbirth, gender, religion, category, mobile, email, fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, note, bloodgroup, aadhaar, voterid, disableperson, disablecertificate, sportquota, sportcertificate  from tbl_applicant where applicationid = " . $_GET['applicationid'];
            $result = $mysqli->query($query);
            if($row=$result->fetch_row()){
                ?>
                     <!-- Main content -->
                    <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                <img class="profile-user-img img-fluid"
                                    src="<?php echo $row[1]; ?>"
                                    alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?php echo $row[0]; ?></h3>

                                <p class="text-muted text-center">Applied for: <strong><?php echo $row[2]; ?></strong></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>HSLC</b> <a id="HSLCPER" class="float-right">0<sup>%</sup></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>HSSLC</b> <a id="HSSLCPER" class="float-right">0<sup>%</sup></a>
                                    </li>
                                                                    
                                <li class="list-group-item" style="display: none;">
                                    <b>Core</b> <a id="core" class="float-right">Core</a>
                                </li>
                                </ul>
                                <?php
                                    if($_SESSION['$role'] === '1'){
                                        //Super Power
                                        if(isset($_GET['action'])){
                                            if($_GET['action'] === "newapplication" || $_GET['action'] === "monitor" || $_GET['action'] === "waiting"){
                                                //Can approve...Show Send for Approval Button, and change state to monitor
                                                if($counter>=4){
                                                    echo '<a href="?action=approve&applicationid='.$_GET['applicationid'].'" class="btn btn-primary btn-block"><b>Approve Application</b></a>';                                                
                                                    //echo '<a href="?action=monitor&applicationid='.$_GET['applicationid'].'" class="btn btn-primary btn-block"><b>Send for Approval</b></a>'; //If clicked, send to principal for approval                                                
                                                }
                                                echo '<a href="?action=reject&applicationid='.$_GET['applicationid'].'" class="btn btn-danger btn-block"><b>Reject Application</b></a>';
                                                echo '<a href="?action=waiting&applicationid='.$_GET['applicationid'].'" class="btn btn-warning btn-block"><b>Send to Waiting List</b></a>';
                                            }   
                                        }
                                    }
                                    else if($_SESSION['$role'] === '2'){
                                        //Administrator
                                        if(isset($_GET['action'])){
                                            if($_GET['action'] === "newapplication" || $_GET['action'] === "incomplete"){
                                                //Can approve...Show Send for Approval Button, and change state to monitor
                                                if($counter>=4){
                                                    echo '<a href="?action=monitor&applicationid='.$_GET['applicationid'].'" class="btn btn-primary btn-block"><b>Send for Approval</b></a>'; //If clicked, send to principal for approval
                                                }
                                                echo '<a href="?action=reject&applicationid='.$_GET['applicationid'].'" class="btn btn-danger btn-block"><b>Reject Application</b></a>';
                                                echo '<a href="?action=waiting&applicationid='.$_GET['applicationid'].'" class="btn btn-warning btn-block"><b>Send to Waiting List</b></a>';
                                            }
                                            else if($_GET['action'] === "monitor"){
                                                if($counter>=4){
                                                    echo '<b>This application has been sent to the principal for further approval. But you can still reject from your end if you want to.</b>';
                                                }
                                                echo '<a href="?action=reject&applicationid='.$_GET['applicationid'].'" class="btn btn-danger btn-block"><b>Reject Application</b></a>';
                                                echo '<a href="?action=waiting&applicationid='.$_GET['applicationid'].'" class="btn btn-warning btn-block"><b>Send to Waiting List</b></a>';
                                            }                                              
                                            else if($_GET['action'] === "waiting"){
                                                echo '<b>This application has been put on waiting. But you can re-check it for approval. Pricipal will be notified.</b>';
                                                echo '<a href="?action=monitor&applicationid='.$_GET['applicationid'].'" class="btn btn-secondary btn-block"><b>Send for Approval</b></a>'; //If clicked, send to principal for approval
                                                
                                            }                                               
                                            else if($_GET['action'] === "reject"){
                                                echo '<b>This application has been rejected. But you can re-check it for approval. Pricipal will be notified.</b>';
                                                echo '<a href="?action=reject&applicationid='.$_GET['applicationid'].'" class="btn btn-primary btn-block"><b>Reject Application</b></a>'; 
                                                
                                            } 
                                            //Delete Button
                                            echo '<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-danger""><b>Delete Permanently</b></button>';
                                            ?>
                                            <div class="modal fade" id="modal-danger">
                                                <div class="modal-dialog">
                                                  <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Confirm to Delete</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <p>Are you sure to delete? You won't be able to revert this!</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>                                                      
                                                      <a href="?action=delete&applicationid=<?php echo $_GET['applicationid']; ?>" class="btn btn-outline-light"><b>Yes, Delete it</b></a>
                                                    </div>
                                                  </div>
                                                  <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                            <?php                                    
                                        }
                                    }
                                    else if($_SESSION['$role'] === '3'){
                                        //Operator
                                        if(isset($_GET['action'])){
                                            if($_GET['action'] === "newapplication"){
                                                //Can approve...Show Send for Approval Button, and change state to monitor
                                                if($counter>=4){
                                                    echo '<a href="?action=monitor&applicationid='.$_GET['applicationid'].'" class="btn btn-primary btn-block"><b>Send for Approval</b></a>'; //If clicked, send to principal for approval
                                                }
                                                echo '<a href="?action=waiting&applicationid='.$_GET['applicationid'].'" class="btn btn-info btn-block"><b>Send to Waiting List</b></a>';
                                                echo '<a href="?action=reject&applicationid='.$_GET['applicationid'].'" class="btn btn-danger btn-block"><b>Reject Application</b></a>';
                                            }
                                            else if($_GET['action'] === "monitor"){
                                                echo '<b>This application has been sent to the principal for further approval.</b>';
                                            }
                                            else if($_GET['action'] === "waiting"){
                                                echo '<b>This application has been hold on as waiting list.</b>';
                                            }
                                            else if($_GET['action'] === "reject"){
                                                echo '<b>This application has been hold on as Rejected list.</b>';
                                            }                                        
                                        }
                                    }
                                    else if($_SESSION['$role'] === '4'){
                                        //Staff
                                        if(isset($_GET['action'])){
                                            if($_GET['action'] === "newapplication"){
                                                //Can approve...Show Send for Approval Button, and change state to monitor
                                                if($counter>=4){
                                                    echo '<a href="?action=monitor&applicationid='.$_GET['applicationid'].'" class="btn btn-primary btn-block"><b>Send for Approval</b></a>'; //If clicked, send to principal for approval
                                                }
                                                echo '<a href="?action=waiting&applicationid='.$_GET['applicationid'].'" class="btn btn-info btn-block"><b>Send to Waiting List</b></a>';
                                                echo '<a href="?action=reject&applicationid='.$_GET['applicationid'].'" class="btn btn-danger btn-block"><b>Reject Application</b></a>';
                                            }
                                            else if($_GET['action'] === "monitor"){
                                                echo '<b>This application has been sent to the principal for further approval.</b>';
                                            }
                                            else if($_GET['action'] === "waiting"){
                                                echo '<b>This application has been put on hold.</b>';
                                            }
                                            else if($_GET['action'] === "reject"){
                                                echo '<b>This application has been hold on as Rejected list.</b>';
                                            }
                                        }

                                    }
                                ?>                               
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->
                            <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Action</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="#" class="btn btn-info btn-block" data-toggle="modal" data-target="#modal-xl"><b><i class="fas fa-print"></i>&nbsp;Print Application</b></a>
                                <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal-sms"><b><i class="fas fa-comment-lines"></i>&nbsp;Send Message</b></a>                           
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>                        
                        <!-- /.col -->

                        <div class="modal fade" id="modal-sms">
                            <div class="modal-dialog modal-sm"><form action="" method="post">
                            <div class="modal-content">
                                <div class="modal-header"><i class="fas fa-sms"></i>
                                <h4 class="modal-title">Send SMS</h4>                                
                                </div>
                                <textarea name="message" placeholder="Your sms message" required></textarea>                              
                                
                                <div class="modal-footer justify-content-between">
                                <input type="hidden" name="mobile" value="<?php echo str_replace(' ', '', $row[7]); ?>">
                                <input type="hidden" name="action" value="sendsms">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-sms"></i>&nbsp;Send</button>
                                </div>
                            </div></form>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->



                        <div class="col-md-9">
                            <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Educational Qualification</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Subject Combination</a></li>
                                <li class="nav-item"><a class="nav-link" href="#additional" data-toggle="tab">Additional Information</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 515px;">
                                <div class="tab-content">
                                <div class="active tab-pane" id="activity">                                    
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Particular</th>
                                            <th>Details</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td>1.</td>
                                            <td>Course Programme</td>
                                            <td>
                                                <?php echo $row[2]; ?>
                                            </td>                                            
                                            </tr>
                                            <tr>
                                            <td>2.</td>
                                            <td>Date of Birth</td>
                                            <td>
                                                <?php $date = strtotime($row[3]); echo date('d-m-Y', $date); ?>
                                            </td>                                            
                                            </tr>
                                            <tr>
                                            <td>3.</td>
                                            <td>Gender</td>
                                            <td>
                                                <?php echo $row[4]; ?>
                                            </td>
                                            
                                            </tr>
                                            <tr>
                                            <td>4.</td>
                                            <td>Blood Group</td>
                                            <td>
                                                <?php echo $row[18]; ?>
                                            </td>
                                            
                                            </tr>
                                            <tr>
                                            <td>5.</td>
                                            <td>Aadhaar</td>
                                            <td>
                                                <?php echo $row[19]; ?>
                                            </td>
                                            
                                            </tr>
                                            <tr>
                                            <td>6.</td>
                                            <td>Voter ID</td>
                                            <td>
                                                <?php echo $row[20]; ?>
                                            </td>
                                            
                                            </tr>
                                            <tr>
                                            <td>7.</td>
                                            <td>Religion</td>
                                            <td>
                                                <?php echo $row[5]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>8.</td>
                                            <td>Category</td>
                                            <td>
                                                <?php echo $row[6]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>9.</td>
                                            <td>Mobile</td>
                                            <td>
                                                <a href="https://api.whatsapp.com/send/?phone=91<?php echo str_replace(' ', '', $row[7]); ?>&text&app_absent=0" target="_blank"><?php echo $row[7]; ?></a>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>10.</td>
                                            <td>Email</td>
                                            <td>
                                                <?php echo $row[8]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>11.</td>
                                            <td>Father's Name</td>
                                            <td>
                                                <?php echo $row[9]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>12.</td>
                                            <td>Father's Contact #</td>
                                            <td>
                                                <?php echo $row[10]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>13.</td>
                                            <td>Mother's Name</td>
                                            <td>
                                                <?php echo $row[11]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>14.</td>
                                            <td>Mother's Contact #</td>
                                            <td>
                                                <?php echo $row[12]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>15.</td>
                                            <td>Permanent Address</td>
                                            <td>
                                                <?php echo $row[13]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>16.</td>
                                            <td>Local Guardian</td>
                                            <td>
                                                <?php echo $row[14]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>17.</td>
                                            <td>Guardian's Contact #</td>
                                            <td>
                                                <?php echo $row[15]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>18.</td>
                                            <td>Local Address</td>
                                            <td>
                                                <?php echo $row[16]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>19.</td>
                                            <td>Physically Handicap</td>
                                            <td>
                                                <?php 
                                                    if($row[21] === "Yes"){                                                        
                                                        echo '<a href="" data-toggle="modal" data-target="#'.$row[21].'"><strong>'.$row[21].'</strong></a></td>';
                                                    ?>
                                                    <div class="modal fade" id="<?php echo $row[21];?>">
                                                        <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Certifcate of Disability</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body table-responsive p-0">
                                                            <p><img src="<?php echo $row[22];?>" height="50%" width="50%"/></p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    <?php
                                                    }
                                                    else{
                                                        echo $row[21];
                                                    }                                               
                                                
                                                 ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>20.</td>
                                            <td>Any achievement(s) in Sports</td>
                                            <td>
                                                <?php echo $row[17]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>21.</td>
                                            <td>Seeking Sport Quota</td>
                                            <td>
                                                <?php 
                                                    if($row[23] === "Yes"){                                                        
                                                        echo '<a href="" data-toggle="modal" data-target="#'.$row[23].'"><strong>'.$row[23].'</strong></a></td>';
                                                    ?>
                                                    <div class="modal fade" id="<?php echo $row[23];?>">
                                                        <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Sport Certificate</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body table-responsive p-0">
                                                            <p><img src="<?php echo $row[24];?>" height="50%" width="50%"/></p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    <?php
                                                    }
                                                    else{
                                                        echo $row[23];
                                                    }                                               
                                                
                                                 ?>
                                            </td>                                           
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Examination</th>
                                            <th>Institute</th>   
                                            <th>Board</th> 
                                            <th>Passing Year</th>  
                                            <th>Division</th>
                                            <th>Percentage</th>                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = "select * from tbl_applicant_qualification where applicationid = '" . $_GET['applicationid'] . "';";
                                                $result = $mysqli->query($query);
                                                $counter = 1;
                                                while($row=$result->fetch_row()){
                                                    echo '<tr>';
                                                    echo '<td>' . $counter++ .'</td>';
                                                    echo '<td><a href="" data-toggle="modal" data-target="#'.substr($row[1], 0, 4).'"><strong>'.$row[1].'</strong></a></td>';
                                                    ?>
                                                    <div class="modal fade" id="<?php echo substr($row[1], 0, 4);?>">
                                                        <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Scanned Copy of <?php echo $row[1]; ?> Marksheet</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body table-responsive p-0">
                                                            <p><img src="<?php echo $row[7];?>" height="50%" width="50%"/></p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    <?php
                                                    echo '<td>'.$row[2].'</td>';
                                                    echo '<td>'.$row[3].'</td>';
                                                    echo '<td>'.$row[4].'</td>';                                          
                                                    echo '<td>'.$row[5].'</td>';
                                                    $pos = strtok($row[1], " ");
                                                    echo '<script>document.getElementById("'. $pos .'PER").innerHTML = "'.$row[6].'<sup>%</sup>";</script>';      
                                                    echo '<td class="float-right">'.$row[6].'<sup>%</sup></td>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->                                

                                <div class="tab-pane" id="settings">
                                <table class="table table-head-fixed text-nowrap">
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
                                                $query = "select * from tbl_applicant_subject_choice where applicationid = " . $_GET['applicationid'] . " ORDER BY id ASC;";
                                                $result = $mysqli->query($query);
                                                $counter = 1;
                                                while($row=$result->fetch_row()){
                                                    echo '<tr>';
                                                    if($counter === 1){echo '<script>document.getElementById("core").innerHTML = "'.$row[2].'";</script>';}
                                                    echo '<td>' . $counter++ . '</td>';
                                                    echo '<td>'.$row[2].'</td>';
                                                    echo '<td>'.$row[3].'</td>';
                                                    echo '<td>'.$row[4].'</td>';
                                                    echo '</tr>';                                                    
                                                }
                                            ?>
                                            <tr></tr>
                                            <tr><td colspan="4">The choices are arranged in order as per the applicant's choice.</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                                
                                <div class="tab-pane" id="additional">
                                <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                            <th>Blood Group</th>
                                            <th>Aadhaar #</th>
                                            <th>Voter ID</th>                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = "select bloodgroup, aadhaar, voterid, aadhaarscanned, aadhaarbackscanned, voteridscanned, voteridbackscanned from tbl_applicant where applicationid = " . $_GET['applicationid'];
                                                $result = $mysqli->query($query);
                                                $counter = 1;
                                                while($row=$result->fetch_row()){
                                                    echo '<tr>';
                                                    echo '<td>' . $row[0] .'</td>';
                                                    echo '<td><a href="" data-toggle="modal" data-target="#aadhaar"><strong>'.$row[1].'</strong></a></td>';
                                                    ?>
                                                    <div class="modal fade" id="aadhaar">
                                                        <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Scanned Copy of Aadhaar Card</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body table-responsive p-0">
                                                            <p><img src="<?php echo $row[3];?>" width="25%"/> &emsp;
                                                            <img src="<?php echo $row[4];?>" width="25%"/></p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    
                                                    <?php
                                                        echo '<td><a href="" data-toggle="modal" data-target="#voterid"><strong>'.$row[2].'</strong></a></td>';
                                                    ?>
                                                    <div class="modal fade" id="voterid">
                                                        <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Scanned Copy of Voter ID</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body table-responsive p-0">
                                                            <p><img src="<?php echo $row[5];?>" width="25%"/>&emsp;<img src="<?php echo $row[6];?>" width="25%"/></p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    <?php
                                                    echo '<script>document.getElementById("'.$row[1].'PER").innerHTML = "'.$row[6].'<sup>%</sup>";</script>';      
                                                    
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane --> 
                                
                                
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->


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
                                $query = "select status from tbl_applicant_payment where applicationid = ". $_GET['applicationid'];
                                $result = $mysqli->query($query);
                                if($row = $result->fetch_row()){
                                    if($row[0] === 'paid'){
                                    $status = 'paid';
                                    }
                                }

                                $query = "select program, fullname, dateofbirth, gender, category, religion, mobile, email,
                                fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, note, bloodgroup, aadhaar, voterid, disableperson, disablecertificate, sportquota, sportcertificate from tbl_applicant where applicationid = ". $_GET['applicationid'];
                                $result = $mysqli->query($query);
                                $row = $result->fetch_row();
                            ?>
                                <div class="modal-body">
                                    
                                    <div class="float-right">
                                    <img src="<?php echo $row[16]; ?>" style="" class="profile-user-img img-fluid">
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
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Particular</th>
                                            <th>Details</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td>1.</td>
                                            <td>Course Programme</td>
                                            <td>
                                                <?php echo $row[0]; ?>
                                            </td>                                            
                                            </tr>
                                            <tr>
                                            <td>2.</td>
                                            <td>Date of Birth</td>
                                            <td>
                                                <?php echo date('d-m-Y', strtotime($row[2])); ?>
                                            </td>                                            
                                            </tr>
                                            <tr>
                                            <td>3.</td>
                                            <td>Gender</td>
                                            <td>
                                                <?php echo $row[3]; ?>
                                            </td>
                                            
                                            </tr>
                                            <tr>
                                            <td>4.</td>
                                            <td>Blood Group</td>
                                            <td>
                                                <?php echo $row[18]; ?>
                                            </td>
                                            
                                            </tr>
                                            <tr>
                                            <td>5.</td>
                                            <td>Aadhaar</td>
                                            <td>
                                                <?php echo $row[19]; ?>
                                            </td>
                                            
                                            </tr>
                                            <tr>
                                            <td>6.</td>
                                            <td>Voter ID</td>
                                            <td>
                                                <?php echo $row[20]; ?>
                                            </td>
                                            
                                            </tr>
                                            <tr>
                                            <td>7.</td>
                                            <td>Religion</td>
                                            <td>
                                                <?php echo $row[5]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>8.</td>
                                            <td>Category</td>
                                            <td>
                                                <?php echo $row[4]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>9.</td>
                                            <td>Mobile</td>
                                            <td>
                                                <?php echo $row[6]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>10.</td>
                                            <td>Email</td>
                                            <td>
                                                <?php echo $row[7]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>11.</td>
                                            <td>Father's Name</td>
                                            <td>
                                                <?php echo $row[8]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>12.</td>
                                            <td>Father's Contact #</td>
                                            <td>
                                                <?php echo $row[9]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>13.</td>
                                            <td>Mother's Name</td>
                                            <td>
                                                <?php echo $row[10]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>14.</td>
                                            <td>Mother's Contact #</td>
                                            <td>
                                                <?php echo $row[11]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>15.</td>
                                            <td>Permanent Address</td>
                                            <td>
                                                <?php echo $row[12]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>16.</td>
                                            <td>Local Guardian</td>
                                            <td>
                                                <?php echo $row[13]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>17.</td>
                                            <td>Guardian's Contact #</td>
                                            <td>
                                                <?php echo $row[14]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>18.</td>
                                            <td>Local Address</td>
                                            <td>
                                                <?php echo $row[15]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>19.</td>
                                            <td>Physically Handicap</td>
                                            <td>
                                                <?php echo $row[21]; ?>
                                            </td>                                           
                                            </tr>
                                            <tr>
                                            <td>20.</td>
                                            <td>Any achievement(s) in Sports</td>
                                            <td>
                                                <?php echo $row[17]; ?>
                                            </td>                                           
                                            </tr>
                                            <td>21.</td>
                                            <td>Seeking Sport Quota</td>
                                            <td>
                                                <?php echo $row[23]; ?>
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
                                            $query = "select examinationpassed, institute, board, yearofpassing, divisiongrade, percentage from tbl_applicant_qualification where applicationid = ". $_GET['applicationid'];
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
                                            $query = "select coresubject, electiveone, electivetwo, id from tbl_applicant_subject_choice where applicationid = ". $_GET['applicationid'] . " ORDER BY id ASC;";
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
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <a href="../printit.php?applicationid=<?php echo $_GET['applicationid']; ?>" target="_blank" class="btn btn-primary">Print</a>
                                </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->                             


                    </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>

                <?php
            }
        }
        else{
            die;
        }
     }
     else{
         die;
     }
  ?>  