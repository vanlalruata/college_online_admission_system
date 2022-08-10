  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student's Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Student's Profile</li>
              <li class="breadcrumb-item"><a href="logout.php"><i class="fas fa-sign-out text-danger"></i>&nbsp;Logout</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <?php
     $mobile = '';
     require_once 'config/dbconfig.php';
     $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

     if(isset($_SESSION['$universityreg'])){
        $_SESSION['$applicantid'] = $_SESSION['$universityreg'];
      }
               
     $counter = 0;  
     $query = "select fullname, photo, program, dateofbirth, gender, religion, category, mobile, email, fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, note, bloodgroup, aadhaar, voterid, semester from tbl_applicant where universityreg = '" . $_SESSION['$universityreg']."';";
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

                         <p class="text-muted text-center">Admitted for: <strong><?php echo $row[2]; ?></strong></p>

                         <ul class="list-group list-group-unbordered mb-2"> 
                         <form action="" method="post" enctype="multipart/form-data">     
                         <li class="list-group-item">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="photo" class="custom-file-input" id="customFile" accept="image/jpg, image/jpeg" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                         </li>                              
                         <input type="hidden" name="action" value="updatepassport">
                         <input type="hidden" name="id" value="<?php echo $_SESSION['$universityreg']; ?>">                                  
                         <li class="list-group-item">
                            <center><button type="submit" class="btn btn-primary">Submit</button></center>
                         </li>
                         </form>
                         </ul>                                                       
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
                         <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal-sms"><b><i class="fas fa-info-circle"></i>&nbsp;Update Details</b></a>                           
                     </div>
                     <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                 </div>                        
                 <!-- /.col -->

                 <div class="modal fade" id="modal-sms">
                     <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                         <div class="modal-header"><i class="fas fa-info-circle"></i>
                         <h4 class="modal-title">Update Details</h4>                                
                         </div>
                         <div class="card-body">
                            <form method="post" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Blood Group</label><code>*</code>
                                    <select name="bloodgroup" class="form-control" required>
                                        <option value="A+ve">A+ve</option>
                                        <option value="A-ve">A-ve</option>
                                        <option value="B+ve">B+ve</option>
                                        <option value="B-ve">B-ve</option>
                                        <option value="O+ve">O+ve</option>
                                        <option value="O-ve">O-ve</option>
                                        <option value="AB+ve">AB+ve</option>
                                        <option value="AB-ve">AB-ve</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Aadhaar #</label><code>*</code>
                                    <input type="text" name="aadhaar" class="form-control" placeholder="Enter your aadhaar number" required>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Voter ID</label>
                                    <input type="text" name="voterid" class="form-control" placeholder="Enter your aadhaar number">
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile #</label><code>*</code> 
                                    <input type="number" name="mobile" class="form-control" placeholder="Enter your mobile number" required>
                                </div>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-sm-6">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Local Guardian</label>
                                    <input type="text" name="guardian" class="form-control" placeholder="Enter your guradian's name">
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Guardian Mobile #</label>
                                    <input type="number" name="guardianmobile" class="form-control" placeholder="Guradian's  number">
                                </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Local Address</label>
                                    <textarea name="localaddress" class="form-control" rows="3" placeholder="Enter your local address"></textarea>
                                </div>
                                </div>
                            </div>  
                            <div class="row">  
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Aadhaar Front</label> (only jpg format)<code>*</code> 
                                        <div class="custom-file">
                                        <input type="file" name="aadhaarfront" class="custom-file-input" id="AadhaarFront" accept="image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="AadhaarFront">Choose file</label>
                                        </div>					
                                    </div>
                                    </div>                              
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Aadhaar Back</label> (only jpg format)<code>*</code> 
                                        <div class="custom-file">
                                        <input type="file" name="aadhaarback" class="custom-file-input" id="AadhaarBack" accept="image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="AadhaarBack">Choose file</label>
                                        </div>					
                                    </div>
                                    </div>                                    
                            </div> 
                            <div class="row">  
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Voter Front</label> (only jpg format)
                                        <div class="custom-file">
                                        <input type="file" name="voterfront" class="custom-file-input" id="VoterFront" accept="image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="VoterFront">Choose file</label>
                                        </div>					
                                    </div>
                                    </div>                              
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Voter Back</label> (only jpg format)
                                        <div class="custom-file">
                                        <input type="file" name="voterback" class="custom-file-input" id="VoterBack" accept="image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="VoterBack">Choose file</label>
                                        </div>					
                                    </div>
                                    </div>                                    
                            </div>              
                            
                            
                        </div>
                        <!-- /.card-body -->                             
                         
                         <div class="modal-footer justify-content-between">
                         <input type="hidden" name="id" value="<?php echo $_SESSION['$universityreg']; ?>">
                         <input type="hidden" name="action" value="updatedetails">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary"><i class="fas fa-info-circle"></i>&nbsp;Submit</button>
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
                         <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Fee Transaction</a></li>
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
                                         <?php echo $row[2] . ' - ' . $row[21] ;  ?>
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
                                         <?php echo $row[7]; ?>
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
                                     <td>Any achievement(s) in Sports</td>
                                     <td>
                                         <?php echo $row[17]; ?>
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
                                     <th>Roll No</th>   
                                     <th>Programme</th> 
                                     <th>Passing Year</th>  
                                     <th>Division</th>
                                     <th>Percentage</th>                                        
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                         $query = "select * from tbl_applicant_qualification where applicationid = '" . $_SESSION['$universityreg'] . "';";
                                         $result = $mysqli->query($query);
                                         $counter = 1;
                                         while($row=$result->fetch_row()){
                                             echo '<tr>';
                                             echo '<td>' . $counter++ .'</td>';
                                             echo '<td><a href="" data-toggle="modal" data-target="#mark-'.substr($row[1],0,2).'"><strong>'.$row[1].'</strong></a></td>';
                                             ?>
                                             <div class="modal fade" id="<?php echo "mark-".substr($row[1], 0, 2);?>">
                                                 <div class="modal-dialog modal-xl">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                     <h4 class="modal-title">Scanned Copy of <?php echo $row[1]; ?> Marksheet</h4>
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                     </button>
                                                     </div>
                                                     <div class="modal-body table-responsive p-0">
                                                     <p><img src="<?php echo $row[7];?>"/></p>
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
                                             echo '<script>document.getElementById("'.$row[1].'PER").innerHTML = "'.$row[6].'<sup>%</sup>";</script>';      
                                             echo '<td class="float-right">'.$row[6].'<sup>%</sup></td>';
                                         }
                                     ?>
                                 </tbody>
                             </table>
                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addedu"><i class="fas fa-plus-circle"></i>&ensp;Add Educational Qualification</button>
                                            <div class="modal fade" id="addedu">
                                                 <div class="modal-dialog modal-xl">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                     <h4 class="modal-title">Add Educational Qualification</h4>
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                     </button>
                                                     </div>
                                                     <div class="modal-body table-responsive p-0">
                                                     <form action="" id="education" method="post" enctype="multipart/form-data">
                                                        <div class="card-body table-responsive p-0">
                                                            <table class="table table-bordered">
                                                            <thead>                  
                                                                <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Examination Passed</th>
                                                                <th>Roll No</th>
                                                                <th>Programme</th>
                                                                <th>Year of Passing</th>
                                                                <th>Division Grade</th>
                                                                <th>Percentage</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                <td>#.</td>
                                                                <td><select class="form-control" id="qualification" name="qualification" placeholder="Eg: 2nd Sem" required>
                                                                        <option value="1st Sem">1st Sem</option>
                                                                        <option value="2nd Sem">2nd Sem</option>
                                                                        <option value="3rd Sem">3rd Sem</option>
                                                                        <option value="4th Sem">4th Sem</option>
                                                                        <option value="4th Sem">5th Sem</option>
                                                                        <option value="4th Sem">6th Sem</option>
                                                                </select>
                                                                </td>
                                                                <td>
                                                                <input type="text" class="form-control" id="institutename" name="semester" placeholder="Eg: MZU1234" required>
                                                                </td>
                                                                <td>
                                                                <input type="text" class="form-control" id="programme" name="programme" placeholder="Eg: B. Sc" required>
                                                                </td>
                                                                <td>
                                                                <input type="text" class="form-control" id="passingyear" name="passingyear" placeholder="Eg: 2020"  required> 
                                                                
                                                                </td>
                                                                <td>
                                                                <select  class="form-control" id="division" name="division" placeholder="Eg: First"  required>
                                                                    <option value="First">Distinction</option>
                                                                    <option value="Distinction">First</option>
                                                                    <option value="Second">Second</option>
                                                                    <option value="Third">Third</option>
                                                                </select>
                                                                </td>
                                                                <td>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" id="percentage" name="percentage" min="40.00" max="100.00" step="0.01" placeholder="Enter your percentage" required>
                                                                    <div class="input-group-append">
                                                                        <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                                                                    </div>
                                                                    </div>                      
                                                                </td>                      
                                                                </tr>                                                                
                                                                <tr>                    
                                                                <td colspan="4">
                                                                <div class="form-group">
                                                                    <label for="exampleInputFile">Choose Scanned Marksheet</label> (only jpg format)
                                                                    <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="marksheet" class="custom-file-input" id="exampleInputFile" accept="image/jpg, image/jpeg" required>
                                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </td>                                                                
                                                                </tr>                    
                                                                <tr>
                                                                <input type="hidden" name="id" value="<?php echo $_SESSION['$universityreg'];?>">
                                                                <input type="hidden" name="action" value="educationalqualification">
                                                                 </tr>
                                                            </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.card-body -->    
                                                        
                                                     </div>
                                                     <div class="modal-footer justify-content-between">
                                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                     <button type="submit" class="btn btn-primary" ><i class="fas fa-server"></i>&emsp;Submit</button>
                                                     </form> 
                                                     </div>
                                                 </div>
                                                 <!-- /.modal-content -->
                                                 </div>
                                                 <!-- /.modal-dialog -->
                                             </div>
                                             <!-- /.modal -->                       
                         </div>
                         <!-- /.tab-pane -->                                

                         <div class="tab-pane" id="settings">
                         <table class="table table-head-fixed text-nowrap">
                                 <thead>
                                     <tr>
                                     <th style="width: 10px">#</th>
                                     <th>Fee Amount</th>
                                     <th>Transaction ID</th>  
                                     <th>Status</th>                                          
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                         $query = "select * from tbl_applicant_payment where applicationid = '" . $_SESSION['$universityreg'] . "' ORDER BY applicationid ASC;";
                                         $result = $mysqli->query($query);
                                         $counter = 1;
                                         while($row=$result->fetch_row()){
                                             echo '<tr>';                                             
                                             echo '<td>' . $counter++ . '</td>';
                                             echo '<td>'.$row[1].'</td>';
                                             echo '<td>'.$row[2].'</td>';
                                             echo '<td>';
                                             if($row[3] === "paid"){
                                                echo '<span class="badge bg-success">Paid</span>';
                                             }
                                             else{
                                                echo '<span class="badge bg-warning"><a href="?page=feepay&applicantid=' . $_SESSION['$universityreg'].'">Unpaid : Pay Now</a></span>';
                                             }
                                             echo '</td>';
                                             echo '</tr>';                                                    
                                         }
                                     ?>
                                     <tr></tr>
                                     <tr></tr>
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
                                         $query = "select bloodgroup, aadhaar, voterid, aadhaarscanned, aadhaarbackscanned, voteridscanned, voteridbackscanned from tbl_applicant where universityreg = '" . $_SESSION['$universityreg'] . "';";
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
                         $query = "select status from tbl_applicant_payment where applicationid = '". $_SESSION['$universityreg']."';";
                         $result = $mysqli->query($query);
                         if($row = $result->fetch_row()){
                             if($row[0] === 'paid'){
                             $status = 'paid';
                             }
                         }

                         $query = "select program, fullname, dateofbirth, gender, category, religion, mobile, email,
                         fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, note, bloodgroup, aadhaar, voterid from tbl_applicant where universityreg = '". $_SESSION['$universityreg'] . "';";
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
                             <h5 style="color:red";><strong>University Reg #:</strong> &emsp;<?php echo $_SESSION['$universityreg']; ?></h5> 
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
                                     <td>Any achievement(s) in Sports</td>
                                     <td>
                                         <?php echo $row[17]; ?>
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
                                     $query = "select examinationpassed, institute, board, yearofpassing, divisiongrade, percentage from tbl_applicant_qualification where applicationid = '". $_SESSION['$universityreg'] . "';";
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

  ?>  