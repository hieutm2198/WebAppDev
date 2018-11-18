<?php
    include('server.php');
    $msv = $_SESSION['msv'];
    $anh = $_SESSION['anh'];
    $sql_info_message = "SELECT * FROM thongbao WHERE idcuusinhvien='$msv' ORDER BY thoigian DESC";
    $result = mysqli_query($db, $sql_info_message);
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)) {
            $idbaidang = $row['idbaidang'];
            $noidung = $row['noidung'];
            $thoigian = $row['thoigian'];
?>
    <div class='media pt-2 pb-1 border-bottom border-gray'>
        <div class='media-body pb-1 mb-0 small lh-125'>
            <div class='d-flex justify-content-between align-items-center w-100'>
                <strong class='text-gray-dark'>
                    <i class='fas fa-landmark mr-2'></i><?php echo $_SESSION['username'] ?>
                </strong>
                <span class='d-block small'><?php echo $thoigian ?></span>
            </div>
            <span class='d-block'><?php echo $noidung ?></span>
        </div>
    </div>
<?php
        }
    }
?>