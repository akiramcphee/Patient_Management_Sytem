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
    $med_reg_id = $_POST["med_reg_id"];
    $med_name = $_POST["med_name"];
    $time_of_day = $_POST["time_of_day"];
    $delivery_status = $_POST["delivery_status"];
    $date_given = date("d/m/Y");

    // Put variables into array to pass to insert function
    $patient_id = get_patientID($conn,$fname,$lname);
    $med_id = get_med_ID($conn,$med_name);

    $med_data_array = array(
        0=> $med_reg_id,
        1=> $med_id,
        2=> $patient_id,
        3=> $delivery_status,       
        4=> $time_of_day,
        5=> $date_given,
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
           
                insert_new_med_status($conn,$med_data_array);
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
