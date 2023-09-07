<!DOCTYPE html>

<!-- Start the session !--> 
<?php 

    require ("db_helper.php");
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
            <form id = "reg_form" method = "post" onsubmit = "validInfo()" action = "../php/regSuccess.php" target = "blank">
                    <div class="line"></div>     
                    <div class="form_title">Register New Patient</div>
                    <div class ="Exit">  <!-- cross on form to exit registration back to home -->
                        <a href="../php/homepage.php"><img src="../../images/refused.png" style="width:34px;height:33px;"></a>
                    </div>
                <label class = "reg_input_field" for="fname">First name:</label><br>
                <input class="input_field_text" type="text" id="fname" name="fname" onchange = "ValidFirstName()"><br>
                <div class = "input_comment">
                    <p id = "fname_input_comment" style = "margin:0"></p>
                </div>
            
                <!-- Last Name --> 
                <label class = "reg_input_field" for="lname">Last name:</label><br>
                <input class="input_field_text"type="text" id="lname" name="lname" onchange="ValidLastName()"><br>
                <div class = "input_comment">
                    <p id = "lname_input_comment" style = "margin:0"></p>
                </div>
                
                <!-- Email --> 
                <label class = "reg_input_field" for="email">Email:</label><br>
                <input class="input_field_text"type="text" id="email" name="email" onchange = "ValidEmail()"><br>
                <div class = "input_comment">
                    <p id = "email_input_comment" style = "margin:0"></p>
                </div>

                <!-- Phone Number --> 
                <label class = "reg_input_field"for="phone">Phone Number:</label><br>
                <input class="input_field_text"type="text" id="phone" name="phone"><br>

                <!-- Address --> 
                <label class = "reg_input_field" for="address"> Address:</label><br>
                <input class="input_field_text" type="text" id="address" name="address"><br>

                <!-- Emergency Contact name --> 
                <label class = "reg_input_field"for="emer_contact">Emergency contact name:</label><br>
                <input class="input_field_text" type="text" id="emer_contact" name="emer_contact"><br>

                <!-- Emergency Contact Phone  --> 
                <label class = "reg_input_field"for="emer_phone">Emergency contact phone num :</label><br>
                <input class="input_field_text"type="text" id="emer_phone" name="emer_phone"><br>

                <!-- Nutrition ID --> 
                <label class = "reg_input_field"for="nutrition_id">Nutrition ID:</label><br>
                <input class="input_field_text"type="text" id="nutrition_id" name="nutrition_id" onchange = "isValidID('nutrition_id')"><br>
                <div class = "input_comment">
                    <p id = "nutrition_id_input_comment" style = "margin:0"></p>
                </div>

                <!-- Med Reg ID --> 
                <label class = "reg_input_field"for="med_reg_id"> Med_Reg_ID:</label><br>
                <input class="input_field_text" type="text" id="med_reg_id" name="med_reg_id" onchange = "isValidID('med_reg_id')"  ><br>
                <div class = "input_comment">
                    <p id = "med_reg_id_input_comment" style = "margin:0"></p>
                </div>

                <!-- Exercise ID --> 
                <label class = "reg_input_field"for="exercise_id"> Exercise_ID:</label><br>
                <input class="input_field_text"type="text" id="exercise_id" name="exercise_id" onchange = "isValidID('exercise_id')"><br>
                <div class = "input_comment">
                    <p id = "exercise_id_input_comment" style = "margin:0"></p>
                </div>

                <!-- Photo --> 
                <!-- Images will be saved as urls -->
                <label class = "reg_input_field"for="photo"> Patient Photo:</label><br>
                <input class="input_field_text"  id = "profile_link" type="text" name="photo" onchange = "previewImage()"/>
                <div id = "preview_profile_image"></div>

                <!-- Room ID --> 
                <label class = "reg_input_field" for="room_id"> Room_ID:</label><br>
                <input class="input_field_text" type="text" id="room_id" name="room_id" onchange = "isValidID('room_id')"><br>
                <div class = "input_comment">
                    <p id = "room_id_input_comment" style = "margin:0"></p>
                </div>

                <!-- Weight --> 
                <label class = "reg_input_field" for="weight"> Weight:</label><br>
                <input class="input_field_text" type="text" id="weight" name="weight" onchange = "isValidMeas('weight')"><br>
                <div class = "input_comment">
                    <p id = "weight_input_comment" style = "margin:0"></p>
                </div>

                <!-- Height --> 
                <label class = "reg_input_field"for="height"> Height:</label><br>
                <input class="input_field_text"type="text" id="height" name="height" onchange = "isValidMeas('height')"><br>
                <div class = "input_comment">
                    <p id = "height_input_comment" style = "margin:0"></p>
                </div>

                <!-- DOB -->
                <label class = "reg_input_field"for="dob"> DOB:</label><br>
                <input class="input_field_text"type="text" id="dob" name="dob" onchange = "ValidDOB()"><br>
                <div class = "input_comment">
                    <p id = "dob_input_comment" style = "margin:0"></p>
                </div>

                <!-- Sex --> 
                <label class = "reg_input_field" for="sex">Sex</label>
                <select class = "select_form" id="sex" name="sex">
                    <option  value="Male">Male</option>
                    <option  value="Female">Female</option>
                </select>
                
                <!-- Submit --> 
                <div class = "submit_button_placement">
                    <input class = "submit_form_button" type="submit" value="Submit">
                </div>
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