<?php

session_start();

if(isset($_POST["submit"])){

    $committee1 = $_POST["committee1"];
    $country1a = $_POST["country1a"];
    $country1b = $_POST["country1b"];
    $country1c = $_POST["country1c"];
    
    $committee2 = $_POST["committee2"];
    $country2a = $_POST["country2a"];
    $country2b = $_POST["country2b"];
    $country2c = $_POST["country2c"];
    
    $committee3 = $_POST["committee3"];
    $country3a = $_POST["country3a"];
    $country3b = $_POST["country3b"];
    $country3c = $_POST["country3c"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($committee1, $country1a, $country1b ) !== false){
        header("location: ../preference.php?error=emptyInput");
        exit();
    }
    

    $delId = $_SESSION["delId"];

    assignPreference($conn, $committee1, $country1a, $country1b, $country1c, $committee2, $country2a, $country2b, $country2c,$committee3, $country3a, $country3b, $country3c, $delId);
    
    $data = getPreference($conn, $delId);
    print_r($data);
    

}
else{
    header("location: ../completeRegistration");
    exit();
}