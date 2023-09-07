<!DOCTYPE html>

<!-- Start the session !--> 
<?php 
    require "db_helper.php";
    session_start(); 

    $conn = odbc_connect('z5309236', '', '', SQL_CUR_USE_ODBC);
    if(!$conn){exit("Connection Failed:". $conn);}

    $username = $_POST["Username"];
    $pword = $_POST["Password"];
    
    if ( $practitioner_id = get_practitionerID($conn) != 0){

    } else {
        $practitioner_id = login_practitioner($conn, $username, $pword);

    }
     

?>
<!-- Check for authorised access !--> 
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    

    <html>
    <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Diet Regime</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel='stylesheet' type='text/css' media='screen' href='../css/diet_regime.css'>
    </head>
    <body>
        <!-- navbar -->
        <div class="navbar_bgd"></div>
        <div class="bell_bgd">
            <div class="bell_img">
            </div>
        </div>
        <div class="nav_frame">
            <!-- navbar links back to login for now, assign correct pathways -->
            <a href="login.html"><span class="home_nav">Home</span></a>
            <a href="login.html"><span class="sched_nav">Schedule</span></a>
            <a href="login.html"><span class="resource_nav">Resources</span></a>
            <a href="login.html"><span class="reports_nav">Reports</span></a>
        </div>
        <span class="logo_title">M</span><span class="logo_title_detail">ANAG</span><span class="logo_title">ED.</span>
        <div class="logo"></div>
        <div class="table_bgd">
            <span class="table_title">Diet Regime</span>
            <div class="line"></div>
            <div class="btn_bgd_meal">
                <!-- link this to Akira's patient meal page !-->
                <a href="New_patient.html"><span class="btn_txt">Add Meal Plan</span></a>
            </div>
            <div class="btn_bgd_med">
                <!-- link this to Akira's patient med page !-->
                <a href="New_patient.html"><span class="btn_txt">Add Med Plan</span></a>
            </div>
            <!-- link this to php to return Patient Name here !-->
            <span class="Patient_Name">Montgomery James</span>
            <div class="time">
                <span class="Current_time" id="time">Current Time:</span>
            </div>
            <!-- link this to php to return regimes on summary page respective of time and date !-->
            <div class="date">
                <span class="selected_date">Select Date:</span>
                <input type="date" id="date" name="date">
            </div>
            <!-- link this to php to return regimes on summary page respective of time and date !-->
            <div class="round">
                <span class="selected_round">Select Round:</span>
                <input type="time" id="round" name="round">
            </div>
            <!-- download csv of the table view !-->
            <div class="tpt_tab_3"></div>
            <div class="download_icon"></div>
        </div>
        <div class="panel"></div>
        <!-- link this to php to return Patient photo in this panel !-->
        <div class="Patient_table">
            <table id = "Patient_table" border="1" cellpadding="5">
                <tr>
                    <th>Date</th>
                    <th>Round</th>
                    <th>Diet ID</th>
                    <th>Allergies</th>
                    <th>Diet Details</th>
                    <th>Administered</th>
                    <th>Dispensing Practioner</th>
                    <th>Exercise ID</th>
                    <th>Exercise Details</th>
                    <th>Administered</th>
                    <th>Dispensing Practioner</th>
                    <!-- link this to php to return patient status for exercise, meal and medicine closest to the viewed time !-->
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><select name="adminstered" id="adminstered">
                        <option selected>Not Given</option>
                        <option>Given</option>
                        <option>Refused</option>
                        <option>Fasting</option>
                        <option>No Stock</option>
                        <option>Ceased</option></select>   
                    </th>
                    <th><select name="practioner" id="practioner">
                        <option selected>Practioner</option>
                        <option></option>
                        <option></option>
                        <option></option>
                        <option></option>
                        <option></option></select>   
                    </th>
                    <th></th>
                    <th></th>
                    <th><select name="adminstered" id="adminstered">
                        <option selected>Not Completed</option>
                        <option>Completed</option>
                        <option>Refused</option>
                        <option>Ceased</option></select>   
                    </th>
                    <th><select name="practioner" id="practioner">
                        <option selected>Practioner</option>
                        <option></option>
                        <option></option>
                        <option></option>
                        <option></option>
                        <option></option></select>   
                    </th>
                </tr>
            </table>
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