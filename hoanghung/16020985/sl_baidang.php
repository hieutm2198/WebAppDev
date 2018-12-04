<?php
    include('server.php');
    $sql_count_bd = "SELECT count(*) count_baidang FROM baidang";
    $result = mysqli_query($db, $sql_count_bd);
    echo mysqli_fetch_array($result)['count_baidang']. " bài đăng"; 
?>