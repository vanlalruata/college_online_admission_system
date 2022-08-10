<?php 
    include 'header.php';

    date_default_timezone_set('Asia/Kolkata');

    include 'sidebar.php';      
                
    $requestType = $_SERVER['REQUEST_METHOD'];
    if($requestType == 'POST'){ 
        if(isset($_POST['action'])){
            if($_POST['action'] === "logoupdate"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                
                $query="update tbl_general_settings set logo = 'data:image/png;base64," . base64_encode(file_get_contents($_FILES['logo']['tmp_name'])) . "' where id = 1;";    
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    //Successfully added into the database
                    //Display Success message toast
                    echo "<script>toastr.info('Successfully submitted! Your update logo will be used from now on.');</script>";
                    
                    //Now redirect to the previous page
                    //header('Location: ' . $_SERVER['HTTP_REFERER']);     
                    
                    require_once 'generalsetting.php';
                }
                else{
                    echo "<script>toastr.error('There's nothing to be updated!');</script>";
                    require_once 'generalsetting.php';
                }         
            } 
            else if($_POST['action'] === "faviconupdate"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                
                $query="update tbl_general_settings set favicon = 'data:image/png;base64," . base64_encode(file_get_contents($_FILES['favicon']['tmp_name'])) . "' where id = 1;";    
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    //Successfully added into the database
                    //Display Success message toast
                    echo "<script>toastr.info('Successfully submitted! Your update favicon will be used from now on.');</script>";
                    
                    //Now redirect to the previous page
                    //header('Location: ' . $_SERVER['HTTP_REFERER']);     
                    
                    require_once 'generalsetting.php';
                }
                else{
                    echo "<script>toastr.error('There's nothing to be updated!');</script>";
                    require_once 'generalsetting.php';
                }         
            }  
            else if($_POST['action'] === "generalupdate"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                
                $query="update tbl_general_settings set site_title = '".$_POST['sitetitle']."', college_name = '".$_POST['collegename']."',
                email = '".$_POST['collegeemail']."', phone = '".$_POST['collegephone']."', address = '".$_POST['collegeaddress']."', college_code = '".$_POST['collegecode']."',
                currency_symbol = '".$_POST['currencysymbol']."', currency = '".$_POST['currencycode']."', currency_code = '".$_POST['currencycode']."', copyright_text = '".$_POST['copyright']."', smartchat = '".htmlspecialchars($_POST['smartchat'])."' where id = 1;";    
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    //Successfully added into the database
                    //Display Success message toast
                    echo "<script>toastr.info('Successfully submitted! The Setting details have been updated');</script>";
                    
                    //Now redirect to the previous page
                    //header('Location: ' . $_SERVER['HTTP_REFERER']);     
                    
                    require_once 'generalsetting.php';
                }
                else{
                    echo "<script>toastr.error('There's nothing to be updated!');</script>";
                    require_once 'generalsetting.php';
                }         
            }                 
            else if($_POST['action'] === "payfee"){
                //Fee will be collected
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);                   

                
                date_default_timezone_set('Asia/Kolkata');
                $query = "update tbl_applicant_payment set status = 'paid', transactionid = 'CASH : ".$_POST['collector']."', paymentdate='".date("Y-m-d")."', paymenttime='".date('H:i:s')."' where applicationid = '".$_POST['applicationid']."';";
                             
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    $query = "UPDATE tbl_applicant SET remark = 'feepaid' WHERE applicationid = ".$_POST['applicationid'].";";
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();

                    echo "<script>toastr.success('Successfully fee collected. It has been stored in the database!.');</script>";
                }
                //$counter = $mysqli->affected_rows;
                  
                //Notify the user that his payment is received and admission is accepted
                $mobile = '';
                $name = '';                    
                $query = "select mobile, fullname from tbl_applicant where applicationid = " . $_POST['applicationid'];
                $result = $mysqli->query($query);
                if($row = $result->fetch_row()){
                    $name=$row[1];
                    $mobile=$row[0];
                }
                

                //SMS first
                $query="select * from tbl_smsconfiguration where isdefault = 1;";                    
                $result = $mysqli->query($query);
                if($row = $result->fetch_row()) { //MSG91
                    if($row[0] === "MSG91"){
                        //Your authentication key
                        $authKey = $row[1];

                        //Multiple mobiles numbers separated by comma
                        $mobileNumber = str_replace(' ', '', $mobile); 
						$code = "+91";		
		
						if(strlen($mobileNumber) === 10){
								$mobileNumber = "91" . $mobileNumber;
						}	
		
						if(strpos($mobileNumber, $code) !== false){
							$mobileNumber = str_replace(['-', '+', '_'], '', $mobileNumber);
						}
		
						

                        //Sender ID,While using route4 sender id should be 6 characters long.
                        $senderId = 'ZOBIZZ';

                        //Your message to send, Add URL encoding here.
                        $message = urlencode('Dear ' . $name . ', Your application bearing application # '.$_POST['applicationid'].'  has been processed and we had received the fee/payment. Your admission is now confirmed. Thank you.');
                        
						$curl = curl_init();

						curl_setopt_array($curl, array(
						CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60d0a4620dba13425d2430d6\",\n  \"sender\": \"ZOBIZZ\",\n  \"mobiles\": \"" . $mobileNumber . "\",\n  \"name\": \"" . $name . "\"}",
						CURLOPT_HTTPHEADER => array(
												"authkey: 36371AItp1I8JW5f534689P1",
												"content-type: application/JSON"
						),
						));
											
						$response = curl_exec($curl);
						$err = curl_error($curl);
											
						curl_close($curl);
							
                        
                    }
                }

                require_once 'paymentdue.php';
            } 
            else if($_POST['action'] === "upayfee"){
                //Fee will be collected
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);                   

                
                date_default_timezone_set('Asia/Kolkata');
                $query = "insert into tbl_applicant_payment values ('".$_POST['applicationid']."', '".$_POST['feeamount'] ."', 'CASH : Principal', 'paid','".date("Y-m-d")."', '".date('H:i:s')."');";
                                           
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    $query = "UPDATE tbl_applicant SET remark = 'feepaid' WHERE applicationid = ".$_POST['applicationid'].";";
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();

                    echo "<script>toastr.success('Successfully fee collected. It has been stored in the database!.');</script>";
                }
                //$counter = $mysqli->affected_rows; 
                
                require 'studentlist.php';
            } 
            else if($_POST['action'] === "smsgateway"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                
                $query="update tbl_smsconfiguration set authenticationkey = '".$_POST['apikey']."', senderid = '".$_POST['senderid']."', isdefault = ".$_POST['isdefault']." where gateway = '".$_POST['gateway']."';";    
                                   
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    //Successfully added into the database
                    //Display Success message toast
                    echo "<script>toastr.info('Successfully submitted! Your update logo will be used from now on.');</script>"; 
                    
                    require_once 'gateways.php';
                }
                else{
                    echo "<script>toastr.error('There's nothing to be updated!');</script>";
                    require_once 'gateways.php';
                }         
            }   
            else if($_POST['action'] === "smtpgateway"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                
                $query="update tbl_smtp set apikey = '".$_POST['apikey']."', serverid = '".$_POST['serverkey']."', status = '".$_POST['isactive']."' where hostname = '".$_POST['hostname']."';";    
                                                        
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    //Successfully added into the database
                    //Display Success message toast
                    echo "<script>toastr.info('Successfully submitted! Your gateway has been updated.');</script>"; 
                    
                    require_once 'gateways.php';
                }
                else{
                    echo "<script>toastr.error('There's nothing to be updated!');</script>";
                    require_once 'gateways.php';
                }         
            } 
            else if($_POST['action'] === "paymentgateway"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                
                $query="update tbl_payment_gateway set apikey = '".$_POST['apikey']."', secret = '".$_POST['secret']."', status = '".$_POST['status']."' where paymentgateway = '".$_POST['gateway']."';";    
                                                        
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    //Successfully added into the database
                    //Display Success message toast
                    echo "<script>toastr.info('Successfully submitted! Your gateway has been updated.');</script>"; 
                    
                    require_once 'gateways.php';
                }
                else{
                    echo "<script>toastr.error('There's nothing to be updated!');</script>";
                    require_once 'gateways.php';
                }         
            } 
            else if($_POST['action'] === "admissionedit"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                if(isset($_POST['id']) && $_POST['id']!=''){
                    $query="update tbl_adm_application set sessionyear = '".$_POST['session']."', startdate = '".date('Y-m-d', strtotime($_POST['startdate']))."', closedate = '".date('Y-m-d', strtotime($_POST['enddate']))."', detailseditend = '".date('Y-m-d', strtotime($_POST['editend'])) ."', declaration = '".$_POST['declaration']."', status = '".$_POST['status']."', applicationprefix = '".$_POST['prefix']."', appfee='".$_POST['appfee']."', appfeestatus='".$_POST['appfeestatus']."' where id = ".$_POST['id'].";";                          
                }
                else{
                    $query = "insert into tbl_adm_application values(null, '".$_POST['session']."','".date('Y-m-d', strtotime($_POST['startdate']))."','".date('Y-m-d', strtotime($_POST['enddate']))."','".date('Y-m-d', strtotime($_POST['editend']))."','".$_POST['declaration']."', '".$_POST['status']."', '".$_POST['prefix']."', '".$_POST['appfee']."', '".$_POST['appfeestatus']."');";
                }
                                                                          
                $stmt = $mysqli->prepare($query);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    //Successfully added into the database
                    //Display Success message toast
                    echo "<script>toastr.info('Successfully submitted! The admission application as been added/updated.');</script>"; 
                    
                    require_once 'admissionlist.php';
                }
                else{
                    echo "<script>toastr.error('There's nothing to be updated!');</script>";
                    require_once 'admissionlist.php';
                }         
            } 
            else if($_POST['action'] === "removeadmission"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                if(isset($_POST['id']) && $_POST['id']!=''){
                    $query="delete from tbl_adm_application where id = ".$_POST['id'].";";  
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();
    
                    if($stmt->affected_rows > 0){
                        //Successfully added into the database
                        //Display Success message toast
                        echo "<script>toastr.info('Successfully deleted! The admission application as been removed.');</script>"; 
                        
                        require_once 'admissionlist.php';
                    }
                    else{
                        echo "<script>toastr.error('There's nothing to be deleteded!');</script>";
                        require_once 'admissionlist.php';
                    }                             
                }
                else{
                    echo "<script>toastr.error('ID Missing!');</script>";
                    require_once 'admissionlist.php';
                }  
            }
            else if($_POST['action'] === "removeuser"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                if(isset($_POST['id']) && $_POST['id']!=''){
                    $query="delete from tbl_staff where id = ".$_POST['id'].";";  
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();
    
                    if($stmt->affected_rows > 0){
                        //Successfully added into the database
                        //Display Success message toast
                        echo "<script>toastr.info('Successfully deleted! The admission application as been removed.');</script>"; 
                        
                        require_once 'userlist.php';
                    }
                    else{
                        echo "<script>toastr.error('There's nothing to be deleteded!');</script>";
                        require_once 'userlist.php';
                    }                             
                }
                else{
                    echo "<script>toastr.error('ID Missing!');</script>";
                    require_once 'userlist.php';
                }  
            }
            else if($_POST['action'] === "deletefee"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                if(isset($_POST['id']) && $_POST['id']!=''){
                    $query="delete from tbl_fee_details where id = ".$_POST['id'].";";  
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();
    
                    if($stmt->affected_rows > 0){
                        //Successfully added into the database
                        //Display Success message toast
                        echo "<script>toastr.info('Successfully deleted! The fee entry been removed.');</script>"; 
                        
                        require_once 'feestructure.php';
                    }
                    else{
                        echo "<script>toastr.error('There's nothing to be deleteded!');</script>";
                        require_once 'feestructure.php';
                    }                             
                }
                else{
                    echo "<script>toastr.error('ID Missing!');</script>";
                    require_once 'feestructure.php';
                }  
            }
            else if($_POST['action'] === "addfee"){
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                if(isset($_POST['id']) && $_POST['id']!=''){
                    $query="update tbl_fee_details set year = '".$_POST['semester']."', totalfee = ".$_POST['amount']." where id = ".$_POST['id'].";";                                             
                }
                else{
                    $query="insert into tbl_fee_details (programme, year, totalfee) values ('".$_POST['programme']."', '".$_POST['semester']."', ".$_POST['amount'].");";                           
                }  
                $stmt = $mysqli->prepare($query);
                $stmt->execute();
    
                if($stmt->affected_rows > 0){                            
                    echo "<script>toastr.info('Successfully Added! The fee entry been added/updated in the list');</script>";                             
                    require_once 'feestructure.php';
                }
                else{
                    echo "<script>toastr.error('Something went wrong! There's nothing to be added/updated!');</script>";
                    require_once 'feestructure.php';
                }          
            }
            else if($_POST['action'] === "profileupdate"){

                if($_POST['password'] === $_POST['confirm']){
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                    
                    $query="update tbl_staff set fullname = '".$_POST['fullname']."', photo = 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . "', password = '" . crypt($_POST['password'], '$5$ZobizzOnlineServiceLLP$') . "' where email = '".$_POST['email']."';";    
                                                            
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();
    
                    if($stmt->affected_rows > 0){
                        //Successfully added into the database
                        //Display Success message toast
                        echo "<script>toastr.info('Successfully submitted! Your Profile has been updated.');</script>"; 
                        $_SESSION['$photo'] = "data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name']));
                        require_once 'profile.php';
                    }
                    else{
                        echo "<script>toastr.error('There's nothing to be updated!');</script>";
                        require_once 'profile.php';
                    }    
                }
                else{
                    echo "<script>toastr.error('Password missmatched!');</script>";
                        require_once 'profile.php';    
                }

                     
            } 
            else if($_POST['action'] === "sendsms"){
               
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
                    
                    //SMS
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
                        $senderId = $row[2];

                        //Your message to send, Add URL encoding here.
                        $message = urlencode($_POST['message']);

                        //Define route 
                        $route = "4";

                        //Prepare you post parameters
                        $postData = array(
                            'authkey' => $authKey,
                            'mobiles' => $mobileNumber,
                            'message' => $message,
                            'sender' => $senderId,
                            'route' => $route
                        );

                        //API URL
                        $url="http://api.msg91.com/api/sendhttp.php";

                        // init the resource
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                            //,CURLOPT_FOLLOWLOCATION => true
                        ));


                        //Ignore SSL certificate verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


                        //get response
                        $output = curl_exec($ch);
                        curl_close($ch);
                        
                    }
                    else {
                        //Different SMS Gateways
                    }
                }
               
                require_once 'dashboard.php';
                     
            }  
            else if($_POST['action'] === "edituser"){
                    if($_POST['password'] === $_POST['confirm']){
                        require_once '../config/dbconfig.php';
                        $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
            
                        if($_POST['userid'] === ""){
                            $query = "insert into tbl_staff (email, password, fullname, designation, role) values('".$_POST['email']."', '".crypt($_POST['password'], '$5$ZobizzOnlineServiceLLP$')."', '".$_POST['fullname']."','".$_POST['designation']."','".$_POST['role']."');";
                        }
                        else{
                                $query = "update tbl_staff set email = '".$_POST['email']."', fullname = '".$_POST['fullname']."', password='".crypt($_POST['password'], '$5$ZobizzOnlineServiceLLP$')."' where id = ".$_POST['userid']. ";";
                            }
                        $stmt = $mysqli->prepare($query);
                        $stmt->execute();
            
                        if($stmt->affected_rows > 0){
                            echo "<script>toastr.success('Successfully Updated!.');</script>";
                        }   
                        require_once 'userlist.php';
                    }
                    else{
                        echo "<script>toastr.error('Password Mismatched! You need to provide the same password on the confirmation. Please try again.');</script>";
                        require_once 'userlist.php';
                    }                        
            }
			else if($_POST['action'] === "editpage"){
				//Page Edit
				if(isset($_POST['pageid'])){
					require_once '../config/dbconfig.php';
					$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
	
					if($_POST['pageid'] === ""){
						$query = "insert into tbl_pages (pagetitle, pagecontent) values('" . $_POST['title'] . "', '" . htmlspecialchars($_POST['description']) . "');";
					}
					else{
						$query="update tbl_pages set pagetitle = '" . $_POST['title'] . "', pagecontent = '" . htmlspecialchars($_POST['description']) . "' where id = " . $_POST['pageid'].";";                
					}					  
					$stmt = $mysqli->prepare($query);
					$stmt->execute();
					if($stmt->affected_rows > 0){
						echo "<script>toastr.success('Successfully Updated!.');</script>";
					}   
					require_once 'pagelist.php';
				}
            }
            else if($_POST['action'] === "addapplicant"){                
                //Record the new application
                $password = crypt(date('dmY', strtotime($_POST['dob'])), '$5$ZobizzOnlineServiceLLP$'); //Password in the format of ddmmyyyy

                $query = "insert into tbl_applicant (program, sessionyear, fullname, dateofbirth, gender, religion, category, mobile, email, 
                fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, applicationprefix, password, signature, note, semester) values
                ('" . $_POST['programme'] . "','" . $_POST['sessionyear'] . "','" . $_POST['fullname'] . "','" . date('Y-m-d', strtotime($_POST['dob'])) . "',
                '" . $_POST['gender'] . "','" . $_POST['religion'] . "','" . $_POST['category'] . "','" . $_POST['mobile'] . "', '" . $_POST['email'] . "',
                '" . $_POST['fathername'] . "','" . $_POST['fathermobile'] . "','" . $_POST['mothername'] . "','" . $_POST['mothermobile'] . "',
                '" . $_POST['permanentaddress'] . "', '" . $_POST['guardianname'] . "','" . $_POST['guardianmobile'] . "', '" . $_POST['localaddress'] . "',
                'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . "', '" . $_POST['prefix'] . "', '" . $password . "', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['signature']['tmp_name'])) . "', '".$_POST['note'] ."', '1st');";
                
                $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $id = $mysqli->insert_id;

                if($stmt->affected_rows > 0){
                    $query = "insert into tbl_applicant_qualification values('".$id."', 'HSLC or equivalent', '".$_POST['hslcinstitutename']."','".$_POST['hslcboardname']."', '".$_POST['hslcpassingyear']."', '".$_POST['hslcdivision']."', ".$_POST['hslcpercentage'].", 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['hslcmarksheet']['tmp_name'])) . "');";
                    $query .= "insert into tbl_applicant_qualification values('".$id."', 'HSSLC or equivalent', '".$_POST['hsslcinstitutename']."','".$_POST['hsslcboardname']."', '".$_POST['hsslcpassingyear']."', '".$_POST['hsslcdivision']."', ".$_POST['hsslcpercentage'].", 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['hsslcmarksheet']['tmp_name'])) . "');";      
    
                    $stmt = $mysqli->multi_query($query);
                    $counter = 0;
                    while ($mysqli->more_results()) {
                    //if (!$mysqli->more_results()) {break;}
                    $row = $mysqli->next_result();
                    }
                    $counter = $mysqli->affected_rows;
                    if($counter > 0){
                        $query = "insert into tbl_applicant_subject_choice (applicationid, coresubject, electiveone, electivetwo) values(" .$id. ",'".$_POST['firstchoice']."', '".$_POST['firstelectiveone']."', '".$_POST['firstelectivetwo']."');";
                        //$query .= "insert into tbl_applicant_subject_choice (applicationid, coresubject, electiveone, electivetwo) values(" .$id. ",'".$_POST['secondchoice']."', '".$_POST['secondelectiveone']."', '".$_POST['secondelectivetwo']."');";
                        //$query .= "insert into tbl_applicant_subject_choice (applicationid, coresubject, electiveone, electivetwo) values(" .$id. ",'".$_POST['thirdchoice']."', '".$_POST['thirdelectiveone']."', '".$_POST['thirdelectivetwo']."');";
                        $stmt = $mysqli->multi_query($query);
                        $counter = 0;
                        while ($mysqli->more_results()) {
                            //if (!$mysqli->more_results()) {break;}
                            $row = $mysqli->next_result();
                        }
                        $counter = $mysqli->affected_rows;
                        if($counter > 0){
                            echo "<script>toastr.success('Successfully submited. Kindly continue with Additional Information.');</script>";
                            require_once 'dashboard.php'; 

                            //Send Email and SMS
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
		

                                    //Include father mobile if not same 
                                    if(($_POST['mobile'] != $_POST['fathermobile']) && $_POST['fathermobile'] != ""){
                                        //$mobileNumber .= ",".str_replace(' ', '', $_POST['fathermobile']);
                                    }

                                    //Sender ID,While using route4 sender id should be 6 characters long.
                                    $senderId = 'ZOBIZZ';

                                    //Send App ID and Password
                                    
									$curl = curl_init();

									curl_setopt_array($curl, array(
									CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => "",
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 30,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => "POST",
									CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60bada2753c8d45754776092\",\n  \"sender\": \"ZOBIZZ\",\n  \"mobiles\": \"" . $mobileNumber . "\",\n  \"name\": \"" . $_POST["fullname"] . "\",\n  \"id\": \"" . $id .  "\",\n  \"pass\": \"" . date('dmY', strtotime($_POST['dob'])) . "\"}",
									CURLOPT_HTTPHEADER => array(
															"authkey: 36371AItp1I8JW5f534689P1",
															"content-type: application/JSON"
									),
									));
														
									$response = curl_exec($curl);
									$err = curl_error($curl);
														
									curl_close($curl);
								
                                    
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
                                    require '../vendor/autoload.php'; // If you're using Composer (recommended)
                                
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
                                                    <td align="left">Password:</td><td><h4><font color="green">'. date('dmY', strtotime($_POST['dob'])) .'</font></h4></td> 
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
                                                    <td align='left'>Password:</td><td><h4><font color='green'>". date('dmY', strtotime($_POST['dob'])) ."</font></h4></td> 
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
                                    $headers[] = 'Api-Key: ' . $row[1];
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
                        }
                        else{
                            echo "<script>toastr.error('Something went wrong! You can try again to submit your application.');</script>";
                            require_once 'dashboard.php';
                        }
                    }
                    else{
                        echo "<script>toastr.error('Something went wrong! You can try again to submit your application.');</script>";
                        require_once 'dashboard.php';
                    }
                }
                else{
                    echo "<script>toastr.error('Something went wrong! You can try again to submit your application.');</script>";
                    require_once 'dashboard.php';
                }
            }
            else if($_POST['action'] === "addstudent"){                
                //Record the new application
                $password = crypt(date('dmY', strtotime($_POST['dob'])), '$5$ZobizzOnlineServiceLLP$'); //Password in the format of ddmmyyyy

                $query = "insert into tbl_applicant (program, sessionyear, fullname, dateofbirth, gender, religion, category, mobile, email, 
                fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, photo, applicationprefix, password, signature, note, universityreg, universityroll, semester) values
                ('" . $_POST['programme'] . "','" . $_POST['sessionyear'] . "','" . $_POST['fullname'] . "','" . date('Y-m-d', strtotime($_POST['dob'])) . "',
                '" . $_POST['gender'] . "','" . $_POST['religion'] . "','" . $_POST['category'] . "','" . $_POST['mobile'] . "', '" . $_POST['email'] . "',
                '" . $_POST['fathername'] . "','" . $_POST['fathermobile'] . "','" . $_POST['mothername'] . "','" . $_POST['mothermobile'] . "',
                '" . $_POST['permanentaddress'] . "', '" . $_POST['guardianname'] . "','" . $_POST['guardianmobile'] . "', '" . $_POST['localaddress'] . "',
                'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . "', '" . $_POST['prefix'] . "', '" . $password . "', 'data:image/jpeg;base64," . base64_encode(file_get_contents($_FILES['signature']['tmp_name'])) . "', '".$_POST['note'] ."',
                '" . $_POST['uregno'] . "','" . $_POST['urollno'] . "', '" . $_POST['semester'] . "');";
                
                $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $id = $mysqli->insert_id;

                if($stmt->affected_rows > 0){
                    echo "<script>toastr.success('Successfully submited. Kindly continue with Additional Information.');</script>";
                    require_once 'dashboard.php'; 

                    //Send Email and SMS                    

                    //Now eMail
                    $query="select * from tbl_smtp where status = 'active'";
                    $result = $mysqli->query($query);
                    if($row = $result->fetch_row()){
                        //SendGrid Gateway
                        if($row[0] == "sendgrid"){ 
                            require '../vendor/autoload.php'; // If you're using Composer (recommended)
                        
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
                                            <td align="left">University Reg #:</td><td><h4><font color="red">'. $_POST['uregno'] .'</font></h4></td> 
                                        </tr> 
                                        <tr> 
                                            <td align="left">Password:</td><td><h4><font color="green">'. date('dmY', strtotime($_POST['dob'])) .'</font></h4></td> 
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
                                            <td align='left'>University Reg #:</td><td><h4><font color='red'>". $_POST['uregno'] ."</font></h4></td> 
                                        </tr> 
                                        <tr> 
                                            <td align='left'>Password:</td><td><h4><font color='green'>". date('dmY', strtotime($_POST['dob'])) ."</font></h4></td> 
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
                            $headers[] = 'Api-Key: ' . $row[1];
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
                }
                else{
                    echo "<script>toastr.error('Something went wrong! You can try again to submit your application.');</script>";
                    require_once 'dashboard.php';
                }
            }
            
			else if($_POST['action'] === "addunistudent"){                
                
                $query = "insert into tbl_university_students (programme, acayear, semester, fullname, universityreg, universityroll) values
                ('" . $_POST['programme'] . "','" . $_POST['sessionyear'] . "','" . $_POST['semester'] . "', '" . $_POST['fullname'] . "',
                '" . $_POST['uregno'] . "','" . $_POST['urollno'] . "');";
                                
                $stmt = $mysqli->prepare($query);
                $stmt->execute();      
                
                

                if($stmt->affected_rows > 0){
                    echo "<script>toastr.success('Successfully added.');</script>";
                    require_once 'studentlist.php';                                         
                }
                else{
                    echo "<script>toastr.error('Something went wrong! You can try again to submit your application.');</script>";
                    require_once 'dashboard.php';
                }
            }
			
			else if($_POST['action'] === "updatestudent"){                
                //Record the new application
                $query = "update tbl_applicant set universityreg = '".$_POST['ureg']."', universityroll='".$_POST['uroll']."', semester = '".$_POST['semester']."' where applicationid = ".$_POST['id'].";";
                
                $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $id = $mysqli->insert_id;

                if($stmt->affected_rows > 0){
                    echo "<script>toastr.success('Successfully submited. Kindly continue with Additional Information.');</script>";
                    require_once 'importstudent.php';                                   

                    //Now eMail
                    $query="select * from tbl_smtp where status = 'active'";
                    $result = $mysqli->query($query);
                    if($row = $result->fetch_row()){
                        //SendGrid Gateway
                        if($row[0] == "sendgrid"){ 
                            require '../vendor/autoload.php'; // If you're using Composer (recommended)
                        
                            $email = new \SendGrid\Mail\Mail();
                            $email->setFrom("admission@champhaicollege.edu.in", "GCC");
                            $email->setSubject("You have been registered");
                            $email->addTo($_POST["email"], $_POST["fullname"]);
                            //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                            $email->addContent(
                                "text/html", '<html> 
                                <head> 
                                    <title>You can now login as a student</title> 
                                </head> 
                                <body> 
                                    <b>Dear '.$_POST["fullname"].'</b>,<br><br>
                                    <h1>Thank you for beng a good student!</h1> 
                                    <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                                        <tr> 
                                            <td align="left">Name:</td><td><h4><font color="green">' . $_POST["fullname"]. '</font></h4></td> 
                                        </tr> 
                                        <tr style="background-color: #e0e0e0;"> 
                                            <td align="left">University Reg #:</td><td><h4><font color="red">'. $_POST['ureg'] .'</font></h4></td> 
                                        </tr> 
                                        <tr> 
                                            <td align="left">Password:</td><td><h4><font color="green">'. date('dmY', strtotime($_POST['dob'])) .'</font></h4></td> 
                                        </tr> 
                                        <tr style="background-color: #e0e0e0;"> 
                                            <td align="left">Email:</td><td><h4><font color="red">'. $_POST["email"] .'</font></h4></td> 
                                        </tr>                                                 
                                    </table> <br>
                                    <p>
                                    You have been registered in the system. Kindly update your photo with your recent passport size photo.<br><br>
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
                            curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"GCC\",\n      \"email\":\"admission@champhaicollege.edu.in\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"  ". $_POST["email"]. " \",\n         \"name\":\" " . $_POST["fullname"] . " \"\n      }\n   ],\n   \"subject\":\"You have registered as student\",\n   \"htmlContent\":\"
                            <html> 
                                <head> 
                                    <title>You can now login as a student</title> 
                                </head> 
                                <body> 
                                    <b>Dear ".$_POST['fullname']."</b>,<br><br>
                                    <h1>Thank you for applying the Admission!</h1> 
                                    <table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
                                        <tr> 
                                            <td align='left'>Name:</td><td><h4><font color='green'>" . $_POST['fullname']. "</font></h4></td> 
                                        </tr> 
                                        <tr style='background-color: #e0e0e0;'> 
                                            <td align='left'>University Reg #:</td><td><h4><font color='red'>". $_POST['ureg'] ."</font></h4></td> 
                                        </tr> 
                                        <tr> 
                                            <td align='left'>Password:</td><td><h4><font color='green'>". date('dmY', strtotime($_POST['dob'])) ."</font></h4></td> 
                                        </tr> 
                                        <tr style='background-color: #e0e0e0;'> 
                                            <td align='left'>Email:</td><td><h4><font color='red'>". $_POST['email'] ."</font></h4></td> 
                                        </tr>                                                 
                                    </table> <br>
                                    <p>
                                    You have been registered in the system. Kindly update your photo with your recent passport size photo.<br><br>
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
                            $headers[] = 'Api-Key: ' . $row[1];
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
                }
                else{
                    echo "<script>toastr.error('Something went wrong! You can try again to submit your application.');</script>";
                    require_once 'importstudent.php';
                }
            }
            else{
                require_once 'importstudent.php';
            }
		}               
        require_once 'importstudent.php';     
    }
    else if ($requestType === 'GET'){
        if(isset($_GET['page'])){
            if($_GET['page'] === "dashboard"){
                require_once 'dashboard.php'; 
            }
            else if($_GET['page'] === "profile"){
                require_once 'profile.php'; 
            }
                else if($_GET['page'] === "pageedit"){
                    require_once 'pageeditor.php'; 
            }
            else if($_GET['page'] === "pagelist"){
                require_once 'pagelist.php'; 
            }
            else if($_GET['page'] === "newapplication" || $_GET['page'] === "admitted" || $_GET['page'] === "feepaid" || $_GET['page'] === "incomplete" || $_GET['page'] === "monitor" || $_GET['page'] === "rejected" || $_GET['page'] === "waiting" || $_GET['page'] === "approved" || $_GET['page'] === "allapp" || $_GET['page'] === "phyapplication"){
                require_once 'applicantdetails.php'; 
            }
            else if($_GET['page'] === "details"){
                require_once 'details.php'; 
            }
            else if($_GET['page'] === "userlist"){
                require_once 'userlist.php'; 
            }
            else if($_GET['page'] === "useredit"){
                require_once 'useredit.php'; 
            } 
            else if($_GET['page'] === "generalsetting"){
                require_once 'generalsetting.php'; 
            } 
            else if($_GET['page'] === "paymentlist"){
                require_once 'paymentlist.php'; 
            }  
            else if($_GET['page'] === "paymentdetail"){
                    require_once 'paymentdetail.php'; 
            } 
            else if($_GET['page'] === "addpayment"){
                    require_once 'paymentdue.php'; 
            } 
            else if($_GET['page'] === "collectfee"){
                    require_once 'collectfee.php'; 
            } 
            else if($_GET['page'] === "gateways"){
                    require_once 'gateways.php'; 
            }  
            else if($_GET['page'] === "admissionlist"){
                    require_once 'admissionlist.php'; 
            } 
            else if($_GET['page'] === "admissionedit"){
                    require_once 'admissionedit.php'; 
            }  
            else if($_GET['page'] === "feestructure"){
                    require_once 'feestructure.php'; 
            }
            else if($_GET['page'] === "addadmission"){
                    $GET['id'] = '';
                    require_once 'admissionedit.php'; 
            } 
            else if($_GET['page'] === "exportapplicants"){
                $GET['id'] = '';
                require_once 'exportapplicantlist.php'; 
            }   
            else if($_GET['page'] === "addstudent"){                
                //require_once 'addstudent.php'; 
				require_once 'addunistudent.php'; 
            }  
            else if($_GET['page'] === "addapplicant"){                
                require_once 'addapplicant.php'; 
            }  
            else if($_GET['page'] === "studentlist"){                
                require_once 'studentlist.php'; 
            }
            else if($_GET['page'] === "studentdetails"){                
                require_once 'studentdetails.php'; 
            }  
            else if($_GET['page'] === "importstudent"){                
                require_once 'importstudent.php'; 
            } 
            else if($_GET['page'] === "ustudfee"){                
                require_once 'ustudentfee.php'; 
            }    
            
            
            else{
                require_once 'dashboard.php';
            }                
        }
        else if(isset($_GET['action'])){
            if($_GET['action'] === "monitor"){
                //Send to pricipal for approval
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                $query = "insert into tbl_screening values(".$_GET['applicationid'].", 'monitor', '". $_SESSION['$name'] ."', '".$_SESSION['$legitUser']."', 'Found all correct.');";
                $query .= "update tbl_applicant set remark = 'monitor' where applicationid=".$_GET['applicationid'];
                $stmt = $mysqli->multi_query($query);
                $counter = 0;
                while ($row = $mysqli->next_result()) {
                    if (!$mysqli->more_results()) {break;}
                    $counter++;
                }
                //$counter = $mysqli->affected_rows;

                if($counter > 0){
                    echo "<script>toastr.success('Successfully sent to principal for approval!.');</script>";
                }   
            }
            else if($_GET['action'] === "approve"){
                //Update database
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                $feeamount = 0;
                $query = "select program from tbl_applicant where applicationid = " . $_GET['applicationid'];
                $result = $mysqli->query($query);
                $row = $result->fetch_row();

                $query = "select totalfee from tbl_fee_details where year = '1st' and programme = '" . $row[0] . "'";
                $result = $mysqli->query($query);
                $row = $result->fetch_row();
                $feeamount=(int)$row[0];

                //If taking Geography take more rs. 110
                $query = "select coresubject, electiveone, electivetwo, electivethree from tbl_applicant_subject_choice where applicationid = '".$_GET['applicationid']."';";
                $result = $mysqli->query($query);
                $row = $result->fetch_row();
                if($row[0] === "Geography" || $row[1] === "Geography" || $row[2] === "Geography" || $row[3] === "Geography"){
                    $feeamount += 110;
                }


                $query = "insert into tbl_screening values(".$_GET['applicationid'].", 'approved', '". $_SESSION['$name'] ."', '".$_SESSION['$legitUser']."', 'Found all correct.');";
                $query .= "update tbl_applicant set remark = 'approved' where applicationid=".$_GET['applicationid']. ";";
                $query .= "insert into tbl_applicant_payment (applicationid, feeamount, status) values(".$_GET['applicationid'].", " . $feeamount .", 'unpaid');";
                $stmt = $mysqli->multi_query($query);
                $counter = 0;
                while($mysqli->more_results()){
                    $counter += 1;
                    $row = $mysqli->next_result();
                }
                
                //$counter = $mysqli->affected_rows;

                if($counter > 0){
                    echo "<script>toastr.success('Successfully approved by the Principal!.');</script>";
                }   
                
                //Notify the user that his application is approved.
                $mobile = '';
                $name = '';
                $emailaddress = '';  
                
               
                //date_default_timezone_set('Asia/Kolkata');               
                $fixdate = " 05th July 2021";
                //$fixdate->add(new DateInterval('P3D'));
                       

                $query = "select mobile, fullname, email from tbl_applicant where applicationid = " . $_GET['applicationid'];
                $result = $mysqli->query($query);
                while($row = $result->fetch_row()){
                    $name = $row[1];
                    $mobile = $row[0];
                    $emailaddress = $row[2];
                }                   

                /*
                if($mobile !== ''){
                    //Successfully added into the database   
                
                    //Hetilai vel hi siam that a la ngai!
        
                    //send the applicant SMS and Email to confirm acceptance of the application. Send $id and $password
                            
                    //SMS first
                    $query="select * from tbl_smsconfiguration where isdefault = 1;";                    
                    $result = $mysqli->query($query);
                    if($row = $result->fetch_row()) { //MSG91
                        if($row[0] === "MSG91"){
                            //Your authentication key
                            $authKey = $row[1];
                        
                            //Multiple mobiles numbers separated by comma
                            $mobileNumber = $mobile;

                            $code = "+91";	
                        
                            if(strlen($mobileNumber) === 10){
                                    $mobileNumber = "91" . $mobileNumber;
                            }	
                        
                            if(strpos($mobileNumber, $code) !== false){
                                $mobileNumber = str_replace(['-', '+', '_'], '', $mobileNumber);
                            }                     

                            //Sender ID,While using route4 sender id should be 6 characters long.
                            $senderId = 'ZOBIZZ';
                        
                            //Registration - Student Provisional		                           

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60d0a429cf566959b06322b9\",\n  \"sender\": \"ZOBIZZ\",\n  \"mobiles\": \"" . $mobileNumber . "\",\n  \"name\": \"" . $name . "\",\n  \"date\": \"" . $fixdate . "\"}",
                            CURLOPT_HTTPHEADER => array(
                                                    "authkey: 36371AItp1I8JW5f534689P1",
                                                    "content-type: application/JSON"
                            ),
                            ));

                            $response = curl_exec($curl);
                            $err = curl_error($curl);

                            curl_close($curl);                                    
                        }
                        else {
                            //Different SMS Gateways
                        }

                    }                      
                }  */
                
                //Now eMail
                $query="select * from tbl_smtp where status = 'active'";
                $result = $mysqli->query($query);
                if($row = $result->fetch_row()){
                    //SendGrid Gateway
                    if($row[0] === "sendgrid22"){ 
                        require '../vendor/autoload.php'; // If you're using Composer (recommended)

                        $email = new \SendGrid\Mail\Mail();
                        $email->setFrom("admission@champhaicollege.edu.in", "GCC");
                        $email->setSubject("GCC admission application has been approved - Fee Regard");
                        $email->addTo($emailaddress, $name);
                        //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                        $email->addContent(
                            "text/html", '<html> 
                            <head> 
                                <title>Provisionally Admission for Accepted</title> 
                            </head> 
                            <body> 
                                <b>Dear ' . $name . '</b>,<br><br>
                                <h1>Thank you for applying the Admission!</h1>                                             
                                <p>
                                You have been provisionally registered and approved for Admission. Kindly pay the admission fee on or before <h3>' . $fixdate . '</h3> otherwise seat cannot be reserved. <br><br>
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

                        echo "<script>toastr.success('Successfully email sent!');</script>";  
                    }  
                    //SendInBlue Gateway
                    else {
    
                        $ch = curl_init();
                        
                        curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"GCC\",\n      \"email\":\"admission@champhaicollege.edu.in\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"  ". $emailaddress . " \",\n         \"name\":\" " . $name . " \"\n      }\n   ],\n   \"subject\":\"Your admission has been approved\",\n   \"htmlContent\":\"
                        <html> 
                        <head> 
                        <title>Provisionally Admission for Accepted</title> 
                        </head> 
                        <body> 
                        <b>Dear " . $name . "</b>,<br><br>
                        <h1>Thank you for applying the Admission!</h1>                                             
                        <p>
                        You have been provisionally registered and approved for Admission. Kindly pay the admission fee on or before <h3>5th July 2021</h3> otherwise seat cannot be reserved. <br><br>Click here to login <a href='https://gccadmission.online/applicantlogin.php'>https://gccadmission.online/applicantlogin.php</a><br><br><br>
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
                        $headers[] = 'Api-Key: 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';
                        $headers[] = 'Content-Type: application/json';
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        
                        $result = curl_exec($ch);
                        if (curl_errno($ch)) {
                            echo 'Error:' . curl_error($ch);
                        }
                        curl_close($ch);
                    } 
                        
                
                    }        
                    //Display Success message toast
                    //echo "<script>toastr.success('Successfully submitted!');</script>"; 
                                
            }
            else if($_GET['action'] === "reject"){
                    //Reject the application and send notification to principal
                    require_once '../config/dbconfig.php';
                    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                    $query = "insert into tbl_screening values(".$_GET['applicationid'].", 'rejected', '". $_SESSION['$name'] ."', '".$_SESSION['$legitUser']."', 'Rejected.');";
                    $query .= "update tbl_applicant set remark = 'rejected' where applicationid=".$_GET['applicationid'];
                    $query .= "delete from tbl_applicant_payment where applicationid=".$_GET['applicationid'];
                    $stmt = $mysqli->multi_query($query);
                    $counter = 0;
                    while ($row = $mysqli->next_result()) {
                        if (!$mysqli->more_results()) {break;}
                        $counter++;
                    }
                    //$counter = $mysqli->affected_rows;

                    if($counter > 0){
                        echo "<script>toastr.success('Successfully rejected!.');</script>";
                    }   

                    //Notify the user that his application is rejected.
                    $mobile = '';
                    $name = '';   
                    $emailaddress = '';                 
                    $query = "select mobile, fullname, email from tbl_applicant where applicationid = " . $_GET['applicationid'];
                    $result = $mysqli->query($query);
                    if($row = $result->fetch_row()){
                        $name=$row[1];
                        $mobile=$row[0];
                        $emailaddress = $row[2];
                    }
                    
                    //Now eMail
                    $query="select * from tbl_smtp where status = 'active'";
                    $result = $mysqli->query($query);
                    if($row = $result->fetch_row()){
                        //SendGrid Gateway
                        if($row[0] === "sendgrid"){ 
                            require '../vendor/autoload.php'; // If you're using Composer (recommended)

                            $email = new \SendGrid\Mail\Mail();
                            $email->setFrom("admission@champhaicollege.edu.in", "GCC");
                            $email->setSubject("GCC admission application has been rejected - Regard");
                            $email->addTo($emailaddress, $name);
                            //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                            $email->addContent(
                                "text/html", '<html> 
                                <head> 
                                    <title>Admission Application Rejected</title> 
                                </head> 
                                <body> 
                                    <b>Dear ' . $name . '</b>,<br><br>
                                    <h1>Thank you for applying the Admission!</h1>                                             
                                    <p>
                                    You have been provisionally in a rejected list. Kindly pay attention to your email or SMS for further communication if needed <br><br>
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

                            echo "<script>toastr.success('Successfully email sent!');</script>";  
                        }  
                        //SendInBlue Gateway
                        else if($row[0] === "sendinblue"){
                        
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"GCC\",\n      \"email\":\"admission@champhaicollege.edu.in\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"  ". $emailaddress . " \",\n         \"name\":\" " . $name . " \"\n      }\n   ],\n   \"subject\":\"Application Rejected\",\n   \"htmlContent\":\"
                            <html> 
                            <head> 
                            <title>Admission Rejected</title> 
                            </head> 
                            <body> 
                            <b>Dear " . $name . "</b>,<br><br>
                            <h1>Thank you for applying the Admission!</h1>                                             
                            <p>
                            You have been provisionally in a rejected list. Kindly pay attention to your email or SMS for further communication if needed. <br><br>
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
                            $headers[] = 'Api-Key: ' . $row[1];
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
            } 
            else if($_GET['action'] === "waiting"){
                //Reject the application and send notification to principal
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                $query = "insert into tbl_screening values(".$_GET['applicationid'].", 'waiting', '". $_SESSION['$name'] ."', '".$_SESSION['$legitUser']."', 'Found all correct.');";
                $query .= "update tbl_applicant set remark = 'waiting' where applicationid=".$_GET['applicationid'];
                $stmt = $mysqli->multi_query($query);
                $counter = 0;
                while ($row = $mysqli->next_result()) {
                    if (!$mysqli->more_results()) {break;}
                    $counter++;
                }
                //$counter = $mysqli->affected_rows;

                if($counter > 0){
                    echo "<script>toastr.success('Successfully added to waiting list!.');</script>";
                }   

                //Notify the user that his application is in Waiting List.
                $mobile = '';
                $name = ''; 
                $emailaddress = '';                   
                $query = "select mobile, fullname, email from tbl_applicant where applicationid = " . $_GET['applicationid'];
                $result = $mysqli->query($query);
                if($row = $result->fetch_row()){
                    $name=$row[1];
                    $mobile=$row[0];
                    $emailaddress = $row[2];
                }                

                //Now eMail
                $query="select * from tbl_smtp where status = 'active'";
                $result = $mysqli->query($query);
                if($row = $result->fetch_row()){
                    //SendGrid Gateway
                    if($row[0] === "sendgrid"){ 
                        require '../vendor/autoload.php'; // If you're using Composer (recommended)

                        $email = new \SendGrid\Mail\Mail();
                        $email->setFrom("admission@champhaicollege.edu.in", "GCC");
                        $email->setSubject("GCC admission application has been in waiting list - Regard");
                        $email->addTo($emailaddress, $name);
                        //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                        $email->addContent(
                            "text/html", '<html> 
                            <head> 
                                <title>Provisionally in Waiting List for Admission</title> 
                            </head> 
                            <body> 
                                <b>Dear ' . $name . '</b>,<br><br>
                                <h1>Thank you for applying the Admission!</h1>                                             
                                <p>
                                You have been provisionally in a waiting list and you may get a chance for Admission Approval. Kindly pay attention to your email or SMS. <br><br>
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

                        echo "<script>toastr.success('Successfully email sent!');</script>";  
                    }  
                    //SendInBlue Gateway
                    else if($row[0] === "sendinblue"){
    
                        $ch = curl_init();
                        
                        curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"GCC\",\n      \"email\":\"admission@champhaicollege.edu.in\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"  ". $emailaddress . " \",\n         \"name\":\" " . $name . " \"\n      }\n   ],\n   \"subject\":\"Application is Waiting list - GCC\",\n   \"htmlContent\":\"
                        <html> 
                        <head> 
                        <title>Provisionally Admission in Waiting List</title> 
                        </head> 
                        <body> 
                        <b>Dear " . $name . "</b>,<br><br>
                        <h1>Thank you for applying the Admission!</h1>                                             
                        <p>
                        You have been provisionally in a waiting list and you may get a chance for Admission Approval. Kindly pay attention to your email or SMS. <br><br>
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
                        $headers[] = 'Api-Key: ' . $row[1];
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
                    //echo "<script>toastr.success('Successfully submitted!');</script>"; 
            }
            else if($_GET['action'] === "delete"){
                //Delete the application
                require_once '../config/dbconfig.php';
                $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

                $query = "DELETE FROM tbl_applicant where applicationid=".$_GET['applicationid'].";";
                $query .= "DELETE FROM tbl_applicant_qualification where applicationid='".$_GET['applicationid']."';";
                $query .= "DELETE FROM tbl_applicant_subject_choice where applicationid='".$_GET['applicationid']."';";
                $query .= "DELETE FROM tbl_applicant_payment where applicationid=".$_GET['applicationid'];
                //$query .= "DELETE FROM tbl_screening where applicationid=".$_GET['applicationid'].";";

                $stmt = $mysqli->multi_query($query);
                $counter = 0;
                while ($row = $mysqli->next_result()) {
                    if (!$mysqli->more_results()) {break;}
                    $counter++;
                }
                $counter = $mysqli->affected_rows;

                if($counter > 0){
                    echo "<script>toastr.info('Successfully Deleted!.');</script>";
                }              
            }

            require_once 'dashboard.php'; 
        }
        else {
            require_once 'dashboard.php'; 
        }
    }
    else{
        require_once 'dashboard.php'; 
    }   

    include 'footer.php';  
?>