<?php

session_start();

if(isset($_POST["submit"])){

    
    $committee = $_POST["committee"];
    $country = $_POST["position"];
        
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

  
    $_SESSION["committee"] = $committee;
    $_SESSION["country"] = $country;
    header("location:../execChat.php");
}
else{
    header("location: ../completeRegistration.php");
    exit();
}