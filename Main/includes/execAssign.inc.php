<?php

session_start();

if(isset($_POST["submit"])){

    
    $delId = $_POST["delId"];
    $committee = $_POST["committee"];
    $country = $_POST["country"];
    
    
    

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($committee, $country, $delId ) !== false){
        header("location: ../executive.php?error=emptyInput");
        exit();
    }
    

    assignCommittee($conn, $delId, $committee, $country);

}
else{
    header("location: ../completeRegistration.php");
    exit();
}