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
?>
<!-- Check for xauthorised access !--> 
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
              <!-- navbar -->
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
            <!-- Temporary form but with same fields as final -->
            <!-- Include div below for each field which needs validation-->
        <div class = "form_background">
            <div class="line"></div>     
            <div class="form_title">Enter New Diet Record</div>
            <div class ="Exit">  <!-- cross on form to exit registration back to home -->
                <a href="../php/homepage.php"><img src="../../images/refused.png" style="width:34px;height:33px;"></a>
            </div>
            <!-- Temporary form but with same fields as final -->
            <!-- Include div below for each field which needs validation-->
            <form id = "nutrition_status_form" method = "post" onsubmit = "validInfo()" action = "../php/nutrition_status_success.php" target = "blank">
            <label class = "reg_input_field"for="fname">First name:</label><br>
            <input class="input_field_text"type="text" id="fname" name="fname" onchange = "ValidFirstName()"><br>
            <div class = "input_comment">
                <p id = "fname_input_comment" style = "margin:0"></p>
            </div>
           
            <!-- Last Name --> 
            <label class = "reg_input_field" for="lname">Last name:</label><br>
            <input class="input_field_text" type="text" id="lname" name="lname" onchange="ValidLastName()"><br>
            <div class = "input_comment">
                <p id = "lname_input_comment" style = "margin:0"></p>
            </div>

            <!-- Med ID --> 
            <label class = "reg_input_field"for="meal_id"> Meal ID :</label><br>
            <input class="input_field_text"type="text" id="meal_id" name="meal_id"><br>
            <div class = "input_comment">
                <p id = "meal_id_input_comment" style = "margin:0"></p>
            </div>

            <!-- Delivery Status --> 
            <label class = "reg_input_field"for="delivery_status">Delivery Status</label><br>
            <select class = "select_form_meal" id="delivery_status" name="delivery_status">
                <option value="Received">Received</option>
                <option value="Refused">Refused</option>
                <option value="No Stock">No Stock</option>
                <option value="Fasting">Fasting</option>
            </select> <br>


            <!-- Submit --> 
            <input id = "back_to_home_meal" type="submit" value="Submit">
            </form>
        </div>
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