<?php

session_start();    
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $delId = $_SESSION["delId"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $preference = getPreference($conn, $delId);

    $query = "UPDATE  deldata SET paymentStatus = 'processing' WHERE delId =".$delId;
    if ($conn->query($query)) {
        
        if($preference["committee1"] !== "gmc"){
            header("location: https://www.schoolpay.co.in/form_generator/view.php?id=135670");
        }
        else{
            header("location:https://www.schoolpay.co.in/form_generator/view.php?id=136975");
        }
    } else {
        echo $conn->error;
    }

