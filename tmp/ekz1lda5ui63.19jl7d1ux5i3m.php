<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member #<?= ($viewMember['member_id']) ?></title>
</head>
<body>
<div class="container">
    <?php foreach (($viewMember?:[]) as $key=>$val): ?>
        <p id="<?= ($key) ?>">
            <b><?= ($key) ?>:</b>
            <?php if ($key == "image"): ?>
                
                    <br>
                    <img src="<?= ($val) ?>" title="<?= ($val) ?>" class="rounded" id="profile-pic">
                
                <?php else: ?>
                    <?= ($val)."
" ?>
                
            <?php endif; ?>
        </p>
    <?php endforeach; ?>
</div>
</body>
</html>