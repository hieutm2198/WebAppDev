<?php
    include('server.php');
    $idbaidang = $_SESSION['idbaidang'];
    $sql_count_like = "SELECT yeuthich FROM baidang WHERE idbaidang='$idbaidang'";
    $result = mysqli_query($db, $sql_count_like);
    echo mysqli_fetch_array($result)['yeuthich'];
?>