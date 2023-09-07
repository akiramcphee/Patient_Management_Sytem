function validation() //Validation function for inputs
{

    var Uname= document.getElementById("Uname").value; //creating variable for first name
    var pwd= document.getElementById("password").value; //creating variable for last name

    //creating variable error or valid message output
    var validUname = document.getElementById("Uname_valid");
    var validpwd = document.getElementById("pwd_valid");

    //expression to filter out Username conditions for letters and numbers only
    var filterUname = /^(?=.*?[a-zA-Z])(?=.*?[0-9])/; // letters and numbers only
    var filterPwd = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/; //characters with at least one number and one letter, upper case and lowercase


    //Validation for Username
    if(Uname == '') // if input is empty
    {
        validUname.textContent = "Please enter first name"
        validUname.classList.add("white")
        validUname.classList.remove("black")
    }
    else if(!filterUname.test(Uname)) //if input doesnt match filter
    {
        validUname.textContent = "Username should contain letters and numbers"
        validUname.classList.add("white")
        validUname.classList.remove("black")
    }
    else //if input clears the filter
    {
        validUname.textContent = "No error"
        validUname.classList.add("black")
        validUname.classList.remove("white")
    }

    //Validation for password
    if(pwd=='') // if input is empty
    {
        validpwd.textContent = "Please enter a password"
        validpwd.classList.add("white")
        validpwd.classList.remove("black")
    }
    else if(!filterPwd.test(pwd)) //if input doesnt match filter
    {
        validpwd.textContent = "Password must contain at least 6 characters, and must include an uppercase, lowercase and a number"
        validpwd.classList.add("white")
        validpwd.classList.remove("black")
    }
    // This is the only part not working
    else if(pwd.length < 6) //if input is less than 6 characters
    {
        validpwd.textContent = "Password must contain at least 6 letters and include uppercase, lowercase and a number"
        validpwd.classList.add("white")
        validpwd.classList.remove("black")
    }
    else //if input clears the filter
    {
        validpwd.textContent = "No error"
        validpwd.classList.add("black")
        validpwd.classList.remove("white")
    }
}

function Login() //Function to login
{
    var Uname= document.getElementById("Uname").value; //creating variable for first name
    var pwd= document.getElementById("password").value; //creating variable for last name

    // If statements ensure all fields are filled before submission else alert statement is displayed
    if(Uname != '' && pwd != '' && validUname == "No error" && validpwd == "No error") {
        window.location = "index.php"; //redirects to php to check input with database	                             
    }
}
