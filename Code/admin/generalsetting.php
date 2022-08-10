<?php     
    require_once '../config/dbconfig.php';
    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

    $query="select logo, favicon, site_title, college_name, email, phone, address, college_code, currency_symbol, currency, copyright_text, smartchat from tbl_general_settings where id = 1;";
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
              <li class="breadcrumb-item active">General Settings</li>
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
                       src="<?php if($row[0] != "") {echo $row[0];} else {echo '../dist/img/Logo.png'; } ?>"
                       alt="User profile picture">
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <h3 class="profile-username text-center">Site Logo</h3>
                    <p class="text-muted text-center">You can choose different logo if you want to update the logo. Prefer size is 150 * 150 px. Only PNG and GIF Format accepted.</p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="logo" accept="image/png, image/gif" required>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div><br><br>
                    <input type="hidden" name="action" value="logoupdate">
                    <button type="submit" class="btn btn-primary btn-block"><b>Save</b></button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid"
                       src="<?php if($row[1] != "") {echo $row[1];} else {echo '../dist/img/Logo.png'; } ?>"
                       alt="User profile picture">
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <h3 class="profile-username text-center">Site FavIcon</h3>
                    <p class="text-muted text-center">Prefer size is 32 * 32 px. Only PNG Format accepted.</p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="favicon" accept="image/png" required>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div><br><br>
                    <input type="hidden" name="action" value="faviconupdate">
                    <button type="submit" class="btn btn-primary btn-block"><b>Save</b></button>
                </form>
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
                <h3 class="card-title">General Settings</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Site Title</label>
                        <input type="text" class="form-control" name="sitetitle" placeholder="Eg: Welcome to Govt Champhai College" value="<?php if($row[2] != "") {echo $row[2];} else {echo ''; } ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>College Name</label>
                        <input type="text" class="form-control" name="collegename" placeholder="Eg: Govt Champhai College" value="<?php if($row[3] != "") {echo $row[3];} else {echo ''; } ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>College Email</label>
                        <input type="email" class="form-control" name="collegeemail" value="<?php if($row[4] != "") {echo $row[4];} ?>"  placeholder="Eg: college@domain.com">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>College Phone</label>
                        <input type="phone" class="form-control" name="collegephone" value="<?php if($row[5] != "") {echo $row[5];} ?>"  placeholder="Eg: 03831 235331">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>College Address</label>
                        <textarea class="form-control" name="collegeaddress" rows="3" placeholder="Enter the complete address"><?php if($row[6] != "") {echo $row[6];} ?></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>College Code</label>
                        <textarea class="form-control" name="collegecode" rows="3" placeholder="Enter the College's Code"><?php if($row[7] != "") {echo $row[7];} ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Currency Symbol</label>
                        <input type="text" class="form-control" value="<?php if($row[8] != "") {echo $row[8];} ?>"  name="currencysymbol" placeholder="Eg: ₹" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Currency Code</label>
                        <input type="text" class="form-control" name="currencycode" <?php if($row[9] != "") {echo ' value="' .$row[9].'"';} ?> placeholder="Eg: INR" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Copyright Text</label> HTML Code Allowed
                        <textarea class="form-control" rows="3" name="copyright" placeholder="Eg: Copyright © 2020. All Right Reserved." required><?php if($row[10] != "") {echo htmlspecialchars($row[10]);} ?></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Smart Direct Chat Code</label> (only tawk.to)
                        <textarea class="form-control" rows="3" name="smartchat" placeholder="Eg: 5e8f41a569e9320caac1fb10"><?php if($row[11] != "") {echo htmlspecialchars_decode($row[11]);} ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <input type="hidden" name="action" value="generalupdate">
                        <center><button class="btn btn-primary" type="submit"><i class="far fa-database"></i>&emsp;Save</button></center>
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

