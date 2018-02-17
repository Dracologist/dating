<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<?php
require_once('vendor/autoload.php');

$f3 = Base::instance();

include('validation/validate.php');

$f3->set('indoorOptions', array("Watching TV", "Reading", "Napping", "Internet", "Video games", "Music"));
$f3->set('outdoorOptions', array("Walking", "Hiking", "Running", "Bird watching", "Swimming", "Sports"));

$f3->route('GET /', function() {
    $view = new View();
    echo $view->render('pages/home.html');
});

$f3->route('GET|POST /profile', function() {
    $template = new Template;
    echo $template->render('pages/profile.html');
});

$f3->route('POST /submit-profile', function($f3) {
    $template = new Template;
    if(validName($_POST['fname'], $_POST['lname'], $f3)){
        $f3->set('fname', $_POST['fname']);
        $f3->set('lname', $_POST['lname']);
    }
    if(validAge($_POST['age'], $f3)){
        $f3->set('age', $_POST['age']);
    }
    if(validPhone($_POST['phone'], $f3)){
        $f3->set('phone', $_POST['phone']);
    }
    $f3->set('bio', $_POST['bio']);
    $f3->set('gender', $_POST['gender']);
    $f3->set('seeking', $_POST['seeking']);
    $f3->set('state', $_POST['state']);
    $f3->set('email', $_POST['email']);
    $f3->set('premium', $_POST['premium'] == "yes");
    if(empty($f3->get('errors'))){
        if($f3->get('premium')){
            echo $template->render('pages/interests.html');
        }
        else{
            echo $template->render('pages/summary.html');
        }
    }

    else{
        echo $template->render('pages/profile.html');
    }

});

$f3->route('POST /submit-interests', function($f3) {
    $template = new Template;
    if(validIndoor($_POST['indoor[]'], $f3->get('indoorOptions'), $f3)){
        $f3->set('indoor', $_POST['indoor[]']);
    }
    if(validOutdoor($_POST['outdoor[]'], $f3->get('outdoorOptions'), $f3)){
        $f3->set('outdoor', $_POST['outdoor[]']);
    }

    if(empty($f3->get('errors'))){
        echo $template->render('pages/summary.html');
    }
    else{
        echo $template->render('pages/interests.html');
    }
});

$f3->route('GET|POST interests/', function($f3) {
    $template = new Template();
    echo $template->render('pages/interests.html');
});

$f3->route('GET|POST /summary', function($f3) {
    $template = new Template();
    if($f3->get('premium')){

        $member = new PremiumMember($f3->get('fname'), $f3->get('lname'), $f3->get('age'), $f3->get('gender'),
            $f3->get('phone'), $f3->get('email'), $f3->get('state'), $f3->get('seeking'), $f3->get('bio'),
            $f3->get('indoor'), $f3->get('outdoor'));
    }
    else{
        $member = new Member($f3->get('fname'), $f3->get('lname'), $f3->get('age'), $f3->get('gender'),
            $f3->get('phone'), $f3->get('email'), $f3->get('state'), $f3->get('seeking'), $f3->get('bio'));
    }
    $f3->set('member', $member);
    echo $template->render('pages/summary.html');
});

$f3->run();