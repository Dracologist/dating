<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin View</title>
</head>
<body>
<div class="container">
    <table id="members" class="table table-striped" >
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th><th>Phone</th>
            <th>Gender</th>
            <th>Email</th>
            <th>State</th>
            <th>Seeking</th>
            <th>Bio</th>
            <th>Premium</th>
            <th>Profile Image</th>
            <th>Interests</th>
            <th>Profile</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (($members?:[]) as $currentMember): ?>
            <tr>
                <?php foreach (($currentMember?:[]) as $info): ?><td><?= ($info) ?></td><?php endforeach; ?>
                <td><a href="view-<?= ($currentMember['member_id']) ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>