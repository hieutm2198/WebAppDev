<?php
    include('server.php');
    if($_SESSION['check_user'] == 0) {
        $msv = $_SESSION['msv'];
        $sql_info_message = "SELECT * FROM thongbao WHERE idcuusinhvien='$msv' ORDER BY thoigian DESC";
        $result = mysqli_query($db, $sql_info_message);
        if(mysqli_num_rows($result) > 0) {
            while($row=mysqli_fetch_assoc($result)) {
                $idbaidang = $row['idbaidang'];
                $noidung = $row['noidung'];
                $thoigian = $row['thoigian'];
                $hoten_thongbao = strchr($noidung, "đã", true);
                $sql_anh_thongbao = "SELECT anh FROM cuusinhvien WHERE hoten='$hoten_thongbao'";
                $result1 = mysqli_query($db, $sql_anh_thongbao);
                $anh_thongbao = mysqli_fetch_array($result1)['anh'];
?>
    <a href="server.php?view_thongbao=<?php echo $noidung ?>" style="text-decoration: none; color: black" class='media pt-2 pb-1 border-bottom border-gray'>
        <img src="image/<?php echo $anh_thongbao ?>" alt='Image_Friend' class='mr-2 mt-1 rounded-circle' width='30px;' height='30px'>
        <div class='media-body pb-1'>
            <div class='d-flex justify-content-between align-items-center w-100'>
                <span class='d-block' style="font-size: 12px; font-weight: 500; letter-spacing: 0.25px"><?php echo $noidung ?></span>
            </div>
            <span class='d-block small mt-1'><?php echo substr($thoigian, 11, 8). " " 
            .substr($thoigian, 8, 2). "/" .substr($thoigian, 5, 2). "/" .substr($thoigian, 0, 4) ?></span>
        </div>
    </a>
<?php
            }
        }
    }
?>