<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    if(isset($_GET['tanglike'])) {
        $like_cmt = $_GET['tanglike'];
        $dislike_cmt = "dis" .$like_cmt;
        $idbinhluan = substr($like_cmt, 8);
        $sql_info_like_cmt = "SELECT * FROM like_cmt WHERE idcuusinhvien='$msv'";
        $result = mysqli_query($db, $sql_info_like_cmt);
        $arr_info_like_cmt = mysqli_fetch_array($result);
        $check_like = $arr_info_like_cmt[$like_cmt];
        $check_dislike = $arr_info_like_cmt[$dislike_cmt];
        $sql_count_like_cmt = "SELECT like_cmt FROM binhluan WHERE idbinhluan='$idbinhluan'";
        $result1 = mysqli_query($db, $sql_count_like_cmt);
        $total_like_cmt = mysqli_fetch_array($result1)['like_cmt'];
        if($check_like == 0) {
            if($check_dislike == 0) {
                $total_like_cmt += 1;
            }        
            if($check_dislike == 1) {
                $total_like_cmt += 2;
            }
            $check_like = 1;
            $check_dislike = 0;
        }
        else {
            $check_like = 0;
            $total_like_cmt -= 1;
        }
        $sql_update_like_cmt = "UPDATE like_cmt SET $like_cmt='$check_like', $dislike_cmt='$check_dislike' WHERE idcuusinhvien='$msv'";
        $result2 = mysqli_query($db, $sql_update_like_cmt);
        $sql_update_count_like_cmt = "UPDATE binhluan SET like_cmt='$total_like_cmt' WHERE idbinhluan='$idbinhluan'";
        $result3 = mysqli_query($db, $sql_update_count_like_cmt);
        header("location: post.php");
    }
    if(isset($_GET['giamlike'])) {
        $dislike_cmt = $_GET['giamlike'];
        $like_cmt = substr($dislike_cmt, 3);
        $idbinhluan = substr($like_cmt, 8);
        $sql_info_like_cmt = "SELECT * FROM like_cmt WHERE idcuusinhvien='$msv'";
        $result = mysqli_query($db, $sql_info_like_cmt);
        $arr_info_like_cmt = mysqli_fetch_array($result);
        $check_like = $arr_info_like_cmt[$like_cmt];
        $check_dislike = $arr_info_like_cmt[$dislike_cmt];
        $sql_count_like_cmt = "SELECT like_cmt FROM binhluan WHERE idbinhluan='$idbinhluan'";
        $result1 = mysqli_query($db, $sql_count_like_cmt);
        $total_like_cmt = mysqli_fetch_array($result1)['like_cmt'];
        if($check_dislike == 0) {
            if($check_like == 0) {
                $total_like_cmt -= 1;
            }        
            if($check_like == 1) {
                $total_like_cmt -= 2;
            }
            $check_dislike = 1;
            $check_like = 0;
        }
        else {
            $check_dislike = 0;
            $total_like_cmt += 1;
        }
        $sql_update_like_cmt = "UPDATE like_cmt SET $like_cmt='$check_like', $dislike_cmt='$check_dislike' WHERE idcuusinhvien='$msv'";
        $result2 = mysqli_query($db, $sql_update_like_cmt);
        $sql_update_count_like_cmt = "UPDATE binhluan SET like_cmt='$total_like_cmt' WHERE idbinhluan='$idbinhluan'";
        $result3 = mysqli_query($db, $sql_update_count_like_cmt);
        header("location: post.php");
    }
    if(isset($_GET['tanglike1'])) {
        $like_rep_cmt = $_GET['tanglike1'];
        $dislike_rep_cmt = "dis" .$like_rep_cmt;
        $idtraloi = substr($like_rep_cmt, 12);
        $sql_info_like_rep_cmt = "SELECT * FROM like_rep_cmt WHERE idcuusinhvien='$msv'";
        $result = mysqli_query($db, $sql_info_like_rep_cmt);
        $arr_info_like_rep_cmt = mysqli_fetch_array($result);
        $check_like = $arr_info_like_rep_cmt[$like_rep_cmt];
        $check_dislike = $arr_info_like_rep_cmt[$dislike_rep_cmt];
        $sql_count_like_rep_cmt = "SELECT like_rep_cmt FROM traloi WHERE idtraloi='$idtraloi'";
        $result1 = mysqli_query($db, $sql_count_like_rep_cmt);
        $total_like_rep_cmt = mysqli_fetch_array($result1)['like_rep_cmt'];
        if($check_like == 0) {
            if($check_dislike == 0) {
                $total_like_rep_cmt += 1;
            }        
            if($check_dislike == 1) {
                $total_like_rep_cmt += 2;
            }
            $check_like = 1;
            $check_dislike = 0;
        }
        else {
            $check_like = 0;
            $total_like_rep_cmt -= 1;
        }
        $sql_update_like_rep_cmt = "UPDATE like_rep_cmt SET $like_rep_cmt='$check_like', $dislike_rep_cmt='$check_dislike' WHERE idcuusinhvien='$msv'";
        $result2 = mysqli_query($db, $sql_update_like_rep_cmt);
        $sql_update_count_like_rep_cmt = "UPDATE traloi SET like_rep_cmt='$total_like_rep_cmt' WHERE idtraloi='$idtraloi'";
        $result3 = mysqli_query($db, $sql_update_count_like_rep_cmt);
        header("location: post.php");
    }
    if(isset($_GET['giamlike1'])) {
        $dislike_rep_cmt = $_GET['giamlike1'];
        $like_rep_cmt = substr($dislike_rep_cmt, 3);
        $idtraloi = substr($like_rep_cmt, 12);
        $sql_info_like_rep_cmt = "SELECT * FROM like_rep_cmt WHERE idcuusinhvien='$msv'";
        $result = mysqli_query($db, $sql_info_like_rep_cmt);
        $arr_info_like_rep_cmt = mysqli_fetch_array($result);
        $check_like = $arr_info_like_rep_cmt[$like_rep_cmt];
        $check_dislike = $arr_info_like_rep_cmt[$dislike_rep_cmt];
        $sql_count_like_rep_cmt = "SELECT like_rep_cmt FROM traloi WHERE idtraloi='$idtraloi'";
        $result1 = mysqli_query($db, $sql_count_like_rep_cmt);
        $total_like_rep_cmt = mysqli_fetch_array($result1)['like_rep_cmt'];
        if($check_dislike == 0) {
            if($check_like == 0) {
                $total_like_rep_cmt -= 1;
            }        
            if($check_like == 1) {
                $total_like_rep_cmt -= 2;
            }
            $check_dislike = 1;
            $check_like = 0;
        }
        else {
            $check_dislike = 0;
            $total_like_rep_cmt += 1;
        }
        $sql_update_like_rep_cmt = "UPDATE like_rep_cmt SET $like_rep_cmt='$check_like', $dislike_rep_cmt='$check_dislike' WHERE idcuusinhvien='$msv'";
        $result2 = mysqli_query($db, $sql_update_like_rep_cmt);
        $sql_update_count_like_rep_cmt = "UPDATE traloi SET like_rep_cmt='$total_like_rep_cmt' WHERE idtraloi='$idtraloi'";
        $result3 = mysqli_query($db, $sql_update_count_like_rep_cmt);
        header("location: post.php");
    }
?>