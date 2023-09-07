<!DOCTYPE html>
<!-- Start the session !--> 
<?php session_start(); ?>
<!-- Check for authorised access !--> 
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    <html>
        <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Schedule Page</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
        <link rel='stylesheet' type='text/css' media='screen' href='../css/schedule.css '>
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
				<span class="home_nav">Home</span>
				<span class="sched_nav_selected">Schedule</span>
				<span class="resource_nav">Resources</span>
				<span class="reports_nav">Reports</span>
			</div>
			<span class="logo_title">M</span><span class="logo_title_detail">ANAG</span><span class="logo_title">ED.</span>
			<div class="logo"></div>

			<!-- patient table in the body !-->
			<div class="table_bgd">
				<span class="table_title">Today's Schedule</span>
				
				<!-- display today's date -->
				<div class="btn_bgd">
					<span class="btn_txt">Monday 7th November</span>
				</div>

				<!-- display "time of day" -->
				<div class="btn_bgd_tod">
					<span class="btn_txt">Afternoon</span>
				</div>

				<div class="line"></div>

				<!-- search through the table !--> 
				<div class="tpt_bar"></div>
				<div class="search_icon"></div>
				<span class="hidden_text">Search</span>

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

			</div>

			<!-- footer -->
			<div id="footer_dynamic"></div>

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