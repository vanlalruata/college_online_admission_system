<?php

if(!isset($_GET['page']) || $_GET['page'] != 'applynow'){die;} //Protect again hacking - Direct page access

$prefix = '';
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
      <?php
            require_once 'config/dbconfig.php';
            $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
            
            $query = "select * from tbl_adm_application where status = 'active'";
            $result = $mysqli->query($query);
            $row = $result->num_rows;
            if((int)$row > 0){
                ?>
                <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div id="card" class="card card-warning">
                        <div class="card-header">
                            <h3 id="card-title" class="card-title">Fill the information Correctly</h3>
                        </div>
                        <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script>
    
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <form action="" role="form" method="post" enctype="multipart/form-data">
                                <!-- First Row -->
                                <div class="row">                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Course Programme</label><code>*</code><br>
                                            
                                            <select class="form-control" name="programme" placeholder="Course Programme" required>
                                            <?php
                                                $query = "select DISTINCT(programme) from tbl_fee_details ORDER BY programme ASC;";
                                                $result = $mysqli->query($query);
                                                while($row = $result->fetch_row()){
                                                    echo '<option value="'. $row[0] .'">'. $row[0] .'</option>';
                                                }


                                                ?>
                                            </select>        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <!-- <label>Academic Year</label><code>*</code> -->
                                        <select class="form-control" name="sessionyear" placeholder="Session Year" style="display: none;">
                                            <?php    
                                                while($row = $result->fetch_row()){
                                                    $prefix = $row[7];
    
                                                    if((date('Y-m-d',strtotime($row[2])) <=  date("Y-m-d", strtotime("now"))) && (date('Y-m-d',strtotime($row[3])) >=  date("Y-m-d", strtotime("now")))){ //Compare the start date is already opened or not, also, closing date is over or not
                                                        //Start date and end date is perfect!           
                                                    //Add session to Combo Box
                                                    echo '<option value="'. $row[1] .'" selected>'. $row[1] . '</option>'; 
                                                    }                                          
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    </div>
                                </div>
    
                                <!-- Second Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name</label><code>*</code> 
                                        <input type="text" name="fullname" class="form-control" placeholder="Full Name - Eg: Vanlalruata Hnamte" required>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label> (as per HSLC)<code>*</code> 
                                        <div class="input-group">                                    
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" name="dob" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask required>
                                            
                                        </div>
                                    </div>
                                    </div>
                                </div>
    
                                <!-- Third Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gender</label><code>*</code> 
                                        <select class="form-control" name="gender" placeholder="Gender" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                        </select> 
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Religion</label><code>*</code> 
                                        <select class="form-control" name="religion" placeholder="Gender" required>
                                            <option value="Christian" Selected>Christian</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Muslim">Muslim</option>
                                            <option value="Buddhist">Buddhist</option>
                                            <option value="Jain">Jain</option>
                                            <option value="Sikh">Sikh</option>
                                            <option value="Others">Others</option>
                                        </select> 
                                    </div>
                                    </div>
                                </div>
    
                                <!-- Forth Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Category</label><code>*</code> 
                                        <select class="form-control" name="category" placeholder="Gender" required>
                                            <option value="General">General</option>
                                            <option value="Schedule Tribe" selected>Schedule Tribe</option>
                                            <option value="Schedule Caste">Schedule Caste</option>
                                            <option value="OBC">OBC</option>
                                            <option value="PWD">PWD</option>
                                        </select> 
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile Number</label><code>*</code> 
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="mobile" class="form-control" data-inputmask="'mask': ['9999 999 999 [x99999]', '+91 9999 999 999']" data-mask required>
                                        </div>                                    
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Fifth Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address</label><code>*</code> 
                                        <input type="email" class="form-control" name="email" placeholder="email@somewhere.com" required> 
                                    </div>
                                    </div>
                                     <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>HSSLC Board Roll No</label><code>*</code> 
                                        <input type="text" class="form-control" name="xiirollno" placeholder="123456542" required> 
                                    </div>
                                    </div>
                                </div>							
                                    
                                <!-- Sixth Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Father's Name</label><code>*</code> 
                                        <input type="text" class="form-control" name="fathername" placeholder="Eg: John William">                                        
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Father's Mobile Number</label><code>*</code> 
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="fathermobile" class="form-control" data-inputmask="'mask': ['9999 999 999 [x99999]', '+91 9999 999 999']" data-mask>
                                        </div>                                    
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Seventh Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mother's Name</label><code>*</code> 
                                        <input type="text" class="form-control" name="mothername" placeholder="Eg: Sarah William">                                        
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mother's Mobile Number</label><code>*</code> 
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="mothermobile" class="form-control" data-inputmask="'mask': ['9999 999 999 [x99999]', '+91 9999 999 999']" data-mask>
                                        </div>                                    
                                        </div>
                                    </div>
                                </div>

                                 <!-- Ninth Row -->
                                 <div class="row">
                                    <div class="col-sm-6">                                
                                    <div class="form-group">
                                        <label>Guardian's Name</label> (if any)
                                        <input type="text" class="form-control" name="guardianname" placeholder="Eg: John William">                                        
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Guardian's Mobile Number</label> (if any)
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="guardianmobile" class="form-control" data-inputmask="'mask': ['9999 999 999 [x99999]', '+91 9999 999 999']" data-mask>
                                        </div>                                    
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Eighth Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Complete Permanent Address</label><code>*</code> 
                                        <textarea class="form-control" name="permanentaddress" id="permanentaddress" rows="3" placeholder="Eg: H No. 123, Colony Name, Section, Street, Locality, Landmark, City/Town/Vilage, District, State, Country - PIN Code" required></textarea>
                                    </div>
                                    </div>
                                </div>   
                               
    
                                <!-- Tenth Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Complete Local Address</label>&emsp;<input type="checkbox" name="sameaddress" id="sameaddress">&ensp;Same as Above
                                        <textarea class="form-control" rows="3" id="localaddress" name="localaddress" placeholder="Eg: H No. 123, Colony Name, Section, Street, Locality, Landmark, City/Town/Vilage, District, State, Country - PIN Code"></textarea>
                                    </div>
                                    </div>
                                </div> 

                                <!-- Fifth Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-check">
                                        <label>Whether a candidate is with benchmark disabilities</label><code>*</code> <br> &nbsp; &nbsp; &nbsp; 
                                        <input type="radio" class="form-check-input" name="disability" value="Yes"> <label class="form-check-label">Yes</label> &emsp; &emsp; 
                                        <input type="radio" class="form-check-input" name="disability" value="No" checked> <label class="form-check-label">No</label>
                                    </div>
                                    </div>
                                     <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Upload Certificate</label> Only if you choose YES<code>*</code> 
                                        <div class="custom-file">
                                        <input type="file" name="disabilitycer" class="custom-file-input" id="customFileDis" accept="image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="customFileDis">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>	
        

                                 <!-- Twelveth Row-->
                                 <div class="row">                              
                                    
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Any Achievement in Sports</label> (if any)
                                        <textarea class="form-control" name="note" placeholder="Eg: National, State Level, etc" row="3"></textarea>
                                    </div>
                                    </div>
                                </div> 

                                <!-- Fifth Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-check">
                                        <label>Are you seeking Admission with Sports quota?</label><code>*</code> <br> &emsp;
                                        <input type="radio" class="form-check-input" name="sportquota" value="Yes"> <label class="form-check-label">Yes</label> &emsp; &emsp; 
                                        <input type="radio" class="form-check-input" name="sportquota" value="No" checked> <label class="form-check-label">No</label>
                                    </div>
                                    </div>
                                     <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Upload Certificate</label> Only if you choose YES<code>*</code> 
                                        <div class="custom-file">
                                        <input type="file" name="sportcer" class="custom-file-input" id="customFilespo" accept="image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="customFilespo">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>	

                                <!-- Twelveth Row-->
                                <div class="row">  
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Passport Photo</label> (only jpg format)<code>*</code> 
                                        <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input" id="photo" accept="image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="photo">Choose file</label>
                                        </div>					
                                    </div>
                                    </div>                              
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Signature</label> (only jpg format)<code>*</code> 
                                        <div class="custom-file">
                                        <input type="file" name="signature" class="custom-file-input" id="signature" accept="image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="signature">Choose file</label>
                                        </div>					
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
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">                                    
                                        <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" required> 
                                            <label for="customCheckbox1" class="custom-control-label"><?php echo $declaration; ?></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>   
    
                                                     
                                
                                <!-- Thirteenth Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                    
                                    <div class="form-group">  
                                        <input type="hidden" name="sessionyear" value="" />
                                        <input type="hidden" name="prefix" value="<?php echo $prefix; ?>"/>
                                        <input type="hidden" name="page" value="applynow"/>
    
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
            }
            else{
                echo '<script>document.getElementById("pagetitle").innerHTML = "Admission is closed right now!";</script>
                <script>document.getElementById("card-title").innerHTML = "Admission is closed right now!";</script>';
                echo '<div class="row">
                        <div class="col-sm-12">
                            Kindly visit us sometime later in the session ending. We are not accepting admission right now. Thank you for your understanding.
                        </div>
                      </div';
            
            }
        ?>   
   
      </div>
    </section>
</div>

<script>
    $('#photo').on('change', function() {
        if(this.files[0].size > 100000) {
            toastr.error('Try to upload file less than 100KB!');   
            document.getElementById("photo").value = "";
        }         
    });  
    $('#signature').on('change', function() {
        if(this.files[0].size > 100000) {
            //alert("Try to upload file less than 100KB!");
            toastr.error('Try to upload file less than 100KB!');   
            document.getElementById("signature").value = "";
        }         
    });    
    $('#customFilespo').on('change', function() {
        if(this.files[0].size > 100000) {
            //alert("Try to upload file less than 100KB!");
            toastr.error('Try to upload file less than 100KB!');   
            document.getElementById("customFilespo").value = "";
        }         
    });  
    $('#customFileDis').on('change', function() {
        if(this.files[0].size > 100000) {
            //alert("Try to upload file less than 100KB!");
            toastr.error('Try to upload file less than 100KB!');   
            document.getElementById("customFileDis").value = "";
        }         
    });    
</script>