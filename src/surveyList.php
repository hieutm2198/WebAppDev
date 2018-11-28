<?php
    include("database.php");
    $sql = "select * from khaosat join cuusinhvien on khaosat.MaNguoiTao = cuusinhvien.idcuusinhvien where khaosat.TrangThaiKS = 'published';";
    $result = $connection -> query($sql);
    
    $response;

    while($row = $result -> fetch_assoc()) {
        $response -> requiredSurvey[] = array(
            surveyId => $row['MaKS'],
            surveyTitle => $row['TieuDe'],
            creatorId => $row['MaNguoiTao'],
            creatorName => $row['hoten']
            
        );
    }

    

    die(json_encode($response, JSON_UNESCAPED_UNICODE));
?>