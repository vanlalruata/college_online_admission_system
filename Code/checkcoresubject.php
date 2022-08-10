<?php

require_once 'config/dbconfig.php';
$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

//$query = "SELECT applicationid, program, fullname, dateofbirth, gender, religion, category, mobile, email, fathername, fathermobile, mothername, mothermobile, permanentaddress, localguardian, guardianmobile, localaddress, bloodgroup, aadhaar, voterid, classxiirollno FROM tbl_applicant WHERE remark = 'feepaid' ORDER BY applicationid;";

$query = "SELECT * FROM tbl_university_students ORDER BY universityroll;";

$result = $mysqli->query($query);
while($row = $result->fetch_row()){

    echo $row[0]. ',' . $row[1] . ',' . $row[2] . ','. ucfirst($row[3]) . ','. $row[4]. ','. $row[5];

    //echo $row[0] . ',' . $row[1] . ',' . $row[2] . ','. $row[3] . ','. $row[4] . ','. $row[5] . ',' . $row[6] . ',' . $row[7]  . ',' . $row[8] . ',' . $row[9] . ','. $row[10] . ',' . $row[11] . ',' . $row[12] . ',' . str_replace(',', ' ', $row[13]) . ',' . $row[14] . ',' . $row[15]. ',' . str_replace(',', ' ', $row[16]) . ',' . $row[17] . ',' . $row[18] . ',' . $row[19] . ',' . $row[20] . ','. $row[21];
    
    //Core Subject
    $qr = "SELECT * FROM tbl_applicant_corepaper WHERE universityroll = '". $row[5] ."';";

    //Subject Combination
    //$qr = "SELECT * FROM tbl_applicant_subject_choice WHERE applicationid = '".$row[0]."';";
    
    $rs = $mysqli->query($qr);
    if($rw = $rs->fetch_row()){
        echo ','. $rw[1];
        //echo ',', $rw[2] . ',', $rw[3] . ',', $rw[4];
    }
    else{
        echo ', ';
        //echo ', , , ';
    }

    //Payment Details
    $qrt = "SELECT * FROM tbl_applicant_payment WHERE applicationid = '".$row[5]."';";
    $rst = $mysqli->query($qrt);
    if($rwt = $rst->fetch_row()){
        echo ',' . $rwt[1] . ',' . $rwt[2] . ',' . $rwt[4] . ',' . $rwt[5] . ',' . $rwt[3];
    }
    else{
        echo ', 0.00, None, None, None, Unpaid';
    }
    echo '<br>';
}


?>