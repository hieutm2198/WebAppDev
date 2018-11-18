<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    $idnamhoc = $_SESSION['idnamhoc'];
    $sql_info_friend = "SELECT idcuusinhvien, hoten, anh, online FROM cuusinhvien WHERE idnamhoc='$idnamhoc' AND idcuusinhvien!='$msv' ORDER BY online DESC";
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
                echo "<div class='media pt-3'>
                        <img src='image/" .$anh_friend. "' alt='Image_Friend' class='mr-2 rounded-circle' width='40px;' height='40px'>
                        <div class='media-body pb-1 mb-0'>
                            <div class='d-flex justify-content-between align-items-center w-100'>
                                <a style='text-decoration: none; color: gray' href='server.php?detail_friend=" .$hoten_friend. "'><strong class='text-dark'>" .$hoten_friend. "</strong></a>
                                <i class='fas fa-circle small text-success'></i>
                            </div>
                            <span class='d-block small text-dark'>Đang hoạt động</span>
                        </div>
                    </div>";
            }
            else {
                echo "<div class='media text-muted pt-3'>
                        <img src='image/" .$anh_friend. "' alt='Image_Friend' class='mr-2 rounded-circle' width='40px;' height='40px'>
                        <div class='media-body pb-1 mb-0'>
                            <div class='d-flex justify-content-between align-items-center w-100'>
                                <a style='text-decoration: none; color: gray' href='server.php?detail_friend=" .$hoten_friend. "'><strong class='text-gray-dark'>" .$hoten_friend. "</strong></a>
                                <i class='fas fa-circle small'></i>
                            </div>
                            <span class='d-block small'>".substr($offline, 11, 8). " " 
                            .substr($offline, 8, 2). "/" .substr($offline, 5, 2). "/" .substr($offline, 0, 4). "</span>
                        </div>
                    </div>";
            }
        }
    }
?>