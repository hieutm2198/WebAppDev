<?php
    include('server.php');
    $sql_count_user_online = "SELECT count(*) count_user_online FROM cuusinhvien WHERE idcuusinhvien!='2018' AND online='1'";
    $result = mysqli_query($db, $sql_count_user_online);
    echo mysqli_fetch_array($result)['count_user_online']. " người đang online"; 
?>