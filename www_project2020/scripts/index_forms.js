function createLoginForm(){
    console.log("Login button pressed");

    // If form has already be created, nothing happens
    //if(document.getElementById("login_form")!=null)
    //    return;

    var login_button = document.getElementById("login");
    var signup_button = document.getElementById("signup");
    var signup_form = document.getElementById("signup_form");

    // Disable login button and darken parent's background color
    login_button.disabled = true;
    login_button.parentNode.style.background='rgb(25,25,25)';

    // Remove welcoming message
    if(document.getElementById("welcome")!=null)
        document.getElementById("welcome").remove();
    // Remove signup form and re-enable signup button
    if(signup_form!=null){
        signup_form.remove();
        signup_button.disabled = false;
        signup_button.parentNode.style.background='transparent';
    }


    // Create a break line element 
    var br = document.createElement("br");  

    // Create a form synamically 
    var form = document.createElement("form"); 
    form.setAttribute("class", "form");
    form.setAttribute("id", "login_form"); 
    form.setAttribute("method", "post"); 
    form.setAttribute("action", "login.php"); 

    // Create a label for Username
    var UNL = document.createElement("label");
    UNL.setAttribute("for","username");
    UNL.innerHTML = "Username";

    // Create an input element for Username 
    var UN = document.createElement("input"); 
    UN.setAttribute("type", "text"); 
    UN.setAttribute("name", "username"); 
    UN.setAttribute("placeholder", "Your username..."); 

    // Create a label for Password
    var PWDL = document.createElement("label");
    PWDL.setAttribute("for","password");
    PWDL.innerHTML = "Password";

    // Create an input element for password 
    var PWD = document.createElement("input"); 
    PWD.setAttribute("type", "password"); 
    PWD.setAttribute("name", "password"); 
    PWD.setAttribute("placeholder", "Your password..."); 

    // Create a submit button 
    var s = document.createElement("input"); 
    s.setAttribute("type", "submit"); 
    s.setAttribute("name", "Login_Button"); 
    s.setAttribute("value", "Login"); 
    
    // Append the form elements to the form
    form.appendChild(UNL);
    form.appendChild(br.cloneNode()); // Line break 
    form.appendChild(UN);
    form.appendChild(br.cloneNode());
    form.appendChild(PWDL);
    form.appendChild(br.cloneNode());
    form.appendChild(PWD);
    form.appendChild(br.cloneNode());
    form.appendChild(s);  

    document.getElementById("content-wrapper").appendChild(form); 
}

function createSignupForm(){
    console.log("Signup button pressed");

    var login_button = document.getElementById("login");
    var signup_button = document.getElementById("signup");
    var login_form = document.getElementById("login_form");

    // Disable login button and darken parent's background color
    signup_button.disabled = true;
    signup_button.parentNode.style.background='rgb(25,25,25)';

    // Remove welcoming message
    if(document.getElementById("welcome")!=null)
        document.getElementById("welcome").remove();
    // Remove signup form and re-enable signup button
    if(login_form!=null){
        login_form.remove();
        login_button.disabled=false;
        login_button.parentNode.style.background='transparent';
    }


    // Create a break line element 
    var br = document.createElement("br");  

    // Create a form synamically 
    var form = document.createElement("form"); 
    form.setAttribute("class", "form");
    form.setAttribute("id", "signup_form"); 
    form.setAttribute("method", "post"); 
    form.setAttribute("action", "signup.php"); 

    // Create a label for Username
    var UNL = document.createElement("label");
    UNL.setAttribute("for","new_username");
    UNL.innerHTML = "Your Username";

    // Create an input element for Username 
    var UN = document.createElement("input"); 
    UN.setAttribute("type", "text"); 
    UN.setAttribute("name", "new_username"); 
    UN.setAttribute("placeholder", "st1059713..."); 

    // Create a label for Email
    var EMAILL = document.createElement("label");
    EMAILL.setAttribute("for","new_email");
    EMAILL.innerHTML = "Your Email";

    // Create an input element for Email 
    var EMAIL = document.createElement("input"); 
    EMAIL.setAttribute("type", "text"); 
    EMAIL.setAttribute("name", "new_email"); 
    EMAIL.setAttribute("placeholder", "st1059713@ceid.upatras.gr..."); 

    // Create a label for Password
    var PWDL = document.createElement("label");
    PWDL.setAttribute("for","new_password");
    PWDL.innerHTML = "Password";
    
    // Create a subtext explaining password requirements
    var PWDREQ = document.createElement("div")
    PWDREQ.setAttribute("class","pwdReq");
    PWDREQ.innerHTML = "Must include: 8 characters, 1 upper case letter, 1 number and 1 special character";

    // Create an input element for password 
    var PWD = document.createElement("input"); 
    PWD.setAttribute("type", "password"); 
    PWD.setAttribute("name", "new_password"); 
    PWD.setAttribute("placeholder", "Your password..."); 

    // Create a label for Password verification
    var PWD2L = document.createElement("label");
    PWD2L.setAttribute("for","new_password2");
    PWD2L.innerHTML = "Re-enter your password";

    // Create an input element for password verification
    var PWD2 = document.createElement("input"); 
    PWD2.setAttribute("type", "password"); 
    PWD2.setAttribute("name", "new_password2"); 
    PWD2.setAttribute("placeholder", "Re-enter your password..."); 

    // Create a submit button 
    var s = document.createElement("input"); 
    s.setAttribute("type", "submit"); 
    s.setAttribute("name", "Signup_Button"); 
    s.setAttribute("value", "Signup"); 
    
    // Append the form elements to the form
    form.appendChild(UNL);
    form.appendChild(br.cloneNode()); // Line break 
    form.appendChild(UN);
    form.appendChild(br.cloneNode());
    form.appendChild(EMAILL);
    form.appendChild(br.cloneNode());
    form.appendChild(EMAIL);
    form.appendChild(br.cloneNode());
    form.appendChild(PWDL);
    form.appendChild(br.cloneNode());
    form.appendChild(PWDREQ);
    form.appendChild(PWD);
    form.appendChild(br.cloneNode());
    form.appendChild(PWD2L);
    form.appendChild(br.cloneNode());
    form.appendChild(PWD2);
    form.appendChild(br.cloneNode());
    form.appendChild(s);  

    document.getElementById("content-wrapper").appendChild(form); 
}

document.getElementById('login').addEventListener('click', createLoginForm, false);
document.getElementById('signup').addEventListener('click', createSignupForm, false);