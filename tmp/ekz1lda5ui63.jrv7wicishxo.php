<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="container">
    <div class="col">
        <p><b>First Name:</b> <?= ($SESSION['member']->getFname()) ?></p>
        <p><b>Last Name:</b> <?= ($SESSION['member']->getLname()) ?></p>
        <p><b>Age:</b> <?= ($SESSION['member']->getAge()) ?></p>
        <p><b>Gender:</b> <?= ($SESSION['member']->getGender()) ?></p>
        <p><b>Phone Number:</b> <?= ($SESSION['member']->getPhone()) ?></p>
        <p><b>Email:</b> <?= ($SESSION['member']->getEmail()) ?></p>
        <p><b>State:</b> <?= ($SESSION['member']->getState()) ?></p>
        <p><b>Seeking:</b> <?= ($SESSION['member']->getSeeking()) ?></p>
        <?php if ($SESSION['premium']): ?>
            <p>
                <b>Interests:</b>
                <?php foreach (($SESSION['member']->getOutdoorInterests()?:[]) as $outdoorInterest): ?>
                    <?= ($outdoorInterest) ?><?php if ($outdoorInterest != end($SESSION['member']->getOutdoorInterests()) || $SESSION['member']->getIndoorInterests() != null): ?>,<?php endif; ?>
                <?php endforeach; ?>
                <?php foreach (($SESSION['member']->getIndoorInterests()?:[]) as $indoorInterest): ?>
                    <?= ($indoorInterest) ?><?php if ($indoorInterest != end($SESSION['member']->getIndoorInterests())): ?>,<?php endif; ?>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>
        <a href="finalize" class="btn btn-primary">Finish</a>
    </div>
    <div class="col">
        <?php if ($SESSION['premium']): ?>
            <?php if ($SESSION['member']->getProfilePic() != null): ?>
                <img src="<?= ($SESSION['member']->getProfilePic()) ?>" title="<?= ($SESSION['member']->getProfilePic()) ?>"  class="rounded">
            <?php endif; ?>
        <?php endif; ?>
        <blockquote><b>Biography:</b> <?= ($SESSION['member']->getBio()) ?></blockquote>
    </div>
</div>

</body>
</html>