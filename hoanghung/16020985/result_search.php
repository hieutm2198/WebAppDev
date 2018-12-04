<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    $idnamhoc = $_SESSION['idnamhoc'];
    $search_text = ucwords($_POST['search_text']);
    if($_SESSION['role_user'] == "normal") {
        $sql_find = "SELECT hoten, anh FROM cuusinhvien WHERE idnamhoc='$idnamhoc'
        AND idcuusinhvien!='$msv' AND hoten LIKE '%{$search_text}%'";
    }
    else {
        $sql_find = "SELECT hoten, anh FROM cuusinhvien WHERE idcuusinhvien!='$msv' AND hoten LIKE '%{$search_text}%'";
    }
    $result = mysqli_query($db, $sql_find);
    $data = "";
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)) {
            $hoten_friend = $row['hoten'];
            $anh_friend = $row['anh'];
            $data .= "<div class='media pt-3 mb-2'>
                        <img src='image/" .$anh_friend. "' alt='Image_Friend' class='mr-2 rounded-circle' width='30px' height='30px'>
                        <div class='media-body pb-1 mb-0'>
                            <span class='text-dark' style='font-size: 13px; font-weight: 600'>" .$hoten_friend. "</span>
                        </div>
                    </div>";
        }
    }
    die(json_encode($data));
?>