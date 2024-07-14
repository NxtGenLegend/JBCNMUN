<?php
include_once("includes/header.inc.php");
if (!isset($_SESSION["userId"])) {
    header("location:register");
}



?>





<!-- <div class="signup-form background-graphic-dark"></div>

        <div class="signup-form background-graphic"> -->
<br>
<div class="outerform">
    <div class="preference-form">
        <div class="imgholder">
            <img src="assets/jbcnLogo.png" alt="" class="preflogo">
        </div>
        <form action="includes/complete.inc.php" class="signup" method="POST" autocomplete="off" autocapitalize="on">
            <h6 class="formTitle">Complete Registration</h6>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyInput") {
                    echo "<p> Please fill all fields</p>";
                } else if ($_GET["error"] == "stmtFailure") {
                    echo "<p>Something went wrong! Please try again or contact the tech team</p>";
                } else if ($_GET["error"] == "invalidMobile") {
                    echo "<p> Please enter valid mobile number</p>";
                }
            }
            ?>
            <input type="text" name="name" placeholder="Full Name" class="inputField">
            <input type="text" name="mobile" placeholder="Mobile Number" class="inputField">
            <input type="text" name="school" placeholder="School Name" class="inputField">
            <input type="text" name="grade" placeholder="Grade" class="inputField">
            <input type="text" name="division" placeholder="Division (JBCN ONLY)" class="inputField">
            <textarea type="text" name="munXP" placeholder="MUN Experience" class="inputField long"></textarea>
            <button class="submit inputField" type="submit" name="submit">Complete Registration</button>
            <p class="altAction"><a href="help.php"> Help</a> </p>
        </form>



    </div>
</div>
</body>

</html>