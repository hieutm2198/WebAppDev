<?php 
    include("database.php");
   
    if(isset($_GET['khaosat'])) {
        $MaKS = $_GET['khaosat'];    
        
    } else {
        header("location: 404.php");
    }  

    $sql = 'select * from khaosat where MaKS=' . $MaKS . ';';
    $result = $connection -> query($sql);
    $surveyTitle = ($result -> fetch_assoc())['TieuDe'];
    
    $sql = 'select * from khaosat join cuusinhvien on khaosat.MaNguoiTao = cuusinhvien.idcuusinhvien where khaosat.MaKS=' . $MaKS . ';';
    $result = $connection -> query($sql);
    $row = $result -> fetch_assoc();
    $surveyCreatorName = $row['hoten'];
    $surveyCreatorId = $row['idcuusinhvien'];

    $questionContentList = [];
    $questionIdList = [];
    $questionTypeList = [];

    $sql = 'select * from cauhoi join khaosat on cauhoi.MaKS = khaosat.MaKS where khaosat.MaKS=' . $MaKS . ';';
    $result = $connection -> query($sql);
    while($row = $result -> fetch_assoc()) {
        $questionContentList[] = $row['NoiDungCH'];
        $questionIdList[] = $row['MaCH'];
        $questionTypeList[] = $row['LoaiCauHoi'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>C004 - Thực hiện khảo sát</title>
        <!-- Bootstrap's dependcies -->
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/popper-1.14.3.js"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="js/bootstrap.js"></script>
        <!-- Roboto Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet"> 
        <!-- Awesome Icon -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
        <script src="js/B009.js"></script>
        <link rel="stylesheet" href="css/B009.css">
        <!-- Google chart -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
<?php
        echo 'var surveyId = ' . $MaKS . ';';
        echo 'var questionIdList = [';
        for($i = 0; $i < sizeof($questionIdList) - 1; ++$i) {
            echo $questionIdList[$i] . ', ';
        }
        echo $questionIdList[sizeof($questionIdList) - 1];
        echo '];';
?>

        var answerList = [];

        function sendSurvey() {
            
            for(var i = 0; i < questionIdList.length; ++i) {
                
                var inputList = document.getElementsByName(questionIdList[i]);
                for(var j = 0; j < inputList.length; ++j) {
                    if(inputList[j].checked) {
                     
                        answerList.push(parseInt(inputList[j].value));
                    }
                }
            }

            $.ajax({
                url: "receiveSurvey.php",
                type: "post",
                // dataType: "text",
                data: {
                    surveyId: surveyId,
                    answerList: answerList
                },
                success: function (result) {                        
                    window.location.replace("B007.php");
                }
            });
        }
        </script>

    </head>
    <body>
        <?php include("navbar.php") ?>
        <div class="container-fluid">
            <div class="row">
            <?php include("leftbar.php") ?>
                <div class="col-6 bg-light">
                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-outline-primary" onclick="window.location.replace('B007.php')">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Trở về
                        </button>
                       <div class="btn-group" id="action-buttons" onclick="sendSurvey()">
                            <button class="btn btn-success">
                                <i class="fas fa-paper-plane mr-1"></i>
                                Gửi
                            </button>
                       </div>
                    </div>
                    <div class="bg-white rounded shadow-sm mt-3 p-3">
                        <div class="pb-2 border-bottom border-grey d-flex justify-content-between">
                            <div id="thong-tin-chung">Thông tin chung</div>
                            <!-- <span class="small" onclick="hideInfo()">
                                <i class="fas fa-caret-up mr-1"></i>
                                Thu gọn
                            </span> -->
                        </div>
                        <div id="info">
                            <div class="mt-3">
                                <h6>
                                <i class="fas fa-tag mr-1"></i>
                                <?php echo $surveyTitle; ?></h6>
                            </div>

                            <div class="mt-3">
                                <i class="fas fa-hashtag mr-1"></i>
                                <?php echo $MaKS; ?>
                            </div>

                            <div class="mt-3">
                                <i class="fas fa-user-edit mr-2"></i>
                                <?php
                                echo 'Tạo bởi ' . $surveyCreatorName .' (' . $surveyCreatorId . ')'; 
                                ?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="bg-white rounded shadow-sm mt-3 p-3">
                            <div class="pb-2 border-bottom border-grey d-flex justify-content-between">
                                <div>Các câu hỏi</div>
                                <!-- <span class="small" onclick="hideQuestions()" id="hideQuestionsBtn">
                                    <i class="fas fa-caret-up mr-1"></i>
                                    Thu gọn
                                </span> -->
                            </div>
                            <div id="questions">
<?php
                            $count = count($questionIdList);
                            for($i = 0; $i < $count; ++$i) {
                                echo '<div class="mt-3 pb-3 border-bottom border-grey">';
                                echo '<h6>' . $questionContentList[$i] . '</h6>';
                                
                                $answerList = array();
                                $answerIdList = array();
                                
                                $sql = "select * from (khaosat join cauhoi on khaosat.MaKS = cauhoi.MaKS) join luachon on cauhoi.MaCH = luachon.MaCH where cauhoi.MaCH = " . $questionIdList[$i] . ";";
                                
                                $result = $connection -> query($sql);
                                if($result -> num_rows > 0) {
                                    
                                    while($row = $result -> fetch_assoc()) {
                                        $answerList[] = $row['NoiDungLC'];
                                        $answerIdList[] = $row['MaLC'];
                                        
                                    }
                                }

                                if(true) { //TODO Tùy theo loại câu hỏi, in ra checkbox hoặc radio
                                    $countAnswer = count($answerList);
                                    
                                    for($j = 0; $j < $countAnswer; ++$j) {
                                        
                                        echo '<div class="form-check">';        
                                            $inputType = "radio";
                                            if($questionTypeList[$i] === "multi") {
                                                $inputType = "checkbox";
                                            }
                                            echo '<input value="'.$answerIdList[$j].'" type="'.$inputType.'" class="form-check-input" name="' . $questionIdList[$i] . '">';
                                            echo '<label class="form-check-label">';
                                                echo $answerList[$j];
                                            echo '</label>';
                                        echo "</div>";    
                                    }
                                    
                                    
                                }
                                echo '</div>';

                            }
                            
?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-4">
                            <a class="btn btn-outline-secondary" href="#action-buttons">
                            <i class="fas fa-angle-up mr-1"></i>
                            Lên đầu
                            </a>
                    </div>
                </div>
                <?php include("rightbar.php") ?>
            </div>
        </div>
    </body>
</html>