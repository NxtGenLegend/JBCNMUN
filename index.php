<?php

require_once('includes/dashboardHeader.inc.php');

?>


<div class="main">
    <div class="mainGrid">
        <div class="gridItem schedule">
            <!-- <iframe src="https://calendar.google.com/calendar/embed?src=kjh2l868i5c9ktf286glt0mgv0%40group.calendar.google.com&ctz=Asia%2FKolkata" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe> -->
            <h1 class="center">Schedule</h1>
            <br>
            Conference Schedule Coming Soon!
        </div>

        <div class="gridItem resources">
            <h1 class="center">Resources</h1>
            <iframe src="https://drive.google.com/embeddedfolderview?id=1Vwbr5MQZiw27zIGHGLiqtpu27xjXIH4v#list" style="width:100%; height:100%; border:0;"></iframe>
        </div>
        <div class="gridItem profile">
            <h1>Profile</h1>
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
                echo "<a href='completeRegistration'><div class='registerFull'> Complete Registration </div></a>";
            } ?>
        </div>
        <div class="gridItem paymentstatus">
            <div class="statusInd">
                <h6 class="status">Committee <br> Preference:</h6>
                <?php if (isset($_SESSION["pId"])) {
                    echo "<p>Selected </p>
            <img src='img/complete.png' alt='green-tick' class='indicator complete'></img>";
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
            <br>
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
            

        </div>
    </div>


</div>