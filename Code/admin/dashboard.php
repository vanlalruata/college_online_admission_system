 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-gradient-warning">
              <div class="inner">
                <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "SELECT `fullname`,`applicationid`,`program`,`permanentaddress`,`mobile` FROM `tbl_applicant` WHERE `bloodgroup` IS NULL ORDER BY `applicationid` ASC ;";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 
                <p>Incomplete Applications</p>
              </div>
              <div class="icon">
                <i class="far fa-calendar-alt"></i>
              </div>
              <a href="?page=incomplete" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->



          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile from tbl_applicant as ta where ta.bloodgroup IS NOT null AND ta.remark is null;";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 
                <p>New Applications</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="?page=newapplication" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "SELECT `fullname`,`applicationid`,`program`,`permanentaddress`,`mobile` FROM `tbl_applicant` WHERE `remark` = 'monitor' ORDER BY `applicationid` ASC;";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 
                <p>Verified Applications</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="?page=monitor" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "SELECT `fullname`,`applicationid`,`program`,`permanentaddress`,`mobile` FROM `tbl_applicant` WHERE `remark` = 'rejected' ORDER BY `applicationid` ASC;";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 

                <p>Rejected Applications</p>
              </div>
              <div class="icon">
                <i class="ion ion-close"></i>
              </div>
              <a href="?page=rejected" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-gradient-danger">
              <div class="inner">
              <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "SELECT `fullname`,`applicationid`,`program`,`permanentaddress`,`mobile` FROM `tbl_applicant` WHERE `remark` = 'waiting' ORDER BY `applicationid` ASC;";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 

                <p>Awaiting Applications</p>
              </div>
              <div class="icon">
                <i class="fa fa-hourglass"></i>
              </div>
              <a href="?page=waiting" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-gradient-success">
              <div class="inner">
                <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile from tbl_applicant as ta where ta.bloodgroup IS NOT null AND ta.remark is null AND disableperson = 'Yes';";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 
                <p>Quota Applications</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="?page=phyapplication" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">                
                <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "SELECT `fullname`,`applicationid`,`program`,`permanentaddress`,`mobile` FROM `tbl_applicant` WHERE `remark` = 'approved' ORDER BY `applicationid` ASC;";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 
                <p>Approved Applications</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="?page=approved" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->         


          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile from tbl_applicant as ta LEFT JOIN tbl_applicant_payment as tp ON ta.applicationid = tp.applicationid where ta.remark = 'feepaid' AND tp.status = 'paid';";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 

                <p>Admitted Applications</p>
              </div>
              <div class="icon">
                <i class="far fa-thumbs-up"></i>
              </div>
              <a href="?page=feepaid" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->



          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-gradient-info">
              <div class="inner">
              <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "select ta.fullname, ta.applicationid, ta.program, ta.permanentaddress, ta.mobile from tbl_applicant as ta;";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<h3>'.$row_cnt.'</h3>'; //Number of new application
                  }
                  else{
                    echo '<h3>0</h3>';
                  }
                ?> 

                <p>All Applications</p>
              </div>
              <div class="icon">
                <i class="far fa-flag"></i>
              </div>
              <a href="?page=allapp" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->         

        </div>
        <!-- /.row -->        

        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-rupee-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Payment Received</span>
                <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "select SUM(feeamount) as total from tbl_applicant_payment where status = 'paid';";
                  $result = $mysqli->query($query);
                  if($row_cnt = $result->fetch_assoc()){
                    echo '<span class="info-box-number">₹ '.$row_cnt['total'].'/-</span>'; //Number of Completed Payment
                  }
                  else{
                    echo '<span class="info-box-number">₹  0.00/-</span>';
                  }
                ?> 
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-credit-card-front"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payment to be processed</span>
                <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "select SUM(feeamount) as total from tbl_applicant_payment where status = 'unpaid';";
                  $result = $mysqli->query($query);
                  if($row_cnt = $result->fetch_assoc()){
                    echo '<span class="info-box-number">₹ '.$row_cnt['total'].'/-</span>'; //Number of Completed Payment
                  }
                  else{
                    echo '<span class="info-box-number">₹  0.00/-</span>';
                  }
                ?> 
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Completed Payment</span>
                <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "select * from tbl_applicant_payment where status = 'paid';";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<span class="info-box-number">'.$row_cnt.'</span>'; //Number of Completed Payment
                  }
                  else{
                    echo '<span class="info-box-number">0</span>';
                  }
                ?> 
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-star-exclamation"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Unpaid Fee</span>
                <?php 
                  require_once '../config/dbconfig.php';
                  $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                  $query = "select * from tbl_applicant_payment where status = 'unpaid';";
                  if($result = $mysqli->query($query)){
                    $row_cnt = $result->num_rows;
                    echo '<span class="info-box-number">'.$row_cnt.'</span>'; //Number of Incomplete Payment
                  }
                  else{
                    echo '<span class="info-box-number">0</span>';
                  }
                ?> 
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->