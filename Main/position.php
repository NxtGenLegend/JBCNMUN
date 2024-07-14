<?php

    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    
    
    session_start();
    
    echo $_SESSION["position"];
?>