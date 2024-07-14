<?php
require_once('header.inc.php');

require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

if (!isset($_SESSION["userId"])) {
    header("location:register");
}

$delData = getStatus($conn);


if ($delData !== null) {
    $_SESSION["delId"] = $delData["delId"];
    $_SESSION["delName"] = $delData["delName"];
    $_SESSION["committee"] = $delData["committee"];
    $_SESSION["country"] = preg_replace('/\s+/', '',    $delData["country"]);
    $_SESSION["paymentStatus"] = $delData["paymentStatus"];
    $_SESSION["discordStatus"] = $delData["discordStatus"];
    if ($data = getPreference($conn, $delData["delId"])) {
        $_SESSION["pId"] = $data["pId"];
    }
};
?>


<div class="navbar">
    <div class="left TopNav">
        <div class="logo"><img class="mainLogo" src="assets/jbcnLogo.png" alt=""></div>
        <div class="pageName">Welcome to the JBCN MUN Dashboard</div>
    </div>
    <div class="right TopNav">
        <div class="name">
            <h2><?php 
                if(isset($_SESSION["delName"])){
                    echo $_SESSION["delName"];
                } else{
                    echo "Registration Incomplete";    
                }
                ?>
            </h2>
            <p>
                <?php 
                    if(isset($_SESSION["committee"]) && isset($_SESSION["country"])){
                        echo $_SESSION["committee"].", ".$_SESSION["country"];
                    } else{
                        echo "";    
                    }
                ?>
            </p>
        </div>
        <div class="logo">
            <?php 
                if($_SESSION["country"] == "unassigned"){                
                    echo '<span class="enlarged fi fi-un"></span>';
                } else{
                    echo'<span class="enlarged fi fi-'.$_SESSION["country"].'"></span>';
                }
            ?>
            
        </div>
    </div>
</div>

<div class="leftNav">
    <div class="sidenav">
        <table class="navTable">
            <tr class="navRow">
                
                    <td class="sideNavItem" style="text-align:right;"><a href="index" class="navLink"><i class="fa-solid fa-house"></i></a></td>
                    <td class="sideNavItem" style="text-align:left;"><a href="index" class="navLink">Home</a></td>
                </a>
            </tr>
            <tr class="navRow">
                <a href="" class="navLink">
                    <td class="sideNavItem" style="text-align:right;"><i class="fa-solid fa-book"></i></td>
                    <td class="sideNavItem" style="text-align:left;">Resources</td>
                </a>
            </tr>
            <tr class="navRow">
                <a href="" class="navLink">
                    <td class="sideNavItem" style="text-align:right;"><i class="fa-solid fa-calendar"></i></td>
                    <td class="sideNavItem" style="text-align:left;">Schedule</td>
                </a>
            </tr>
            <tr class="navRow">
                <a href="" class="navLink">
                    <td class="sideNavItem" style="text-align:right;"><i class="fa-solid fa-envelope"></i></td>
                    <td class="sideNavItem" style="text-align:left;">Contact</td>
                </a>
            </tr>
            <tr class="navRow">
                <a href="" class="navLink">
                    <td class="sideNavItem" style="text-align:right;"><i class="fa-solid fa-bell"></i></td>
                    <td class="sideNavItem" style="text-align:left;">Alerts</td>
                </a>
            </tr>
            <tr class="navRow">
                <a href="" class="navLink">
                    <td class="sideNavItem" style="text-align:right;"><i class="fa-solid fa-image"></td>
                    <td class="sideNavItem" style="text-align:left;">Gallery</td>
                </a>
            </tr>
            <tr class="navRow">
                <a href="" class="navLink">
                    <td class="sideNavItem" style="text-align:right;"><i class="fa-solid fa-map"></i></td>
                    <td class="sideNavItem" style="text-align:left;">Country Matrix</td>
                </a>
            </tr>
            <tr class="navRow">
                    <td class="sideNavItem" style="text-align:right;"><a href="includes/logout.inc.php" class="navLink"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></td>
                    <td class="sideNavItem" style="text-align:left;"><a href="includes/logout.inc.php" class="navLink">Logout</a></td>
            </tr>
        </table>

    </div>
    <div class="bottomNav">
        <div class="logo">
            <img class="sideLogo" src="assets/jbcnLogo.png" alt="">
            <br><br>
            <p class="center">Built By Scorpyn</p>

        </div>
        <div class="social">
            <div class="socialIcon"><i class="fa-brands fa-instagram"></i></div>
            <div class="socialIcon"><i class="fa-brands fa-facebook-square"></i></div>
            <div class="socialIcon"><i class="fa-brands fa-twitter-square"></i></div>
        </div>
    </div>
</div>