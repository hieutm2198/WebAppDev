<?php
    include("database.php");
    $userId = $_POST['userId'];
    $sql = 'select * from user where iduser='.$userId.';';
    $result = $connection -> query($sql);
    $currentRole = ($result -> fetch_assoc())['role_user'];
    if($currentRole == 'normal') {
        $nextRole = 'moderator';
    } else if($currentRole == 'moderator') {
        $nextRole = 'normal';
    }

    $sql = 'update user set role_user="'.$nextRole.'" where iduser='.$userId.';';
    $connection -> query($sql);
?>