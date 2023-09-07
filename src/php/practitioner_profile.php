<!DOCTYPE html>

<!-- Start the session !--> 
<?php 
    require "db_helper.php";
    session_start(); 

    $conn = odbc_connect('z5309236', '', '', SQL_CUR_USE_ODBC);
    if(!$conn){exit("Connection Failed:". $conn);}
?>
<!-- Check for authorised access !--> 
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    
    <html>
        <head>
            <script src="../js/Functions.js"></script>
        </head>
        <body>
            <?php 
              $fname = $_POST["fnameProfile"];
              $lname = $_POST["lnameProfile"];
              show_practitioner_profile($conn,$fname,$lname);

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