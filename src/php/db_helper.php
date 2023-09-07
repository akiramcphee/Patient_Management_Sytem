<?php

function login_practitioner($conn, $username, $pword){
    $valid_user_sql ="
                SELECT *

                FROM Practitioner
                WHERE Username = '$username'
                AND Password = '$pword';
            ";
    $valid_user  = odbc_exec($conn,$valid_user_sql);
    $row = odbc_fetch_array($valid_user);
    if($row == NULL) {
        header("Location: ../html/login.html");
        exit();
    }

    $login_practitioner_sql = "
        UPDATE Practitioner 
        SET Is_Active = -1
        WHERE Username = '$username'
        AND Password = '$pword';
    ";

    $login_practitioner = odbc_exec($conn,$login_practitioner_sql);
    $practitioner_ID = $row["Practitioner_ID"];
    return $practitioner_ID;
    //echo "login dsucess";
}

function is_logged_in($conn){
    $login_sql = "
                SELECT Is_Active
                FROM Practitioner;
            ";

    $is_loggedin = odbc_exec($conn,$login_sql);

    // Loop through to check if an active user exists.
    // TODO: match with the username and password as submitted by the form
    // then update SQL query so that only that combination is searched for. 
    // Make use of != NULL instead of looping to find a true value
    while($row = odbc_fetch_array($is_loggedin)){	
        $check = $row["Is_Active"];
        if($row["Is_Active"] == 1){
           // echo "<h2> User is Logged in<br> </h2>";
            return true;
        }			
    }
    
    echo "Could not find a logged in user";

    return false;
}

// Check if a patient with a first name, last name and DOB combination has already been registered
function already_registered($conn,$fname,$lname,$email){
    // Check if user is already registered
    $is_registered_SQL = "
    SELECT * from Patient
    WHERE ((LCase(Patient.First_Name) = LCase('$fname') 
    AND LCase(Patient.Last_Name) = LCase('$lname'))
    OR LCase(Patient.Email) = LCase('$email'));";

    $isRegistered = odbc_exec($conn,$is_registered_SQL);

    if(odbc_result($isRegistered,1) != NULL) {
        echo "<h2> Registration failed<br> </h2>";
        echo "<p> $fname $lname with email $email has already been registered. <br></p>";
        return true;
    }
    return false;
}

function insert_new_patient($conn,$reg_data_array){
    $insert_new_user_SQL = "
        INSERT INTO Patient(First_Name, Last_Name, Phone_Num, Email,Address,
        Emergency_Contact_Name,
        Emergency_Contact_Num,
        Nutrition_ID,
        Med_Reg_ID,
        Exercise_ID,
        Patient_Photo,
        Room_ID,
        Weight,
        Height,
        DOB,
        Sex)
        VALUES(
            '$reg_data_array[0]',
            '$reg_data_array[1]',
            '$reg_data_array[2]',
            '$reg_data_array[3]',
            '$reg_data_array[4]',
            '$reg_data_array[5]',
            '$reg_data_array[6]',
            '$reg_data_array[7]',
            '$reg_data_array[8]',
            '$reg_data_array[9]',
            '$reg_data_array[10]',
            '$reg_data_array[11]',
            '$reg_data_array[12]',
            '$reg_data_array[13]',
            '$reg_data_array[14]',
            '$reg_data_array[15]');";

    $successful_register = odbc_exec($conn,$insert_new_user_SQL);

    if(!successful_register) {
        echo "<p> Register failed </p>";
    }
    else {
        echo "<p> $reg_data_array[0] $reg_data_array[1] has now been added to the database </p>";
    } 
}

function get_patientID($conn,$fname, $lname){
    $get_patientID_SQL = "
        SELECT First_Name, Last_Name, Patient_ID
        FROM Patient
        WHERE Patient.First_Name = '$fname'
        AND Patient.Last_Name = '$lname';
    ";

    $returned_id = odbc_exec($conn,$get_patientID_SQL);
    while($row = odbc_fetch_array($returned_id)){	
        $patient_id = $row["Patient_ID"];
       // echo "<h2> $patient_id </h2>";
        return $patient_id;	
    }
    echo "<h2> Incorrect Patient name </h2>";
    return 0;
}

function get_med_id($conn, $med_name){
    $get_medID_SQL = "
        SELECT Med_Name, Med_ID
        FROM Medications_Details
        WHERE Medications_Details.Med_Name = '$med_name';
    ";

    $returned_id = odbc_exec($conn,$get_medID_SQL);
    while($row = odbc_fetch_array($returned_id)){	
        $med_id = $row["Med_ID"];
       // echo "<h2> $patient_id </h2>";
        return $med_id;
    		
    }
    echo "<h2> Incorrect Med name </h2>";
    return 0;
}

function get_nutritionID($conn, $patient_id){
    $get_nutritionID_SQL = "
        SELECT Nutrition_ID, Patient_ID
        FROM Patient
        WHERE Patient.Patient_ID = $patient_id;
    ";

    $returned_id = odbc_exec($conn,$get_nutritionID_SQL);
    while($row = odbc_fetch_array($returned_id)){	
        $nutrition_id = $row["Nutrition_ID"];
       // echo "<h2> $patient_id </h2>";
        return $nutrition_id;	
    }
    echo "<h2> Incorrect Nutrition name </h2>";
    return 0;
}

function get_practitionerID($conn){
    $login_sql = "
                SELECT Practitioner_ID, Is_Active
                FROM Practitioner;
            ";

    $is_loggedin = odbc_exec($conn,$login_sql);

    // Loop through to check if an active user exists.
    // TODO: match with the username and password as submitted by the form
    // then update SQL query so that only that combination is searched for. 
    // Make use of != NULL instead of looping to find a true value
    while($row = odbc_fetch_array($is_loggedin)){	
        $check = $row["Is_Active"];
        $practitioner_id = $row["Practitioner_ID"];
        if($row["Is_Active"] == 1){
           // echo "<h2> User is Logged in<br> </h2>";
            return $practitioner_id;
        }			
    }
    
    echo "Could not find a logged in user";

    return 0;
}

function showPatients($conn,$practitioner_ID){
    $show_patients_sql = "
        SELECT First_Name, Last_Name, Phone_Num, Email,Address,Emergency_Contact_Num,Emergency_Contact_Name,Sex,DOB,Patient_Photo

        FROM Medications_Regime 
        INNER JOIN Patient ON Medications_Regime.Med_Reg_ID = Patient.Med_Reg_ID
        WHERE Medications_Regime.Practitioner_ID = $practitioner_ID;
    ";

    $show_patients = odbc_exec($conn,$show_patients_sql);

    // Loop through to check if an active user exists.
    // TODO: match with the username and password as submitted by the form
    // then update SQL query so that only that combination is searched for. 
    // Make use of != NULL instead of looping to find a true value
    while($row = odbc_fetch_array($show_patients)){	
        // Define variables from form input
        $fname = $row["First_Name"];
        $lname = $row["Last_Name"];
        $phone = $row["Phone_Num"];
        $email = $row["Email"];
        $address = $row["Address"];
        $emer_phone = $row["Emergency_Contact_Num"];
        $emer_name = $row["Emergency_Contact_Name"];
        $nutrition_id = $row["Nutrition_ID"];
        $med_reg_id = $row["Med_Reg_ID"];
        $exercise_id = $row["Exercise_ID"];
        $photo = $row["Patient_Photo"];
        $room_id = $row["Room_ID"];
        $weight = $row["Weight"];
        $height = $row["Height"];
        $dob = $row["DOB"];
        $sex = $row["Sex"];

        echo "
        <div class = 'med_table_entry'>
        <div class = 'row'>
           <div class ='column'>
            <img class = 'profile_display' src = '$photo' width = '160' height = '120' margin-right = '10' '> 

           </div>  
           <div class = 'column'>
               <p> $fname $lname </p>

           </div> 
           <div class = 'column'>
               <p> $sex </p>

           </div>  
           <div class = 'column'>
               <p> $dob </p>
           </div>
           <div class = 'column'>
           <form method = 'post' action='../php/Med_Regime.php' target = 'blank'>
                <input type='hidden' id='fnameProfile' name='fnameProfile' value='$fname'>
                <input type='hidden' id='lnameProfile' name='lnameProfile' value='$lname'>
                <input class = 'view_regime_button' type='submit' value='View Med Regime'>
            </form>
           </div>  
           <div class = 'column'>
           <form method = 'post' action='../php/Diet_Regime.php' target = 'blank'>
                <input type='hidden' id='fnameProfile' name='fnameProfile' value='$fname'>
                <input type='hidden' id='lnameProfile' name='lnameProfile' value='$lname'>
                <input class = 'view_regime_button' type='submit' value='View Diet Regime'>
            </form>
           </div>  
           <div class = 'column'>
           <form method = 'post' action='../php/profile_page.php' target = 'blank'>
                <input type='hidden' id='fnameProfile' name='fnameProfile' value='$fname'>
                <input type='hidden' id='lnameProfile' name='lnameProfile' value='$lname'>
                <input class = 'view_profile_button' type='submit' value='View Profile'>
            </form>
           </div>  
               
       </div>  
   </div>
        
        ";
    }

    return 0;		
}

function show_patient_profile($conn, $fname, $lname){
    $patient_id = get_patientID($conn,$fname,$lname);
    $show_patients_sql = "
        SELECT *

        FROM Patient
        WHERE Patient_ID = $patient_id;
    ";

    $show_patients = odbc_exec($conn,$show_patients_sql);

    $row = odbc_fetch_array($show_patients);

    $phone = $row["Phone_Num"];
    $email = $row["Email"];
    $address = $row["Address"];
    $emer_phone = $row["Emergency_Contact_Num"];
    $emer_name = $row["Emergency_Contact_Name"];
    $nutrition_id = $row["Nutrition_ID"];
    $med_reg_id = $row["Med_Reg_ID"];
    $exercise_id = $row["Exercise_ID"];
    $photo = $row["Patient_Photo"];
    $room_id = $row["Room_ID"];
    $weight = $row["Weight"];
    $height = $row["Height"];
    $dob = $row["DOB"];
    $sex = $row["Sex"];

    $date = date_create($dob);
    $dob = date_format($date,"d/m/Y");
    // <div id = 'patient_dob_field>
    //         <p class = 'field_name'> Date of Birth (dd/mm/yyyy):  </p>
    //         <p class = 'field_text'> $dob </p>
    //     </div>

    echo "

        <span class='table_title'>$fname $lname</span>
        <div class='line'></div>
    
    
        <div class='panel'>
            <img src='$photo' alt='$fname $lname profile' width = '345' height = '258' >
        </div>

        <div id = 'patient_info'>
            <div style='width: 100%; overflow: hidden;'>
                <div style='width: 50%; float: left; margin-left:10%;'> 
                    <p class = 'field_name'> <b>Sex</b>: $sex </p>
                    <p class = 'field_name'> Date of Birth: $dob </p>
                    <p class = 'field_name'> Email: $email </p>
                    <p class = 'field_name_under_photo'> Room Number: $room_id </p>
                    <p class = 'field_name_under_photo'> Height: $height cm </p>
                    <p class = 'field_name_under_photo'> Weight: $weight kg </p>
                </div>
                <div style='margin-right: 10%;'> 
                    <p class = 'field_name'> Address: $address </p>
                    <p class = 'field_name'> Emergency Contact Name: $emer_name </p>
                    <p class = 'field_name'> Emergency Contact Phone: $emer_phone</p>
                </div>
            </div>
        </div>

  
  


    ";
    
    return 0;	

}

function show_practitioner_profile($conn){
    $practitioner_ID = get_practitionerID($conn);
    $show_practitioner_sql = "
        SELECT *

        FROM Practitioner
        WHERE Practitioner_ID = $practitioner_ID;
    ";

    $show_practitioner = odbc_exec($conn,$show_practitioner_sql);

    $row = odbc_fetch_array($show_practitioner);

    $fname = $row["First_Name"];
    $lname = $row["Last_Name"];
    $role = $row["Role"];
    $email = $row["Email"];
    $photo = $row["Practitioner_Photo"];


    echo "
    <img src='$photo' alt='$fname $lname profile' width = '230' height = '172' >
    <p> Name: $fname $lname </p>
    <p> Role: $role </p>
    <p> Email: $email </p>
    <form method = 'post' action='../php/practitioner_profile_update.php' target = 'blank'>
        <input type='hidden' id='fname' name='fname' value='$fname'>
        <input type='hidden' id='lname' name='lname' value='$lname'>
        <input type='hidden' id='email' name='email' value='$email'>
        <input type='hidden' id='photo' name='photo' value='$photo'>
        <input type='submit' value='Update Details'>
    </form>
    ";
   
    
    return 0;	

}

function  update_practitioner_details($conn,$fname,$lname,$email,$photo){
    $practitioner_ID = get_practitionerID($conn);
    $show_practitioner_sql = "
        UPDATE Practitioner 
        SET First_Name = '$fname', 
            Last_Name = '$lname',
            Email = '$email',
            Practitioner_Photo = '$photo'
        WHERE Practitioner_ID = $practitioner_ID;
    ";

    $show_practitioner = odbc_exec($conn,$show_practitioner_sql);
}

function show_med_round($conn,$fname,$lname){
    $patient_id = get_patientID($conn,$fname,$lname);
    $show_med_round_sql = "
        SELECT *

        FROM Medications_Status
        WHERE Patient_ID = $patient_id;
    ";
    $show_med_rounds = odbc_exec($conn,$show_med_round_sql);

    while($row = odbc_fetch_array($show_med_rounds)){	
        // Define variables from form input
        $med_id = $row["Med_ID"];
        $delivery_status = $row["Delivery_Status"];
        $time_of_day = $row["Time_of_Day"];
        $date_given = $row["Date_Given"];

        $med_name = get_med_name($conn,$med_id);
        if($delivery_status == 'Received'){
            $icon = 'tick.png';
        } else if ($delivery_status == 'No Stock'){
            $icon = 'warning.png';
        }
        
        else {
            $icon = 'refused.png';
        }

        echo "  
        <div class = 'med_table_entry'>
             <div class = 'row'>
                <div class ='column'>
                     <p> $date_given </p>
                </div>  
                <div class = 'column'>
                    <p> $time_of_day </p>

                </div> 
                <div class = 'column'>
                    <p> $med_name </p>

                </div>  
                <div class = 'column'>
                    <p> $delivery_status </p>
                </div>  
                <div id = 'status_column'>
                    <div id = 'status_column'>
                        <img src = '../../images/$icon' width = '30' height = '30' margin-right = '10' '> 
                    </div>
                </div>  
                    
            </div>  
        </div>
        
        ";
    }
    echo "
    <div id = 'add_new_record'>
        <form method = 'post' action='../php/med_status_form.php' target = 'blank'>
            <input class = 'new_record_button'  type='submit' value='New Med Record'>
        </form>
    </div>
    
    ";
    return 0;		
}

function get_med_name($conn,$med_id){
    $get_med_name_SQL = "
    SELECT Med_Name, Med_ID
    FROM Medications_Details
    WHERE Medications_Details.Med_ID = $med_id;
    ";

    $returned_id = odbc_exec($conn,$get_med_name_SQL);
        while($row = odbc_fetch_array($returned_id)){	
            $med_name = $row["Med_Name"];
            // echo "<h2> $patient_id </h2>";
            return $med_name;
                
            }
        echo "<h2> Incorrect Med ID </h2>";
        return 0;
    
}

function show_diet_round($conn,$fname,$lname){
    $patient_id = get_patientID($conn,$fname,$lname);
    $show_diet_round_sql = "
        SELECT *

        FROM Nutrition_Status
        WHERE Patient_ID = $patient_id;
    ";
    $show_diet_rounds = odbc_exec($conn,$show_diet_round_sql);

    while($row = odbc_fetch_array($show_diet_rounds)){	
        // Define variables from form input
        $meal_id = $row["Meal_ID"];
        $delivery_status = $row["Status"];
        $time_given = $row["Time_Given"];
        $date_given = $row["Date_Given"];

        // if($delivery_status == 'Received'){
        //     $icon = 'tick.png';
        // } else ($delivery_status == 'Fasting'){
        //     $icon = 'fasting.png';
        // }
        if($delivery_status == 'Received'){
            $icon = 'tick.png';
        } else if ($delivery_status = 'Fasting') {
            $icon = 'fasting.png';
        } else {
            $icon = 'refused.png';
        }


        echo "  
        <div class = 'med_table_entry'>
            <div class = 'row'>
                <div class ='column'>
                        <p> $date_given </p>
                </div>  
                <div class = 'column'>
                    <p> $time_given </p>

                </div> 
                <div class = 'column'>
                    <p> $meal_id </p>

                </div>  
                <div class = 'column'>
                    <p> $delivery_status </p>
                </div>  
                <div id = 'status_column'>
                    <div id = 'status_column'>
                        <img src = '../../images/$icon' width = '30' height = '30' margin-right = '10' '> 
                    </div>
                </div>  
                
            </div>  
        </div>
            
        
        ";
    }
    echo "
    <div id = 'add_new_record'>
        <form method = 'post' action='../php/nutrition_status_form.php' target = 'blank'>
            <input class = 'new_record_button' type='submit' value='New Diet Record'>
        </form>
    </div>
    ";
    return 0;		
}


function insert_new_med_status($conn,$med_data_array){
    $insert_new_status_SQL = "
        INSERT INTO Medications_Status(
            Med_Reg_ID,
            Med_ID,
            Patient_ID,
            Delivery_Status,
            Time_of_Day,
            Date_Given)
        VALUES(
            '$med_data_array[0]',
            '$med_data_array[1]',
            '$med_data_array[2]',
            '$med_data_array[3]',
            '$med_data_array[4]',
            '$med_data_array[5]');";

        $successful_update = odbc_exec($conn,$insert_new_status_SQL);

        if(!$successful_update) {
            echo "<p> Register failed </p>";
        }
        else {
            echo "<p> Success </p>";
        } 
}

function insert_new_nutriiton_status($conn,$nutrition_data_array){
    $insert_new_status_SQL = "
        INSERT INTO Nutrition_Status(
            Nutrition_ID,
            Meal_ID,
            Status,
            Date_Given,
            Time_Given,
            Patient_ID)
        VALUES(
            '$nutrition_data_array[0]',
            '$nutrition_data_array[1]',
            '$nutrition_data_array[2]',
            '$nutrition_data_array[3]',
            '$nutrition_data_array[4]',
            '$nutrition_data_array[5]');";

        $successful_update = odbc_exec($conn,$insert_new_status_SQL);

        if(!$successful_update) {
            echo "<p> Register failed </p>";
        }
        else {
            echo "<p> Success </p>";
        } 
}

?>