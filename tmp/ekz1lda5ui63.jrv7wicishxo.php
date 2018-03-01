<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<p><b>First Name:</b> <?= ($SESSION['member']->getFname()) ?></p>
<p><b>Last Name:</b> <?= ($SESSION['member']->getLname()) ?></p>
<p><b>Age:</b> <?= ($SESSION['member']->getAge()) ?></p>
<p><b>Gender:</b> <?= ($SESSION['member']->getGender()) ?></p>
<p><b>Phone Number:</b> <?= ($SESSION['member']->getPhone()) ?></p>
<p><b>Email:</b> <?= ($SESSION['member']->getEmail()) ?></p>
<p><b>State:</b> <?= ($SESSION['member']->getState()) ?></p>
<p><b>Seeking:</b> <?= ($SESSION['member']->getSeeking()) ?></p>
<p><b>Biography:</b> <?= ($SESSION['member']->getBio()) ?></p>
<?php if ($SESSION['premium']): ?>
    <p>
        <b>Indoor Interests:</b>
        <?php foreach (($SESSION['member']->getIndoorInterests()?:[]) as $indoorInterest): ?><br><?= ($indoorInterest) ?><?php endforeach; ?>
    </p>
    <p>
        <b>Outdoor Interests:</b>
        <?php foreach (($SESSION['member']->getOutdoorInterests()?:[]) as $outdoorInterest): ?><br><?= ($outdoorInterest) ?><?php endforeach; ?>
    </p>
<?php endif; ?>
</body>
</html>