<?php
    include("database.php");
    $userId = $_POST['userId'];
    $sql = 'select * from cuusinhvien join user on cuusinhvien.idcuusinhvien = user.idcuusinhvien where iduser='.$userId.';';
    $studentId = (($connection -> query($sql)) -> fetch_assoc())['idcuusinhvien'];

    
    $sql = 'SET foreign_key_checks = 0;';
    $sql .= 'delete from user where  iduser = '.$userId.';';
    $sql .= 'delete from cuusinhvien where  idcuusinhvien = "'.$studentId.'";';
    $sql .= 'SET foreign_key_checks = 1;';
    $connection -> multi_query($sql);
?>