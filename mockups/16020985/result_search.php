<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    $idnamhoc = $_SESSION['idnamhoc'];
    $search_text = ucwords($_POST['search_text']);
    $sql_find = "SELECT hoten, anh FROM cuusinhvien WHERE idnamhoc='$idnamhoc'
    AND idcuusinhvien!='$msv' AND hoten LIKE '%{$search_text}%'";
    $result = mysqli_query($db, $sql_find);
    $data = "";
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)) {
            $hoten_friend = $row['hoten'];
            $anh_friend = $row['anh'];
            $data .= "<div class='media pt-3 mb-2'>
                        <img src='image/" .$anh_friend. "' alt='Image_Friend' class='mr-2 rounded-circle' width='40px' height='40px'>
                        <div class='media-body pb-1 mb-0'>
                            <strong class='text-dark'>" .$hoten_friend. "</strong>
                        </div>
                    </div>";
        }
    }
    die(json_encode($data));
?>