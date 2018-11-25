<?php
    include("database.php");
    $surveyId = $_POST['surveyId'];
    $surveyTitle = $_POST['surveyTitle'];
    $questionList = $_POST['questionList'];
    $questionTypeList = $_POST['questionTypeList'];
    $answerList = $_POST['answerList'];
    $surveyStatus = $_POST['surveyStatus'];
    $creatorId = $_SESSION['MaSV'];
    
    $sql = 'SET foreign_key_checks = 0;';
    $connection -> query($sql);


    // Xóa các lựa chọn cũ
    $sql = 'select * from cauhoi where MaKS='.$surveyId.';';
    $result = $connection -> query($sql);
    while($row = $result -> fetch_assoc()) {
        $questionId = $row['MaCH'];
        $sql = 'delete from luachon where MaCH='.$questionId.';';
        $connection -> query($sql);
        echo $sql;
    }

    // Xóa các câu hỏi cũ
    $sql = 'delete from cauhoi where MaKS='.$surveyId.';';
    $connection -> query($sql);
    echo $sql;

    // Cập nhật tiêu đề
    $sql = 'update khaosat set TieuDe="'.$surveyTitle.'", TrangThaiKS="'.$surveyStatus.'" where MaKS='.$surveyId.';';

    if($connection -> query($sql) === true) {
        // Thêm các câu hỏi và lựa chọn mới
        for($i = 0; $i < sizeof($questionList); ++$i) {
            $sql = 'insert into cauhoi(NoiDungCH, LoaiCauHoi, MaKS) values("' . $questionList[$i] . '", "' . $questionTypeList[$i] . '", ' . $surveyId . ');';
            if($connection -> query($sql) === true) {
                $lastQuestionId = $connection -> insert_id;
                for($j = 0; $j < sizeof($answerList[$i]); ++$j) {
                    $sql = 'insert into luachon(NoiDungLC, MaCH) values("' . $answerList[$i][$j] . '", ' . $lastQuestionId . ');';
                    $connection -> query($sql);
                }
            }
        }
        
        

    } else {
        
    }
    $sql = 'SET foreign_key_checks = 1;';
    $connection -> query($sql);
    die($surveyId);
?>