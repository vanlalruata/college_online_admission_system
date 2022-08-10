  <?php     
    require_once '../config/dbconfig.php';
    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

    $query="select fullname, photo, designation, role, email from tbl_staff where email = '" . $_SESSION['$legitUser'] . "';";
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
              <li class="breadcrumb-item active">User Profile</li>
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
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php if($row[1] != "") {echo $row[1];} else {echo '../dist/img/avatar5.png'; } ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $row[0]; ?></h3>

                <p class="text-muted text-center"><?php echo $row[2]; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Role</b> <a class="float-right"><?php if($row[3] === "1"){echo 'Principal';} else if($row[3] === "2"){echo 'Administrator';} else if($row[3] === "3"){echo 'Operator';} else if($row[3] === "4"){echo 'Staff';} else{echo 'Unknown';}?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Designation</b> <a class="float-right"><?php echo $row[2]; ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" data-toggle="tab">Details</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Eg: Vanlalruata Hnamte" value="<?php echo $row[0]; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Eg: someone@domain.com" value="<?php echo $row[4]; ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Use strong password" value="" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm" class="form-control" placeholder="Enter the same password"  value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control" value="<?php echo $row[2];?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>User Role</label>
                        <input type="text" name="role" class="form-control" value="<?php echo $row[3];?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/png,image/jpg" value="" required>
                      </div>
                    </div>
                  </div>

                  <!-- input states -->
                  <div class="form-group">                    
                    <input type = "hidden" value="profileupdate" name="action">
                    <input type ="hidden" name="email" value="<?php echo $row[4];?>">
                    <div class="mb-6">
                        <center><button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>&nbsp;Save</button></center>
                    </div> 
                  </div>                 
                </form>
              </div>

                       
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

