<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);


require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

require_once 'header.php';


if(!isset($_SESSION["validExec"])){
    header("location:index.php");
}


$sortKey = "delId";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$pId = array();


$sql = "SELECT  deldata.userId AS userId,
                deldata.delName AS Full_Name,
                deldata.paymentStatus AS Fees
        FROM deldata
        ORDER BY deldata.paymentStatus"; // SQL with parameters
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
        <form action="includes/finance.assign.php" class="signup" method="POST">
                <h6 class="formTitle">Payment Status</h6>
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
                    }else if ($_GET["error"]=="reset"){
                        echo "<p> Reset Succesful</p>";
                    }
                }
                ?>
                <select name="userId"  class="prefInput" required="">
                    <option disabled="" selected="">Delegate User ID </option>
                    <?php 

                        print("<p>TEST</p>");
                       $result = mysqli_query($conn, 'SELECT userId FROM deldata');

                       while ($username = mysqli_fetch_assoc($result)){
                           echo '<option value='.$username['userId'].'>'.$username['userId'].'</option>';
                       }
                    ?>
                    
                </select>
                <select name="delName"  class="prefInput" required="">
                    <option disabled="" selected="">Delegate Name </option>
                    <?php 

                        print("<p>TEST</p>");
                       $result = mysqli_query($conn, 'SELECT delName FROM deldata');

                       while ($username = mysqli_fetch_assoc($result)){
                           echo '<option value='.$username['delName'].'>'.$username['delName'].'</option>';
                       }
                    ?>
                    
                </select>
                
                <select name="status"  class="prefInput" required="">
                    <option disabled="" selected="">Change Status</option>
                    <option value="pending">Pending</option>
                    <option value="complete">Complete</option>
                </select>

                <button class="submit inputField" type="submit" name="submit">Assign Changes</button>
                <button class="submit inputField" type="submit" name="reset">Reset</button>

        </div>
    </div>
</div>
</body>

</html>