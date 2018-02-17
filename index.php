<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<?php
require_once('vendor/autoload.php');
$f3 = Base::instance();

$f3->route('GET /', function() {
    $view = new View;
    echo $view->render('pages/home.html');
});

$f3->route('GET|POST /personal-info', function($f3) {
    $view = new Template;
    echo $view->render('pages/personal-info.html');
});

$f3->route('GET|POST /profile', function($f3) {
    $view = new Template;
    echo $view->render('pages/profile.html');
});

$f3->route('GET|POST /interests', function($f3) {
    $view = new Template();
    echo $view->render('pages/interests.html');
});

$f3->route('GET|POST /summary', function($f3) {
    $view = new Template();
    echo $view->render('pages/summary.html');
});

$f3->run();