<?php

require_once 'config/dbconfig.php';
$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);


$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType == 'POST'){

    $query = "SELECT * FROM tbl_university_students WHERE universityroll = '" . $_POST['urollno'] . "';";
    $result = $mysqli->query($query);
    $row = $result->num_rows;
    if($row > 0){
        //Already Exist.

        
        echo "<script>alert('Your details are already in the database, you can proceed payment or download the receipt.');</script>";   
    }
    else{

        if($_POST['fullname'] === '' || $_POST['uregno'] === '' || $_POST['urollno'] === '' || $_POST['sessionyear'] === '' || $_POST['semester'] === '' || strlen($_POST['urollno']) <= 8){
            include 'ustudentfee.php';
            echo "<script>alert('Please fill all the fields.');</script>";
            die;
        }

        $query = "insert into tbl_university_students values
        ('" . $_POST['programme'] . "','" . $_POST['sessionyear'] . "','" . $_POST['semester'] . "', '" . $_POST['fullname'] . "',
        '" . $_POST['uregno'] . "','" . $_POST['urollno'] . "');";
                        
        $stmt = $mysqli->prepare($query);
        $stmt->execute();          
        

        if($stmt->affected_rows > 0){
            $query = "insert into tbl_applicant_corepaper values('" . $_POST['urollno'] . "','" . $_POST['coresubject'] . "');";
            $stmt = $mysqli->prepare($query);
            $stmt->execute(); 
            echo "<script>alert('Successfully added.');</script>";  
        }
        else{
        echo "<script>alert('Something went wrong! You can try again to submit your application.');</script>";        
        }
    }   


    include 'ustudentfee.php';


    //echo '<html><head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head><body>';
    
    //echo '<p align="center"><a class="btn btn-success" href="/ustudentfee.php" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Pay your Fee Now</a></p>';

    //echo '</body></html>';
    //die;
}


?>