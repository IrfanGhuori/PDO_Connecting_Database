<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User list</title>
</head>
<body>
    <?php
    define('ACCESS_ALLOW', true);
    require('app/config/connect_me.php');

    $db = new ConnectMe();
    $pdo = $db->getConnection();

    $statement = $pdo->prepare('SELECT user_name FROM `user`');
    $statement->execute();

    while ($row = $statement->fetch()) {
        echo htmlspecialchars($row['user_name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '<br>';
    }
    ?>
</body>
</html>
