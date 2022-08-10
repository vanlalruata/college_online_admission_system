<?php
    require_once '../config/dbconfig.php';
    $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

    $division = $percent = $board = $institute = $admissiondate = $feepaid = $transactionid = $admissiontime = $coresubject = $electiveone = $electivetwo = '';


    echo 'App ID,Program,Fullname,DoB,Gender,Religion,Category,Mobile,Email,Father Name,Father Mobile,Mother Name,Mother Mobile,Permanent Address,Current Address,Guardian Name,Guardian Mobile,Blood Grp,Aadhaar,Voter ID,Class XII,Transaction ID,Payment Date,Payment Time,Fee Amount,Board,Institute,Division,Percentage,Core,Elective 1,Elective 2<br>';

    $query = "select applicationid,program,fullname,dateofbirth,gender,religion,category,mobile, email,fathername,fathermobile,mothername,mothermobile,permanentaddress,localaddress,localguardian,guardianmobile,bloodgroup,aadhaar,voterid,classxiirollno from tbl_applicant where remark = 'feepaid' ORDER BY program;";
    $result = $mysqli->query($query);
    while($row=$result->fetch_row()){

        //Division and Last Institution
        $qr = "SELECT divisiongrade, institute, percentage, board FROM `tbl_applicant_qualification` WHERE `applicationid` = '".$row[0]."' AND examinationpassed NOT LIKE 'HSLC%';";
        $rs = $mysqli->query($qr);                                
        while($rw=$rs->fetch_row()){
            $division = $rw[0];
            $institute = $rw[1];
            $percent = $rw[2];
            $board = $rw[3];
        }

        //Admission Date
        $qr = "SELECT transactionid, paymentdate, paymenttime, feeamount FROM `tbl_applicant_payment` WHERE `applicationid` = '".$row[0]."';";
        $rs = $mysqli->query($qr);                                
        while($rw=$rs->fetch_row()){
            $transactionid = $rw[0];
            $admissiondate = $rw[1];
            $admissiontime = $rw[2];      
            $feepaid = $rw[3];      
        }

        //Subject Combination
        $qr = "SELECT coresubject, electiveone, electivetwo FROM `tbl_applicant_subject_choice` WHERE `applicationid` = '".$row[0]."';";
        $rs = $mysqli->query($qr);                                
        while($rw=$rs->fetch_row()){
            $coresubject = $rw[0];
            $electiveone = $rw[1];
            $electivetwo =  $rw[2];          
        }

        echo $row[0] . ',' . $row[1]  . ',' . $row[2]  . ',' . $row[3]  . ',' . $row[4]  . ',' . $row[5]  . ',' . $row[6]  . ',' .  $row[7]  . ',' . $row[8]  . ',' . $row[9]  . ',' . $row[10]  . ',' . $row[11]  . ',' . $row[12]  . ',' . str_replace(',',' ', $row[13]) . ',' . str_replace(',',' ', $row[14]) . ',' . $row[15] . ',' . $row[16] . ',' . $row[17] . ',' . $row[18] . ',' . $row[19] . ',' . $row[20] . ',' . $transactionid . ',' . $admissiondate . ',' . $admissiontime . ',' . $feepaid . ',' . str_replace(',',' ', $board) . ',' . str_replace(',',' ', $institute) . ',' . str_replace(',',' ', $division) . ',' . str_replace(',',' ', $percent) . ',' . $coresubject  . ',' . $electiveone   . ',' . $electivetwo . '<br>';

    }

?>