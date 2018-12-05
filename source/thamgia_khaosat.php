<?php
    include('server.php');
    $sql_thamgia_ks = "SELECT count(*) thamgia_ks FROM thuchienkhaosat";
    $result = mysqli_query($db, $sql_thamgia_ks);
    echo mysqli_fetch_array($result)['thamgia_ks']. " lượt tham gia"; 
?>