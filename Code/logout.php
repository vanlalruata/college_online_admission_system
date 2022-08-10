<?php
try{
    if(empty($_SESSION)){
      session_start();
    }
    
    session_destroy();
    if (!isset( $_SERVER['HTTP_HOST'] ) ) {
      $_SERVER['HTTP_HOST'] = 'localhost';
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
catch(Exception $e) {
    //echo 'Message: ' .$e->getMessage();
  }
?>