<!-- Content Wrapper. Contains page content -->
<div class="">
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
                            <h3 id="card-title" class="card-title">Check the declaration and Click on submit if you agree.</h3>
                        </div>
                        <script>document.getElementById("pagetitle").innerHTML = "Additional Information";</script>
    
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <form action="" role="form" method="post" enctype="multipart/form-data">
                                <!-- First Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood Group</label><code>*</code> 
                                        <select class="form-control" name="bloodgroup" placeholder="Blood Group" >
                                            <option value="Not Known" selected>Not Known</option>
                                            <option value="A+ve">A +ve</option>
                                            <option value="A-ve">A -ve</option>
                                            <option value="B+ve">B +ve</option>
                                            <option value="B-ve">B -ve</option>
                                            <option value="AB+ve">AB +ve</option>
                                            <option value="AB-ve">AB -ve</option>
                                            <option value="O+ve">O +ve</option>
                                            <option value="O-ve">O -ve</option>
                                        </select>
                                    </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label></label><br>
                                            <code>*</code> If you know your blood group, please select it, otherwise choose Not Known                                           
                                            
                                            </select>        
                                        </div>
                                    </div> 
                                </div>
    
                                <!-- Second Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Aadhaar #</label><code>*</code>(if you dont have, write NA)
                                        <input type="text" name="aadhaar" class="form-control" placeholder="Eg: 4235 6542 6552" required>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Voter ID</label>  (optional) (if you dont have, write NA)
                                        <div class="input-group">  
                                            <input type="text" name="voterid" class="form-control" placeholder="Eg: IND0000000">     
                                        </div>
                                    </div>
                                    </div>
                                </div>
    
                                <!-- Third Row --><!--
                                <div class="row" style="display: none;">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Aadhaar Front Copy</label>  (optional)
                                        <div class="custom-file">
                                        <input type="file" name="aadhaarfront" class="custom-file-input" id="aadhaarfront" accept="image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="aadhaarfront">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Aadhaar Backside Copy</label>  (optional)
                                        <div class="custom-file">
                                        <input type="file" name="aadhaarback" class="custom-file-input" id="aadhaarback" accept="image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="aadhaarback">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                                </div> -->
    
                                <!-- Forth Row --><!--
                                <div class="row" style="display: none;">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>EPIC Front Copy</label>  (optional)
                                        <div class="custom-file">
                                        <input type="file" name="voterfront" class="custom-file-input" id="epicfront" accept="image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="epicfront">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>EPIC Backside Copy</label>  (optional) 
                                        <div class="custom-file">
                                        <input type="file" name="voterback" class="custom-file-input" id="epicback" accept="image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="epicback">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>     --> 
                                
                                  
                                <!-- Fifth Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Declaration</label>
                                       <br><div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="check" required> <label class="form-check-label">I hereby declare that all the information furnished in this form is correct. In the event of my being admitted, I promise to attend 75% of
theory and practical classes taken separately and to abide by the Rules  and Regulations of this college, failing which I agree to accept any
decision imposed upon me by the Authority.</label>
                                      </div>  
                                        
                                    </div>
                                    </div>
                                </div>  
                                
                                <!-- Thirteenth Row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                    
                                    <div class="form-group">  
                                        <input type="hidden" name="page" value="additionalinfo"/>
    
                                        <center>                             
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

<script>
    $('#aadhaarfront').on('change', function() {
        if(this.files[0].size > 100000) {
            alert("Try to upload file less than 100KB!");
            document.getElementById("aadhaarfront").value = "";
        }         
    });  
    $('#aadhaarback').on('change', function() {
        if(this.files[0].size > 100000) {
            alert("Try to upload file less than 100KB!");
            document.getElementById("aadhaarback").value = "";
        }         
    });    
    $('#epicfront').on('change', function() {
        if(this.files[0].size > 100000) {
            alert("Try to upload file less than 100KB!");
            document.getElementById("epicfront").value = "";
        }         
    });  
    $('#epicback').on('change', function() {
        if(this.files[0].size > 100000) {
            alert("Try to upload file less than 100KB!");
            document.getElementById("epicback").value = "";
        }         
    });    
</script>