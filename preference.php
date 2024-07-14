<?php
include_once("includes/header.inc.php");
if (!isset($_SESSION["userId"])) {
    header("location:register.php");
}
?>




<container class="pageHolder">

    <!-- <div class="signup-form background-graphic-dark"></div>

    <div class="signup-form background-graphic"> -->

    </div>

    <div class="preference-form">
        <div class="imgholder">
            <img src="assets/jbcnLogo.png" alt="" class="logo">
        </div>
        <div class="preferenceForm">
            <form action="includes/assign.inc.php" class="signup" method="POST" autocomplete="off">
                <h6 class="formTitle">Select Preferences</h6>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyInput") {
                        echo "<p> Please fill all fields</p>";
                    } else if ($_GET["error"] == "stmtFailure") {
                        echo "<p>Something went wrong! Please try again or contact the tech team</p>";
                    } else if ($_GET["error"] == "invalidMobile") {
                        echo "<p> Please enter valid mobile number</p>";
                    } else if ($_GET["error"] == "gmc") {
                        echo "<p>Select 1st preference as International Press<br>Enter media house preference in space for country<br> Leave other fields blank</p>";
                    }
                }
                ?><br>
                <select name="committee1" class="prefInput" required="">
                    <option disabled="" selected="">1st Preference [Committee] </option>
                    <option value="sc">UNSC</option>
                    <option value="icef">UNICEF</option>
                    <option value="hrc">UNHRC</option>
                    <option value="disec">DISEC</option>
                    <option value="ip">International Press</option>
                </select>
                <div>
                    <input type="text" name="country1a" placeholder="Country 1" class="prefInput item2">
                    <input type="text" name="country1b" placeholder="Country 2" class="prefInput item2">
                    <input type="text" name="country1c" placeholder="Country 3" class="prefInput item2">
                </div>
                <br>
                <select name="committee2" class="prefInput">
                    <option disabled="" selected="">2nd Preference [Committee] </option>
                    <option value="sc">UNSC</option>
                    <option value="icef">UNICEF</option>
                    <option value="hrc">UNHRC</option>
                    <option value="disec">DISEC</option>
                    <option value="ip">International Press</option>
                </select>
                <div>
                    <input type="text" name="country2a" placeholder="Country 1" class="prefInput item2">
                    <input type="text" name="country2b" placeholder="Country 2" class="prefInput item2">
                    <input type="text" name="country2c" placeholder="Country 3" class="prefInput item2">
                </div>
                <br>
                <select name="committee3" class="prefInput">
                    <option disabled="" selected="">3rd Preference [Committee] </option>
                    <option value="sc">UNSC</option>
                    <option value="icef">UNICEF</option>
                    <option value="hrc">UNHRC</option>
                    <option value="disec">DISEC</option>
                    <option value="ip">International Press</option>
                </select>
                <div>
                    <input type="text" name="country3a" placeholder="Country 1" class="prefInput item2">
                    <input type="text" name="country3b" placeholder="Country 2" class="prefInput item2">
                    <input type="text" name="country3c" placeholder="Country 3" class="prefInput item2">
                </div>
                <br>
                <button class="submit inputField" type="submit" name="submit">Select</button>
                <p class="altAction"><a href="preference.php?error=gmc"> For International Press Delegates</a> </p>
                <p class="altAction"><a href="mailto:aarav.parikh@jnis.ac.in"> Help</a> </p>
            </form>
        </div>


    </div>
</container>
</body>

</html>