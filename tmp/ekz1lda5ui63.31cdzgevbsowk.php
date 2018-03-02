<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="container">
    <form method="post" action="submit-profile" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
                <h4>Seeking</h4>
                <?php if (isset($SESSION['errors']['seeking'])): ?><p><?= ($SESSION['errors']['seeking']) ?></p><?php endif; ?>
                <input type="radio" name="seeking" value="male" <?php if ($SESSION['member']->getSeeking() == 'male'): ?>checked<?php endif; ?>> Male<br>
                <input type="radio" name="seeking" value="female" <?php if ($SESSION['member']->getSeeking() == 'female'): ?>checked<?php endif; ?>> Female
                <h4>State</h4>
                <select name="state">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA" selected>Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
                <h4>Email</h4>
                <?php if (isset($SESSION['errors']['email'])): ?><p><?= ($SESSION['errors']['email']) ?></p><?php endif; ?>
                <input type="text" name="email" value="<?= ($SESSION['member']->getEmail()) ?>">
            </div>
            <div class="col-sm-6">
                <h4>Biography</h4>
                <?php if (isset($SESSION['errors']['bio'])): ?><p><?= ($SESSION['errors']['bio']) ?></p><?php endif; ?>
                <textarea name="bio" rows="10" cols="30" class="rounded"><?= ($SESSION['member']->getBio()) ?></textarea>
                <?php if ($SESSION['premium']): ?>
                    <h4>Profile Picture</h4>
                    <input type="file" name="profilePic" accept="image/*">
                <?php endif; ?>
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