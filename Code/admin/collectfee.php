<?php     
    require_once '../config/dbconfig.php';
    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

    $query="select ta.photo, ta.fullname, ta.note, ta.program, ta.sessionyear, ta.fathername, ta.mothername, tp.feeamount from tbl_applicant ta inner join tbl_applicant_payment tp on ta.applicationid = tp.applicationid where ta.applicationid = ".$_GET['applicationid'].";";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();
    
  ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Fee Collection</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
                       src="<?php if($row[0] != "") {echo $row[0];} ?>"
                       alt="User profile picture">
                </div>
                
                    <h3 class="profile-username text-center"><?php if($row[1] != "") {echo $row[1];} ?></h3>
                    <p class="text-muted text-center"><?php if($row[2] != "") {echo $row[2];} ?></p>
                    <br><br>
                    
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->            
          </div>
          <!-- /.col -->
          <!-- right column -->
          <div class="col-md-9">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">General Information</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Course Programme</label>
                        <input type="text" class="form-control" name="sitetitle" value="<?php if($row[3] != "") {echo $row[3];} else {echo ''; } ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Session Year</label>
                        <input type="text" class="form-control" name="collegename" value="<?php if($row[4] != "") {echo $row[4];} else {echo ''; } ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Father Name</label>
                        <input type="text" class="form-control" name="collegeemail" value="<?php if($row[5] != "") {echo $row[5];} ?>"  disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Mother Name</label>
                        <input type="text" class="form-control" name="collegephone" value="<?php if($row[6] != "") {echo $row[6];} ?>"  disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fee Amount</label>
                        <input type="text" class="form-control" name="feeamount" value="<?php if($row[7] != "") {echo $row[7];} ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Payment Mode</label>
                        <input type="text" class="form-control" name="paymentmode" value="Offline" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        Your user id will be recorded for the fee you collected in offline.
                      </div>
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <input type="checkbox" required> Check here to confirm receive and click the process button below.
                      </div>
                    </div>                    
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <input type="hidden" name="action" value="payfee">
                        <input type="hidden" name="collector" value="<?php echo $_SESSION['$name']; ?>">
                        <input type="hidden" name="applicationid" value="<?php echo $_GET['applicationid']; ?>">
                        <center><button class="btn btn-primary" type="submit"><i class="far fa-money-bill"></i>&emsp;Collect & Process</button></center>
                      </div>
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

