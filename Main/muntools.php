<?php

require_once("dashboardHeader.php");

?>
<script type="text/javascript">
/*      $(document).ready(function(){
    function refreshData(){
      var session;
      $.ajaxSetup({cache: false})
      $.get('position.php', function (data) {
      session = data;});
      var display = document.getElementById("content");
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "muntools#".session);
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttp.send();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          display.innerHTML = this.responseText;
          setTimeout(refreshData(), 1000);
        } else {
          setTimeout(refreshData(), 1000);

        };
      }
    } 

   refreshData();
  });   */
  
  



  function submitForm() {
    var message = $("#message").val();
    $.post("submitChat.php", {
      message: message
    });
    $('#chatForm')[0].reset();
  }

  


</script>



</container>

<div class="containerMUN">
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
          $readReceipt = checkRead($conn, $_SESSION["committee"], $r); 
          $temp= $readReceipt->fetch_assoc();
          $x= preg_replace('/\s+/', '', $r);
          if(isset($temp["mId"])){
            $_SESSION[$x] = $temp["mId"];
          }
          if(isset($temp["messageRead"])){
            if($temp["messageRead"]==0){
            if($x == $_SESSION["country"]){
            }else{
            print '<a class="chatGroups unreadChat" href="#' . $x . '">' . $r . '</a> ';}}
            else{
              print '<a class="chatGroups" href="#' . $x . '">' . $r . '</a> ';

            }
        }else{
          if($x == $_SESSION["country"]){
          }else{
          print '<a class="chatGroups" href="#' . $x . '">' . $r . '</a> ';
        }}
      }}}

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
          $x= preg_replace('/\s+/', '', $r);

          $_SESSION['receiverCountry'] = $x;

          if($x == $_SESSION["country"]){
            
          }else{
          print '<div class="chatContent" id=' . $x . '>
            <h2 style="text-align: center;">Chat with ' . $r . '</h2>
              <div class="chatWindow" id="content">';
                getChatContent($conn, $_SESSION["committee"], $_SESSION["receiverCountry"], $_SESSION["country"]);
              print '</div>
            ';
            $_SESSION["receiverCountry"] = $x;
            $_SESSION["position"] = ('#'.$x);
             print '<div class="userInput">';
            print '<form id="chatForm" action=submitChat.php?location=' . $_SESSION["receiverCountry"] . '&position=' . $_SESSION["position"] . ' method="POST">';
          print '<input type="text" name="message" class="chatBox" placeholder="Type a message" id="message"><button class="chatSend" type="submit" value="submit" name="submit">Send</button>
          <button class="chatSend" type="submit" value="reset" name="reset">Mark as read</button>
          </form>'; 
           print '</div></div>'; 
        }}
      }} ?>

    </div>
    </div>

  <div class="chatItem resources">
    <iframe class='responsive-iframe' src="https://drive.google.com/embeddedfolderview?id=1ZiQ2tDuVw1leb19wqnKqojXS695WxzlE#grid" frameborder="0"></iframe>

  </div>

</div>
</div>