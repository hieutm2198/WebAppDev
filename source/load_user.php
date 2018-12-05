<?php
    include('server.php');
    if($_SESSION['check_user'] == 0) {
    $msv = $_SESSION['msv'];
    $idnamhoc = $_SESSION['idnamhoc'];
    if($_SESSION['role_user'] == "normal") {
        $sql_info_friend = "SELECT idcuusinhvien, hoten, anh, online FROM cuusinhvien WHERE idnamhoc='$idnamhoc' AND idcuusinhvien!='$msv' ORDER BY online DESC";
    }
    else {
        $sql_info_friend = "SELECT idcuusinhvien, hoten, anh, online FROM cuusinhvien WHERE idcuusinhvien!='$msv' ORDER BY online DESC";
    }
    $result = mysqli_query($db, $sql_info_friend);
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)) {
            $msv_friend = $row['idcuusinhvien'];
            $hoten_friend = $row['hoten'];
            $anh_friend = $row['anh'];
            $online = $row['online'];
            $sql_status_online = "SELECT dangnhapgannhat FROM user WHERE idcuusinhvien='$msv_friend'";
            $result1 = mysqli_query($db, $sql_status_online);
            $offline = mysqli_fetch_array($result1)['dangnhapgannhat'];
            if($online == 1) {
                echo "<div onclick='message(this)' style='cursor: pointer' class='media pt-3 pr-2'>
                        <img src='image/" .$anh_friend. "' alt='Image_Friend' class='mr-2 rounded-circle' width='30px;' height='30px'>
                        <div class='media-body pb-1 mb-0 ml-1'>
                            <div class='d-flex justify-content-between align-items-center w-100'>
                                <span class='text-dark' style='position: relative; top: -5px; font-size: 13px; font-weight: 600'>" .$hoten_friend. "</span>
                                <i class='fas fa-circle text-success' style='font-size: 8px'></i>
                            </div>
                            <span class='d-block small text-dark' style='position: relative; top: -5px'>Đang hoạt động</span>
                        </div>
                    </div>";
            }
            else {
                echo "<div onclick='message(this)' style='cursor: pointer' class='media text-muted pt-3 pr-2'>
                        <img src='image/" .$anh_friend. "' alt='Image_Friend' class='mr-2 rounded-circle' width='30px;' height='30px'>
                        <div class='media-body pb-1 mb-0 ml-1'>
                            <div class='d-flex justify-content-between align-items-center w-100'>
                                <span class='text-gray-dark' style='position: relative; top: -5px; font-size: 13px; font-weight: 600'>" .$hoten_friend. "</span>
                                <i class='fas fa-circle' style='font-size: 8px'></i>
                            </div>
                            <span class='d-block small' style='position: relative; top: -5px'>".substr($offline, 11, 8). " " 
                            .substr($offline, 8, 2). "/" .substr($offline, 5, 2). "/" .substr($offline, 0, 4). "</span>
                        </div>
                    </div>";
            }
        }
    }
}
?>