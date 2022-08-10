  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gateway Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Gateway Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
    require_once '../config/dbconfig.php';
    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SMS Gateway</h3> - <i class="far fa-sms nav-icon"></i>
              </div>
              <?php
                $query = "select * from tbl_smsconfiguration where isdefault= 1";
                $result = $mysqli->query($query);
                $row = $result->fetch_row();
              ?>  
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" method="post" action="" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Gateway</label> (Upper case only)
                        <input type="text" class="form-control" name="gateway" value="<?php if($row[0]!='') {echo $row[0];} ?>" placeholder="Eg: MSG91">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>API Key</label>
                        <input type="text" class="form-control" name="apikey" value="<?php if($row[1]!='') {echo $row[1];} ?>" placeholder="Eg: 87sdkk564kk90sdf456546">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Sender ID</label> (MAX 6 Char)
                        <input type="text" class="form-control" minlength="6" maxlength="6" style="text-transform:uppercase" name="senderid" value="<?php if($row[2]!='') {echo $row[2];} ?>" placeholder="Eg: ZOBIZZ">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="isdefault">
                            <option value="1" <?php if($row[3]=='1') {echo 'selected';} ?>>Active</option>
                            <option value="0" <?php if($row[3]!='1') {echo 'selected';} ?>>Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">    
                        <input type ="hidden" name="action" value="smsgateway">                   
                        <button type="submit" class="btn btn-primary form-control"><i class="far fa-sms nav-icon"></i>&emsp;Save</button>
                      </div>
                    </div>
                  </div>                    
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Payment Gateway</h3> - <i class="far fa-money-check-alt nav-icon"></i>
              </div>
              <?php
                $query = "select paymentgateway, apikey, secret, status from tbl_payment_gateway where id = 1";
                $result = $mysqli->query($query);
                $row = $result->fetch_row();
              ?>  
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" method="post" action="" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Payment Gateway</label>
                        <input type="text" class="form-control" name="gateway" value="<?php if($row[0]!='') {echo $row[0];} ?>" placeholder="Eg: RazorPay">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>API Key</label>
                        <input type="text" class="form-control" name="apikey" value="<?php if($row[1]!='') {echo $row[1];} ?>" placeholder="Eg: 8fghertetwewerwerw6">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Secret Key</label>
                        <input type="text" class="form-control" name="secret" value="<?php if($row[2]!='') {echo $row[2];} ?>" placeholder="Eg: 345345jsdf983u94u5osdjsd0">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="active" <?php if($row[3]!='inactive') {echo 'selected';} ?>>Active</option>
                            <option value="inactive" <?php if($row[3]!='active') {echo 'selected';} ?>>Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">    
                        <input type ="hidden" name="action" value="paymentgateway">                   
                        <button type="submit" class="btn btn-primary form-control"><i class="far fa-rupee-sign nav-icon"></i>&emsp;Save</button>
                      </div>
                    </div>
                  </div>                    
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->            

          </div>
          <!--/.col (left) -->

          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">SMTP Gateway</h3> - <i class="far fa-envelope nav-icon"></i>
              </div>
              <?php
                $query = "select * from tbl_smtp where status = 'active'";
                $result = $mysqli->query($query);
                $row = $result->fetch_row();
              ?>  
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" method="post" action="" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Host Name</label> (Lower case only)
                        <input type="text" class="form-control" name="hostname" value="<?php if($row[0]!='') {echo $row[0];} ?>" placeholder="Eg: sendgrid">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>API Key</label>
                        <input type="text" class="form-control" name="apikey" value="<?php if($row[1]!='') {echo $row[1];} ?>" placeholder="Eg: 23453453s6d5fsd6345635455656a6sd65a=">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Server Key</label>
                        <input type="text" class="form-control" name="serverkey" value="<?php if($row[2]!='') {echo $row[2];} ?>" placeholder="Eg: 1234234iwe4w">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="isactive">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">    
                        <input type ="hidden" name="action" value="smtpgateway">                   
                        <button type="submit" class="btn btn-primary form-control"><i class="far fa-at nav-icon"></i>&emsp;Save</button>
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