<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin View</title>
    <link rel="stylesheet" href='//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.min.css">
</head>
<body>
<div class="container">
    <table id="members" class="display table-striped" >
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th><th>Phone</th>
            <th>Gender</th>
            <th>Email</th>
            <th>State</th>
            <th>Gender</th>
            <th>Seeking</th>
            <th>Premium</th>
            <th>Profile Image</th>
            <th>Interests</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (($members?:[]) as $currentMember): ?>
            <a href="<?= ($currentMember['member_id']) ?>">
                <tr>
                    <?php foreach (($currentMember?:[]) as $info): ?><td><?= ($info) ?></td><?php endforeach; ?>
                </tr>
            </a>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>