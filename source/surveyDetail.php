<?php
    include("database.php");
    error_reporting(E_ERROR | E_PARSE);
    $surveyId = $_POST["surveyId"];
    
    $sql = 'select * from khaosat join cuusinhvien on khaosat.MaNguoiTao = cuusinhvien.idcuusinhvien where MaKS=' . $surveyId .';';
    $result = $connection -> query($sql);

    $response;

    if($row = $result -> fetch_assoc()) {
        $response -> success = true;
        $response -> surveyId = $row['MaKS'];
        $response -> surveyName = $row['TieuDe'];
        $response -> surveyCreatorId = $row['MaNguoiTao'];
        $response -> surveyCreatorName = $row['hoten']; 

        $sql = "select * from khaosat join cauhoi on khaosat.MaKS = cauhoi.MaKS where khaosat.MaKS = " . $row['MaKS'] . ";";
        $questionResult = $connection -> query($sql);

        while($questionRow = $questionResult -> fetch_assoc()) {
            $sql = "select * from (khaosat join cauhoi on khaosat.MaKS = cauhoi.MaKS) join luachon on cauhoi.MaCH = luachon.MaCH where cauhoi.MaCH = " . $questionRow['MaCH'] . ";";
            $answerResult = $connection -> query($sql);
            $answer = array();

            while($answerRow = $answerResult -> fetch_assoc()) {
                $sql = 'select count(traloicauhoi.MaLC) as SoNguoiLuaChon from (traloicauhoi join luachon on traloicauhoi.MaLC = luachon.MaLC) where traloicauhoi.MaLC = ' . $answerRow['MaLC'] . ';';
                $numberOfChoosed = (($connection -> query($sql)) -> fetch_assoc())['SoNguoiLuaChon'];
        
                $answer[] = array(
                    answerContent => $answerRow['NoiDungLC'],
                    number => $numberOfChoosed
                );
            }
            $response -> question[] = array(
                questionId => $questionRow['MaCH'],
                questionContent => $questionRow['NoiDungCH'],
                questionType => $questionRow['LoaiCauHoi'],
                answer => $answer
            );
        }

        

    } else {
        $response -> success = false;
    }
    
    die(json_encode($response, JSON_UNESCAPED_UNICODE));
?>