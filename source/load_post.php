<?php
    include('server.php');
    if($_SESSION['check_user'] == 0) {
    $msv = $_SESSION['msv'];
    $idnamhoc = $_SESSION['idnamhoc'];
    if($_SESSION['role_user'] == "normal") {
        $sql_info_post = "SELECT csv.hoten hoten_user_post, csv.anh anh_user_post, bd.idbaidang id_post,
        bd.tieude tieude_post, bd.noidung noidung_post, bd.hinhanh anh_post, bd.yeuthich like_post, bd.thoigian time_post 
        FROM cuusinhvien csv JOIN baidang bd ON csv.idcuusinhvien=bd.idcuusinhvien 
        WHERE csv.idnamhoc='$idnamhoc' ORDER BY time_post DESC";
    }
    else {
        $sql_info_post = "SELECT csv.hoten hoten_user_post, csv.anh anh_user_post, bd.idbaidang id_post,
        bd.tieude tieude_post, bd.noidung noidung_post, bd.hinhanh anh_post, bd.yeuthich like_post, bd.thoigian time_post 
        FROM cuusinhvien csv JOIN baidang bd ON csv.idcuusinhvien=bd.idcuusinhvien ORDER BY time_post DESC";
    }
    $result = mysqli_query($db, $sql_info_post);
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)) {
            $hoten_user = $row['hoten_user_post'];
            $anh_user = $row['anh_user_post'];
            $tieude_post = $row['tieude_post'];
            $noidung_post = $row['noidung_post'];
            $anh_post = $row['anh_post'];
            $like_post = $row['like_post'];
            $time_post = $row['time_post'];
            $id_post = $row['id_post'];
            $sql_count_cmt = "SELECT count(*) count_cmt FROM binhluan WHERE idbaidang='$id_post'";
            $result1 = mysqli_query($db, $sql_count_cmt);
            $count_cmt = mysqli_fetch_array($result1)['count_cmt'];
            echo "<div class='card pl-4' style='width: 100%; padding: 20px; margin-bottom: 20px;'>
                    <div class='card-header' style='border-bottom: none; background: transparent; padding: 0;'>
                        <div class='media'>
                            <img src='image/" .$anh_user. "' alt='Image_User' class='mr-2 rounded-circle' style='width: 50px; height: 50px;'>
                            <div class='media-body'>
                                <h6>" .$hoten_user. "</h6>
                                <p style='font-size: 12px; color: rgba(173, 172, 172, 0.8);'>"
                                    .substr($time_post, 11, 8). " " .substr($time_post, 8, 2). "/" .substr($time_post, 5, 2). "/" 
                                    .substr($time_post, 0, 4). "</p>
                            </div>
                        </div>
                    </div>
                    <div class='card-body mt-2' style='padding: 0;'>
                        <img style='width: 99%' src='image/" .$anh_post. "' alt='Image_Post'> 
                        <p class='mt-3'><a href='server5.php?detail_post=" .$id_post. "-" .$hoten_user. "-" .$anh_user. "' style='text-decoration: none; font-size: 22px; font-weight: 500;'>" .$tieude_post. "</a></p>
                    </div>    
                    <div class='card-footer' style='border-top: none; background: transparent; padding: 0; position: relative'>
                        <span>" .$like_post. "</span>
                        <i class='fas fa-caret-up fa-2x ml-2' style='color: gray; font-size: 32px; position: relative; top: 5px;'></i>
                        <i class='fas fa-caret-down fa-2x ml-1' style='color: gray; font-size: 32px; position: relative; top: 5px;'></i>
                        <i class='fas fa-comment fa-lg' style='color: gray; position: absolute; right: 6%; bottom: 5px;'></i>
                        <span style='position: absolute; right: 4%; bottom: 0px;'>" .$count_cmt. "</span>
                    </div>
                </div>";
        }
    }
    else {
        echo "<h3 style='margin-top: 20px'>Không có bài đăng</h3>";
    }
}
?>