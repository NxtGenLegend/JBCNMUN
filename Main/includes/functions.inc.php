<?php

function emptyInputSignup($email, $pwd, $pwdRepeat)
{
    $result;

    if ( empty($email) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyInputLogin($email, $pwd)
{
    $result;

    if (empty($email) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyInputComplete($name, $mobile, $school, $grade, $munXP)
{
    $result;

    if ( empty($name) || empty($mobile) || empty($school) || empty($grade) || empty($munXP)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidMobile($mobile)
{
    $result;

    if (strlen($mobile)!==10) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result;

    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../register.php?error=stmtFailure");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $email, $pwd)
{
    $sql = "INSERT INTO users  (userEmail, userPwd ) VALUES (?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../register.php?error=stmtFailure");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $pwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt); 
    header("location:../login");
}

function completeRegistration($conn, $name, $mobile, $school, $grade, $division, $munXP, $userId)
{
    $sql = "INSERT INTO deldata (delName, delMobile, delSchool, delGrade, delDivision, delMunXP, userId ) VALUES (?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../completeRegistration.php?error=stmtFailure");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssissi", $name, $mobile,$school, $grade, $division, $munXP, $userId);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../index.php?error=none");
    
    $_SESSION["delName"] = $name;
    exit();
}

function assignPreference($conn, $committee1, $country1a, $country1b, $country1c, $committee2, $country2a, $country2b, $country2c,$committee3, $country3a, $country3b, $country3c, $delId)
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $sql = "INSERT INTO preference(committee1, country1a, country1b, country1c, committee2, country2a, country2b, country2c, committee3, country3a, country3b, country3c ,delId ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssssssssi", $committee1, $country1a, $country1b, $country1c, $committee2, $country2a, $country2b, $country2c,$committee3, $country3a, $country3b, $country3c, $delId);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../index.php?error=none");
    exit();
}

function loginUser($conn, $email, $pwd){
    $emailExists = emailExists($conn, $email);

    if($emailExists === false){
        header("location: ../register.php?error=nonExistentUser");
        exit();
    }

    $dbPass = $emailExists["userPwd"];

    if($pwd!==$dbPass){
        header("location:../login.php?error=incorrectPassword");
        exit();
    }
    else if($dbPass==$pwd){
        session_start();
        $_SESSION["userId"] = $emailExists["userId"];
        $_SESSION["email"] = $email;
        header("location:../index");
        exit();
    }

}

function getStatus($conn){
    $sql = "SELECT * FROM deldata WHERE userId=?"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $userId = $_SESSION["userId"];
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $user = $result->fetch_assoc(); // fetch the data  
    return $user;
}

function getPreference($conn, $delId){
    $sql = "SELECT * FROM preference WHERE delId=?"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $delId);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $pId = $result->fetch_assoc(); // fetch the data  
    return $pId;
}

function assignCommittee($conn, $delId, $committee, $country){
    $sql = "UPDATE deldata SET committee=?, country=? WHERE delId=?"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ssi", $committee, $country, $delId);
    $stmt->execute();

    header("location:../executive.php?error=none");
}

function assignFinance($conn, $userId, $delName, $status){
    $sql = "UPDATE deldata SET paymentStatus=? WHERE userId=?"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("si", $status, $userId);
    $stmt->execute();

    header("location:../finance.php?error=none");
}

function resetFinance($conn){

    $result = mysqli_query($conn, "SELECT userId FROM deldata WHERE paymentStatus='processing'");
    print_r($result);

    foreach($result as $userId){
        $status="pending";
        $sql = "UPDATE deldata SET paymentStatus=? WHERE userId=?"; // SQL with parameters
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("si", $status,$userId["userId"]);
        $stmt->execute();
    }
    unset($userId);


/* 

    $sql = "UPDATE deldata SET paymentStatus=? WHERE peymentStatus=?"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ss", "pending", "processing");
    $stmt->execute(); */

     header("location:../finance.php?error=none");
}

function passwordReset($conn, $email, $pwd){
    $emailExists = emailExists($conn, $email);

    if($emailExists === false){
        header("location: ../register.php?error=nonExistentUser");
        exit();
    }

    $dbPass = $emailExists["userPwd"];

    echo $dbPass;

   if($pwd!==$dbPass){
        
        $sql = "UPDATE users SET userPwd=? WHERE userEmail=?"; // SQL with parameters
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("ss", $pwd, $email);
        $stmt->execute();
        header("location:../passwordReset.php?error=none");
        
    }
    else if($dbPass==$pwd){
        session_start();
        $_SESSION["userId"] = $emailExists["userId"];
        $_SESSION["email"] = $email;
        header("location:../index");
        exit();
    }
}

function getChats($conn, $committee){
        $sql = "SELECT country FROM deldata WHERE committee=?"; // SQL with parameters
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $committee);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        return $result;


}

function checkRead($conn, $committee, $country){
    $sql2 = "SELECT * FROM chat WHERE receiverCommittee=? AND author=? AND receiverCountry=?"; // SQL with parameters
    $stmt2 = $conn->prepare($sql2); 
    $stmt2->bind_param("sss", $committee, $country, $_SESSION["country"]);
    $stmt2->execute();
    $result2 = $stmt2->get_result(); // get the mysqli result
    return $result2;
}

function getGroupChatContent($conn, $committee, $country){
    $sql = "SELECT * FROM chat WHERE receiverCountry=? AND receiverCommittee=?"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ss", $country, $committee);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    if(mysqli_num_rows($result)>0){
        while($row = $result->fetch_assoc()){
            if($row["author"] != $_SESSION["country"]){
              print '<div class="chatMessage"><span class="auth">'.$row["author"].'</span><br>'.$row["message"].'<br><span class=leftMeta>'.$row["timeSent"].'</span></div>';
          }else{
            print '<div class="chatMessageSelf"><span class="auth">'.$row["author"].'</span><br>'.$row["message"].'<br><span class=leftMeta>'.$row["timeSent"].'</span></div>';
          }
        }  }else{
            print 'There are no messages';
        }
}

function sendMessage($conn, $author, $receiverCommittee, $receiverCountry, $message ){
 
    $sql = "INSERT INTO chat  ( author, receiverCommittee, receiverCountry, `message`, `messageRead`) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
       header("location:../muntools?error=stmtFailure");       
exit();
    }
    $read="0";
    mysqli_stmt_bind_param($stmt, "ssssi", $author, $receiverCommittee, $receiverCountry, $message, $read);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt); 
    


}

function getChatContent($conn, $committee, $country1, $country2){
    $sql = "SELECT * FROM chat WHERE (author=? AND receiverCountry=? AND receiverCommittee=?) OR (receiverCountry=? AND author=? AND receiverCommittee=?)"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ssssss", $country1, $country2,$committee, $country1, $country2, $committee);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    if(mysqli_num_rows($result)>0){
        while($row = $result->fetch_assoc()){
            if($row["author"] != $_SESSION["country"]){
              print '<div class="chatMessage"><span class="auth">'.$row["author"].'</span><br>'.$row["message"].'<br><span class=leftMeta>'.$row["timeSent"].'</span></div>';
          }else{
            print '<div class="chatMessageSelf"><span class="auth">'.$row["author"].'</span><br>'.$row["message"].'<br><span class=leftMeta>'.$row["timeSent"].'</span></div>';
          }
        }  }else{
            print 'There are no messages';
        } 
}

function fetchChat($conn, $committee, $author, $receiver){
    $sql = "SELECT * FROM chat WHERE (author=? AND receiverCountry=? AND receiverCommittee=?) "; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("sss", $author, $receiver,$committee);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    if(mysqli_num_rows($result)>0){
        while($row = $result->fetch_assoc()){
            if($row["author"] != $_SESSION["country"]){
              print '<div class="chatMessage"><span class="auth">'.$row["author"].'</span><br>'.$row["message"].'<br><span class=leftMeta>'.$row["timeSent"].'</span></div>';
          }else{
            print '<div class="chatMessageSelf"><span class="auth">'.$row["author"].'</span><br>'.$row["message"].'<br><span class=leftMeta>'.$row["timeSent"].'</span></div>';
          }
        }  }else{
            print 'There are no messages';
        } 
}

function markRead($conn, $mId){
    $sql = "UPDATE  chat SET messageRead =? WHERE mId=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
       header("location:../muntools?error=stmtFailure");       
exit();
    }
    $read="1";
    mysqli_stmt_bind_param($stmt, "ii",$read, $mId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt); 
    


}

