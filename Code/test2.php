<?php

require_once 'config/dbconfig.php';
$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

$query = "SELECT applicationid, fullname, mobile FROM tbl_applicant WHERE remark = 'feepaid';";
$result = $mysqli->query($query);

while($row = $result->fetch_row()){

        //SMS first
       
        //Multiple mobiles numbers separated by comma
        $mobileNumber = str_replace(' ', '', $row[2]);
        $code = "+91";		

        if(strlen($mobileNumber) === 10){
                $mobileNumber = "91" . $mobileNumber;
        }	

        if(strpos($mobileNumber, $code) !== false){
            $mobileNumber = str_replace(['-', '+', '_'], '', $mobileNumber);
        }		

        $qr = "SELECT feeamount FROM tbl_applicant_payment WHERE applicationid = '".$row[0]."';";
        $rs = $mysqli->query($qr);
        $rw = $rs->fetch_row();

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
        CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"60d0a4620dba13425d2430d6\",\n  \"sender\": \"ZOBIZZ\",\n  \"mobiles\": \"" . $mobileNumber . "\",\n  \"name\": \"" . $row[1] . "\",\n  \"amount\": \"" . $rw[0] . "\"}",
        CURLOPT_HTTPHEADER => array(
                                "authkey: 36371AItp1I8JW5f534689P1",
                                "content-type: application/JSON"
        ),
        ));
                            
        $response = curl_exec($curl);
        $err = curl_error($curl);
                            
        curl_close($curl);
        
        echo "Successfully SMS Sent. " . $response . "<br>";

}