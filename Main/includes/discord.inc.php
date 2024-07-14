<?php

session_start();
    
    $delId = $_SESSION["delId"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $query = "UPDATE  deldata SET discordStatus = 'clicked' WHERE delId =".$delId;
    if ($conn->query($query)) {
        header("location: https://discord.com/register");
    } else {
        echo $conn->error;
    }

