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
        </head>
        <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home Page with Patients</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel='stylesheet' type='text/css' media='screen' href='../css/home_page.css'>
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
            <a href="../php/homepage.php"><span class="home_nav_selected">Home</span></a>
            <a href="../php/practitioner_schedule.php"><span class="sched_nav">Schedule</span></a>
            <a href="login.html"><span class="resource_nav">Resources</span></a>
            <a href="../php/profile_page.php"><span class="reports_nav">Reports</span></a>
        </div>
        <span class="logo_title">M</span><span class="logo_title_detail">ANAG</span><span class="logo_title">ED.</span>
        <div class="logo"></div>

        <!-- patient table in the body !-->
        <div class="table_bgd">
            <span class="table_title">Patients</span>
            <div class="btn_bgd">
                <!-- link this to Akira's patient reg page !-->
                <a href="../php/reg_patient.php"><span class="btn_txt">Create New Patient</span></a>
            </div>
            <div class="line"></div>

            <!-- search through the table !--> 
            <form id="search" name="search" method="POST" action="../php/searched.php"></form> <!-- return searched patient !--> 
                <div class="tpt_bar"></div>
                <div class="search_icon"></div>
                <span class="hidden_text">Search</span>
                <input type="text" class="search_text" id="search" name="search" value=""/>
            </form>

            <!-- filter the table results !--> 
            <div class="tpt_tab_1"></div>
            <div class="drop_icon_filt"></div>
            <span class="hidden_text_filt">Filter by</span>

            <!-- sort the table results !--> 
            <div class="tpt_tab_2"></div>
            <div class="drop_icon_sort"></div>
            <span class="hidden_text_sort">Sort by</span>


            <!-- download csv of the table view !-->
            <div class="tpt_tab_3"></div>
            <div class="download_icon"></div>

        
        <div id = 'patient_list'>
            <div class = "med_table_title">   
                <div class = "row">
                     <div class = "column">
                        <p>Patient Photo<p>
                    </div>  
                    <div class = "column">
                        <p>Name<p>
                    </div>  
                    <div class = "column">
                        <p>Sex<p>
                    </div> 
                    <div class = "column">
                        <p>Date of Birth<p>
                    </div>  
                    <div class = "column">
                        <p>Med Regime</p>
                    </div>  
                    <div class = "column">
                        <p>Diet Regime</p>
                    </div>  
                    <div class = "column">
                        <p> View Report </p>
                    </div>  
                       
                </div>  
            </div>
            <?php showPatients($conn,$practitioner_id); ?>

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