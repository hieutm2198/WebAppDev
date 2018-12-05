<?php
    include('server.php');
    if(isset($_GET['detail_post'])) {
        $idbaidang = $_GET['detail_post'];
        $_SESSION['idbaidang'] = $idbaidang;
        $sql_info_post = "SELECT * FROM baidang WHERE idbaidang='$idbaidang'";
        $result34 = mysqli_query($db, $sql_info_post);
        $arr_info_post = mysqli_fetch_array($result34);
        $sql_count_cmt = "SELECT count(*) count_cmt FROM binhluan WHERE idbaidang='$idbaidang'";
        $result35 = mysqli_query($db, $sql_count_cmt);
        $_SESSION['cmt_baidang'] = mysqli_fetch_array($result35)['count_cmt'];
        $_SESSION['hinhanh'] = $arr_info_post['hinhanh'];
        $_SESSION['thoigian_dangbai'] = $arr_info_post['thoigian'];
        $_SESSION['tieude'] = $arr_info_post['tieude'];
        $_SESSION['noidung'] = $arr_info_post['noidung'];
        header("location: post_friend.php");
    }
?>