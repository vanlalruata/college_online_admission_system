<?php

require_once 'config/dbconfig.php';
$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);


$query = "SELECT `fullname`,`applicationid`,`dateofbirth`,`mobile`, `email` FROM `tbl_applicant` WHERE `remark` = 'approved' ORDER BY `applicationid` ASC;";
//$query = "SELECT `fullname`,`applicationid`,`dateofbirth`,`mobile`, `email` FROM `tbl_applicant` WHERE `bloodgroup` IS NULL OR `remark` IS NULL ORDER BY `applicationid` ASC;";
$result = $mysqli->query($query);

while($row = $result->fetch_row()){

    $ch = curl_init();  			
    curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\"sender\":{\n\"name\":\"Govt Champhai College\",\n\"email\":\"admission@champhaicollege.edu.in\"\n},\n   \"to\":[\n{\n\"email\":\"".$row[4]."\",\n\"name\":\"".$row[0]."\"\n}\n],\n\"subject\":\"Govt Champhai College Admission: Regard\",\n
    \"htmlContent\":\"<html><body>Dear ".$row[0].",<br><br>Kindly complete your application and also kindly pay the admission fee on or before 5th July 2021 inorder to avoid the late fee.<br><br>Your Application ID is <b>".$row[1]."</b><br>Your Password is <b>". date('dmY', strtotime($row[2]))."</b><br><br><br>You can login using <a href='https://gccadmission.online/applicantlogin.php'>https://gccadmission.online/applicantlogin.php</a><br><br><br>Regards,<br><br>Principal<br>Govt Champhai College<br>Champhai, Mizoram</body></html>\"}");

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
    echo $rs . '<br>';
} 

  

/* while($row = $result->fetch_row()){
    $authKey = "36371AItp1I8JW5f534689P1";
			
		//Multiple mobiles numbers separated by comma
		$mobileNumber = str_replace(' ', '', $row[3]);
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
        CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60d0a429cf566959b06322b9\",\n \"sender\": \"" . $senderId . "\",\n \"name\": \"" . $row[0] . "\",\n \"date\": \"05th July 2021\"}",
        CURLOPT_HTTPHEADER => array(
                                "authkey: 36371AItp1I8JW5f534689P1",
                                "content-type: application/JSON"
        ),
        ));
                            
        $response = curl_exec($curl);
        $err = curl_error($curl);
                            
        curl_close($curl); 

        echo 'Sent to: ' . $mobileNumber . ' Full Name: ' . $row[0] . '<br>';

} */