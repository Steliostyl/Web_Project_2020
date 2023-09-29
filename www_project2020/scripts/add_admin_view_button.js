let button = document.getElementById("hidden_admin");
// Create anchor element. 
var element = document.createElement('element');
var link = document.createTextNode("View as admin");
element.appendChild(link);
element.title = "View as admin";
element.href = "adminPanel.php"
button.appendChild(element);