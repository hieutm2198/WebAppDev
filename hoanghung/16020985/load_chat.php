<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    $user_chat = $_SESSION['user_chat'];
    $sql_info_user_chat = "SELECT idcuusinhvien, anh FROM cuusinhvien WHERE hoten='$user_chat'";
    $result = mysqli_query($db, $sql_info_user_chat);
    $arr_info_user_chat = mysqli_fetch_array($result);
    $msv_user_chat = $arr_info_user_chat['idcuusinhvien'];
    $anh_user_chat = $arr_info_user_chat['anh'];
    $sql_get_message = "SELECT id_user1, noidung, thoigian FROM tinnhan WHERE (id_user1='$msv' AND id_user2='$msv_user_chat') OR
    (id_user1='$msv_user_chat' AND id_user2='$msv') ORDER BY thoigian ASC";
    $result1 = mysqli_query($db, $sql_get_message);
    if(mysqli_num_rows($result1) > 0) {
        while($row=mysqli_fetch_assoc($result1)) {
            if($row['id_user1'] == $msv) {
                echo "<small style='margin-left: 45%'>" .substr($row['thoigian'], 11, 8). " " .substr($row['thoigian'], 8, 2). "/" .substr($row['thoigian'], 5, 2). "/" 
                .substr($row['thoigian'], 0, 4). "</small>
                <p style='color: #fff; padding: 5px 8px 6px; border-radius: 10px; margin-left: 35%; width: 65%; background: rgb(53, 166, 231)' class='mt-1'>" .$row['noidung']. "</p>";
            }
            else {
                echo "<div class='media p-2'>
                <img src='image/" .$anh_user_chat. "' alt='User_chat' class='mr-2 rounded-circle' width='30px' height='30px'
                style='position: relative; top: 30px'>
                <div class='media-body' style='width: 72%'>
                    <small class='ml-4'>" .substr($row['thoigian'], 11, 8). " " .substr($row['thoigian'], 8, 2). "/" .substr($row['thoigian'], 5, 2). "/" 
                    .substr($row['thoigian'], 0, 4). "</small>
                    <p class='mt-1' style='background: #e9ebee; padding: 5px 8px 6px; border-radius: 10px; width: 72%;'>"
                    .$row['noidung']. "</p>
                </div>
            </div>";
            }
        }
    }
?>