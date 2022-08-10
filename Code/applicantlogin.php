<?php    
    if(!isset($_SESSION['$applicantid'])){
      session_start(); 
    }

    require('vendor/razorpay-php/Razorpay.php');

    date_default_timezone_set('Asia/Kolkata');

    use Razorpay\Api\Api;
    use Razorpay\Api\Errors\SignatureVerificationError;

    require_once 'config/dbconfig.php';
    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

        $apikey = '';
        $secret = '';
        $query ="select apikey, secret from tbl_payment_gateway where status = 'active'";
        $result = $mysqli->query($query);    
        if($row = $result->fetch_row()){
          //RazorPay Payment Gateway
          $apikey = $row[0];
          $secret = $row[1];
        }

    $api = new Api($apikey, $secret);

    $query = "select college_name, site_title, logo, favicon from tbl_general_settings where college_id = 1";
    $result = $mysqli->query($query);
    $row = $result->fetch_row();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $row[0]?> : Online Admission Portal</title>
  <link rel="icon" 
      type="image/png" 
      href="<?php if($row[3]!= "") {echo $row[3];} else { echo 'dist/img/Logo.png';}?>">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="">
  <div class="header">    
      <div class="col-md-12">        
          <div style="margin-top: 15px;">
            <center><img src="<?php if($row[2] != "") {echo $row[2];} else {echo './dist/img/Logo.png'; } ?>" style="height:96px;"></center>             
          </div>
          <div style="text-align:center; vertical-align: middle;">
            <h2><?php echo $row[1]; ?></h2>
          </div> 
      </div>
    </div>

<hr style="border: 7px solid #52248f;"/>

<div class="wrapper">  
<!-- Navbar -->
<nav class="navbar navbar-shrink navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">      
      <li class="nav-item d-none d-sm-inline-block">
        <label id="pagetitle" name="pagetitle" class="pagetitle nav-link">Title</label>
      </li>     
    
</nav>
<!-- /.navbar -->

<?php

$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType === "POST"){
  if(isset($_POST['page'])){
    if($_POST['page'] === "applicantlogin"){
      $query = "select password from tbl_applicant where applicationid = " . $_POST['applicationid'];
      $result = $mysqli->query($query);    
      if($row = $result->fetch_row()){
          //Check if the password is same
          if($row[0] === crypt($_POST['password'], '$5$ZobizzOnlineServiceLLP$')){
              //Successfully logged in
              $_SESSION['$applicantid'] = $_POST['applicationid'];
              //include the php file
              require_once 'applicantdashboard.php';
    
              //Show successful login page
              echo "<script>toastr.info('Successfully verified! You can proceed with your application.');</script>";            
          }
          else{
              //Wrong Password
              echo "<script>toastr.error('You have entered a wrong ID or a wrong password. Please try again.');</script>"; 
              echo '<script>document.getElementById("pagetitle").innerHTML = "Wrong Login Information";</script>';  
              echo '<center><a href="applicantlogin.php" class="btn btn-warning">Click here to go back</a></center><br><br>';    
              echo '<center><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAMAAADDpiTIAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAMUExURUpKR0RLUufs7vB3eyZXQiEAAAABdFJOUwRHixx/AAAMwklEQVR42u3djbLbRAyGYUu6/3sGOtCetim2dyWtdvV+BwYmE+zi74mS+O9cFyGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEII+Rq55KdccpEezd+FTdS3exBQPgpoHwO0jwHahwD1Y4D6IUD9EKB+CFA/BKgfAfQPge71I6B7/RCgfwR07x8C3etHQPv+EdC9fwR07x8C7ftHQPf+EdC9fwR07x8B3fsHQPP+EbBz/9f3HwT06t93cbSwE4AIU9SwS//Ll0sW9l9m0WRF/7GLp4viAKqugKT0n7AO2qjbf85q6KMogDRoFHJo/09XRSMFAaRio5Jj+89eG/GpZOv1kWp9AGAzACeskpQqAwAbAThoraROEwDYBMBp8Mi7Is6TR6rUAIDWAwABOwC4AMAAOFQfKVABI6A5AEZA8/4B0B3ABYDCAFoIBMDizQ8AAACgcf8AAAAAWgO4AAAAAFQE0AkhAIoCoCEmAAEAAQABAAEAAQABADnsOzgAmAAAAAAAAAAAPgMAgAkAAAAAAAAA4DMAAJgAABiM/vPzJd8eAMDprT/MFwsAaNX8bxIA0LX6/wKAxuUDoHf3AGjfPgB6lw+A7u0XAcCewFXtMwGatw+A5u3fAFDV6wLAyfXfAsghAIBF7T8BkGCACbCs/mcAogkAYFn9as8AxBIAwKr6H0+AYAMAWFX/8wkQSYAJsKr+dxMgjAAAltX/cgIEEQDAqvrfT4AYAgBYVf8QAGUCHFP/GABvAgBYVv8oAF8CAFjX/zAATwIAWFb/DAAFwP71TwFwIwAA3RSAAmDz+mcB+BBoDkC3BqAA2Ll+BwAeBBoD0AMAKBNg3/5dAMwSaAtA9RQACoBN+/cCMEegJYAS9Q+cDxAgoOUE0CLxA6AA2LB/xwkwLqAhANUDJ8A4gW4A6tTvOwFGBXSbAFopzgAUAHv17w5AAbBV//4AFAA79R8A4D2BTgB0NwCmZmpf/qFm9ttD+uMxNbV/e/321y9df3isEwDdCkCJUD8AAAAA6gcA/QOA/gFA/wAAAACoHwAAiD8cDIDj+5cdQv99X/5HCODl31sA/fcWwPjvTYD+ewug/94CePtvLoD+ewug/94CeP/vLYD+ewug/+YC+ADQWwD99wZA/70F8AGguQAGQG8BZ/RvWTkOwAlvAJadkwRsPwBsTU4RsHn/tjBHANj7DcAW5wABWw8AW5/dAew8AKxE9haw80lAViUAWDEArFD2FbDvADDbSwAAfAeAGQI6DwCz7QTQvyMAMwQwAHYTQP9HD4B7AQDwAmB7AhD6P7v/7UYAAJIF0L8LADNGwNn9274ADACtB8BOABQAvQXsCsAAcHr/tjUAA0Drd4BdACjvAAAAQL4AADQHIPQ/9xnQAHA8AAUA/W8NwACw/C3gy9Km835Z5QHo4RPgF1BO9T9fFgDWAvh9pnj1/3BZiQDkKn5zlA+bMPoz4Kd3Fa/6ny0rA8BOd8ix1Amg6iZAB5cVDGDDmyQlTgBVNwE6uqxIALveJytrAqi6CdByAHa+UZolTQB1E6Dji4oBsPmt8ixlAqi6CagF4ICbJaZMAPUSoDNLcgdwxu0yEyaAqpMArQRADonFTwB1EqCFAMg5WT4BngrQOgBEAOA4AZ4J0DIA5KzY+gnwRIBWASACAPcJcC9AqwCQ81JhAty2VwTAgfUnTIB5Aao1AMiRWbsn8El/WgRA5/7jJ8CfC/TpfxqACACWCNAaAAQAEUcD7zv06n8SgABgjQC3/ucAtO9/9pzA0R61BgABgKwR4Fb/FAD6d7gybESA4+t/BgD9B1wY8qRMz/onABzcf9Y5gWN9ag0AvP7dLg59V6hv/cMA6N/x6vA3nWoNANTvenn481K96x8EMPH2WvhH318a6HV/CP/L1kMBBH+w2ilSUkDwDSKix+opALwu7dgcgB4dKSgg+hYxtB8xARwFBAOg/pgJ4CUg+iZR1B81AZwEVAGg2h7ACgHht4nz+9KXTiXkC6lr/w4CogG4vfzT9xEEjScpJSD+RpHuL/+kKRC2Puf+JwWEA4h4+WcIiFuhFBKQcKvYsP5jBQSu0L3/CQHxAJw+/Wd/bZBFAHIFjN5f8gWA0P7jBISuL6D/QQE1AMxsMksGIFUnwIiA4VX5ApjbZNm7aspOgAEBGQCi+08HIGUnwFsBEyvyBDC9xbL31dadAC8FpABw2vvfCECWgKnV+AFQAHj2H3D+7xwAr3P+mACbTgCnAWBMAP/PABkA3A7/MwH2/BaQcjUlE2B0PwAAzpoA9fYE+p3/9WwxfvuGH/6xR0GUORZwEgDzfJE++WNPHJAImQAFDwblXE8dcfJO8PoKnQ8QCUCyAJj7UcKbP3fk/85BZwSN9v+nN9uoi8s+mAm+RLzUOYHFANjHZwUW8nFwiKSQcxOg2QLmATzfNBZZyIsZnwRgwXUBQQBGtpa4ZvKlGCegx5VBA0eBJLkQkTUCivU/IGAaQEofkty/LJkAukJACABJLkTkgAngtfPbH8DrLWX7A7D0CeB3+GM9AEkGILJsBPhNAF0kYBMAtiGAY+4S9nZDCRNgbf+vBEwCyOrDRk8z22MCPC7WX8AmALIHgGVOgDcvbHcBAFi+H+Bdp94C7gEIAGInwMtKnQXsAeB//69t6wnwvk9fAXsAqLojMO93BqkFCQDA2qOBQ116CpgDUOPQzLr+s35voFqYgIAJkH5sdtV3wPkJMNyjn4CICWDZr8dl/WtK/2qBAuYAWEIhmgwg77qAqQ5rAEhoZL6HwP5Tfnu4hQqIAWDZdaypf24CzBZYAYCENuLWRMCbv8MEmC7QRUDMBPBoxPO1GPHin50ADu2tByBRe2jdy/B/8c9OAI/2SgOYqEQD6ghZYfAEcPkiuRLAcCcT58LUAWAJACwBwDW95SxTQO76IieA08HkxRNgdBDMnhSXtL7ICeB0OkGBCTACYPI8yawZEDcB3E4ojAVgYZ/OsgFI9gQwtxN7VwKQsD4kuf+xmRO1J9DvohKrACD7q0CNfQ+WBsCKA6j17dx1fTFHAz3vLLHm8nAfAJbb/4iAmPMBHO8tYgUAJO+en1if5U4Ac6t/YlnxAGodoHFeX8Q5gY73F1x4j6B1AFKPCZm7gPG7/kadFTwJIPsI/dy5KLlvAR9qM/MTsPY2cT7H6XMHwPv12TQA86p/cFnzAEKv3a8OYH4C/OjNXPJ2WacBqLQ+2yDiAEAOAmD5bwE7ALjaANA17wGbA5g4N1STAdx9SQDAx/7HAdxv71QAlru+YwbAhID7d9zEfbNy+wwAjAGwsQ10OyScvwXePmXg97bvLcALwNgVQvdPcd4TfPuU7APCpfv3+d3RT17fWYcCNGKFsrMARwD2fgPdP8cXQPb6dgdwXS4j4NF/kHI6QMz6dgYgngBeC7h9kvP5QNnrqy9AXgHwFnD7JOczAsPWJ9sK8AYgbz4H3m3HmQtDnn1GSToD9Zj+fQXcbEn364Lu/liBFyF0AvD4XeD/nudx8/w3X1It8tcTFwYgEQCe7Q7QhIjfPJk9AHlK/3MCvm8n06RY2vp2FCAjACYFHBvZUMBQ/48ACADqC5CxAfBQgCCguoBgAAKA0gJkuP/HAgwBdQXIDICnAgQAVQnM9f8YQDMC2wh41t3lIkAAUI7AfP+vBAgCSgl4WtvlJ6CPgecXH1Wv/67/lwC6GHhz/Vnl9u/7HxDQAsG7axCrtv8IwJCAHxeD2U9/i4jJzw/Z5GO/PRiwjo/rfR/7/p/aLz+zj339V+/+5wSQ0rkuBAAAAfSPAPpHAP0jgP4RQP8IAAAC6B8B1A8B+kcA/SOA/iFA/wigfwhQPwLoHwLUDwH6hwD1Q4D6IUD9GKB+DLRvHwLUjwLKBwHl/wwBCm2794uSP+fqEGpuDsDouXX/jIDu/SOge/8IAABp3T8CuvePgO79IwAApHX/COjePwK694+A9gAQ0Lx/ADTvHwHd+0dA9/4R0L3/9gIuQv8IAAACWsbovrcAmu8tgN57C6D13gAovTcBGu8tgL57C6Dt1gKourkAmm4tgJp7C6Dk3gKouLcACu5NgHZ7C6Db1gIotrcAau1NgE5bC6DQ3gKoszcBumwtgCJ7C6DG1gSosLcACmxNgPJ6C6C61gSozTFG/wwB6ocA9UOA/hFA/RCgfghQPwSoHwLUDwHqxwD1Q4D6IUD7GKB+CNA+BmgfA7SPAdrHAO2DgPZBQPkgoHsUUD4K3sSo/kQID64vuGi+DYd/fwghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIichfggJrqugItKsAAAAASUVORK5CYII="></center>';
          }
      }
      else{
          //No such user
          echo "<script>toastr.error('So such application found! Kindly check your application ID again.');</script>";
          //echo '<script>var s = document.getElementById("applicantid"); s.value = "'. $_POST['applicantid'] .'";</script>';
      }  
    }
    else if($_POST['page'] === "educationalqualification"){
      $id = $_SESSION['$applicantid'];
      $query = "select * from tbl_applicant_qualification where applicationid = " . $id;
      $result = $mysqli->query($query); 
      $counter = 0;   
      while($row = $result->fetch_row()){
        $counter++;
      }
  
      if($counter > 0){
        //Update
        $query = "update tbl_applicant_qualification set examinationpassed = 'HSLC or equivalent', institute = '". str_replace("'", " ", $_POST['hslcinstitutename'])."',board = '".$_POST['hslcboardname']."', yearofpassing='".$_POST['hslcpassingyear']."', divisiongrade='".$_POST['hslcdivision']."', percentage= ".$_POST['hslcpercentage'].", scanimage = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['hslcmarksheet']['tmp_name'])) . "', totalmark = " . $_POST['hslctotalmark'] . ", markobtained = " . $_POST['hslcmarkobtained'] . " where applicationid = ".$id." examinationpassed = 'HSLC or equivalent';";
        
        $query .= "update tbl_applicant_qualification set examinationpassed = 'HSSLC or equivalent', institute = '".str_replace("'", " ", $_POST['hsslcinstitutename'])."',board = '".$_POST['hsslcboardname']."', yearofpassing='".$_POST['hsslcpassingyear']."', divisiongrade='".$_POST['hsslcdivision']."', percentage= ".$_POST['hsslcpercentage'].", scanimage = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['hsslcmarksheet']['tmp_name'])) . "', totalmark = " . $_POST['hsslctotalmark'] . ", markobtained = " . $_POST['hsslcmarkobtained'] . " where applicationid = ".$id." and examinationpassed = 'HSLC or equivalent';";
      }
      else{
        //Insert
        $query = "insert into tbl_applicant_qualification values(".$id.", 'HSLC or equivalent', '".str_replace("'", " ", $_POST['hslcinstitutename'])."','".$_POST['hslcboardname']."', '".$_POST['hslcpassingyear']."', '".$_POST['hslcdivision']."', ".$_POST['hslcpercentage'].", 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['hslcmarksheet']['tmp_name'])) . "', " . $_POST['hslctotalmark'] . ", " . $_POST['hslcmarkobtained'] . ");";
        $query .= "insert into tbl_applicant_qualification values(".$id.", 'HSSLC or equivalent', '".str_replace("'", " ", $_POST['hsslcinstitutename'])."','".$_POST['hsslcboardname']."', '".$_POST['hsslcpassingyear']."', '".$_POST['hsslcdivision']."', ".$_POST['hsslcpercentage'].", 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['hsslcmarksheet']['tmp_name'])) . "', " . $_POST['hsslctotalmark'] . ", " . $_POST['hsslcmarkobtained'] . ");";      
      }
  
      $stmt = $mysqli->multi_query($query);
      $counter = 0;
      while ($mysqli->more_results()) {
        //if (!$mysqli->more_results()) {break;}
        $row = $mysqli->next_result();
      }
      $counter = $mysqli->affected_rows;

      if($counter > 0){
        //if mark higher than 60% then notify admin
        $percentage = 0;
        if(strpos($_POST['hsslcpercentage'], "%") !== false){
          $perentage = (float)trim($_POST['hsslcpercentage'],"%");
        }
        else{
          $perentage = (float)$_POST['hsslcpercentage'];
        }
        if($percentage >= 60){
          //Notify Admin             
           //Now eMail
           $query="select * from tbl_smtp where status = 'active'";
           $result = $mysqli->query($query);
           if($row = $result->fetch_row()){
               //SendGrid Gateway
               if($row[0] == "sendgrid"){ 
                   require 'vendor/autoload.php'; // If you're using Composer (recommended)
                  
                   $email = new \SendGrid\Mail\Mail();
                   $email->setFrom("admission@champhaicollege.edu.in", "GCC");
                   $email->setSubject("You have completed Step 1 of Application form for admission application");
                   $tos = ["admission@champhaicollege.edu.in" => "Admission Admin", "admission@champhaicollege.edu.in" => "Administrator"];
                   $email->addTos($tos);
                   //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                   $email->addContent(
                       "text/html", '<html> 
                       <head> 
                           <title>Provisionally Admission for Applicant more than 60%</title> 
                       </head> 
                       <body> 
                           <b>Dear Admin</b>,<br>
                           <br>
                           <p>
                           There has been an applicant securing more than 60% in the HSSLC. Kindly check the details now.<br>
                           Application ID: ' . $id . '
                           </p>
                           Thank you.
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
               else{
                   //Differet SMTP Gateway
               }    
           }
        }
  
        echo "<script>toastr.info('Successfully Submitted and Recorded! You can proceed with your application.');</script>";
        require_once 'applicantdashboard.php';
      }
      else{
        echo "<script>toastr.error('Something went wrong! You can try again to submit your application.');</script>";
        require_once 'applicantdashboard.php';
      }
    }
    else if($_POST['page'] === "coresubjectcombination"){
      if($_POST['firstelectiveone'] != "Elective Choice" && $_POST['firstelectivetwo'] != "Elective Choice" ) { //} && $_POST['secondelectiveone'] != "Elective Choice" && $_POST['secondelectivetwo'] != "Elective Choice" && $_POST['thirdelectiveone'] != "Elective Choice" && $_POST['thirdelectivetwo'] != "Elective Choice"){
          
          $counter = 0;

          if(true) {//$_POST['program'] !== "B.Sc") {
            $query = "insert into tbl_applicant_subject_choice (applicationid, coresubject, electiveone, electivetwo) values('" .$_SESSION['$applicantid']. "','".$_POST['firstchoice']."', '".$_POST['firstelectiveone']."', '".$_POST['firstelectivetwo']."');";          
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $counter = $stmt->affected_rows;
          }
          else{
            $query = "insert into tbl_applicant_subject_choice (applicationid, coresubject, electiveone, electivetwo) values('" .$_SESSION['$applicantid']. "','".$_POST['firstchoice']."', '".$_POST['firstelectiveone']."', '".$_POST['firstelectivetwo']."');";
            //$query .= "insert into tbl_applicant_subject_choice (applicationid, coresubject, electiveone, electivetwo) values('" .$_SESSION['$applicantid']. "','".$_POST['secondchoice']."', '".$_POST['secondelectiveone']."', '".$_POST['secondelectivetwo']."');";
            //$query .= "insert into tbl_applicant_subject_choice (applicationid, coresubject, electiveone, electivetwo) values('" .$_SESSION['$applicantid']. "','".$_POST['thirdchoice']."', '".$_POST['thirdelectiveone']."', '".$_POST['thirdelectivetwo']."');";    
            //$stmt = $mysqli->multi_query($query);
            $stmt = $mysqli->prepare($query);
            $counter = 0;
            //while ($mysqli->more_results()) {
              //if (!$mysqli->more_results()) {break;}
              //$counter += 1;
              //$row = $mysqli->next_result();
            //}

            $stmt->execute();
            $counter = $stmt->affected_rows;
          }       

          $query  = "";

          //$counter = $mysqli->affected_rows;
          if($counter > 0){
            echo "<script>toastr.success('Successfully submited. Kindly continue with Additional Information.');</script>";
            require_once 'applicantdashboard.php';            

          }
          else{
            echo "<script>toastr.error('Something went wrong. Please try again.');</script>";
            require_once 'applicantdashboard.php';  
          }
  
      }
      else{
        echo "<script>toastr.error('You have not Choose the elective corretly. Please try again.');</script>";
        require_once 'coresubjectcombination.php';  
      }
    }
    else if($_POST['page'] === "payment"){
        
      $success = true;
      $error = "Payment Failed";    
      if (empty($_POST['razorpay_payment_id']) === false){
          $api = new Api($apikey, $secret);      
          
          try{            
              $attributes = array(
                  'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                  'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                  'razorpay_signature' => $_POST['razorpay_signature']
              );
      
              $api->utility->verifyPaymentSignature($attributes);
          }
          catch(SignatureVerificationError $e){
              $success = false;
              $error = 'Razorpay Error : ' . $e->getMessage();
          }
      }
      
      if ($success === true){
       
        //Insert into Database
        $today = getdate();
        $query = "update tbl_applicant_payment set status = 'paid', transactionid = '" . $_POST['razorpay_payment_id'] ."', paymentdate='". date("Y-m-d")."', paymenttime='".date("H:i:s")."' where applicationid = '" . $_SESSION['$applicantid'] . "' and status = 'unpaid';";      
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
  
        if(!isset($_SESSION['$universityreg'])){
          //update applicant table status to approved
          $query = "update tbl_applicant set remark = 'feepaid' where applicationid = " . $_SESSION['$applicantid'];      
          $stmt = $mysqli->prepare($query);
          $stmt->execute();
        }


       
  
        if($stmt->affected_rows > 0){
          echo "<script>toastr.info('Your payment was successful! Payment ID: {$_POST['razorpay_payment_id']}.');</script>";

          //SMS first
								$query="select * from tbl_smsconfiguration where isdefault = 1;";                    
								$result = $mysqli->query($query);
								if($row = $result->fetch_row()) { //MSG91
									if($row[0] === "MSG91"){
										//Your authentication key
										$authKey = $row[1];
			

										
										//Multiple mobiles numbers separated by comma
										$mobileNumber = str_replace(' ', '', $_POST['mobile']);
										$code = "+91";		
		
										if(strlen($mobileNumber) === 10){
												$mobileNumber = "91" . $mobileNumber;
										}	
						
										if(strpos($mobileNumber, $code) !== false){
											$mobileNumber = str_replace(['-', '+', '_'], '', $mobileNumber);
										}		
										
			
										//Sender ID,While using route4 sender id should be 6 characters long.
										$senderId = 'ZOBIZZ';
			
										//Provisional Registration - Student
										
										
										
										$curl = curl_init();

										curl_setopt_array($curl, array(
										CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => "",
										CURLOPT_MAXREDIRS => 10,
										CURLOPT_TIMEOUT => 60,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST => "POST",
										CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60d0a3e309f07635ae535f35\",\n  \"sender\": \"ZOBIZZ\",\n  \"mobiles\": \"" . $mobileNumber . "\",\n  \"name\": \"" . $_POST["fullname"] . "\"}",
										CURLOPT_HTTPHEADER => array(
																"authkey: 36371AItp1I8JW5f534689P1",
																"content-type: application/JSON"
										),
										));
															
										$response = curl_exec($curl);
										$err = curl_error($curl);
															
										curl_close($curl);
										
										echo "<script>toastr.info('Successfully SMS Sent. " . $response . "');</script>";
								
									}
									else {
										//Different SMS Gateways
									}
								}
        }
          
      }
      else{
        echo "<script>toastr.info('Your payment was failed! Message: {$error}.');</script>";        
      }
      
      if(!isset($_SESSION['$universityreg'])){
        //Redirect to Dashboard
        require_once 'applicantdashboard.php';
        echo '<script>document.getElementById("pagetitle").innerHTML = "Dashboard";</script>';
      }
      else{
        require_once 'studentdashboard.php';
        echo '<script>document.getElementById("pagetitle").innerHTML = "Dashboard";</script>';
      }
      
      
    }
    else if($_POST['page'] === "additionalinfo"){
      //$query = "update tbl_applicant set bloodgroup = 'Not Set' where applicationid = " .$_SESSION['$applicantid']. ";";
      //if(isset($_POST['voterid']) && $_POST['voterid'] != ""){
          //$query = "update tbl_applicant set bloodgroup = '".$_POST['bloodgroup']."', aadhaar = '".$_POST['aadhaar']."', voterid = '".$_POST['voterid']."', aadhaarscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['aadhaarfront']['tmp_name'])) . "', aadhaarbackscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['aadhaarback']['tmp_name'])) . "', voteridscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['voterfront']['tmp_name'])) . "', voteridbackscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['voterback']['tmp_name'])) . "'  where applicationid = " .$_SESSION['$applicantid']. ";";
      //}
      //else if(!isset($_POST['voterid'])){
          //$query = "update tbl_applicant set bloodgroup = '".$_POST['bloodgroup']."', aadhaar = '".$_POST['aadhaar']."', aadhaarscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['aadhaarfront']['tmp_name'])) . "', aadhaarbackscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['aadhaarback']['tmp_name'])) . "'  where applicationid = " .$_SESSION['$applicantid']. ";";
      //}
      //else if(isset($_POST['bloodgroup'])){
          $query = "update tbl_applicant set bloodgroup = '".$_POST['bloodgroup']."', aadhaar='".$_POST['aadhaar']."', voterid = '".$_POST['voterid']."' where applicationid = " .$_SESSION['$applicantid']. ";";
      //}
         
          $stmt = $mysqli->prepare($query);
          $stmt->execute();        
          
          if($stmt->affected_rows > 0){
            echo "<script>toastr.success('Successfully submited. You will get notified soon.');</script>";
            require_once 'applicantdashboard.php';  
          }
          else{
            echo "<script>toastr.error('Something went wrong. Please try again.');</script>";
            require_once 'applicantdashboard.php';  
          }    
    }
    else if($_POST['page'] === "studentlogin"){
      //Login for the existing student
      $query = "select password from tbl_applicant where universityreg = '" . $_POST['applicationid']."';";
      $result = $mysqli->query($query);    
      if($row = $result->fetch_row()){
          //Check if the password is same
          if($row[0] === crypt($_POST['password'], '$5$ZobizzOnlineServiceLLP$')){
              //Successfully logged in
              $_SESSION['$universityreg'] = $_POST['applicationid'];
              //include the php file
              require_once 'studentdashboard.php';
              echo '<script>document.getElementById("pagetitle").innerHTML = "Dashboard";</script>';
    
              //Show successful login page
              echo "<script>toastr.info('Successfully verified! You can proceed with your application.');</script>";            
          }
          else{
              //Wrong Password
              echo "<script>toastr.error('You have entered a wrong Registration # or a wrong password. Please try again.');</script>"; 
              echo '<script>document.getElementById("pagetitle").innerHTML = "Wrong Login Information";</script>';  
              echo '<center><a href="applicantlogin.php" class="btn btn-warning">Click here to go back</a></center><br><br>';    
              echo '<center><img src="data:image/png;base64,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"></center>';
          }
      }
      else{
          //No such user
          echo "<script>toastr.error('So such application found! Kindly check your application ID again.');</script>";
          echo '<script>document.getElementById("pagetitle").innerHTML = "Wrong Login Information";</script>';
          echo '<center><a href="" class="btn btn-info">Click here to Go Back</a></center>';
      }  
    } 
    else{
  
    }
  }
  else if(isset($_POST['action'])){
    if($_POST['action'] === 'updatepassport'){
      $query = "update tbl_applicant set photo = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . "' where universityreg='".$_POST['id']."';";
      $stmt = $mysqli->prepare($query);
      $stmt->execute();
      if($mysqli->affected_rows > 0){
        echo "<script>toastr.success('Successfully submited. You can continue checking other information too.');</script>";
            require_once 'studentdashboard.php';  
      }
    }
    else if($_POST['action'] === 'updatedetails'){
      if(!empty($_FILES['voterfront']['tmp_name'])){
        $query = "update tbl_applicant set bloodgroup = '".$_POST['bloodgroup']."', aadhaar = '".$_POST['aadhaar']."', mobile='".$_POST['mobile']."', localguardian = '".$_POST['guardian']."', guardianmobile='".$_POST['guardianmobile']."', localaddress='".$_POST['localaddress']."', aadhaarscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['aadhaarfront']['tmp_name'])) . "', aadhaarbackscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['aadhaarback']['tmp_name'])) . "', voterid='".$_POST['voterid']."', voteridscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['voterfront']['tmp_name'])) . "', voteridbackscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['voterback']['tmp_name'])) . "' where universityreg='".$_POST['id']."';";      
      }
      else{
        $query = "update tbl_applicant set bloodgroup = '".$_POST['bloodgroup']."', aadhaar = '".$_POST['aadhaar']."', mobile='".$_POST['mobile']."', localguardian = '".$_POST['guardian']."', guardianmobile='".$_POST['guardianmobile']."', localaddress='".$_POST['localaddress']."', aadhaarscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['aadhaarfront']['tmp_name'])) . "', aadhaarbackscanned = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['aadhaarback']['tmp_name'])) . "' where universityreg='".$_POST['id']."';";      
      }
      $stmt = $mysqli->prepare($query);
      $stmt->execute();
      if($mysqli->affected_rows > 0){
        echo "<script>toastr.success('Successfully submited. You can continue checking other information too.');</script>";
            require_once 'studentdashboard.php';  
      }
    }
    else if($_POST['action'] === 'educationalqualification'){
      $query = "insert into tbl_applicant_qualification values('".$_POST['id']."', '".$_POST['qualification']."', '".$_POST['semester']."', '".$_POST['programme']."', '".$_POST['passingyear']."', '".$_POST['division']."', '".$_POST['percentage']."', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['marksheet']['tmp_name'])) . "');";
      $stmt = $mysqli->prepare($query);
      $stmt->execute();
      if($mysqli->affected_rows > 0){
        echo "<script>toastr.success('Successfully submited. You can continue checking other information too.');</script>";
            require_once 'studentdashboard.php';  
      }
    }
  }


  
}
else{
  //Post type is Get, check login state 
  if(!isset($_SESSION['$applicantid'])) {     
        //maybe redirect to login page
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="">   
            <?php echo '<script>document.getElementById("pagetitle").innerHTML = "Applicant Login";</script>'; ?>
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Applicant Login</h3>
                      </div>
                      <!-- /.card-header -->              
                      
                      <div class="card-body">
                        <form action="" method="post" role="form">
                          <div class="row">
                            <div class="col-sm-6">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Application ID</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                                  </div>
                                  <input type="text" name="applicationid" id="applicationid" class="form-control" placeholder="Eg: 12345467" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Password</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                  </div>
                                  <input type="hidden" name="page" value="applicantlogin">
                                  <input type="password" name="password" class="form-control" placeholder="Eg: 12345467" required>
                                </div>
                              </div>
                            </div>
                          </div>   

                          <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <center><button type="submit" class="btn btn-primary"><i class="fas fa-user-lock"></i>&emsp;Submit</button></center>
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
                  <div class="col-md-6" style="display:none;">
                    <!-- general form elements -->
                    <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title">Students' Login</h3>
                      </div>
                      <!-- /.card-header -->              
                      
                      <div class="card-body">
                        <form action="" method="post" role="form">
                          <div class="row">
                            <div class="col-sm-6">
                              <!-- text input -->
                              <div class="form-group">
                                <label>University Reg #</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                                  </div>
                                  <input type="text" name="applicationid" id="applicationid" class="form-control" placeholder="Eg: 12345467" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Password</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                  </div>
                                  <input type="hidden" name="page" value="studentlogin">
                                  <input type="password" name="password" class="form-control" placeholder="Eg: 12345467" required>
                                </div>
                              </div>
                            </div>
                          </div>   

                          <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <center><button type="submit" class="btn btn-primary"><i class="fas fa-user-lock"></i>&emsp;Submit</button></center>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <center><code>Kindly avoid apostrophy (') in your input, don't place it anywhere. You can replace it with space or - sign</code></center>
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
                </div>
                <!-- /.row -->
              </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
          <?php
  }

  else{
    //Session alive
    if(isset($_GET['page'])){
      if($_GET['page'] === "educationalqualification"){
        $id = '0';
        if(isset($_GET['applicantid'])) {$id = $_GET['applicantid'];}
        require_once 'educationalqualification.php';  
      }
      else if($_GET['page'] === "coresubjectcombination"){
        $id = '0';
        if(isset($_GET['applicantid'])) {$id = $_GET['applicantid'];}
        require_once 'coresubjectcombination.php';  
      } 
      else if($_GET['page'] === "payment"){
        $id = '0';
        if(isset($_GET['applicantid'])) {$id = $_GET['applicantid'];}
        require_once 'payment.php';  
      }  
      else if($_GET['page'] === "printapplication"){
        $id = '0';
        if(isset($_GET['applicantid'])) {$id = $_GET['applicantid'];}
        require_once 'printapplication.php';  
      }  
      else if($_GET['page'] === "additionalinfo"){
        $id = '0';
        if(isset($_GET['applicantid'])) {$id = $_GET['applicantid'];}
        require_once 'additionalinfo.php';  
      }  
      else if($_GET['page'] === "feepay"){       
        require_once 'payment.php';  
      }        
    }
    else{
      require_once 'logout.php';
    }    
  }  
}

?>

  <!-- Main Footer -->
  <footer class="main-footer">
    
    <!-- Default to the left -->
    <?php
        $query = "select copyright_text from tbl_general_settings where college_id = 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_row();
        echo '<strong>' . $row[0] . '</strong>';        
    ?>
    
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ead3f6510362a7578be4b22/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>