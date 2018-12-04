<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    $user_chat = $_SESSION['user_chat'];
    $text_chat = $_POST['text_chat'];
    if($text_chat != '') {
        $sql_info_user_chat = "SELECT idcuusinhvien FROM cuusinhvien WHERE hoten='$user_chat'";
        $result = mysqli_query($db, $sql_info_user_chat);
        $msv_user_chat = mysqli_fetch_array($result)['idcuusinhvien'];
        $sql_insert_chat = "INSERT INTO tinnhan(id_user1, noidung, id_user2) VALUES ('$msv', '$text_chat', '$msv_user_chat')";
        $result1 = mysqli_query($db, $sql_insert_chat);
    }
?>