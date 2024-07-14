<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);


require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

require_once 'header.php';


if(!isset($_SESSION["validExec"])){
    header("location:index.php");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


?>

    <div class='execInternal' >
        <div class='execForm'>
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
                        echo "<p> Updated Successfully</p>";
                    }else if ($_GET["error"]=="reset"){
                        echo "<p> Reset Successful</p>";
                    }
                }
                ?>
            <form action="includes/chat.fetch.php" class="signup" method="POST">    
                 <select name="committee"  class="prefInput" required="">
                    <option disabled="" selected="">Select Committee</option>
                    <option value="g8">G8</option>
                    <option value="g14">G14</option>
                    <option value="g20">G20</option>
                    <option value="gso">GSO</option>
                    <option value="gmc">GMC</option>
                </select>
                <select name="position"  class="prefInput" required="">
                    <option disabled="" selected="">Select Position</option>
                    <option value="eb">EB</option>
                    <option value="moderator">Moderator</option>
                    <option value="rapporteur">Rapporteur</option>
                    <option value="secretariat">Secretariat</option>
                    <option value="general">General</option>
                </select>

                <button class="submit inputField" type="submit" name="submit">Select</button>
            </form>
            
        </div>
    </div>
    <div class="chatItem chatBoard">
   <?php if(isset($_SESSION["delName"])){ echo '<p>Delegate chat for '.strtoupper($_SESSION["committee"]);} else{ echo '<p>Please Complete Registration</p>';} ?></p>
   <div class="chatTabs">
   <?php
      if(isset($_SESSION["committee"])){ echo '
      <a class="chatGroups" href="#fullCommittee">Full Committee</a>
      <a class="chatGroups" href="#executiveBoard">Executive Board</a>
      <a class="chatGroups" href="#moderator">Moderator|Rapporteur</a>
      <a class="chatGroups" href="#secretariat">Secretariat</a>';}?>
      <?php
      if(isset($_SESSION["committee"])){
      $chatList = getChats($conn, $_SESSION["committee"]);

      while ($row = $chatList->fetch_assoc()) {
        foreach ($row as $r) {
          if($r == $_SESSION["country"]){
          }else{
          print '<a class="chatGroups" href="#' . $r . '">' . $r . '</a> ';
        }}
      }}

      ?>
    </div>
    <div class="scrollDiv">

      <div id="fullCommittee" class="chatContent">
        <h2 style="text-align: center;">Chat with Full Committee</h2>

        <div class="chatWindow" id="content">
          <?php
          $_SESSION['receiverCountry'] = 'all';
          getGroupChatContent($conn, $_SESSION["committee"], $_SESSION["receiverCountry"]);

          ?>

        </div>

        <div class=userInput>
          <?php
          $_SESSION["receiverCountry"] = 'all';
          $_SESSION["position"] = '#fullCommittee';

          print ' <form id="chatForm" action=submitChat.php?location=' . $_SESSION["receiverCountry"] . '&position=' . $_SESSION["position"] . ' method="POST">' ?>
          <input type="text" name="message" class="chatBox" placeholder="Type a message" id="message">
          <button class="chatSend" type="submit" value="submit" name="submit">Send</button>

          </form>
        </div>
      </div>

      <div id="executiveBoard" class="chatContent">
        <h2 style="text-align: center;" >Chat with Executive Board</h2>
        <div class="chatWindow" id="content">
          <?php
          $_SESSION['receiverCountry'] = 'eb';
          getChatContent($conn, $_SESSION["committee"], $_SESSION["receiverCountry"], $_SESSION["country"]);

          ?>

        </div>

        <div class=userInput>
          <?php
          $_SESSION["receiverCountry"] = 'eb';
          $_SESSION["position"] = '#executiveBoard';

          print ' <form id="chatForm" action=submitChat.php?location=' . $_SESSION["receiverCountry"] . '&position=' . $_SESSION["position"] . ' method="POST">' ?>
          <input type="text" name="message" class="chatBox" placeholder="Type a message" id="message">
          <button class="chatSend" type="submit" value="submit" name="submit">Send</button>

          </form>
        </div>
      </div>

      <div id="moderator" class="chatContent">
        <h2 style="text-align: center;">Chat with Moderator</h2>
        <div class="chatWindow" id="content">
          <?php
          $_SESSION['receiverCountry'] = 'moderator';
          getChatContent($conn, $_SESSION["committee"], $_SESSION["receiverCountry"], $_SESSION["country"]);

          ?>

        </div>

        <div class=userInput>
          <?php
          $_SESSION["receiverCountry"] = 'moderator';
          $_SESSION["position"] = '#moderator';

          print ' <form id="chatForm" action=submitChat.php?location=' . $_SESSION["receiverCountry"] . '&position=' . $_SESSION["position"] . ' method="POST">' ?>
          <input type="text" name="message" class="chatBox" placeholder="Type a message" id="message">
          <button class="chatSend" type="submit" value="submit" name="submit">Send</button>

          </form>
        </div>
      </div>

      <div id="secretariat" class="chatContent">
        <h2 style="text-align: center;">Chat with Secretariat</h2>
        <div class="chatWindow" id="content">
          <?php
          $_SESSION['receiverCountry'] = 'secretariat';
          getChatContent($conn, $_SESSION["committee"], $_SESSION["receiverCountry"], $_SESSION["country"]);

          ?>

        </div>

        <div class=userInput>
          <?php
          $_SESSION["receiverCountry"] = 'secretariat';
          $_SESSION["position"] = '#secretariat';

          print ' <form id="chatForm" action=submitChat.php?location=' . $_SESSION["receiverCountry"] . '&position=' . $_SESSION["position"] . ' method="POST">' ?>
          <input type="text" name="message" class="chatBox" placeholder="Type a message" id="message">
          <button class="chatSend" type="submit" value="submit" name="submit">Send</button>

          </form>
        </div>
      </div>

      <?php
      if(isset($_SESSION["committee"])){
      $chatList = getChats($conn, $_SESSION["committee"]);
      while ($row = $chatList->fetch_assoc()) {
        foreach ($row as $r) {
          $_SESSION['receiverCountry'] = $r;

          if($r == $_SESSION["country"]){
            
          }else{
          print '<div class="chatContent" id=' . $r . '>
            <h2 style="text-align: center;">Chat with ' . $r . '</h2>
              <div class="chatWindow" id="content">';
                getChatContent($conn, $_SESSION["committee"], $_SESSION["receiverCountry"], $_SESSION["country"]);
              print '</div>
            ';
            $_SESSION["receiverCountry"] = $r;
            $_SESSION["position"] = ('#'.$r);
             print '<div class="userInput">';
            print '<form id="chatForm" action=submitChat.php?location=' . $_SESSION["receiverCountry"] . '&position=' . $_SESSION["position"] . ' method="POST">';
          print '<input type="text" name="message" class="chatBox" placeholder="Type a message" id="message"><button class="chatSend" type="submit" value="submit" name="submit">Send</button>
          </form>'; 
           print '</div></div>'; 
        }}
      }} ?>

    </div>
    </div>
    </div>
</div>
</body>

</html>