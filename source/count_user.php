<?php
    include('server.php');
    $sql_count_user = "SELECT count(*) count_user FROM cuusinhvien WHERE idcuusinhvien!='2018'";
    $result = mysqli_query($db, $sql_count_user);
    echo mysqli_fetch_array($result)['count_user']. " người dùng"; 
?>