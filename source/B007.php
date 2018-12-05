<?php
    include("database.php");
    $sql = 'select * from khaosat where TrangThaiKS="published" and MaNguoiTao=' . $_SESSION['MaSV'] .';';
    $result = $connection -> query($sql);
    $publishedIdList = [];
    $publishedTitleList = [];
    while($row = $result -> fetch_assoc()) {
        $publishedIdList[] = $row['MaKS'];
        $publishedTitleList[] = $row['TieuDe'];
    }

    $sql = 'select * from khaosat where TrangThaiKS="saved" and MaNguoiTao=' . $_SESSION['MaSV'] .';';
    $result = $connection -> query($sql);
    $savedIdList = [];
    $savedTitleList = [];
    while($row = $result -> fetch_assoc()) {
        $savedIdList[] = $row['MaKS'];
        $savedTitleList[] = $row['TieuDe'];
    }

    $sql = 'select * from thuchienkhaosat join khaosat on thuchienkhaosat.MaKS = khaosat.MaKS where thuchienkhaosat.MaSV=' . $_SESSION['MaSV'] .';';
    $result = $connection -> query($sql);
    $completedIdList = [];
    $completedTitleList = [];
    while($row = $result -> fetch_assoc()) {
        $completedIdList[] = $row['MaKS'];
        $completedTitleList[] = $row['TieuDe'];
    }

    $sql = 'select khaosat.MaKS, khaosat.TieuDe from khaosat where MaKS NOT IN (select thuchienkhaosat.MaKS from thuchienkhaosat where MaSV='.$_SESSION['MaSV'].');';
    $result = $connection -> query($sql);
    $incompletedIdList = [];
    $incompletedTitleList = [];
    while($row = $result -> fetch_assoc()) {
        $incompletedIdList[] = $row['MaKS'];
        $incompletedTitleList[] = $row['TieuDe'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>B007 - Danh sách khảo sát</title>
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
        <script src="js/B007.js"></script>
        <!-- Google Icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/C001.css">

    </head>
    <body>
       
        <?php include("nav.php") ?>

        <div class="container-fluid">
            <div class="row">
                <!-- <?php include("leftbar.php") ?> -->
                <div class="col-7 bg-light" id="middle-content">
                    <div class="d-flex justify-content-between mt-3">
                        <h4>Danh sách khảo sát</h4>
                        <button type="button" class="btn btn-success btn-sm" onclick="window.location.replace('B008.php')">
                            <i class="fas fa-plus"></i>
                            Tạo mới
                        </button>
                    </div>
                    <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-published-tab" data-toggle="pill" href="#pills-published" role="tab" aria-controls="pills-published" aria-selected="true">
                                <i class="fas fa-paper-plane mr-1"></i>
                                Đã phát hành
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-saved-tab" data-toggle="pill" href="#pills-saved" role="tab" aria-controls="pills-saved" aria-selected="false">
                                <i class="fas fa-save mr-1"></i>
                                Đã lưu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-incomplete-tab" data-toggle="pill" href="#pills-incomplete" role="tab" aria-controls="pills-incomplete" aria-selected="false">
                                <i class="fas fa-scroll mr-1"></i>
                                Chưa thực hiện
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-completed-tab" data-toggle="pill" href="#pills-completed" role="tab" aria-controls="pills-completed" aria-selected="false">
                                <i class="fas fa-check-square mr-1"></i>
                                Đã thực hiện
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-published" role="tabpanel" aria-labelledby="pills-published-tab">
                        <div class="my-3 d-flex justify-content-right font-weight-light text-right">
                        
                        <?php
                            echo 'Tổng số: ' . sizeof($publishedIdList) . '';
                        ?>
                        </div>

<?php
    for($i = 0; $i < sizeof($publishedIdList); ++$i) {
        echo '<div class="mb-3 py-2 px-3 rounded bg-white shadow-sm">';
            echo '<div class="">';
                echo $publishedTitleList[$i];
            echo '</div>';
            echo '<div class="pb-2 d-flex justify-content-between">';
                echo '<div class="small font-italic">';
$sql = 'select count(MaTH) as SoNguoiThamGia from thuchienkhaosat where MaKS = ' . $publishedIdList[$i] . ';';
                    echo (($connection -> query($sql)) -> fetch_assoc())['SoNguoiThamGia'] . ' người đã tham gia';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-secondary btn-sm" onclick="viewDetail(' . $publishedIdList[$i] . ')">';
                    echo 'Chi tiết';
                echo'</button>';
            echo '</div>';
        echo '</div>';
    }
?>
                        </div>
                        
                        <div class="tab-pane fade" id="pills-saved" role="tabpanel" aria-labelledby="pills-saved-tab">
                        <div class="my-3 d-flex justify-content-right font-weight-light text-right">
                        
                        <?php
                            echo 'Tổng số: ' . sizeof($savedIdList) . '';
                        ?>
                        </div>

<?php
    for($i = 0; $i < sizeof($savedIdList); ++$i) {
        echo '<div class="mb-3 py-2 px-3 rounded bg-white shadow-sm">';
            echo '<div class="">';
                echo $savedTitleList[$i];
            echo '</div>';
            echo '<div class="pb-2 d-flex justify-content-between">';
                echo '<div class="small font-italic">';
                    echo '16/11/2018 11:25';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-secondary btn-sm" onclick="editSurvey(' . $savedIdList[$i] . ')">';
                    echo 'Sửa';
                echo'</button>';
            echo '</div>';
        echo '</div>';
    }
?>
                        </div>
                        <div class="tab-pane fade" id="pills-incomplete" role="tabpanel" aria-labelledby="pills-incomplete-tab">

<div class="my-3 d-flex justify-content-right font-weight-light text-right">
                        
                        <?php
                            echo 'Tổng số: ' . sizeof($incompletedIdList) . '';
                        ?>
                        </div>

<?php
    for($i = 0; $i < sizeof($incompletedIdList); ++$i) {
        echo '<div class="mb-3 py-2 px-3 rounded bg-white shadow-sm">';
            echo '<div class="">';
                echo $incompletedTitleList[$i];
            echo '</div>';
            echo '<div class="pb-2 d-flex justify-content-between">';
                echo '<div class="small font-italic">';
$sql = 'select count(MaTH) as SoNguoiThamGia from thuchienkhaosat where MaKS = ' . $incompletedIdList[$i] . ';';
                    echo (($connection -> query($sql)) -> fetch_assoc())['SoNguoiThamGia'] . ' người đã tham gia';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-secondary btn-sm" onclick="doNow(' . $incompletedIdList[$i] . ')">';
                    echo 'Thực hiện';
                echo'</button>';
            echo '</div>';
        echo '</div>';
    }
?>

                        </div>
                        <div class="tab-pane fade" id="pills-completed" role="tabpanel" aria-labelledby="pills-completed-tab">
                        <div class="my-3 d-flex justify-content-right font-weight-light text-right">
                        
                        <?php
                            echo 'Tổng số: ' . sizeof($completedIdList) . '';
                        ?>
                        </div>
                        

<?php
    for($i = 0; $i < sizeof($completedIdList); ++$i) {
        echo '<div class="mb-3 py-2 px-3 rounded bg-white shadow-sm">';
            echo '<div class="">';
                echo $completedTitleList[$i];
            echo '</div>';
            echo '<div class="pb-2 d-flex justify-content-between">';
                echo '<div class="small font-italic">';
                    echo '16/11/2018 11:25';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-secondary btn-sm" onclick="viewDetail(' . $completedIdList[$i] . ')">';
                    echo 'Xem lại';
                echo'</button>';
            echo '</div>';
        echo '</div>';
    }
?>
                        </div>
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