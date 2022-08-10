<?php    
    //if(!isset($_SESSION['$universityreg']){
      session_start();
    //}

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

<?php

include_once 'header.php';
include_once 'sidebar.php';

?>

<?php
$isnormalpage = 1;
$requestType = $_SERVER['REQUEST_METHOD'];
    if($requestType == 'GET'){
        if(isset($_GET['page'])){
            if($_GET['page'] == "home"){ //Show Home Page
                $query = "select pagecontent,pagetitle from tbl_pages where id = 100"; //Home Page ID
                $isnormalpage = 1;
            }
            else if($_GET['page'] == "notification"){ //Show Notification Page
                $query = "select pagecontent,pagetitle from tbl_pages where id = 101"; //Notification Page ID
                $isnormalpage = 1;
            }
            else if($_GET['page'] == "important"){ //Show Important Date Page
                $query = "select pagecontent,pagetitle from tbl_pages where id = 102"; //Important Date Page ID
                $isnormalpage = 1;
            }
            else if($_GET['page'] == "eligibility"){ //Show Eligibility Page
                $query = "select pagecontent,pagetitle from tbl_pages where id = 103"; //Eligibility Page ID
                $isnormalpage = 1;
            }
            else if($_GET['page'] == "prospectus"){ //Show Prospectus Page
                $query = "select pagecontent,pagetitle from tbl_pages where id = 104"; //Prospectus Page ID
                $isnormalpage = 1;
            }
            else if($_GET['page'] == "apply"){ //Show  Apply Now Page
                $query = "select pagecontent,pagetitle from tbl_pages where id = 105"; //Apply Now Page ID
                $isnormalpage = 1;
            }
			else if($_GET['page'] == "privacypolicy"){ //Show Privacy Policy
                $query = "select pagecontent,pagetitle from tbl_pages where id = 107"; //Privacy Policy Page ID
                $isnormalpage = 1;
            }
			else if($_GET['page'] == "refundpolicy"){ //Show Refund Policy
                $query = "select pagecontent,pagetitle from tbl_pages where id = 108"; //Refund Policy Page ID
                $isnormalpage = 1;
            }
			else if($_GET['page'] == "aboutus"){ //Show About Us
                $query = "select pagecontent,pagetitle from tbl_pages where id = 109"; //About Us Page ID
                $isnormalpage = 1;
            }
			else if($_GET['page'] == "termandcondition"){ //Show Term and Condition
                $query = "select pagecontent,pagetitle from tbl_pages where id = 110"; //Term and Condition Page ID
                $isnormalpage = 1;
            }
            else if($_GET['page'] == "applynow"){ //Show  Apply Now Page                
                $isnormalpage = 3;
            }
            else if($_GET['page'] == "feestructure"){ //Show Fee Structure Page
                $query = "select pagecontent,pagetitle from tbl_pages where id = 106"; //Fee Structure Page ID
                $isnormalpage = 2;
            }
            else if($_GET['page'] == "applicantlogin"){
                $isnormalpage = 1;
            }
            else{
                $query = "select pagecontent,pagetitle from tbl_pages where id = 100"; //Home Page ID
                $isnormalpage = 1;
            }

            if($isnormalpage === 1) {
            ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                    
                    </div>
                    <!-- /.content-header -->
                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                    <div class="card-body">   
                                        <p class="card-text">                                
                                        <?php                                                
                                                $result = $mysqli->query($query);
                                                $row = $result->fetch_row();
                                                echo htmlspecialchars_decode($row[0]);
                                                echo '<script>document.getElementById("pagetitle").innerHTML = "'. $row[1] .'";</script>';
                                        ?>                                
                                        </p>                                    
                                    </div>
                                    </div>                    
                                </div>                
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
            <?php
            }
            else if($isnormalpage === 2) {
            ?>
                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                        <div class="container-fluid">
                            
                        </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->
                        <!-- Main content -->
                        <div class="content">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                <div class="row">                                                                   
                                            <?php                                                
                                                    $result = $mysqli->query($query);
                                                    $row = $result->fetch_row();
                                                    echo htmlspecialchars_decode($row[0]);
                                                    echo '<script>document.getElementById("pagetitle").innerHTML = "'. $row[1] .'";</script>';
                                            ?>                          
                                                      
                                </div>
                                <!-- /.row -->
                                </div>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content -->
                    </div>
            <?php
            }
            else if($isnormalpage === 3) {
                //Apply Now Page
                require_once 'application.php';
            }
            else{
                if($_GET['page'] == "applicantlogin"){
                    include_once 'applicantlogin.php'; //Include Applicant login Page
                }
            }
        }
        else{
            $query = "select pagecontent,pagetitle from tbl_pages where id = 100"; //Home Page ID
        ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    
                   
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                            <div class="card-body">   
                                <p class="card-text">                                
                                <?php
                                        $result = $mysqli->query($query);
                                        $row = $result->fetch_row();
                                        echo htmlspecialchars_decode($row[0]);
                                        echo '<script>document.getElementById("pagetitle").innerHTML = "'. $row[1] .'";</script>';
                                ?>                                
                                </p>

                                
                            </div>
                            </div>                    
                        </div>                
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->

         </div>
            <?php
        }
    }
    else if($requestType == 'POST'){
        if(isset($_POST['page'])){
            if($_POST['page'] === "applynow"){
				
				//If Class XII Roll No already exist in Database, Notify with error
				$query = "SELECT COUNT(classxiirollno) AS rollCount FROM tbl_applicant WHERE classxiirollno = '" . $_POST['xiirollno'] . "';";
				$result = $mysqli->query($query);
				$row = $result->fetch_assoc();
				
				if($row["rollCount"] > 0){
					//Rollno Already Exist
					//Display Warning message toast
                    echo "<script>toastr.error('Sorry! Cannot be Submitted. Kindly check your Class XII Roll No. You may had submitted your application with this already.');</script>";                    
					require_once 'error_application.php';     
				}
				else{
					//If unique Roll No, not yet apply for the admission, check whether fee to be paid, and
					//if application fee to be paid, then, check the payment status
					$query = 'SELECT appfee, appfeestatus FROM tbl_adm_application WHERE status = "active";';
					$result = $mysqli->query($query);
                    if($row = $result->fetch_row()){
						
						//If application fee has to be processed first.
						if($row[1] == 'active'){ 
							//Collect the Fee First							
								$fullname = $_POST['fullname'];
								$email = $_POST['email'];
								$mobile = $_POST['mobile'];
								$address = $_POST['permanentaddress'];
								$feeamount = $row[0];
								$displayCurrency = 'INR';                             
								$orderData = [
									'receipt'         => $_POST['xiirollno'],
									'amount'          => (int)(((int)$feeamount * 100) + (($feeamount * 100) * 0.02) + ((($feeamount * 100) * 0.02) * 0.18)), 
									'currency'        => 'INR',
									'payment_capture' => 1 
								];
								
							
							//echo '<p align="center">In order to submit application, you will have to pay for application fee.<br><br><a href="" class="btn btn-primary" data-toggle="modal" data-target="#feepayment"><strong>Continue</strong></a></p>';
							
							
							$password = crypt(date('dmY', strtotime($_POST['dob'])), '$5$ZobizzOnlineServiceLLP$'); //Password in the format of ddmmyyyy

							if($_POST['disability'] === 'Yes'){
								$query_statement = "insert into tbl_applicant (program, sessionyear, fullname, dateofbirth, gender, religion, category, mobile, email, 
								fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, applicationprefix, password, signature, note, semester, classxiirollno, disableperson, disablecertificate, sportquota, sportcertificate) values
								('" . $_POST['programme'] . "','" . $_POST['sessionyear'] . "','" . $_POST['fullname'] . "','" . date('Y-m-d', strtotime($_POST['dob'])) . "',
								'" . $_POST['gender'] . "','" . $_POST['religion'] . "','" . $_POST['category'] . "','" . $_POST['mobile'] . "', '" . $_POST['email'] . "',
								'" . $_POST['fathername'] . "','" . $_POST['fathermobile'] . "','" . $_POST['mothername'] . "','" . $_POST['mothermobile'] . "',
								'" . $_POST['permanentaddress'] . "', '" . $_POST['guardianname'] . "','" . $_POST['guardianmobile'] . "', '" . $_POST['localaddress'] . "',
								'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . "', '" . $_POST['prefix'] . "', '" . $password . "', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['signature']['tmp_name'])) . "', '".$_POST['note'] ."', '1st', '".$_POST['xiirollno'] ."',
								'" . $_POST['disability'] . "','data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['disabilitycer']['tmp_name'])) . "'";								
							}
							else {
								$query_statement = "insert into tbl_applicant (program, sessionyear, fullname, dateofbirth, gender, religion, category, mobile, email, 
								fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, applicationprefix, password, signature, note, semester, classxiirollno, disableperson, sportquota, sportcertificate) values
								('" . $_POST['programme'] . "','" . $_POST['sessionyear'] . "','" . $_POST['fullname'] . "','" . date('Y-m-d', strtotime($_POST['dob'])) . "',
								'" . $_POST['gender'] . "','" . $_POST['religion'] . "','" . $_POST['category'] . "','" . $_POST['mobile'] . "', '" . $_POST['email'] . "',
								'" . $_POST['fathername'] . "','" . $_POST['fathermobile'] . "','" . $_POST['mothername'] . "','" . $_POST['mothermobile'] . "',
								'" . $_POST['permanentaddress'] . "', '" . $_POST['guardianname'] . "','" . $_POST['guardianmobile'] . "', '" . $_POST['localaddress'] . "',
								'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . "', '" . $_POST['prefix'] . "', '" . $password . "', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['signature']['tmp_name'])) . "', '".$_POST['note'] ."', '1st', '".$_POST['xiirollno'] ."', '" . $_POST['disability'] . "'";								
							}

							if($_POST['sportquota'] === 'Yes'){
								$query_statement .= ", '" . $_POST['sportquota'] . "', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['sportcer']['tmp_name'])) . "');";
							}
							else{
								$query_statement .= ", '" . $_POST['sportquota'] . "', '');";
							}

							
							require_once 'applicationfeepayment.php';
								
							
						}
						else{
							//No need to collect the fee
							//Record the new application

							$password = crypt(date('dmY', strtotime($_POST['dob'])), '$5$ZobizzOnlineServiceLLP$'); //Password in the format of ddmmyyyy

							if($_POST['disability'] == 'Yes'){
								$query = "insert into tbl_applicant (program, sessionyear, fullname, dateofbirth, gender, religion, category, mobile, email, 
								fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, applicationprefix, password, signature, note, semester, classxiirollno, disableperson, disablecertificate, sportquota, sportcertificate) values
								('" . $_POST['programme'] . "','" . $_POST['sessionyear'] . "','" . $_POST['fullname'] . "','" . date('Y-m-d', strtotime($_POST['dob'])) . "',
								'" . $_POST['gender'] . "','" . $_POST['religion'] . "','" . $_POST['category'] . "','" . $_POST['mobile'] . "', '" . $_POST['email'] . "',
								'" . $_POST['fathername'] . "','" . $_POST['fathermobile'] . "','" . $_POST['mothername'] . "','" . $_POST['mothermobile'] . "',
								'" . $_POST['permanentaddress'] . "', '" . $_POST['guardianname'] . "','" . $_POST['guardianmobile'] . "', '" . $_POST['localaddress'] . "',
								'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . "', '" . $_POST['prefix'] . "', '" . $password . "', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['signature']['tmp_name'])) . "', '".$_POST['note'] ."', '1st', '".$_POST['xiirollno'] ."',
								'" . $_POST['disability'] . "','data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['disabilitycer']['tmp_name'])) . "'";								
							}
							else {
								$query = "insert into tbl_applicant (program, sessionyear, fullname, dateofbirth, gender, religion, category, mobile, email, 
								fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, applicationprefix, password, signature, note, semester, classxiirollno, disableperson, sportquota, sportcertificate) values
								('" . $_POST['programme'] . "','" . $_POST['sessionyear'] . "','" . $_POST['fullname'] . "','" . date('Y-m-d', strtotime($_POST['dob'])) . "',
								'" . $_POST['gender'] . "','" . $_POST['religion'] . "','" . $_POST['category'] . "','" . $_POST['mobile'] . "', '" . $_POST['email'] . "',
								'" . $_POST['fathername'] . "','" . $_POST['fathermobile'] . "','" . $_POST['mothername'] . "','" . $_POST['mothermobile'] . "',
								'" . $_POST['permanentaddress'] . "', '" . $_POST['guardianname'] . "','" . $_POST['guardianmobile'] . "', '" . $_POST['localaddress'] . "',
								'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . "', '" . $_POST['prefix'] . "', '" . $password . "', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['signature']['tmp_name'])) . "', '".$_POST['note'] ."', '1st', '".$_POST['xiirollno'] ."', '" . $_POST['disability'] . "'";								
							}

							if($_POST['sportquota'] === 'Yes'){
								$query .= ", '" . $_POST['sportquota'] . "', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['sportcer']['tmp_name'])) . "');";
							}
							else{
								$query .= ", '" . $_POST['sportquota'] . "', '');";
							}

							
							$stmt = $mysqli->prepare($query);
							$response = $stmt->execute();	

							if($stmt->affected_rows > 0){
							//Successfully added into the database
								
								//Get the Applicant ID
								$id = $stmt->insert_id;  								
								
			
								//send the applicant SMS and Email to confirm acceptance of the application. Send $id and $password
			
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
										CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60d0a3120863b44a2a433f36\",\n  \"sender\": \"ZOBIZZ\",\n  \"mobiles\": \"" . $mobileNumber . "\",\n  \"name\": \"" . $_POST["fullname"] . "\",\n  \"id\": \"" . $id . "\",\n  \"pass\": \"" . date('dmY', strtotime($_POST['dob'])) . "\"}",
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
			
								//Now eMail
								$ch = curl_init();  			
    							curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
    							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    							curl_setopt($ch, CURLOPT_POST, 1);
    							curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\"sender\":{\n\"name\":\"Govt Champhai College\",\n\"email\":\"admission@champhaicollege.edu.in\"\n},\n   \"to\":[\n{\n\"email\":\"".$row[4]."\",\n\"name\":\"".$row[0]."\"\n}\n],\n\"subject\":\"Govt Champhai College Admission: Regard\",\n
    							\"htmlContent\":\"<html> 
								<head> 
									<title>Provisionally Admission for Accepted</title> 
								</head> 
								<body> 
									<b>Dear ".$_POST['fullname']."</b>,<br><br>
									<h1>Thank you for applying the Admission!</h1> 
									<table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
										<tr> 
											<td align='left'>Name:</td><td><h4><font color='green'>" . $_POST['fullname']. "</font></h4></td> 
										</tr> 
										<tr style='background-color: #e0e0e0;'> 
											<td align='left'>Application ID:</td><td><h4><font color='red'>". $id ."</font></h4></td> 
										</tr> 
										<tr> 
											<td align='left'>Password:</td><td><h4><font color='green'>". date('dmY', strtotime($_POST['dob'])) ."</font></h4></td> 
										</tr> 
										<tr style='background-color: #e0e0e0;'> 
											<td align='left'>Email:</td><td><h4><font color='red'>". $_POST["email"] ."</font></h4></td> 
										</tr>                                                 
									</table> <br>
									<p>
									You have provisionally registered for Admission. Kindly proceed the remaining steps.<br><br>
									(This is an auto generated email, so please don\'t reply back.)<br><br>
									<b>Regards, <br>
									Govt. Champhai College (GCC)<br>
									Vengthlang North, Champhai, Mizoram</b><br>
									<br>
									This email message may contain confidential, legally privileged information and is intended solely for the use of the individual to whom it is addressed. If you have erroneously received this message,
									please delete it immediately. If you are not the intended recipient of the email message, you should not disseminate, distribute or copy this email.
									</p>
								</body> 
								</html>\"}");
								
    							$headers = array();
    							$headers[] = 'Accept: application/json';
    							$headers[] = 'Api-Key: ' . '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';
    							$headers[] = 'Content-Type: application/json';
    							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
								
    							$rs = curl_exec($ch);
    							if (curl_errno($ch)) {
    							    echo 'Error:' . curl_error($ch);
    							}
    							curl_close($ch);   							

			
								//Display Success message toast
								echo "<script>toastr.info('Successfully submitted! Kindly check your email and SMS for the login Credential information.');</script>";
								
								//Now redirect to the login page
								require_once 'success.php';                    
							}
            
						}
					}
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
					//Insert Application fee status into Database
					$today = getdate();
					$query = "insert into tbl_applicantion_payment values('" . $_POST['razorpay_payment_id'] ."', '". date("Y-m-d")."', '".date("H:i:s")."', '" . $_SESSION['$universityreg'] . "' , 'paid');";      
					$stmt = $mysqli->prepare($query);
					$stmt->execute();
					
					if($stmt->affected_rows > 0){
						echo "<script>toastr.info('Your payment was successful! Payment ID: { " . $_POST['razorpay_payment_id'] . "}.');</script>";
					}
					
					$query = $_POST['query'];
					$password = date('dmY', strtotime($_POST['dob']));
				
					$stmt = $mysqli->prepare($query);
					$stmt->execute();

							if($stmt->affected_rows > 0){
							//Successfully added into the database
								
								//Get the Applicant ID
								$id = $stmt->insert_id;                    
			
								//send the applicant SMS and Email to confirm acceptance of the application. Send $id and $password
			
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
										CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60d0a3120863b44a2a433f36\",\n  \"sender\": \"ZOBIZZ\",\n  \"mobiles\": \"" . $mobileNumber . "\",\n  \"name\": \"" . $_POST["fullname"] . "\",\n  \"id\": \"" . $id . "\",\n  \"pass\": \"" . date('dmY', strtotime($_POST['dob'])) . "\"}",
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
										$email->addTo($_POST["email"], $_POST["fullname"]);
										//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
										$email->addContent(
											"text/html", '<html> 
											<head> 
												<title>Provisionally Admission for Accepted</title> 
											</head> 
											<body> 
												<b>Dear '.$_POST["fullname"].'</b>,<br><br>
												<h1>Thank you for applying the Admission!</h1> 
												<table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
													<tr> 
														<td align="left">Name:</td><td><h4><font color="green">' . $_POST["fullname"]. '</font></h4></td> 
													</tr> 
													<tr style="background-color: #e0e0e0;"> 
														<td align="left">Application ID:</td><td><h4><font color="red">'. $id .'</font></h4></td> 
													</tr> 
													<tr> 
														<td align="left">Password:</td><td><h4><font color="green">'. $password .'</font></h4></td> 
													</tr> 
													<tr style="background-color: #e0e0e0;"> 
														<td align="left">Email:</td><td><h4><font color="red">'. $_POST["email"] .'</font></h4></td> 
													</tr>                                                 
												</table> <br>
												<p>
												You have provisionally registered for Admission. Kindly proceed the remaining steps.<br><br>
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
									//SendInBlue Gateway
									else if($row[0] == "sendinblue"){
			
										$ch = curl_init();
			
										curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_POST, 1);
										curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"GCC\",\n      \"email\":\"admission@champhaicollege.edu.in\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"  ". $_POST["email"]. " \",\n         \"name\":\" " . $_POST["fullname"] . " \"\n      }\n   ],\n   \"subject\":\"You have completed Step 1 of Application form for admission application\",\n   \"htmlContent\":\"
										<html> 
											<head> 
												<title>Provisionally Admission for Accepted</title> 
											</head> 
											<body> 
												<b>Dear ".$_POST['fullname']."</b>,<br><br>
												<h1>Thank you for applying the Admission!</h1> 
												<table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
													<tr> 
														<td align='left'>Name:</td><td><h4><font color='green'>" . $_POST['fullname']. "</font></h4></td> 
													</tr> 
													<tr style='background-color: #e0e0e0;'> 
														<td align='left'>Application ID:</td><td><h4><font color='red'>". $id ."</font></h4></td> 
													</tr> 
													<tr> 
														<td align='left'>Password:</td><td><h4><font color='green'>". $password ."</font></h4></td> 
													</tr> 
													<tr style='background-color: #e0e0e0;'> 
														<td align='left'>Email:</td><td><h4><font color='red'>". $_POST['email'] ."</font></h4></td> 
													</tr>                                                 
												</table> <br>
												<p>
												You have provisionally registered for Admission. Kindly proceed the remaining steps.<br><br>
												(This is an auto generated email, so please don\'t reply back.)<br><br>
												<b>Regards, <br>
												Govt. Champhai College (GCC)<br>
												Vengthlang North, Champhai, Mizoram</b><br>
												<br>
												This email message may contain confidential, legally privileged information and is intended solely for the use of the individual to whom it is addressed. If you have erroneously received this message,
												please delete it immediately. If you are not the intended recipient of the email message, you should not disseminate, distribute or copy this email.
												</p>
											</body> 
											</html>");
			
										$headers = array();
										$headers[] = 'Accept: application/json';
										$headers[] = 'Api-Key: ' . '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';
										$headers[] = 'Content-Type: application/json';
										curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			
										$result = curl_exec($ch);
										if (curl_errno($ch)) {
											echo 'Error:' . curl_error($ch);
										}
										curl_close($ch);
									} 
									else{
										//Differet SMTP Gateway
									}    
								}
			
								//Display Success message toast
								echo "<script>toastr.info('Successfully submitted! Kindly check your email and SMS for the login Credential information.');</script>";
								
								//Now redirect to the login page
								require_once 'success.php';                    
							}
				}
				else{
					echo "<script>toastr.info('Your payment was failed! Message: {$error}.');</script>"; 
				}
				
				
				
            }
			else if($_POST['page'] === "appfeepayment"){
				
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
					//Insert Application fee status into Database
					$today = getdate();
					$query = "insert into tbl_applicantion_payment values('" . $_POST['razorpay_payment_id'] ."', '". date("Y-m-d")."', '".date("H:i:s")."', '" . $_SESSION['$universityreg'] . "' , 'paid', '" . $_POST['amount'] . "');";      
					$stmt = $mysqli->prepare($query);
					$stmt->execute();
					
					if($stmt->affected_rows > 0){
						echo "<script>toastr.info('Your payment was successful! Payment ID: {$_POST['razorpay_payment_id']}.');</script>";
					}
					
					$query = $_POST['query'];
					$password = date('dmY', strtotime($_POST['dob']));
				
					$stmt = $mysqli->prepare($query);
					$stmt->execute();

							if($stmt->affected_rows > 0){
							//Successfully added into the database
								
								//Get the Applicant ID
								$id = $stmt->insert_id;                    
			
								//send the applicant SMS and Email to confirm acceptance of the application. Send $id and $password
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
										CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60d0a3120863b44a2a433f36\",\n  \"sender\": \"ZOBIZZ\",\n  \"mobiles\": \"" . $mobileNumber . "\",\n  \"name\": \"" . $_POST["fullname"] . "\",\n  \"id\": \"" . $id . "\",\n  \"pass\": \"" . date('dmY', strtotime($_POST['dob'])) . "\",\n  \"contact\": \"9862215033\"\n}",
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




								//Now eMail								
									  
									//SendInBlue Gateway								
			
										$ch = curl_init();
			
										curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_POST, 1);
										curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"GCC\",\n      \"email\":\"admission@champhaicollege.edu.in\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"  ". $_POST["email"]. " \",\n         \"name\":\" " . $_POST["fullname"] . " \"\n      }\n   ],\n   \"subject\":\"You have completed Step 1 of Application form for admission application\",\n   \"htmlContent\":\"
										<html> 
											<head> 
												<title>Provisionally Admission for Accepted</title> 
											</head> 
											<body> 
												<b>Dear ".$_POST['fullname']."</b>,<br><br>
												<h1>Thank you for applying the Admission!</h1> 
												<table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
													<tr> 
														<td align='left'>Name:</td><td><h4><font color='green'>" . $_POST['fullname']. "</font></h4></td> 
													</tr> 
													<tr style='background-color: #e0e0e0;'> 
														<td align='left'>Application ID:</td><td><h4><font color='red'>". $id ."</font></h4></td> 
													</tr> 
													<tr> 
														<td align='left'>Password:</td><td><h4><font color='green'>". $password ."</font></h4></td> 
													</tr> 
													<tr style='background-color: #e0e0e0;'> 
														<td align='left'>Email:</td><td><h4><font color='red'>". $_POST['email'] ."</font></h4></td> 
													</tr>                                                 
												</table> <br>
												<p>
												You have provisionally registered for Admission. Kindly proceed the remaining steps.<br><br>
												(This is an auto generated email, so please don\'t reply back.)<br><br>
												<b>Regards, <br>
												Govt. Champhai College (GCC)<br>
												Vengthlang North, Champhai, Mizoram</b><br>
												<br>
												This email message may contain confidential, legally privileged information and is intended solely for the use of the individual to whom it is addressed. If you have erroneously received this message,
												please delete it immediately. If you are not the intended recipient of the email message, you should not disseminate, distribute or copy this email.
												</p>
											</body> 
											</html>");
			
										$headers = array();
										$headers[] = 'Accept: application/json';
										$headers[] = 'Api-Key: ' . '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';
										$headers[] = 'Content-Type: application/json';
										curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			
										$result = curl_exec($ch);
										if (curl_errno($ch)) {
											echo 'Error:' . curl_error($ch);
										}
										curl_close($ch);		
								
			
								//Display Success message toast
								echo "<script>toastr.info('Successfully submitted! Kindly check your email and SMS for the login Credential information.');</script>";
								
								//Now redirect to the login page
								require_once 'success.php';                    
							}
				}
				else{
					echo "<script>toastr.info('Your payment was failed! Message: {$error}.');</script>"; 
				}
				
				
				
            }
			else if($_POST['page'] === "updatenow"){

            }
            else{

            }
        }
		 
    }    

include_once 'footer.php';
?>