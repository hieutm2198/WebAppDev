<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    $luot_like = $_POST['luot_like'];
    $da_like = $_POST['check1'];
    $da_dislike = $_POST['check2'];
    $idbaidang = $_SESSION['idbaidang'];
    $like_idbaidang = "like_baidang" .$idbaidang;
    $dislike_idbaidang = "dislike_baidang" .$idbaidang;
    $sql_update_yeuthich = "UPDATE baidang SET yeuthich='$luot_like' WHERE idbaidang='$idbaidang'";
    $result = mysqli_query($db, $sql_update_yeuthich);
    $sql_update_like_baidang = "UPDATE like_baidang SET $like_idbaidang='$da_like', $dislike_idbaidang='$da_dislike' WHERE idcuusinhvien='$msv'";
    $result1 = mysqli_query($db, $sql_update_like_baidang);
?>