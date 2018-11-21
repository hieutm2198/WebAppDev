<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    if(isset($_POST['check'])) {
        if($_POST['check'] == 1) {
            $sql_update_trangthai = "UPDATE thongbao SET trangthai=1 WHERE idcuusinhvien='$msv'";
            $result = mysqli_query($db, $sql_update_trangthai);
        }
    }
    $sql_count_message = "SELECT count(*) sothongbao FROM thongbao WHERE trangthai=0 AND idcuusinhvien='$msv'";
    $result1 = mysqli_query($db, $sql_count_message);
    $sothongbao = mysqli_fetch_array($result1)['sothongbao'];
    echo $sothongbao;
?>