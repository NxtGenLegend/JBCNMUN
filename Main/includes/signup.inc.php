<?php

if(isset($_POST["submit"])){

    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["rePwd"];
    $reEmail = $_POST["reEmail"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($email,$pwd,$pwdRepeat, $reEmail) !== false){
        header("location: ../register.php?error=emptyInput");
        exit();
    }

    else if(invalidEmail($email) !== false){
        header("location: ../register.php?error=invalidEmail");
        exit();
    }

    else if(pwdMatch($email, $reEmail) !== false){
        header("location:../register.php?error=emailMatchError");
    }

    else if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../register.php?error=pwdMatchError");
        exit();
    }

    else if(emailExists($conn, $email) !== false){
        header("location: ../register.php?error=emailAlreadyRegistered");
        exit();
    }
    else{
    createUser($conn, $email, $pwd);
    }


}
else{
    header("location: ../register");
    exit();
}