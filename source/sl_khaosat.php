<?php
    include('server.php');
    $sql_count_ks = "SELECT count(*) count_ks FROM khaosat";
    $result = mysqli_query($db, $sql_count_ks);
    echo mysqli_fetch_array($result)['count_ks']. " khảo sát đã gửi"; 
?>