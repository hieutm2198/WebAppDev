<?php
    include('database.php');
    $surveyId = $_POST["surveyId"];

    $sql .= 'SET foreign_key_checks = 0;';
    $sql .= 'delete from khaosat where MaKS = '.$surveyId.';';
    $sql .= 'SET foreign_key_checks = 1;';

    $result = $connection -> multi_query($sql);

?>