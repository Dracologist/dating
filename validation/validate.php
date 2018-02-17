<?php
function validName($fname, $lname, $f3){
    if(!ctype_alpha($fname)){
        $errors['fname'] = "Invalid first name!";
    }
    if(!ctype_alpha($lname)){
        $errors['lname'] = "Invalid last name!";
    }
    $f3->set('errors', $errors);
    return ctype_alpha($fname) && ctype_alpha($lname);
}
function validAge($age, $f3){
    $valid = true;
    if(!is_numeric($age)){
        $errors['age'] = "Age must be a number!";
        $valid = false;
    }
    elseif($age < 18){
        $errors['age'] = "You must be 18 or older to sign up!";
        $valid = false;
    }
    $f3->set('errors', $errors);
    return $valid;
}

function validPhone($phone, $f3){
    if(!is_numeric($phone)){
        $errors['phone'] = "Invalid phone number!";
        $f3->set('errors', $errors);
        return false;
    }
    else{
        $f3->set('errors', $errors);
        return true;
    }
}

function validIndoor($indoor, $validList, $f3){
    $valid = true;
    foreach ($indoor as $activity){
        if(!in_array($activity, $validList)){
            $errors['indoor'] = "Invalid indoor activity!";
            $valid = false;
        }
    }
    $f3->set('errors', $errors);
    return $valid;
}

function validOutdoor($outdoor, $validList, $f3){
    $valid = true;
    foreach ($outdoor as $activity){
        if(!in_array($activity, $validList)){
            $errors['outdoor'] = "Invalid indoor activity!";
            $valid = false;
        }
    }
    $f3->set('errors', $errors);
    return $valid;
}