<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="container">
<form action="submit-interests" method="post">
    <fieldset>
        <legend>Indoor</legend>
        <?php foreach (($SESSION['indoorOptions']?:[]) as $indoorActivity): ?>
            <label><input type="checkbox" name="indoor[]" value="<?= ($indoorActivity) ?>"> <?= ($indoorActivity) ?></label>
        <?php endforeach; ?>
    </fieldset>
    <fieldset>
        <legend>Outdoor</legend>
        <?php foreach (($SESSION['outdoorOptions']?:[]) as $outdoorActivity): ?>
            <label><input type="checkbox" name="outdoor[]" value="<?= ($outdoorActivity) ?>"> <?= ($outdoorActivity) ?></label>
        <?php endforeach; ?>
    </fieldset>
    <input type="submit" value="Next>" class="btn btn-primary">
</form>
</div>
</body>
</html>