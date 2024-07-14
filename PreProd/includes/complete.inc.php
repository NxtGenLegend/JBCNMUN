<?php

session_start();

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $school = $_POST["school"];
    $grade = $_POST["grade"];
    $division = $_POST["division"];
    $munXP = $_POST["munXP"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputComplete($name, $mobile, $school, $grade, $munXP) !== false){
        header("location: ../completeRegistration.php?error=emptyInput");
        exit();
    }
    if(invalidMobile($mobile) !== false){
        header("location: ../completeRegistration.php?error=invalidMobile");
        exit();
    }

    $userId = $_SESSION["userId"];


    
    completeRegistration($conn, $name, $mobile, $school, $grade, $division, $munXP, $userId);


}
else{
    header("location: ../completeRegistration.php");
    exit();
}