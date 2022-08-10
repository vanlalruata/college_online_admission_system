<?php
require_once 'config/dbconfig.php';
$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);   

$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType == 'POST'){
    if(isset($_POST['action']) && $_POST['action'] === 'updatecore'){
        

        $query = "update tbl_applicant_corepaper set coresubject = '".$_POST['coresubject']."' where universityroll = '" .$_POST['urollno']. "';";
        $stmt = $mysqli->prepare($query);   
        $stmt->execute(); 

        if($stmt->affected_rows > 0){
            echo "<script>alert('Successfully Updated.');</script>";  
        }
        else{            
            $query = "insert into tbl_applicant_corepaper values('" .$_POST['urollno']. "', '".$_POST['coresubject']."');";
            $stmt = $mysqli->prepare($query);   
            $stmt->execute();
            echo "<script>alert('Successfully Updated.');</script>";      
        }
    }
}