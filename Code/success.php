<?php

if(!isset($_GET['page']) || $_GET['page'] != 'applynow'){die;} //Protect again hacking - Direct page access

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <script>document.getElementById("pagetitle").innerHTML = "Application Submitted";</script>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Success!</h3>                
              </div>
              <div class="card-body">
                <h4 class="message" id="message">You have finished the first step in our online application process. You must upload your marksheets in next step and also choose subject combinations in order to complete your online application. Kindly check your email or SMS for the login details.</h4><br><br>Please continue to complete your online application.<br><br>
                <table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
                                        <tr> 
                                            <td align='left'>Name:</td><td><h4><font color='green'><?php echo $_POST['fullname'] ?></font></h4></td> 
                                        </tr> 
                                        <tr style='background-color: #e0e0e0;'> 
                                            <td align='left'>Application ID:</td><td><h4><font color='red'><?php echo $id ?></font></h4></td> 
                                        </tr> 
                                        <tr> 
                                            <td align='left'>Password:</td><td><h4><font color='green'><?php echo date('dmY', strtotime($_POST['dob'])) ?></font></h4></td> 
                                        </tr> 
                                        <tr style='background-color: #e0e0e0;'> 
                                            <td align='left'>Email:</td><td><h4><font color='red'><?php echo $_POST['email'] ?></font></h4></td> 
                                        </tr>                                                 
                                    </table>
                <center><a href="applicantlogin.php" class="btn btn-success" target="_blank">Continue</a></center><br><br>
                <h4 class="message" id="message">
                    1 : Personal details --------------COMPLETED <br>
                    2 : Upload your marksheets---------Pending<br>
                    3 : Choose subject combinations----Pending<br>
                </h4>
              </div>
              <!-- /.card-body -->              
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
try{
    if(empty($_SESSION)){
      session_start();
    }    
    session_destroy();      
}
catch(Exception $e) {
    //echo 'Message: ' .$e->getMessage();
  }
?>