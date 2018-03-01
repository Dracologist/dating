<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Personal Info</title>
</head>
<body>
<div class="container">
    <form method="post" action="submit-personal-info">
        <div class="row">
            <div class="col-sm-6">
                <h4>First Name</h4>
                <?php if (isset($SESSION['errors']['fname'])): ?><p><?= ($SESSION['errors']['fname']) ?></p><?php endif; ?>
                <input type="text" name="fname" <?php if (isset($SESSION['member'])): ?>value='<?= ($SESSION['member']->getFname()) ?>'<?php endif; ?>>
                <h4>Last Name</h4>
                <?php if (isset($SESSION['errors']['lname'])): ?><p><?= ($SESSION['errors']['lname']) ?></p><?php endif; ?>
                <input type="text" name="lname" <?php if (isset($SESSION['member'])): ?>value='<?= ($SESSION['member']->getLname()) ?>'<?php endif; ?>>
                <h4>Age </h4>
                <?php if (isset($SESSION['errors']['age'])): ?><p><?= ($SESSION['errors']['age']) ?></p><?php endif; ?>
                <input type="text" name="age" <?php if (isset($SESSION['member'])): ?>value='<?= ($SESSION['member']->getAge()) ?>'<?php endif; ?>>
                <h4>Gender</h4>
                <?php if (isset($SESSION['errors']['gender'])): ?><p><?= ($SESSION['errors']['gender']) ?></p><?php endif; ?>
                <input type="radio" name="gender" value="male" <?php if (isset($SESSION['member'])): ?><?php if ($SESSION['member']->getGender() == 'male'): ?>checked<?php endif; ?><?php endif; ?>> Male<br>
                <input type="radio" name="gender" value="female" <?php if (isset($SESSION['member'])): ?><?php if ($SESSION['member']->getGender() == 'female'): ?>checked<?php endif; ?><?php endif; ?>selected> Female
                <h4>Phone</h4>
                <?php if (isset($SESSION['errors']['phone'])): ?><p><?= ($SESSION['errors']['phone']) ?></p><?php endif; ?>
                <input type="tel" name="phone" <?php if (isset($SESSION['member'])): ?>value='<?= ($SESSION['member']->getPhone()) ?>'<?php endif; ?>>
                <h4>Premium Account</h4>
                <label><input type="checkbox" name="premium" <?php if ($SESSION['premium']): ?>checked<?php endif; ?>> Sign me up for a premium account!</label>
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Next>" class="btn btn-primary">
        </div>
</div>
</form>
</div>
</body>
</html>