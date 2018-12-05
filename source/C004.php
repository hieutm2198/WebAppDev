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
        <!-- Google Icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/C001.css">
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
        <?php include("nav.php") ?>
        <div class="container-fluid">
            <div class="row">
            <!-- <?php include("leftbar.php") ?> -->
                <div class="col-7 bg-light" id="middle-content">
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
                    <div id="tinnhan" class="card" style="width: 22%; position: fixed; bottom: 0; right: 21%; display: none">
                        <div class="card-header p-1 pl-2" style="font-size: 15px; font-weight: 400; position: relative">
                            <i id="online_status" class='fas fa-circle text-success' style='font-size: 8px; position: relative; top: -2px'></i>
                            <a href="#" style="color: black" id="user_chat"></a>
                            <i id="close_chat" class="material-icons" style="position: absolute; right: 2%; font-size: 19px; top: 5px">clear</i>
                        </div>
                        <div id="message" class="card-body p-0" style="height: 260px; overflow-y: auto;">
                            
                        </div>
                        <textarea id="text_chat" rows="1" class="card-footer p-2" type="text" placeholder="Nhập tin nhắn"></textarea>
                    </div>
                </div>
                <div class="border-left pl-2" id="right-content" style="width: 19%">
                    <p class="h6 mt-3">Bạn bè</p>
                    <div id="user_status" class="pb-2 pl-1" style="height: 450px; overflow-y: auto; border-bottom: 1px solid rgba(173, 172, 172, 0.6)">
                    </div>
                    <div id="result_user" class="row mt-2 ml-1" style="width: 100%; height: 60px; overflow-y: auto">
                    </div>
                    <div class="input-group mt-2" style="width: 95%">
                        <div class="input-group-prepend">
                            <span id="search_icon" class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input id="search_btn" type="text" class="form-control" placeholder="Search Username">
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        });
        $(document).ready(function() {
            $("#close_chat").on("click", function() {
                $("#tinnhan").hide();
            })
            setInterval(function() {
                $("#user_status").load("load_user.php").fadeIn();
            }, 500);
            setInterval(function() {
                $("#load_thongbao").load("load_thongbao.php").fadeIn();
            }, 500)
            setInterval(function() {
                $("#count_thongbao").load("load_count_thongbao.php").fadeIn();
            }, 500)
        })
        $(document).ready(function() {
            $("#search_btn").on("keyup", function(){
                if($(this).val() == '') {
                    $("#result_user").html("");
                }
                else{
                    search_text = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "result_search.php",
                        data: {
                            'search_text': search_text
                        },
                        success: function(data) {
                            var content = $.parseJSON(data);
                            $("#result_user").html(content);
                        }
                    })
                }
            })
        })
        $(document).ready(function() {
            $("#an_hien_thongbao").on("click", function() {
                check = 1;
                $.ajax({
                    type: "POST",
                    url: "load_count_thongbao.php",
                    data: {
                        'check': check
                    }, 
                    success: function(data) {
                        return ;
                    }
                })
            })    
        })
        function message(event) {
            $("#tinnhan").show();
            user_chat = $(event).find("span").eq(0).text();
            online_status = $(event).find("span").eq(0).next().attr("class");
            if(online_status.indexOf("text-success") > -1) {
                $("#online_status").show();
            }
            else {
                $("#online_status").hide();
            }
            $.ajax({
                type: "POST",
                url: "load_user_chat.php",
                data: {
                    'user_chat': user_chat
                },
                success: function(data) {
                    return ;
                }
            })
            setInterval(function() {
                $("#message").load("load_chat.php").fadeIn();
            }, 100);
            $("#message").scrollTop($("#message").prop("scrollHeight"));
            $("#user_chat").text(user_chat);
            $("#text_chat").focus();
        }
        $("#text_chat").keydown(function(event) {
                if(event.keyCode == 13 && !event.shiftKey) {
                    event.preventDefault();
                    text_chat = $("#text_chat").val();
                    $.ajax({
                        type: "POST",
                        url: "insert_chat.php",
                        data: {
                            'text_chat': text_chat
                        },
                        success: function(data) {
                            $("#text_chat").val("");
                            $("#message").scrollTop($("#message").prop("scrollHeight"));
                        }
                    })
                }
        })
        $('body').on('click', function (e) {
            if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('.popover.in').length === 0) { 
                $('[data-toggle="popover"]').popover('hide');
            }
        });
    </script>
</html>