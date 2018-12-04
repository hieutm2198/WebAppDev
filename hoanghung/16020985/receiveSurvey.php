<?php
    include("database.php");
    error_reporting(E_ERROR | E_PARSE);
    $surveyId = $_POST['surveyId'];
    $answerList = $_POST['answerList'];
    $MaSV = $_SESSION['MaSV'];

    $sql = 'insert into thuchienkhaosat(MaSV, MaKS) values ('.$MaSV.', '.$surveyId.');';
    echo $sql;
    if($connection -> query($sql) === true) {
        $lastId = $connection -> insert_id;
        for($i = 0; $i < sizeof($answerList); ++$i) {
            $sql = 'insert into traloicauhoi(MaTH, MaLC) values('.$lastId.', '.$answerList[$i].');';
            echo $sql;
            $connection -> query($sql);
        }
    }

?>
