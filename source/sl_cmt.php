<?php
    include('server.php');
    $sql_count_cmt = "SELECT count(*) count_cmt FROM binhluan";
    $result = mysqli_query($db, $sql_count_cmt);
    echo mysqli_fetch_array($result)['count_cmt']. " lượt bình luận"; 
?>