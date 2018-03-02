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
<body>
<div class="container">
    <nav class="navbarnavbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="http://ekanzler.greenriverdev.com/328/dating">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://ekanzler.greenriverdev.com/328/dating/admin">Admin</a>
            </li>
        </ul>
    </nav>
<?php

$f3 = Base::instance();

$f3->set('CACHE', true);
new Session();


$f3->set('indoorOptions', array("Watching TV", "Reading", "Napping", "Internet", "Video games", "Music"));
$f3->set('outdoorOptions', array("Walking", "Hiking", "Running", "Bird watching", "Swimming", "Sports"));

require '/home/ekanzler/connect.php';
try {
    $dbh = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    echo 'Connected to database';
}
catch(PDOException $e) {
    echo $e->getMessage();
}

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
    }
    if(isset($_FILES['profilePic'])) {
        if($member->getProfilePic() != null) {
            $path = $member->getProfilePic();
        } else {
            $name = $f3->get('SESSION.member')->getFname().
                "-".$f3->get('SESSION.member')->getLname();
            $extension = "." . pathinfo($_FILES['profilePic']['name'],PATHINFO_EXTENSION);
            if(file_exists("images/".$name.$extension)){
                $name .= "(1)";
            }
            $path = "images/".$name.$extension;
        }
        move_uploaded_file($_FILES['profilePic']['tmp_name'], $path);
        $member->setProfilePic($path);
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

$f3->route('GET|POST /finalize', function($f3, $dbh) {
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
    $template = new Template;
    $cols = array("fname"=>$f3->get('SESSION.member')->getFname(),
        "lname"=>$f3->get('SESSION.member')->getLname(), "age"=>$f3->get('SESSION.member')->getAge(),
        "gender"=>$f3->get('SESSION.member')->getGender(), "phone"=>$f3->get('SESSION.member')->getPhone(),
        "email"=>$f3->get('SESSION.member')->getEmail(), "state"=>$f3->get('SESSION.member')->getState(),
        "seeking"=>$f3->get('SESSION.member')->getSeeking(), "bio"=>$f3->get('SESSION.member')->getBio(),
        "premium"=>$f3->get('SESSION.premium'));
    $types  = array("fname"=>PDO::PARAM_STR, "lname"=>PDO::PARAM_STR, "age"=>PDO::PARAM_INT,
        "gender"=>PDO::PARAM_STR, "phone"=>PDO::PARAM_STR, "email"=>PDO::PARAM_STR, "state"=>PDO::PARAM_STR,
        "seeking"=>PDO::PARAM_STR, "bio"=>PDO::PARAM_STR, "premium"=>PDO::PARAM_BOOL);
    if($f3->get('SESSION.premium')){
        $cols['image'] = $f3->get('SESSION.member')->getProfilePic();
        $types['image'] = PDO::PARAM_STR;
        $interests = "";
        foreach ($f3->get('SESSION.member')->getOutdoorInterests() as $outdoorInterest){
            $interests .= $outdoorInterest;
            if(end($f3->get('SESSION.member')->getOutdoorInterests()) != $outdoorInterest ||
                $f3->get('SESSION.member')->getIndoorInterests() != null) {
                $interests .= ", ";
            }
        }
        foreach ($f3->get('SESSION.member')->getIndoorInterests() as $indoorInterest){
            $interests .= $indoorInterest;
            if(end($f3->get('SESSION.member')->getIndoorInterests()) != $indoorInterest) {
                $interests .= ", ";
            }
        }
        $cols['interests'] = $interests;
        $types['interests'] = PDO::PARAM_STR;
    }
    $fields = "";
    $values = "";
    foreach ($cols as $name=>$val){
        $fields .= $val;
        $values .= ":".$val;
        if($val != end($cols)){
            $fields .= ", ";
            $values .= ", ";
        }
    }
    $sql = 'INSERT INTO member('.$fields.') VALUES('.$values.')';
    $statement = $dbh->prepare($sql);
    foreach ($cols as $key => &$value){
        $statement->bindParam(":".$key, $value, $types[$key]);
    }
    $statement->execute();
    echo "<p>Member added to database!</p>";
    echo $template->render('views/summary.html');
});

$f3->route('GET /admin', function($f3, $dbh) {
    $template = new Template;
    $sql = 'SELECT * FROM member';
    $statement = $dbh->prepare($sql);
    $f3->set('SESSION.members', $statement->fetchAll(PDO::FETCH_ASSOC));
    echo $template->render('views/admin.html');
});

$f3->route('GET /@id', function($f3, $dbh) {
    $template = new Template;
    $sql = 'SELECT * FROM member WHERE member_id = :id';
    $statement = $dbh->prepare($sql);
    $memberID = $f3->get('PARAMS.id');
    $statement->bindParam(":id", $memberID, PDO::PARAM_INT);
    $f3->set('SESSION.viewMember', $statement->fetch(PDO::FETCH_ASSOC));
    echo $template->render('views/admin.html');
});

$f3->run();
?>
</div>
</body>
