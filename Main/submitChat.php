<?php

require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';


session_start();

$delData = getStatus($conn);

    $message = $_POST["message"];
    $receiverCountry= $_GET["location"];
    $_SESSION["position"] = $_GET["position"];
    $author = $_SESSION["country"];
    $receiverCommittee = $_SESSION["committee"];
    $mId = $_SESSION[$receiverCountry];

 /*    print $message; 
    print $receiverCommittee; 
    print $receiverCountry;
    print $author; */


 if(isset($_POST["reset"])){
     markRead($conn, $mId);
          header("location:muntools".$_SESSION["position"]);

 }else if(isset($_POST["submit"])){
    
    sendMessage($conn, $author, $receiverCommittee, $receiverCountry, $message);
     header("location:muntools".$_SESSION["position"]);}
 


