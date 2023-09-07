<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

    <div class = "row">
        <div class = "column_card">
            <h2 class = "column_title">
				
			<?php
				// Establish connection with server
				$conn = odbc_connect('z5309236', '', '', SQL_CUR_USE_ODBC);
				if(!$conn){exit("Connection Failed:". $conn);}
			

                $PatientsSql = "
					SELECT First_Name,Last_Name,Email
					FROM Practitioner;
				";
				
				$ShowPatient = odbc_exec($conn, $PatientsSql);
                
                echo "<h2> Registered Practioners: </h2>";
                while($row = odbc_fetch_array($ShowPatient)){				
                    $fname = $row["First_Name"];
                    $lname = $row["Last_Name"];									
                    $email = $row["Email"];	 
                    echo "<p> Name: $fname $lname<br></p>";
                    echo "<p>Email: $email</p>";
                }
                ?>
       
</html>
