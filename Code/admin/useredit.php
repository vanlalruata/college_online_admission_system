  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">User Add / Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php

        $email = '';
        $password = '';
        $fullname = '';
        $designation = '';
        $role = '';

        $requestType = $_SERVER['REQUEST_METHOD'];
         if($requestType == 'GET'){
            if(isset($_GET['userid'])){
                require_once '../config/dbconfig.php';
                
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                $query="select email, password, fullname, designation, role from tbl_staff where id = " . $_GET['userid'].";";
                $result = $mysqli->query($query);               

                $row = $result->fetch_row();  
                $email = $row[0];
                $password = $row[1];
                $fullname = $row[2];
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
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">User Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Eg: Vanlalruata Hnamte" value="<?php echo $fullname; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Eg: someone@domain.com" value="<?php echo $email; ?>" required>
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
                        <select name="designation" class="form-control" required>
                            <option value="Principal">Principal</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Operator" selected>Operator</option>
                            <option value="Staff">Staff</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>User Role</label>
                        <select name="role" class="form-control" required>
                            <?php 
                                if($_SESSION['$role'] === '1'){
                                    echo '<option value="1">Principal</option>';
                                    echo '<option value="2">Administrator</option>';
                                }
                            ?>
                            <option value="3" selected>Operator</option>
                            <option value="4">Staff</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Role Description</label>
                        <textarea class="form-control" rows="4" disabled>
                            Principal Role is like a Super Admin. Can do everything.
                            Administrator Role is almost similar to Principal Role, but cannot finally approve the admission, also, cannot add Pricipal User Role and Other Administrator Role.
                            Operator and Staff Role are similar. They are limited to add admin user, and final approval cannot be done.
                        </textarea>
                      </div>
                    </div>
                  </div>

                  <!-- input states -->
                  <div class="form-group">                    
                    <input type = "hidden" value="<?php if(isset($_GET['userid'])) { echo $_GET['userid']; }?>" name="userid">
                    <input type = "hidden" name="action" value="edituser">
                    <div class="mb-6">
                        <center><button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>&nbsp;Submit</button></center>
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