<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
    define('ACCESS_ALLOW',true);
    require('app/config/connect_me.php');

    $pdo = new connect_me();
    $q = $pdo->conn->prepare("SELECT * FROM `user`");
    $q->execute();
    while($row = $q->fetch(PDO::FETCH_OBJ))
    {
        echo $row->user_name."<br>";
    }
    ?>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-129668580-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-129668580-1');
</script>
</body>
</html>
