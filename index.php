<?php session_start(); ?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<?php
require_once('vendor/autoload.php');

$f3 = Base::instance();

$f3->set('CACHE', true);
new Session();


$f3->set('SESSION.indoorOptions', array("Watching TV", "Reading", "Napping", "Internet", "Video games", "Music"));
$f3->set('SESSION.outdoorOptions', array("Walking", "Hiking", "Running", "Bird watching", "Swimming", "Sports"));


$f3->route('GET /', function() {
    $view = new View();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /profile', function() {
    $template = new Template;
    echo $template->render('views/profile.html');
});

$f3->route('POST /submit-profile', function($f3) {
    $template = new Template;
    if(validName($_POST['fname'], $_POST['lname'], $f3)){
        $f3->set('SESSION.fname', $_POST['fname']);
        $f3->set('SESSION.lname', $_POST['lname']);
    }
    if(validAge($_POST['age'], $f3)){
        $f3->set('SESSION.age', $_POST['age']);
    }
    if(validPhone($_POST['phone'], $f3)){
        $f3->set('SESSION.phone', $_POST['phone']);
    }
    $f3->set('SESSION.bio', $_POST['bio']);
    $f3->set('SESSION.gender', $_POST['gender']);
    $f3->set('SESSION.seeking', $_POST['seeking']);
    $f3->set('SESSION.state', $_POST['state']);
    $f3->set('SESSION.email', $_POST['email']);
    $f3->set('SESSION.premium', isset($_POST['premium']));
    if(empty($errors)) {
        if($f3->get('SESSION.premium')){
            $file = 'views/interests.html';
        } else {
            $file = 'views/summary.html';
        }
    } else {
        $file = 'views/profile.html';
    }
    echo $template->render($file);
});

$f3->route('POST /submit-interests', function($f3) {
    $template = new Template;
    if(validIndoor($_POST['indoor'], $f3->get('SESSION.indoorOptions'), $f3)){
        $f3->set('SESSION.indoor', $_POST['indoor']);
    }
    if(validOutdoor($_POST['outdoor'], $f3->get('SESSION.outdoorOptions'), $f3)){
        $f3->set('SESSION.outdoor', $_POST['outdoor']);
    }

    if(empty($f3->get('errors'))){
        $file = 'views/summary.html';
    } else{
        $file = 'views/interests.html';
    }
    echo $template->render($file);
});

$f3->route('GET|POST /summary', function($f3) {
    $template = new Template;
    if($f3->get('premium')){

        $member = new PremiumMember($f3->get('SESSION.fname'), $f3->get('SESSION.lname'),
            $f3->get('SESSION.age'), $f3->get('SESSION.gender'),
            $f3->get('SESSION.phone'), $f3->get('SESSION.email'),
            $f3->get('SESSION.state'), $f3->get('SESSION.seeking'), $f3->get('SESSION.bio'),
            $f3->get('SESSION.indoor'), $f3->get('SESSION.outdoor'));
    }
    else{
        $member = new Member($f3->get('SESSION.fname'), $f3->get('SESSION.lname'),
            $f3->get('SESSION.age'), $f3->get('SESSION.gender'),
            $f3->get('SESSION.phone'), $f3->get('SESSION.email'), $f3->get('SESSION.state'),
            $f3->get('SESSION.seeking'), $f3->get('SESSION.bio'));
    }
    $f3->set('SESSION.member', $member);
    echo $template->render('views/summary.html');
});

$f3->run();