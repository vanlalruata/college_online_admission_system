<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin : College Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" 
      type="image/png" 
      href="../dist/img/Logo.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
   
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">  
  
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>    
</head>
<?php
  if(!isset($_SESSION['$legitUser'])){
    $requestType = $_SERVER['REQUEST_METHOD'];
    if($requestType == 'POST'){
      if((isset($_POST['email'])) && (isset($_POST['password'])) && (!isset($_POST['action']))){
        require_once '../config/dbconfig.php';
        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
        $query="select password, fullname, photo, role from tbl_staff where email = '" . $_POST['email']."';";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        if($row[0] === crypt($_POST['password'], '$5$ZobizzOnlineServiceLLP$')){
                //Success                                                       
                $_SESSION['$legitUser'] = $_POST['email'];
                $_SESSION['$name'] = $row[1];
                $_SESSION['$role'] = $row[3];
                $row[2] != "" ? $_SESSION['$photo'] = $row[2] : $_SESSION['$photo'] = null;   
                header("Refresh: 1");  
                echo '<body class="hold-transition login-page">';  
                echo "<script>toastr.info('Successfully verified!.');</script>";
                
        }
        else{
                //Wrong Password
                header("Refresh: 2");
                echo '<body class="hold-transition login-page">';
                echo "<script> toastr.error('Either the email or password is wrong!.'); </script>";                
        }
        
        $mysqli->close();
      }
      else if($_POST['page'] === 'forgotpassword'){
        //Check email exist or not
        require_once '../config/dbconfig.php';
        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
        $query="select * from tbl_staff where email = '" . $_POST['email']."';";
        $result = $mysqli->query($query);
        $counter = 0;
        while($row = $result->fetch_row()){
          $counter++;
        }
        if($counter === 0){
          echo '<body class="hold-transition login-page">';
          echo "<script> toastr.error('No such email is found for the system. Check your email!'); </script>";
          header("Refresh: 1");
        }
        else{
          //Now eMail
          $query="select * from tbl_smtp where status = 'active'";
          $result = $mysqli->query($query);
          if($row = $result->fetch_row()){
              date_default_timezone_set("Asia/Kolkata");
              //SendGrid Gateway
              if($row[0] == "sendgrid"){ 
                  require '../vendor/autoload.php'; // If you're using Composer (recommended)

                  $email = new \SendGrid\Mail\Mail();
                  $email->setFrom("principal@GCC.com", "GCC Principal");
                  $email->setSubject("Password Reset Request - Reg");
                  $email->addTo($_POST["email"], "Admin User");
                  //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                  $email->addContent(
                      "text/html", '<html> 
                      <head> 
                          <title>Your request for password reset has been processed</title> 
                      </head> 
                      <body> 
                          <b>Dear User</b>,<br><br>                              
                          <br>
                          <p>
                          You had requested to reset the password on '.date("d-m-Y h:i a").'.<br><br>
                          Your password reset link is : <a href="https://'. $_SERVER['SERVER_NAME'].'/admission/admin/?page=forgotpassword&email='.$_POST["email"].'&authenticationkey='. strtotime(date("Y-m-d H:i:s", strtotime("+1 Day"))) .'" target="_blank">CLICK HERE TO RESET YOUR PASSWORD</a><br><br>
                          The link will expire within the next 24 hours from the time the request was made. If you had not request to reset the password, just ignore this.
                          <br><br>
                          (This is an auto generated email, so please don\'t reply back.)<br><br>
                          <b>Regards, <br>
                          Govt. Champhai College (GCC)<br>
                          Vengthlang North, Champhai, Mizoram</b><br>
                          <br>
                          This email message may contain confidential, legally privileged information and is intended solely for the use of the individual to whom it is addressed. If you have erroneously received this message,
                          please delete it immediately. If you are not the intended recipient of the email message, you should not disseminate, distribute or copy this email.
                          </p>
                      </body> 
                      </html>'
                  );
                  $sendgrid = new \SendGrid($row[1]);
                  try {
                      $response = $sendgrid->send($email);
                      //print $response->statusCode() . "\n";
                      //print($response->headers());
                      //print $response->body() . "\n";
                  } catch (Exception $e) {
                      echo 'Caught exception: '. $e->getMessage() ."\n";
                  }
              }  

          }
          echo '<body class="hold-transition login-page">';
          echo "<script> toastr.info('Password reset link has been sent to your email, please check your email and follow the link.'); </script>";
          header("Refresh: 1");
        }
        //Link Sent to email
      }
      else if($_POST['action'] === "resetpassword"){
        if($_POST['password'] === $_POST['confirm']){
            require_once '../config/dbconfig.php';
            $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
            $query="update tbl_staff set password = '".crypt($_POST['password'], '$5$ZobizzOnlineServiceLLP$')."' where email = '" . $_POST['email']."';";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();    
    
            if($stmt->affected_rows > 0){
                echo '<body class="hold-transition login-page">';
                echo "<script>toastr.success('Successfully Updated!.');</script>";
            }  
            else{
                echo '<body class="hold-transition login-page">';
                echo "<script>toastr.error('The password is still the same! You can o ahead with that!');</script>";
            }    
            header("Location: /admission/admin/");        
          }
          else{
            header("Refresh: 2");
            echo '<body class="hold-transition login-page">';
            echo "<script>toastr.error('Password mismatched! Please try again.');</script>";
            //header("Refresh: 1");
          }
      }
    } 

    //echo '<body class="hold-transition login-page">';   
    
    if(isset($_GET['page']) && isset($_GET['authenticationkey'])){
      if(date('Y-m-d H:i:s', $_GET['authenticationkey']) >= date("Y-m-d H:i:s")){
        ?>
              <body class="hold-transition login-page">
              <div class="login-box">
                    <div class="login-logo">
                      <b>Password Reset</b>
                    </div>
                    <!-- /.login-logo -->
                    <div class="card">
                      <div class="card-body login-card-body">
                        <p class="login-box-msg">Choose your password</p>

                        <form action="" method="post">
                          <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="email" required>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                          </div>
                          <div class="input-group mb-3">
                            <input type="password" name="confirm" class="form-control" placeholder="Password" id="password" required>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                          </div>
                          <div class="row">                
                            <!-- /.col -->
                            <div class="col-12">
                              <input type="hidden" name="action" value="resetpassword">
                              <input type="hidden" name="email" value="<?php echo $_GET['email'];?>">
                              <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-key"></i>&nbsp;Submit</button>
                            </div>
                            <!-- /.col -->
                          </div>
                        </form>   
                      </div>
                      <!-- /.login-card-body -->
                    </div>
                  </div>       
      <?php
      }
      else{
        //Invalid authentication key
        echo '<body class="hold-transition login-page">';
        echo "<script>toastr.error('The authentication key already expired!');</script>";
        echo '<br><br><br><br><center><a href="" class="btn btn-danger">CLICK HERE TO GO BACK</a></center>';
      }
    }
    else{
      ?>
        <body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <b>Admin</b> Portal
          </div>
          <!-- /.login-logo -->
          <div class="card">
            <div class="card-body login-card-body">
              <p class="login-box-msg">Enter your credentials to login</p>

              <form action="" method="post">
                <div class="input-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Email" id="email" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input type="checkbox" name="remember" id="remember">
                      <label for="remember">
                        Remember Me
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>      

              <p class="mb-1">
                <a href="?page=forgotpassword" class="forgot btn-default" data-toggle="modal" data-target="#modal-default">I forgot my password</a>
              </p>      
            </div>
            <!-- /.login-card-body -->
          </div>
        </div>
        <!-- /.login-box -->

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Enter your email</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="email" class="form-control" name="email" placeholder="Eg: someone@domain.com" required>
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                        </div>                             
                      </div>
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                      <input type="hidden" name="page" value="forgotpassword">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Submit</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
      <?php
    } 
    ?>
<script type="text/javascript">
 $(function() { 
 if (localStorage.chkbx && localStorage.chkbx != '') {
     $('#remember').attr('checked', 'checked');
     $('#email').val(localStorage.usrname);
     $('#password').val(localStorage.pass);
 } else {
     $('#remember').removeAttr('checked');
     $('#email').val('');
     $('#password').val('');
 }

 $('#remember').click(function() {

     if ($('#remember').is(':checked')) {
         // save username and password
         localStorage.usrname = $('#email').val();
         localStorage.pass = $('#password').val();
         localStorage.chkbx = $('#remember').val();
     } else {
         localStorage.usrname = '';
         localStorage.pass = '';
         localStorage.chkbx = '';
     }
 });
});
</script>
</body>
</html>

<?php
    die;
  }
?>