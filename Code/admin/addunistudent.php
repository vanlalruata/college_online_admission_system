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
                            <h3 id="card-title" class="card-title">Fill the Registered Student Details</h3>
                        </div>
                        <!-- <script>document.getElementById("pagetitle").innerHTML = "Admission Form";</script> -->
    
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <form action="" role="form" method="post" enctype="multipart/form-data">
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
                                            <!--<option value="4th Sem">4th Sem</option>-->
                                            <option value="5th Sem">5th Sem</option>
                                            <!--<option value="6th Sem">6th Sem</option>-->                                          
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
                                        <label>University RegNo.</label><code>*</code> 
                                        <input type="text" name="uregno" class="form-control" placeholder="University Registration No" required>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>University RollNo.</label>
                                        <input type="text" name="urollno" class="form-control" placeholder="University Roll No">                                    
                                    </div>
                                    </div>
                                </div>

                                <!-- Second Row -->
                                <div class="row">
                                                                     
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