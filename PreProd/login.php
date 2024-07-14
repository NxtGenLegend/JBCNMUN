<?php

    include_once("includes/header.inc.php");
?>




    <container class="pageHolder">

<!--         <div class="signup-form background-graphic-dark"></div>
 -->
<!--         <div class="signup-form background-graphic">
 -->
        </div>

        <div class="signup-form">
            <div class="imgholder">
                <img src="assets/jbcnLogo.png" alt="" class="logo">
            </div>
            <form action="includes/login.inc.php" class="signup" method="POST">
                <h6 class="formTitle">Delegate Log In</h6>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyInput") {
                        echo "<p> Please fill all fields</p>";
                    } else if ($_GET["error"] == "invalidEmail") {
                        echo "<p> Please enter valid email</p>";
                    } else if ($_GET["error"] == "stmtFailure") {
                        echo "<p>Something went wrong! Please try again or contact the tech team</p>";
                    } else if ($_GET["error"] == "nonExistentUser") {
                        echo "<p>User does not exist. Please register instead</p>";
                    } else if ($_GET["error"]== "incorrectPassword"){
                        echo "<p> Password Incorrect</p>";
                    }
                }
                ?>
                <input type="text" name="email" placeholder="Email ID" class="inputField">
                <input type="password" name="pwd" placeholder="Password" class="inputField">
                <button class="submit inputField" type="submit" name="submit">Log In</button>
                <p class="altAction"><a href="register"> Register Instead? </a></p>
                <p class="altAction"><a href="executiveLogin"> Executive Board </a></p>
                <p class="altAction"><a href="mailto:aarav.parikh@jnis.ac.in"> Help</a> </p>
            </form>
        </div>
    </container>
</body>

</html>