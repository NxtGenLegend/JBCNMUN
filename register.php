<?php
    include_once("includes/header.inc.php")
?>




    <container class="pageHolder">

<!--         <div class="signup-form background-graphic-dark"></div>
 -->
<!--         <div class="signup-form background-graphic">
 -->
        

        <div class="signup-form">
            <div class="imgholder">
                <img src="assets/jbcnLogo.png" alt="" class="logo">
            </div>
            <form action="includes/signup.inc.php" class="signup" method="POST">
                <br><h6 class="formTitle">Delegate Registration</h6>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyInput") {
                        echo "<p> Please fill all fields</p>";
                    } else if ($_GET["error"] == "invalidEmail") {
                        echo "<p> Please enter valid email</p>";
                    } else if ($_GET["error"] == "pwdMatchError") {
                        echo "<p> Passwords do not match</p>";
                    }  else if ($_GET["error"] == "emailMatchError") {
                        echo "<p> Email IDs do not match</p>";
                    }  else if ($_GET["error"] == "emailAlreadyRegistered") {
                        echo "<p>This email has already been registered</p>";
                    } else if ($_GET["error"] == "stmtFailure") {
                        echo "<p>Something went wrong! Please try again or contact the tech team</p>";
                    } else if ($_GET["error"] == "nonExistentUser") {
                        echo "<p>User does not exist. Please register instead</p>";
                    } else if($_GET["error"] == "reTypeMissing"){
                        echo "<p>Please Select Registration Type (Individual or School)</p>";
                    }
                }
                ?>
                <div class="radioInput">
                    <div>
                    <input type="radio" name="registration-pipeline" id="individual" class="registerRadio" value="individual">
                    <label for="individual" class="registerRadio">Individual</label>
                    </div>
                    <div>
                    <input type="radio" name="registration-pipeline" id="school" class="registerRadio" value="school">
                    <label for="school" class="registerRadio">School</label>
                    </div>
                </div>
                <input type="text" name="email" placeholder="Email ID" class="inputField">
                <input type="text" name="reEmail" placeholder="Re-enter Email ID" class="inputField">
                <input type="password" name="pwd" placeholder="Password" class="inputField">
                <input type="password" name="rePwd" placeholder="Re-enter Password" class="inputField">
                <button class="submit inputField" type="submit" name="submit">Register</button>
                <p class="altAction"><a href="login"> Log In Instead? </a></p>
                <p class="altAction"><a href="mailto:aarav.parikh@jnis.ac.in"> Help</a> </p>
            </form>



        </div>
    </container>
</body>

</html>