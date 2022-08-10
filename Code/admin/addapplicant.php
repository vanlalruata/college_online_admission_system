<?php
    $prefix = '';
    require_once '../config/dbconfig.php';
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
                            <h3 id="card-title" class="card-title">Fill the Student Information</h3>
                        </div>
                        <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->
    
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <form action="" role="form" method="post" enctype="multipart/form-data">
                                <!-- First Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Academic Year</label><code>*</code> 
                                        <select class="form-control" name="sessionyear" placeholder="Session Year" required>
                                            <?php 
                                                $year = date('Y');
                                                $year = $year - 1;
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
                                </div>
    
                                <!-- Second Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name</label><code>*</code> 
                                        <input type="text" name="fullname" class="form-control" placeholder="Full Name - Eg: John Lalsiama Hnamte" required>
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
    
                                <!-- Tenth Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Complete Local Address</label>&emsp;<input type="checkbox" name="sameaddress" id="sameaddress">&ensp;Same as Permanent Address
                                        <textarea class="form-control" rows="3" id="localaddress" name="localaddress" placeholder="Eg: H No. 123, Colony Name, Section, Street, Locality, Landmark, City/Town/Vilage, District, State, Country - PIN Code"></textarea>
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

                                <!-- Twelveth Row-->
                                <div class="row">  
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Passport Photo</label> (only jpg format)<code>*</code> 
                                        <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input" id="customFile" accept="image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>					
                                    </div>
                                    </div>                              
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customFile">Signature</label> (only jpg format)<code>*</code> 
                                        <div class="custom-file">
                                        <input type="file" name="signature" class="custom-file-input" id="customFile" accept="image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>					
                                    </div>
                                    </div>                                    
                                </div>   

                                <!-- Education Row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                        
                                        <!-- /.card-header -->                                        
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-bordered">
                                            <thead>                  
                                                <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Examination Passed</th>
                                                <th>Name of the Institute from where you passed</th>
                                                <th>Name of the Board</th>
                                                <th>Year of Passing</th>
                                                <th>Division Grade</th>
                                                <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td>1.</td>
                                                <td>HSLC (or equivalent)</td>
                                                <td>
                                                <input type="text" class="form-control" id="hslcinstitutename" name="hslcinstitutename" placeholder="Eg: Govt. Champhai High School" required>
                                                </td>
                                                <td>
                                                <input type="text" class="form-control" id="hslcboardname" name="hslcboardname" placeholder="Eg: Mizoram Board of School Education" required>
                                                </td>
                                                <td>
                                                <select class="form-control" id="hslcpassingyear" name="hslcpassingyear" placeholder="Select the year you pass"  required> 
                                                    <?php
                                                            $year = date('Y');
                                                            $year = $year - 10;
                                                            while($year <= date('Y') ){
                                                                echo '<option value="'. $year .'"';
                                                                if($year == (int)date('Y') - 2){echo ' selected';}
                                                                echo '>'. $year++ . '</option>';                                                                
                                                            }
                                                    ?>
                                                </select>
                                                </td>
                                                <td>
                                                <select  class="form-control" id="division" name="hslcdivision" placeholder="Eg: First"  required>
                                                    <option value="First">Distinction</option>
                                                    <option value="Distinction">First</option>
                                                    <option value="Second">Second</option>
                                                    <option value="Third">Third</option>
                                                </select>
                                                </td>
                                                <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="hslcpercentage" name="hslcpercentage" min="40.00" max="100.00" step="0.01" placeholder="Enter your percentage" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                                                    </div>
                                                    </div>                      
                                                </td>                      
                                                </tr>
                                                <tr>
                                                <td>2.</td>
                                                <td>HSSLC (or equivalent)</td>
                                                <td>
                                                <input type="text" class="form-control" id="hsslcinstitutename" name="hsslcinstitutename" placeholder="Eg: Govt. Champhai High School"  required>
                                                </td>
                                                <td>
                                                <input type="text" class="form-control" id="hsslcboardname" name="hsslcboardname" placeholder="Eg: Mizoram Board of School Education"  required>
                                                </td>
                                                <td>
                                                <select class="form-control" id="hsslcpassingyear" name="hsslcpassingyear" placeholder="Select the year you pass"  required> 
                                                <?php
                                                            $year = date('Y');
                                                            $year = $year - 10;
                                                            while($year <= date('Y') ){
                                                                echo '<option value="'. $year .'"';
                                                                if($year == (int)date('Y')){echo ' selected';}
                                                                echo '>'. $year++ . '</option>';                                                                
                                                            }
                                                    ?>
                                                </select>
                                                </td>
                                                <td>
                                                <select  class="form-control" id="hsslcdivision" name="hsslcdivision" placeholder="Eg: First"  required>
                                                    <option value="First">Distinction</option>
                                                    <option value="Distinction">First</option>
                                                    <option value="Second">Second</option>
                                                    <option value="Third">Third</option>
                                                </select>
                                                </td>
                                                <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="hsslcpercentage" name="hsslcpercentage" min="40.00" max="100" step="0.01" placeholder="Enter your percentage" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                                                    </div>
                                                    </div>                      
                                                </td>                      
                                                </tr>
                                                <tr>                    
                                                <td colspan="4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Choose HSLC (or equivalent) Scanned Marksheet</label> (only jpg format)
                                                    <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="hslcmarksheet" class="custom-file-input" id="exampleInputFile" accept="image/jpg, image/jpeg" required>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                </td>
                                                <td colspan="3">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Choose HSSLC (or equivalent) Scanned Marksheet</label> (only jpg format)
                                                    <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="hsslcmarksheet" class="custom-file-input" id="exampleInputFile" accept="image/jpg, image/jpeg" required>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                </td>
                                                </tr> 
                                            </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->    
                                                  
                                        </div>
                                        <!-- /.card -->            
                                    </div>          
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->       

                                <!-- Core Choice -->
                                

                                <!-- Core Choice --> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
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
                                                        <tr>
                                                        <td>1.</td>
                                                        <td>
                                                            <input type="text" name="firstchoice" class="form-control select2" required>                                                       
                                                        </td>
                                                        <td>
                                                            <input type="text" name="firstelectiveone" class="form-control select2" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="firstelectivetwo" class="form-control select2" required>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>2.</td>
                                                        <td>
                                                            <input type="text" name="secondchoice" class="form-control select2" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="secondelectiveone" class="form-control select2" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="secondelectivetwo" class="form-control select2" required>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>3.</td>
                                                        <td>
                                                            <input type="text" name="thirdchoice" class="form-control select2" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="thirdelectiveone" class="form-control select2" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="thirdelectivetwo" class="form-control select2" required>
                                                        </td>
                                                        </tr>                                                    
                                                </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->           
                                </div>
                                <!-- /.col -->
                                </div>
                                <!-- /.row -->       
    
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
                                            <label for="customCheckbox1" class="custom-control-label">Everything is correct.</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>   
    
                                                     
                                
                                <!-- Thirteenth Row -->
                                <div class="row">
                                    <div class="col-sm-12">                                    
                                    <div class="form-group">  
                                        <input type="hidden" name="prefix" value="<?php echo $prefix; ?>"/>
                                        <input type="hidden" name="action" value="addapplicant"/>
    
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