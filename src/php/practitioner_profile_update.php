<!DOCTYPE html>

<!-- Start the session !--> 
<?php 
    require "db_helper.php";
    
    session_start(); 

    $conn = odbc_connect('z5309236', '', '', SQL_CUR_USE_ODBC);
    if(!$conn){exit("Connection Failed:". $conn);}

    if(is_logged_in($conn)){
        $_SESSION['loggedin'] = true;
    }

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $photo = $_POST["photo"];
?>
<!-- Check for xauthorised access !--> 
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    <html>
        <head>
            <script src="../js/Functions.js"></script>
        </head>
        <body>
            <!-- Temporary form but with same fields as final -->
            <!-- Include div below for each field which needs validation-->
            <form id = "practitioner_update_form" method = "post" action = "../php/profile_update_success.php" target = "blank">
            <label for="fname">First name:</label><br>
            <input type="text" placeholder = "<?php echo $fname ?>" value = "<?php echo $fname ?>" id="fname" name="fname" onchange = "ValidFirstName()"><br>
            <div class = "input_comment">
                <p id = "fname_input_comment" style = "margin:0"></p>
            </div>
           
            <!-- Last Name --> 
            <label for="lname">Last name:</label><br>
            <input type="text"placeholder = "<?php echo $lname ?>" value = "<?php echo $lname ?>"id="lname" name="lname" onchange="ValidLastName()"><br>
            <div class = "input_comment">
                <p id = "lname_input_comment" style = "margin:0"></p>
            </div>

             <!-- Email --> 
            <label for="email">Email:</label><br>
            <input type="text" placeholder = "<?php echo $email ?>" value = "<?php echo $email ?>"id="email" name="email" onchange = "ValidEmail()"><br>
            <div class = "input_comment">
                <p id = "email_input_comment" style = "margin:0"></p>
            </div>

            <!-- Photo --> 
            <!-- Images will be saved as urls -->
            <label for="photo"> Update Photo:</label><br>
            <input id = "profile_link" placeholder = "<?php echo $photo ?>" value = "<?php echo $photo ?>"  type="text" name="photo" onchange = "previewImage()"/>
            <div id = "preview_profile_image"></div>

            <!-- Submit --> 
            <input type="submit" value="Submit">
            </form>
		</body>
    </html>


<!-- If the user is not logged in, direct them to the home page !--> 
<?php else: ?>
    <html>
		<div class="panel">
			<h1 class="title">Access not permitted. </h1>
			<h3 class="subtitle">Please <a href="../html/login.html" style="color: #FDAB61;">login</a> to view this page.</h3>
		</div>
		<!-- footer -->
		<div class="footer"></div>
    </html>
<?php endif; ?>