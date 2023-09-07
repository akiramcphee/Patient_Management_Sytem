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
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Patient Summary</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link rel='stylesheet' type='text/css' media='screen' href='../css/patient_summary.css'>
        <script src="time.js"></script>
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
                <!-- navbar links back to login for now, assign correct pathways -->
                <a href="homepage.php"><span class="home_nav">Home</span></a>
                <a href="login.html"><span class="sched_nav">Schedule</span></a>
                <a href="login.html"><span class="resource_nav">Resources</span></a>
                <a href="login.html"><span class="reports_nav">Reports</span></a>
            </div>
            <span class="logo_title">M</span><span class="logo_title_detail">ANAG</span><span class="logo_title">ED.</span>
        <div class="logo"></div>
           

            <div class='table_bgd'>
                <?php 
                $fname = $_POST["fnameProfile"];
                $lname = $_POST["lnameProfile"];
                show_patient_profile($conn,$fname,$lname);
                ?>
                <div id = 'regimes_info'>
                    <!-- <div style='width: 100%; overflow: hidden;'> -->
                        <!-- <div style='width: 50%; height: 100%; float: left; margin-left:10%;'>  -->
                    <div id = 'profile_med_record'>
                        <h2> Medication Record </h2>
                    </div>
                    <div class = "med_table_title">   
                        <div class = "row">
                            <div class = "column">
                                <p>Date and Time<p>
                            </div>  
                            <div class = "column">
                                <p>Time of Day<p>
                            </div> 
                            <div class = "column">
                                <p>Medication Name<p>
                            </div>  
                            <div class = "column">
                                <p>Status<p>
                            </div>  
                            
                                
                        </div>  
                    </div>
                    <?php show_med_round($conn,$fname,$lname); ?>

                </div>
                <div id = 'regimes_info'>

                        
                        <div id = 'profile_med_record'>
                            <h2> Diet Record </h2>
                        </div>
                        <div class = "med_table_title">   
                            <div class = "row">
                                <div class = "column">
                                    <p>Date<p>
                                </div>  
                                <div class = "column">
                                    <p>Time Given<p>
                                </div> 
                                <div class = "column">
                                    <p>Meal ID<p>
                                </div>  
                                <div class = "column">
                                    <p>Status<p>
                                </div>  
                                 
                            </div>  
                        </div>
      
                        <?php show_diet_round($conn,$fname,$lname);?>
          
                    </div> 
                </div>
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