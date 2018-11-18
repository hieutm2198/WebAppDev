<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    $luot_like = $_POST['luot_like'];
    $da_like = $_POST['check1'];
    $da_dislike = $_POST['check2'];
    $lichsu = $_POST['content'];
    $trangthai = $_POST['message'];
    $idbaidang = $_SESSION['idbaidang'];
    $like_idbaidang = "like_baidang" .$idbaidang;
    $dislike_idbaidang = "dislike_baidang" .$idbaidang;
    $sql_update_yeuthich = "UPDATE baidang SET yeuthich='$luot_like' WHERE idbaidang='$idbaidang'";
    $result = mysqli_query($db, $sql_update_yeuthich);
    $sql_update_like_baidang = "UPDATE like_baidang SET $like_idbaidang='$da_like', $dislike_idbaidang='$da_dislike' WHERE idcuusinhvien='$msv'";
    $result1 = mysqli_query($db, $sql_update_like_baidang);
    $info_post = "SELECT bd.tieude tieude_post, csv.idcuusinhvien msv_chu_post, csv.hoten hoten_chu_post FROM baidang bd JOIN cuusinhvien csv 
    ON bd.idcuusinhvien=csv.idcuusinhvien WHERE bd.idbaidang='$idbaidang'";
    $result2 = mysqli_query($db, $info_post);
    $info_post = mysqli_fetch_array($result2);
    $hoten_chu_post = $info_post['hoten_chu_post'];
    $tieude_post = $info_post['tieude_post'];
    if($hoten_chu_post == $_SESSION['username']) {
        $lichsu .= " bài viết " .$tieude_post. " của bạn" ;
    }
    else {
        $lichsu .= " bài viết " .$tieude_post. " của " .$hoten_chu_post;
        $msv_chu_post = $info_post['msv_chu_post'];
        $message = $_SESSION['username'].$trangthai. " bài viết " .$tieude_post. " của bạn";
        $thongbao = "INSERT INTO thongbao(idcuusinhvien, idbaidang, noidung) VALUES ('$msv_chu_post', '$idbaidang', '$message')";
        $result4 = mysqli_query($db, $thongbao);
    }
    $content = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$lichsu')";
    $result3 = mysqli_query($db, $content);
?>