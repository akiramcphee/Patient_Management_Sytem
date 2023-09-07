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
            <?php 
                update_practitioner_details($conn,$fname,$lname,$email,$photo);
                echo "<h1> $fname $lname, your profile has successfully been updated!</h1>"

            ?>
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