  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admission Application</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Admission Application</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php
        $requestType = $_SERVER['REQUEST_METHOD'];
         if($requestType == 'GET'){
            if(isset($_GET['page'])){
                if($_GET['page'] === "admissionedit"){
                    if(isset($_GET['id'])){
                        //Select Query
                        require_once '../config/dbconfig.php';                                        
                        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                        $query = "select * from tbl_adm_application where id = ". $_GET['id'];
                        $result = $mysqli->query($query);  
                        $row = $result->fetch_row();  
                    }
                }
            }            
        }
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Application Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Session Year</label>
                        <input type="text" name="session" class="form-control" placeholder="Eg: 2020 - 2023" value="<?php if(isset($row[1])) {echo $row[1];} ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Application Prefix</label>
                        <input type="text" name="prefix" class="form-control" placeholder="GCC-" value="<?php if(isset($row[7])) {echo $row[7];} ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Start Date</label>
                        <div class="input-group">  
                            <input type="date" name="startdate" value="<?php if(isset($row[2])) {echo $row[2];} ?>" class="form-control" required>                        
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Closing Date</label>
                            <div class="input-group">  
                                <input type="date" name="enddate" value="<?php if(isset($row[3])) {echo $row[3];} ?>" class="form-control" required>                        
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Edit Upto</label>
                        <div class="input-group">  
                            <input type="date" name="editend" value="<?php if(isset($row[4])) {echo $row[4];} ?>" class="form-control" required>                        
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" <?php if(isset($row[6]) && $row[6] === 'active') {echo 'selected';} ?>>Active</option>
                                <option value="inactive" <?php if(isset($row[6]) && $row[6] === 'inactive') {echo 'selected';} ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                  </div>
				  
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Application Fee</label>
                        <div class="input-group">  
                            <input type="number" name="appfee" value="<?php if(isset($row[8])) {echo $row[8];} else {echo '';} ?>" class="form-control" placeholder="₹ 100" required>                        
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Application Fee Status</label>
                            <select name="appfeestatus" class="form-control" required>
                                <option value="active" <?php if(isset($row[9]) && $row[9] === 'active') {echo 'selected';} ?>>Active</option>
                                <option value="inactive" <?php if(isset($row[9]) && $row[9] === 'inactive') {echo 'selected';} ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Declaration</label>
                        <textarea name="declaration" class="form-control" rows="5" placeholder="Eg: I hereby declare that all the information furnished in this form is correct. In the event of my being admitted, I promise to attend 75% and above of theory and practical classes taken separately and to abid by the Rules and Regulations of this college, failing which I agree to accept any decision imposed upon me by the Authority." required><?php if(isset($row[5])) {echo $row[5];} ?></textarea>
                      </div>
                    </div>                    
                  </div>
                  <!-- input states -->
                  <div class="form-group">                    
                    <input type = "hidden" name="id" value="<?php if(isset($_GET['id'])) { echo $_GET['id']; }?>">
                    <input type = "hidden" name="action" value="admissionedit">
                    <div class="mb-6">
                        <center><button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>&nbsp;Save</button></center>
                    </div> 
                  </div>                 
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 