<?php

session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST["submit"])){

    
    $userId = $_POST["userId"];
    $delName = $_POST["delName"];
    $status = $_POST["status"];
    
    
    

   

    if(emptyInputSignup($userId, $delName, $status ) !== false){
        header("location: ../finance.php?error=emptyInput");
        exit();
    }
    

    assignFinance($conn, $userId, $delName, $status );

}else if(isset($_POST["reset"])){
    
    resetFinance($conn);
}
else{
    header("location: ../completeRegistration");
    exit();
}