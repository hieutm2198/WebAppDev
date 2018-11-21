<?php 
    include('server.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>C001 - Dashboard (Normal user)</title>
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
        <script src="js/C001.js"></script>
        <link rel="stylesheet" href="css/C001.css">
    </head>
    <body>
        <?php
            if(isset($_SESSION['status'])) {
                echo "<script>";
                echo "alert('You are logged in');";
                echo "</script>";
                unset($_SESSION['status']);
            }
        ?>
        <nav id="navibar" class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-dark sticky-top">
            <a class="navbar-brand" href="#">
                <img src="img/logo_c9.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                UET graduate forum
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active ml-4">
                            <i class="fas fa-home mr-2"></i>
                            Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="an_hien_thongbao"
                            href="#"
                            class="nav-link ml-4"
                            data-toggle="popover"
                            data-trigger="focus"
                            data-placement="bottom"
                            data-container="#navibar"
                            data-html="true"
                            title=""
                            data-content="
                                <div id='load_thongbao' style='height: 400px; overflow-y: auto'>
                                </div>
                            "
                        >
                            <span class="fas fa-bell mr-2"><i id="count_thongbao" class="badge badge-danger ml-auto"
                            style="position: relative; top: -8px; left: -4px"></i></span>
                            Thông báo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="server.php?profile='1'" class="nav-link ml-4">
                            <i class="fas fa-user mr-2"></i>
                            <?php
                                if(isset($_SESSION['username'])) {
                                    echo $_SESSION['username'];
                                }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div id="left-content" class="col-3 border-right">                    
                    <p class="h6 mt-4">Nhóm</p>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-user-graduate mr-2"></i>
                            Cựu sinh viên UET
                            <span class="badge badge-success badge-pill ml-auto">12</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-users mr-2"></i>
                            Sinh viên khóa K61
                            <span class="badge badge-success badge-pill ml-auto">3</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-code mr-2"></i>
                            Sinh viên khoa CNTT
                            <span class="badge badge-success badge-pill ml-auto">11</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-landmark mr-2"></i>
                            Lớp QH2016-I/CQ-C-D
                            <span class="badge badge-success badge-pill ml-auto">1</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-book-open mr-2"></i>
                            Thư viện Hội Sinh Viên
                            <span class="badge badge-success badge-pill ml-auto">0</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-caret-down mr-2"></i>
                            Xem thêm...
                        </a>
                    </div>
                    <p class="h6 mt-4">Khảo sát</p>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Khảo sát mức độ hài lòng thu nhập
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Khảo sát địa điểm làm việc
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Thu thập thông tin việc làm của sinh viên
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-caret-down mr-2"></i>
                            Xem thêm...
                        </a>
                    </div>
                </div>
                <div id="middle-content" class="col-6">
                </div>
                <div id="right-content" class="col-3 mr-2">
                    <div class="row pb-3 ml-2" style="border-bottom: 1px solid rgba(173, 172, 172, 0.6); width: 98%">
                        <div class="col-12" >
                            <p class="h6 mt-4">Bạn bè</p>
                            <div id="user_status" style="height: 450px; overflow-y: auto">
                            </div>
                        </div>
                    </div>
                    <div id="result_user" class="row ml-4 mt-2" style="width: 88%; height: 60px; overflow-y: auto">
                    </div>
                    <form onsubmit="event.preventDefault()" style="position: fixed; bottom: 7px; right: 45px; width: 18%">
                        <div class="form-row align-items-center">
                            <div class="col-10 mt-3">
                                <input id="search_input" type="text" class="form-control" placeholder="Tìm kiếm người dùng">
                            </div>
                            <div class="col-2 mt-3">
                                <button class="btn btn-outline-success">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $("#user_status").load("load_user.php").fadeIn();
            }, 500);
            setInterval(function() {
                $("#middle-content").load("load_post.php").fadeIn();
            }, 500);
            setInterval(function() {
                $("#load_thongbao").load("load_thongbao.php").fadeIn();
            }, 100)
            setInterval(function() {
                $("#count_thongbao").load("load_count_thongbao.php").fadeIn();
            }, 100)
        })
        $(document).ready(function() {
            $("#search_input").on("keyup", function(){
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
    </script>
</html>
