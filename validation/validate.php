<?php
function validName($fname, $lname){
    if(!ctype_alpha($fname)){
        $errors['fname'] = "Invalid first name!";
    }
    if(!ctype_alpha($lname)){
        $errors['lname'] = "Invalid last name!";
    }
    return ctype_alpha($fname) && ctype_alpha($lname);
}
function validAge($age){
    $valid = true;
    if(!is_numeric($age)){
        $errors['age'] = "Age must be a number!";
        $valid = false;
    }
    elseif($age < 18){
        $errors['age'] = "You must be 18 or older to sign up!";
        $valid = false;
    }
    return $valid;
}

function validPhone($phone){
    if(!is_numeric($phone)){
        $errors['phone'] = "Invalid phone number!";
        return false;
    }
    else{
        return true;
    }
}