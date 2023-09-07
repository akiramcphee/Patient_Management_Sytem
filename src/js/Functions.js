

function ValidFirstName(){
    var input = document.getElementById('fname').value;
    const element = document.getElementById('fname_input_comment');
    const invalid_name_message = "First name should only contain letters, apostrophes, spaces and hyphens"

    // regular expression for letters, apostrophes, spaces and hyphens 
    regex = /^[A-z a-z ' \s -]+$/;
    if(!regex.test(input)){
        element.innerHTML = `<p class = "invalid_input"> ${invalid_name_message} </p>`;
        return 1;

    }
    else {
        element.innerHTML = `<p class = "valid_input"> No Errors</p>`;
        return 0;
    }
}

function ValidLastName(){
    var input = document.getElementById('lname').value;
    const element = document.getElementById('lname_input_comment');
    const invalid_name_message = "Last name should only contain letters, apostrophes, spaces and hyphens"

    // regular expression for letters, apostrophes, spaces and hyphens 
    regex = /^[A-z a-z ' \s -]*$/;
    if(!regex.test(input) || input == ""){
        element.innerHTML = `<p class = "invalid_input"> ${invalid_name_message} </p>`;
        return 1;
    }
    else {
        element.innerHTML = `<p class = "valid_input"> No Errors</p>`;
        return 0;
    }
}

function ValidEmail(){
    var input = document.getElementById('email').value;
    const element = document.getElementById('email_input_comment');
    const invalid_email_message = "Email Address is invalid"

    // regular expression for valid email
    regex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    if(!regex.test(input)){
        element.innerHTML = `<p class = "invalid_input"> ${invalid_email_message} </p>`;
        return 1;
    }
    else {
        element.innerHTML = `<p class = "valid_input"> No Errors</p>`;
        return 0;
    }
}

function ValidPassword(){
    var input = document.getElementById('pword_text_input').value;
    const element = document.getElementById('password_input_comment');
    const invalid_password_message = "Password must contain at least 8 characters and include uppercase, lowercase and numbers";

    // regular expression for upper and lowe case characters, minimum of 8 characters
    regex = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/
    if(!regex.test(input)){
        element.innerHTML = `<p class = "invalid_input"> ${invalid_password_message} </p>`;
        return 1;

    }
    else {
        element.innerHTML = `<p class = "valid_input"> No Errors</p>`;
        return 0;

    }
    
}

function CheckPasswordMatch(){
    var password = document.getElementById('pword_text_input').value;
    var input = document.getElementById('repword_text_input').value;
    const element = document.getElementById('repword_input_comment');
    const invalid_repword_message = "Passwords must match";


    if(input != password ){
        element.innerHTML = `<p class = "invalid_input"> ${invalid_repword_message} </p>`;
        return 1;
    }
    else {
        element.innerHTML = `<p class = "valid_input"> No Errors</p>`;
        return 0;
    }
}

function ValidDOB(){
    var input = document.getElementById('dob').value;
    const element = document.getElementById('dob_input_comment');
    const invalid_dob_message = "Invalid Date of Birth";

    // regular expression for letters, apostrophes, spaces and hyphens 
    const regex = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/

    // Assuming correct format - will fail regex condition if not in correct format
    const year = parseInt(input.substr(input.length -4));
    const month = parseInt(input.substr(input.length -7));
    const day = parseInt(input.substr(input.length -10));

    // years out of range for valid birthdays
    const invalidYear = year > 2020 || year < 1900 ? true : false;

    if(!regex.test(input) || invalidYear || invalidDay(day,month)){
        element.innerHTML = `<p class = "invalid_input"> ${invalid_dob_message} </p>`;
        return 1;
    }
    else {
        element.innerHTML = `<p class = "valid_input"> No Errors</p>`;
        return 0;
    }
    
}

// Check days per month as well as leap years
function invalidDay(day,month){
    // Handle zero and negative days and months
    if (day <= 0 || month <= 0) return 1;
    // Days for each month
    switch(month){
        case 1:
            if (day > 31) return 1;
            break;

        case 2:
            // Februrary during leap years
            if (day > 28 && !isLeapYear(year)) {
                return 1;
            } else if (day > 29 && isLeapYear(year)){
                return 1;
            }
            break;

        case 3:
            if (day > 31) return 1;
            break;

        case 4:
            if (day > 30) return 1;
            break;

        case 5:
            if (day > 31) return 1;
            break;
            
        case 6:
            if (day > 30) return 1;
            break;         

        case 7:
            if (day > 31) return 1;
            break;

        case 8:
            if (day > 31) return 1;
            break;
            
        case 9:
            if (day > 30) return 1;
            break;
            
        case 10:
            if (day > 31) return 1;
            break;   

        case 11:
            if (day > 30) return 1;
            break;

        case 12:
            if (day > 31) return 1;
            break;
        default:
            return 0;
    }
}

function isLeapYear(year) {
    if ((0 == year % 4) && (0 != year % 100) || (0 == year % 400)) {
        return true;
    } else {
        return false;
    }
}

function isValidID(field){
    var input = document.getElementById(field).value;
    const element = document.getElementById(`${field}_input_comment`);
    const invalid_id_message = " ID must be an integer";

    if(isNaN(input)){
        element.innerHTML = `<p class = "invalid_input"> ${invalid_id_message} </p>`;
        return 1;
    }
    else {
        element.innerHTML = `<p class = "valid_input"> No Errors</p>`;
        return 0;
    }
}

function isValidMeas(field){
    var input = document.getElementById(field).value;
    const element = document.getElementById(`${field}_input_comment`);
    
    switch(field){
        case "height":
            min = 140;
            max = 220;
            invalid_id_message = `Height must be between ${min}cm and ${max}cm`;
            if (input < min || input > max){
                element.innerHTML = `<p class = "invalid_input"> ${invalid_id_message} </p>`;
                return 1;
            }
            break;
        
        case 'weight':
            min = 40;
            max = 130;
            invalid_id_message = `Weight must be between ${min}kg and ${max}kg`;
            if (input < min || input > max){
                element.innerHTML = `<p class = "invalid_input"> ${invalid_id_message} </p>`;
                return 1;
            }
            break;
            
        case 'sex':
            invalid_id_message = "Sex must be Male (M) or Female (F)";
            console.log(input);
            if(input != 'M' && input != 'F'){
                element.innerHTML = `<p class = "invalid_input"> ${invalid_id_message} </p>`;
                return 1;
            }
            break;
              
    }

    element.innerHTML = `<p class = "valid_input"> No Errors</p>`;
    return 0;

}

// Validate form info before allowing submission
function validInfo(){
    if(ValidFirstName() ||
       ValidLastName() ||
       ValidEmail() ||
       isValidID('nutrition_id') ||
       isValidID('med_reg_id') ||
       isValidID('exercise_id') ||
       isValidID('room_id') ||
       isValidMeas('weight') ||
       isValidMeas('height') ||
       isValidMeas('sex') ||
       ValidDOB() ){
        alert("Invalid form - ensure all fields are correctly filled");
        // prevent form from submission
        event.preventDefault();
        document.getElementById("reg_form").reset();
        return 1;
    }
    return 0;
}


function previewImage(){
    var input = document.getElementById('profile_link').value;
    const element = document.getElementById('preview_profile_image');
    console.log(input)
    element.innerHTML = `<img src="${input}">`;
   
    return 0;
}
