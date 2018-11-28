<?php
    include("database.php");
    $sql = 'select * from user join cuusinhvien on user.idcuusinhvien = cuusinhvien.idcuusinhvien;';
    $result = $connection -> query($sql);
    $response;

    while($row = $result -> fetch_assoc()) {
        $response -> data[] = array(
            userId => $row['iduser'],
            username => $row['username'],
            password => $row['password_user'],
            studentId => $row['idcuusinhvien'],
            fullname => $row['hoten'],
            sex      => $row['gioitinh'],
            dateofbirth => $row['ngaysinh'],
            recentLogin => $row['dangnhapgannhat'],
            isAdmin => $row['online']
        );
    }

    die(json_encode($response, JSON_UNESCAPED_UNICODE));
?>