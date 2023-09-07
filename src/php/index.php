<?php
    // Connects to Akira's database server
    $conn = odbc_connect('z5206699', '', '',SQL_CUR_USE_ODBC);

    // This would be where i would POST the user input however unsure about the html atm - ask the group
    $username=$_POST["Uname"]; 
    $password=$_POST["password"];

    $sql="SELECT * FROM Test"; // unsure about this too (whats the name of the table im drawing from?)
    $rs=odbc_exec($conn,$sql);
    while ($row = odbc_fetch_row($rs)){
        if ($username != $row['Username'] || $username == NULL) { // if user input doesnt equal to Username in database
            // Insert code that prints incorrect username or password
            alert('Incorrect username or password'); // Not sure if this is right one
        }
    }
    $sql="SELECT * FROM Test"; // unsure about this too (whats the name of the table im drawing from?)
    $rs=odbc_exec($conn,$sql);
    while ($odbc_fetch_row($rs)){
        // Check if password is correct by comparing to database
        if ($passwprd!=odbc_result($rs,"Password")|| $password =='') {
            // Insert code that prints incorrect username or password
            alert('Incorrect username or password'); // Not sure if this is right one
        }
    }
    $sql="SELECT * FROM Test"; // unsure about this too (whats the name of the table im drawing from?)
    $rs=odbc_exec($conn,$sql);
    while (odbc_fetch_row($rs)){
        // Checks if input is valid and relocate to homepage after login
        if ($username == odbc_result($rs,"Username") && $password == odbc_result($rs,"Password") ) { // if user input doesnt equal to Username in database
            // Insert code that prints incorrect username or password
            header("Location: test.php"); // Insert relocation to homepage
        }
    }
?>