var profManForm = document.getElementById("profManForm");
var changeUsername_button = document.getElementById("changeUsername_button");
var changePassword_button = document.getElementById("changePassword_button");

function createChangeUsernameForm(){
    // Remove change password elements if they exist
    if(changePassword_button.disabled != false)
        for (var i=0;i<15;i++)
            profManForm.removeChild(profManForm.lastChild)

    // Disable login changeUsername_button and darken parent's background color
    changeUsername_button.disabled = true;
    changePassword_button.disabled = false;

    //// Create a break line element 
    var br = document.createElement("br");

    // Create a label for Current Username
    var NUNL = document.createElement("label");
    NUNL.setAttribute("for","newusername");
    NUNL.innerHTML = "New Username";

    // Create an input element for Username 
    var NUN = document.createElement("input");
    NUN.setAttribute("type", "text"); 
    NUN.setAttribute("name", "newusername"); 
    NUN.setAttribute("placeholder", "New username..."); 

    // Create a label for Password
    var NPWDL = document.createElement("label");
    NPWDL.setAttribute("for","newpassword");
    NPWDL.innerHTML = "Confirm Password";

    // Create an input element for password 
    var NPWD = document.createElement("input");
    NPWD.setAttribute("type", "password"); 
    NPWD.setAttribute("name", "password"); 
    NPWD.setAttribute("placeholder", "Enter your password..."); 

    // Create a submit button 
    var s = document.createElement("input");
    s.setAttribute("type", "submit"); 
    s.setAttribute("name", "submit_change_username"); 
    s.setAttribute("value", "Submit"); 

    // Append the form elements to the form
    profManForm.appendChild(br.cloneNode()); // Line break
    profManForm.appendChild(NUNL);
    profManForm.appendChild(br.cloneNode());
    profManForm.appendChild(NUN);
    profManForm.appendChild(br.cloneNode())
    profManForm.appendChild(NPWDL);
    profManForm.appendChild(br.cloneNode())
    profManForm.appendChild(NPWD);
    profManForm.appendChild(br.cloneNode())
    profManForm.appendChild(s);
    profManForm.setAttribute('action','changeUsername.php');
}

function createChangePassword(){
    // Delete Change Username elements if they exist
    if(changeUsername_button.disabled != false)
        for (var i=0;i<10;i++)
            profManForm.removeChild(profManForm.lastChild);
    
    changePassword_button.disabled = true;
    changeUsername_button.disabled = false;

    // Create a break line element 
    var br = document.createElement("br");

    // Create a label for Current Password
    var CPWDL = document.createElement("label");
    CPWDL.setAttribute("for","currentPWD");
    CPWDL.innerHTML = "Current Password";

    // Create an input element for Current Password 
    var CPWD = document.createElement("input");
    CPWD.setAttribute("type", "password"); 
    CPWD.setAttribute("name", "currentPWD"); 
    CPWD.setAttribute("placeholder", "Your Current Password..."); 

    // Create a label for New Password
    var NPWDL = document.createElement("label");
    NPWDL.setAttribute("for","newPWD");
    NPWDL.innerHTML = "New Password";

    // Create a subtext explaining password requirements
    var PWDREQ = document.createElement("div")
    //PWDREQ.setAttribute("class","pwdReq");
    PWDREQ.style.fontSize = "1.5vmin";
    PWDREQ.innerHTML = "Must include: 8 characters, 1 upper case letter,<br> 1 number and 1 special character";

    // Create an input element for New Password 
    var NPWD = document.createElement("input");
    NPWD.setAttribute("type", "password"); 
    NPWD.setAttribute("name", "newPWD"); 
    NPWD.setAttribute("placeholder", "Enter a new password..."); 

    // Create a label for New Password Confirmation
    var NPWDCL = document.createElement("label");
    NPWDCL.setAttribute("for","newPWDconf");
    NPWDCL.innerHTML = "Re-enter Password";

    // Create an input element for New Password Confirmation
    var NPWDC = document.createElement("input");
    NPWDC.setAttribute("type", "password"); 
    NPWDC.setAttribute("name", "newPWDconf"); 
    NPWDC.setAttribute("placeholder", "Re-enter password..."); 

    // Create a submit button 
    var s = document.createElement("input");
    s.setAttribute("type", "submit"); 
    s.setAttribute("name", "submit_change_username"); 
    s.setAttribute("value", "Submit"); 

    // Append the form elements to the form
    profManForm.appendChild(br.cloneNode()); // Line break
    profManForm.appendChild(CPWDL);
    profManForm.appendChild(br.cloneNode());
    profManForm.appendChild(CPWD);
    profManForm.appendChild(br.cloneNode());
    profManForm.appendChild(NPWDL);
    profManForm.appendChild(br.cloneNode());
    profManForm.appendChild(PWDREQ);
    profManForm.appendChild(NPWD);
    profManForm.appendChild(br.cloneNode());
    profManForm.appendChild(NPWDCL);
    profManForm.appendChild(br.cloneNode());
    profManForm.appendChild(NPWDC);
    profManForm.appendChild(br.cloneNode());
    profManForm.appendChild(s);
    profManForm.setAttribute('action','changePassword.php');
}

changeUsername_button.addEventListener("click", createChangeUsernameForm,false);
changePassword_button.addEventListener("click", createChangePassword,false);