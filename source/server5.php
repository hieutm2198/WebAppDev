<?php
    include('server.php');
    if(isset($_GET['detail_post'])) {
        $hoten_user = $_SESSION['username'];
        $array = explode("-", $_GET['detail_post']);
        $idbaidang = $array[0];
        $chu_baidang = $array[1];
        $anh_chu_baidang = $array[2];
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
        if($chu_baidang == $hoten_user) {
            header("location: post.php");
        }
        else {
            $_SESSION['username_friend'] = $chu_baidang;
            $_SESSION['anh_friend'] = $anh_chu_baidang;
            header("location: post_friend.php");
        }
    }
?>