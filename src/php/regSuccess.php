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
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $emer_contact = $_POST["emer_contact"];
    $emer_phone = $_POST["emer_phone"];
    $nutrition_id = $_POST["nutrition_id"];
    $med_reg_id = $_POST["med_reg_id"];
    $exercise_id = $_POST["exercise_id"];
    $photo = $_POST["photo"];
    $room_id = $_POST["room_id"];
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    $dob = $_POST["dob"];
    $sex = $_POST["sex"];

    // Put variables into array to pass to insert function
    $reg_data_array = array(
        0=> "$fname",
        1=> "$lname",
        2=>$phone,
        3=>$email,
        4=>$address,
        5=>$emer_contact,
        6=>$emer_phone,
        7=>$nutrition_id,
        8=>$med_reg_id,
        9=>$exercise_id,
        10=>$photo,
        11=>$room_id,
        12=>$weight,
        13=>$height,
        14=>$dob,
        15=> $sex,
    );



?>
<!-- Check for authorised access !--> 
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    <html>
        <head>
        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title>Patient Rego Form</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
            <link rel='stylesheet' type='text/css' media='screen' href='../css/Patient_rego.css'>
            <script src="../js/Functions.js"></script>
    </head>
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
                // Add new Patient if the Patient does not already exist in the database
                if(!already_registered($conn,$fname,$lname,$email)){
                   echo "<h1> $fname $lname with email $email has succefully been registered </h1>";
                   insert_new_patient($conn,$reg_data_array);
                }

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
