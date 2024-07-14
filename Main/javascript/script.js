
function openChat(evt, chatName) {
    // Declare all variables
    var i, chatContent, chatGroups;
  
    // Get all elements with class="tabcontent" and hide them
    chatContent = document.getElementsByClassName("chatContent");
    for (i = 0; i < chatContent.length; i++) {
      chatContent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    chatGroups = document.getElementsByClassName("chatGroups");
    for (i = 0; i < chatGroups.length; i++) {
      chatGroups[i].className = chatGroups[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(chatName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }