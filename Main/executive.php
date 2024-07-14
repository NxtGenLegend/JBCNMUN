<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);


require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

require_once 'header.php';


if(!isset($_SESSION["validExec"])){
    header("location:index");
}


$sortKey = "delId";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$pId = array();


$sql = "SELECT  deldata.delId AS ID, 
                deldata.delName as DelegateName,
                deldata.delGrade AS Grade, 
                deldata.delMunXP AS Experience,
                CONCAT(committee,' | ',country) AS Assigned, 
                preference.committee1 AS Pref1,
                CONCAT_WS('<br> ', country1a, country1b, country1c) AS Country1,
                preference.committee2 AS Pref2,
                CONCAT_WS('<br> ', country2a, country2b, country2c) AS Country2,
                preference.committee3 AS Pref3,
                CONCAT_WS('<br>', country3a, country3b, country3c) AS Country3
        FROM deldata LEFT JOIN preference 
        ON deldata.delId=preference.delId 
        ORDER BY preference.committee1"; // SQL with parameters
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$pId = $result->fetch_assoc();


$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$colNames = array_keys(reset($data));


?>
<div class='execDisp'>
    <div class='execInternal prominent'>
        <table class='demoExec '>
        <thead>    
        <tr>
                <?php
                //print the header
                foreach ($colNames as $colName) {
                    echo "<th>$colName</th>";
                }
                ?>
            </tr>
            </thead>        
            <?php
            //print the rows
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($colNames as $colName) {
                    echo "<td>" . $row[$colName] . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table> 
    </div>
    <div class='execInternal' >
        <div class='execForm'>
        <form action="includes/execAssign.inc.php" class="signup" method="POST">
                <h6 class="formTitle">Delegate Assignment</h6>
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
                        echo "<p> Username or Password Incorrect</p>";
                    }else if ($_GET["error"]=="none"){
                        echo "<p> Updated Succesfully</p>";
                    }
                }
                ?>
                <select name="delId"  class="prefInput" required="">
                    <option disabled="" selected="">Delegate ID [Refer to ID column] </option>
                    <?php 

                        print("<p>TEST</p>");
                       $result = mysqli_query($conn, 'SELECT delId FROM deldata');

                       while ($username = mysqli_fetch_assoc($result)){
                           echo '<option value='.$username['delId'].'>'.$username['delId'].'</option>';
                           echo"test message"; 
                       }
                    ?>
                    
                </select>
                
                <select name="committee"  class="prefInput" required="">
                    <option disabled="" selected="">Assign Committee</option>
                    <option value="g8">G8</option>
                    <option value="g14">G14</option>
                    <option value="g20">G20</option>
                    <option value="gso">GSO</option>
                    <option value="gmc">GMC</option>
                </select>
                <div>
                    <input type="text" name="country" placeholder="Assign Country" class="prefInput item2 ">
                </div>
                <button class="submit inputField" type="submit" name="submit">Assign Changes</button>
        </div>
    </div>
</div>
</body>

</html>