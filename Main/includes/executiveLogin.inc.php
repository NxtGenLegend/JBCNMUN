<?php

session_start();

if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $true = "True";

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($username,$pwd) !== false){
        header("location: ../executiveLogin.php?error=emptyInput");
        exit();
    }
    else if($username == "finance@jnisiyc.com" AND $pwd == "JNISMoney@2021"){
        $_SESSION["validExec"] = $true;
        header("location:../finance.php");
    }

    else if($username == "chat@jnisiyc.com" AND $pwd == "JNISChat@2021"){
        header("location:../execChat.php");
        $_SESSION["validExec"] =$true;
    }

    else if($username != "executive@jnisiyc.com" || $pwd != "JNISExec@2021"){
        header("location:../executiveLogin.php?error=incorrectPassword");
    }
    
   

    else{
        $_SESSION["validExec"] = $true;
        header("location: ../executive");
    }
}
else{
    header("location: ../executiveLogin");
    exit();
}