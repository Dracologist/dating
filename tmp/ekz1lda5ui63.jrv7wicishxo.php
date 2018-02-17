<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<p>First Name: <?= ($SESSION['fname']) ?></p>
<p>Last Name: <?= ($SESSION['lname']) ?></p>
<p>Age: <?= ($SESSION['age']) ?></p>
<p>Gender: <?= ($SESSION['gender']) ?></p>
<p>Phone Number: <?= ($SESSION['phone']) ?></p>
<p>Email: <?= ($SESSION['email']) ?></p>
<p>State: <?= ($SESSION['state']) ?></p>
<p>Seeking: <?= ($SESSION['seeking']) ?></p>
<p>Biography: <?= ($SESSION['bio']) ?></p>
<?php if ($SESSION['premium']): ?>
    <p>
        <b>Indoor Interests:</b>
        <?php foreach (($SESSION['indoor']?:[]) as $indoorInterest): ?><br><?= ($indoorInterest) ?><?php endforeach; ?>
    </p>
    <p>
        <b>Outdoor Interests:</b>
        <?php foreach (($SESSION['outdoor']?:[]) as $outdoorInterest): ?><br><?= ($outdoorInterest) ?><?php endforeach; ?>
    </p>
<?php endif; ?>
</body>
</html>