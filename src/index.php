<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <?php
            if(isset($_SESSION['username'])) {
                echo "<p>Welcome <strong>" .$_SESSION['username']. "</strong></p>";
            }
        ?>
    </div>
</body>
</html>