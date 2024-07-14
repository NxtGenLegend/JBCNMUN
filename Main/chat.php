

<?php

require_once 'includes/dbh.inc.php';
 require_once 'includes/functions.inc.php';


session_start();

$delData = getStatus($conn);


if ($delData !== null) {
    $_SESSION["delId"] = $delData["delId"];
    $_SESSION["delName"] = $delData["delName"];
    $_SESSION["committee"] = $delData["committee"];
    $_SESSION["country"] = $delData["country"];
    $_SESSION["paymentStatus"] = $delData["paymentStatus"];
    $_SESSION["discordStatus"] = $delData["discordStatus"]; 
    if ($data = getPreference($conn, $delData["delId"])) {
        $_SESSION["pId"] = $data["pId"];
    }
};

 getGroupChatContent($conn, $_SESSION["committee"], "all");

          
          
          
     ?>  