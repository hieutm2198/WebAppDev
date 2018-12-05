<?php
    include("database.php");
    error_reporting(E_ERROR | E_PARSE);
    $surveyTitle = $_POST['surveyTitle'];
    $questionList = $_POST['questionList'];
    $questionTypeList = $_POST['questionTypeList'];
    $answerList = $_POST['answerList'];
    $surveyStatus = $_POST['surveyStatus'];

    $creatorId = $_SESSION['MaSV'];
    

    $sql = 'insert into khaosat(TieuDe, MaNguoiTao, TrangThaiKS) value("' . $surveyTitle . '", ' . $creatorId . ', "' . $surveyStatus . '");';
    if($connection -> query($sql) === true) {
        $lastSurveyId = $connection -> insert_id;
        for($i = 0; $i < sizeof($questionList); ++$i) {
            $sql = 'insert into cauhoi(NoiDungCH, LoaiCauHoi, MaKS) values("' . $questionList[$i] . '", "' . $questionTypeList[$i] . '", ' . $lastSurveyId . ');';
            if($connection -> query($sql) === true) {
                $lastQuestionId = $connection -> insert_id;
                for($j = 0; $j < sizeof($answerList[$i]); ++$j) {
                    $sql = 'insert into luachon(NoiDungLC, MaCH) values("' . $answerList[$i][$j] . '", ' . $lastQuestionId . ');';
                    $connection -> query($sql);
                }
            }
        }
        echo $lastSurveyId;
    } else {
        
    }
    
?>