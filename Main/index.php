<?php

require_once("dashboardHeader.php");

?>



</container>
<div class="hero">
<div class="sidebar">
        <a href="" class="sideItem"></a>
        <a href="" class="sideItem"></a>
        <a href="" class="sideItem"></a>
        <a href="" class="sideItem"></a>
        <a href="" class="sideItem"></a>
        <a href="" class="sideItem"></a>
        <a href="" class="sideItem"></a>
    </div>



<div class="contentHolder">
    <br>

    <div class="container">
        <div class="gridItem registerStatus">Registration Status<br>
            <div class="registerIndicator">
                <?php if (isset($_SESSION["delName"])) {
                    echo "<br><p>Complete</p>
                <img src='img/complete.png' alt='green-tick' class='indicator complete'></div>";
                } else {
                    echo "<p>Pending </p>
                <img src='img/pending.png' alt='caution' class='indicator complete'>
                <a href='completeRegistration'>
                <div class='registerFull'> Complete Registration </div>
            </a></div>";
                }

                ?>

            </div>
            <div class="gridItem statusIndicators">
                <div class="message">
                    <?php
                    ?>
                    <img src='img/IYC Logo.png' alt='IYC' class='logo'>

                    <div class='messageContent'>
                        <h7>Dear delegates, <br>
                            Welcome to registration. <br>
                            The decisions you make in this registration allow us to better understand your preferences in Committee & Country- at the diplomat's table, the rest of the world turns blurry- no country remains too small, or too insignificant.</h7>
                    </div>
                </div>
            </div>
            <div class="gridItem profile" id='profile'>
                <p>Profile</p>
                <?php
                if (isset($_SESSION["delId"])) {
                    $delId = $_SESSION["delId"];
                    $sql = "SELECT * FROM deldata WHERE delId=?"; // SQL with parameters
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $delId);
                    $stmt->execute();
                    $result = $stmt->get_result(); // get the mysqli result
                    $pId = $result->fetch_assoc();
                    $_SESSION["committee"] = $pId["committee"];
                    echo "

                
                <br>
                <table class='demo'>

                    <tbody>
                        <tr>
                            <td>Full Name</td>
                            <td>" . $pId["delName"] . "</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>" . $_SESSION["email"] . "</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>" . $pId["delMobile"] . "</td>
                        </tr>
                        <tr>
                            <td>School</td>
                            <td>" . $pId["delSchool"] . "</td>
                        </tr>
                        <tr>
                            <td>Grade</td>
                            <td>" . $pId["delGrade"] . "</td>
                        </tr>
                        <tr>
                            <td>Division</td>
                            <td>" . $pId["delDivision"] . "</td>
                        </tr>
                        <tr>
                            <td>MUN Experience</td>
                            <td>" . $pId["delMunXP"] . "
                        <tr>
                            <td>Committee</td>
                            <td>" . $pId["committee"] . "</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>" . $pId["country"] . "</td>
                        </tr>
                    <tbody>
                </table>";
                } else {
                    echo "<br><div> Please Complete Registration to View Profile</div>";
                } ?>
            </div>
            <div class="gridItem techManual">Tech Manual
                <a href='resources/techManual.pdf'>
                    <img src="img/pdf.png" class='techpdf' alt=""><br>
                    IYC Tech Manual.pdf
                </a>
                <br>
                Conference Schedule
                <a href="resources/conferenceSchedule.pdf">
                <img src="img/pdf.png" class='techpdf' alt=""><br>
                    IYC Conference Schedule.pdf
                </a>
            </div>
            <div class="gridItem links">

                <?php
                if (isset($_SESSION["paymentStatus"]) && $_SESSION["paymentStatus"] === 'complete') {
                    echo "
                        Conference Links and Schedule [Day 1]
                        <table class='conferenceLinks'>
                            <tr>
                                <td colspan='2'> Opening Ceremony<br> [9:00 am to 10:00 am]</td>
                            </tr>
                            <tr>
                                <td colspan='2'> Break <br>[10:00 am to 10:30 am]</td>
                            </tr>
                            <tr>
                                <td colspan='2'> Chairs' Address<br> [10:30 am to 11:00 am]</td>
                            </tr>
                            <tr>
                                <td colspan='2'> Session 1 <br>[11:00 am to 1:00 pm]</td>
                            </tr> 
                            <tr>
                                <td colspan='2'> Lunch <br>[1:00 pm to 2:00 pm]</td>
                            </tr> 
                            <tr>
                                <td colspan='2'> Session 2 <br>[2:00 pm to 4:00 pm] </td>
                            </tr>
                            <tr>
                                <td colspan='2'> Night Crisis <br> [6:30 pm to 8:30 pm] </td>
                            </tr>
                        </table>

                    ";
                } else {
                    echo "<p>Please Register First</p>";
                }
                ?>

            </div>


            <div class="gridItem welcomeMessage">

                <div class="statusInd">
                    <h6 class="status">Committee <br> Preference:</h6>
                    <?php if (isset($_SESSION["pId"])) {
                        echo "<p>Selected </p>
            <img src='img/complete.png' alt='green-tick' class='indicator complete'>";
                    } else if (isset($_SESSION["delId"])) {
                        echo "<p>Not Selected </p>
            <img src='img/pending.png' alt='caution' class='indicator complete'>
            <a href='preference'>
            <div class='registerFull'> Select Preference </div>
            </a>";
                    } else {
                        echo "<p>Registration Incomplete</p>
                <img src='img/pending.png' alt='caution' class='indicator complete'>
                <a href='completeRegistration'>
                    <div class='registerFull'> Complete Registration </div>
                </a>";
                    }

                    ?>
                </div>

                <div class="statusInd">
                    <h6 class="status">Registration<br> Fees:</h6>
                    <?php if (isset($_SESSION["paymentStatus"])) {
                        if ($_SESSION["paymentStatus"] === "complete") {
                            echo "<p>Paid </p>
                   <img src='img/complete.png' alt='green-tick' class='indicator complete'>";
                        } else if ($_SESSION["paymentStatus"] === "processing") {
                            echo "<p>Processing </p><br>
                    <img src='img/processing.png' alt='processing' height='110px' width='110px'>
                    <p> Please wait while<br> our finance team <br> confirms your payment</p>";
                        } else {
                            echo "<p>Pending </p>
                    <img src='img/pending.png' alt='caution' class='indicator complete'>
                    <a href=' includes/payment.inc.php'>
                    <div class='registerFull'> Complete Payment </div>
                    </a>";
                        }
                    } else {
                        echo "<p>Registration Incomplete</p>
                <img src='img/pending.png' alt='caution' class='indicator complete'>
                <a href='completeRegistration' method='POST' value = 'submit'>
                    <div class='registerFull'> Complete Registration </div>
                </a>";
                    }

                    ?>
                </div>

                <div class='statusInd'>
                    <h6 class="status">Delegate<br>chat:</h6>
                    <?php if (isset($_SESSION["discordStatus"])) {
                        if ($_SESSION["discordStatus"] === "complete") {
                            echo "<p>Activated </p>
                   <img src='img/complete.png' alt='green-tick' class='indicator complete'>";
                        } else if ($_SESSION["discordStatus"] === "clicked") {
                            echo "<p>Chat Not Joined </p><br>
                    <img src='img/processing.png' alt='processing' height='110px' width='110px'>
                    <a href='#openPopup'>    
                    <div class='registerFull'> Join Chat </div>
                    </a>";
                        } else {
                            echo "<p>Not Activated </p>
                            <img src='img/pending.png' alt='caution' class='indicator complete'>
                            <a href='#openPopup'>   
                            <div class='registerFull' onclick='pop.open('Title', 'Text')' value='Show'> Create Account </div>
                            </a>";
                        }
                    } else {
                        echo "<p>Registration Incomplete</p>
                <img src='img/pending.png' alt='caution' class='indicator complete'>
                <a href='completeRegistration' method='POST' value = 'submit'>
                    <div class='registerFull'> Complete Registration </div>
                </a>";
                    }

                    ?>
                </div>


                </div>



            </div>