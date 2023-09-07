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

    $username = $_POST["Username"];
    $pword = $_POST["Password"];
    
    if ( $practitioner_id = get_practitionerID($conn) != 0){

    } else {
        $practitioner_id = login_practitioner($conn, $username, $pword);

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
            
        </div>
        <span class="logo_title">M</span><span class="logo_title_detail">ANAG</span><span class="logo_title">ED.</span>
        <div class="logo"></div>
            <!-- Temporary form but with same fields as final -->
            <!-- Include div below for each field which needs validation-->
        <div class = "form_background">
                
                    <div class="form_title">Select Round</div>
                    <div class ="Exit">  <!-- cross on form to exit registration back to home -->
                        <a href="../php/homepage.php"><img src="../../images/refused.png" style="width:34px;height:33px;"></a>
                    </div>
            <!-- Temporary form but with same fields as final -->
            <!-- Include div below for each field which needs validation-->
            <form id = "select_rounds_form" method = "post" onsubmit = "validInfo()" action = "../php/homepage.php" target = "blank">
    
            <!-- Time of Day -->  
            <label class = "reg_input_field"for="med_rounds"> Medications Round </label><br>
            <select class = "select_form_rounds" id="med_rounds" name="med_rounds">
                <option value="Morning">Morning</option>
                <option value="Afternoon">Afternoon</option>
                <option value="Evening">Evening</option>
            </select><br>

            <label class = "reg_input_field"for="diet_rounds"> Diet Round </label><br>
            <select class = "select_form_rounds" id="diet_rounds" name="diet_rounds">
                <option value="Morning">Morning</option>
                <option value="Afternoon">Afternoon</option>
                <option value="Evening">Evening</option>
            </select><br>


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