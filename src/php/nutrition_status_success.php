<!DOCTYPE html>

<!-- Start the session !--> 
<?php 
    require "db_helper.php";
    session_start(); 

    $conn = odbc_connect('z5309236', '', '', SQL_CUR_USE_ODBC);
    if(!$conn){exit("Connection Failed:". $conn);}

    // Define variables from form input
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $meal_id = $_POST["meal_id"];
    $delivery_status = $_POST["delivery_status"];
    $date_given = date("d/m/Y");
    $time_given = date("H:i");

    // Put variables into array to pass to insert function
    $patient_id = get_patientID($conn,$fname,$lname);
    $nutrition_id = get_nutritionID($conn,$patient_id);

    $nutrition_data_array = array(
        0=> $nutrition_id,
        1=> $meal_id,
        2=> $delivery_status,
        3=> $date_given,       
        4=> $time_given,
        5=> $patient_id,
    );
?>
<!-- Check for authorised access !--> 
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    
    <html>
        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title>Patient Rego Form</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
            <link rel='stylesheet' type='text/css' media='screen' href='../css/Patient_rego.css'>
            <script src="../js/Functions.js"></script>
        </head>
        <body>
            <div class="navbar_bgd"></div>
            <div class="bell_bgd">
                <div class="bell_img">
                </div>
            </div>
            <div class="nav_frame">
                <div class="name"></div>
                <!-- navbar links back to login for now, assign correct pathways -->
                <a href="../php/homepage.php"><span class="home_nav">Home</span></a>
                <a href="login.html"><span class="sched_nav">Schedule</span></a>
                <a href="login.html"><span class="resource_nav">Resources</span></a>
                <a href="login.html"><span class="reports_nav">Reports</span></a>
            </div>
            <span class="logo_title">M</span><span class="logo_title_detail">ANAG</span><span class="logo_title">ED.</span>
            <div class="logo"></div>
            <?php 
                insert_new_nutriiton_status($conn,$nutrition_data_array);
            ?>
             <form action="../php/homepage.php">
                <input id = "back_to_home" type="submit" value="Return to Home Page" />
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