<?php
require_once('vendor/autoload.php');

session_start();
session_save_path("/tmp/cache");
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<?php

/*
 * CREATE TABLE member (
    member_id int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fname varchar(25) NOT NULL,
    lname varchar(25) NOT NULL,
    age int(3) NOT NULL,
    gender varchar(6) NOT NULL,
    phone varchar(14) NOT NULL,
    email varchar(25) NOT NULL,
    state varchar(20) NOT NULL,
    seeking varchar(6) NOT NULL,
    bio varchar(600) NOT NULL,
    premium tinyint NOT NULL,
    image varchar(60),
    interests varchar(60)
    );
 */

$f3 = Base::instance();

$f3->set('CACHE', true);
new Session();


$f3->set('indoorOptions', array("Watching TV", "Reading", "Napping", "Internet", "Video games", "Music"));
$f3->set('outdoorOptions', array("Walking", "Hiking", "Running", "Bird watching", "Swimming", "Sports"));


$f3->route('GET /', function() {
    $view = new View();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /signup', function() {
    $template = new Template;
    echo $template->render('views/personal-info.html');
});

$f3->route('POST /submit-personal-info', function($f3) {
    $template = new Template;
    $errors = array();
    if (validName($_POST['fname'], $_POST['lname'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
    }
    if (validAge($_POST['age'], $f3)) {
        $age= $_POST['age'];
    }
    if (validPhone($_POST['phone'], $f3)) {
        $phone = $_POST['phone'];
    }
    if(isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    if(!isset($_POST['gender'])) {
        $errors['gender'] = "Please choose a gender";
    }
    $f3->set('SESSION.premium', isset($_POST['premium']));
    $f3->set('SESSION.errors', $errors);
    if(empty($f3->get('SESSION.errors'))) {
        $file = 'views/profile.html';
        if($f3->get('SESSION.premium')){
            $member = new PremiumMember($fname, $lname, $age, $gender, $phone);
        } else {
            $member = new Member($fname, $lname, $age, $gender, $phone);
        }
        $f3->set('SESSION.member', $member);
    } else {
        $file = 'views/personal-info.html';
    }
    echo $template->render($file);
});

$f3->route('POST /submit-profile', function($f3) {
    $template = new Template;
    $errors = array();
    $member = $f3->get('SESSION.member');
    if(isset($_POST['bio'])) {
        $member->setBio($_POST['bio']);
    } else {
        $errors['bio'] = "Please fill out your bio";
    }
    if(isset($_POST['seeking'])) {
        $member->setSeeking($_POST['seeking']);
    } else {
        $errors['seeking'] = "Please select a gender you're seeking";
    }
    $member->setState($_POST['state']);
    if(isset($_POST['email'])) {
        $member->setEmail($_POST['email']);
    } else {
        $errors['email'] = "Please enter your email";
    }
    $f3->set('SESSION.errors', $errors);
    if(empty($f3->get('SESSION.errors'))) {
        if($f3->get('SESSION.premium')){
            $file = 'views/interests.html';
        } else {
            $file = 'views/summary.html';
        }
        $f3->set('SESSION.member', $member);
    } else {
        $file = 'views/profile.html';
    }
    echo $template->render($file);
});

$f3->route('POST /submit-interests', function($f3) {
    $template = new Template;
    $member = $f3->get('SESSION.member');
    if(validIndoor($_POST['indoor'], $f3->get('indoorOptions'), $f3)){
        $member->setIndoorInterests($_POST['indoor']);
    }
    if(validOutdoor($_POST['outdoor'], $f3->get('outdoorOptions'), $f3)){
        $member->setOutdoorInterests($_POST['outdoor']);
    }

    if(empty($f3->get('errors'))){
        $file = 'views/summary.html';
        $f3->set('SESSION.member', $member);
    } else{
        $file = 'views/interests.html';
    }
    echo $template->render($file);
});

$f3->route('GET|POST /finalize', function($f3) {
    $template = new Template;
    echo $template->render('views/summary.html');
});

$f3->run();