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
        <!-- Google Icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="js/C001.js"></script>
        <link rel="stylesheet" href="css/C001.css">
    </head>
    <body>
        <!-- <?php
            if(isset($_SESSION['status'])) {
                echo "<script>";
                echo "alert('You are logged in');";
                echo "</script>";
                unset($_SESSION['status']);
            }
        ?> -->
        <nav id="navibar" class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-dark sticky-top">
            <label class="switch navbar-brand">
                <input onclick="show_hideNav(this)" type="checkbox" checked>
                <span class="slider"></span>
            </label>
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
                        <span id="an_hien_thongbao"
                            style="cursor: pointer"
                            class="nav-link ml-4"
                            data-toggle="popover"
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
                        </span>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link ml-4">
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
                <div id="left-content" class="col-2 border-right p-0 pt-4">
                    <div class="list-group list-group-flush">
                        <a href="profile.php" class="list-group-item list-group-item-action pb-3" 
                        style="border: none">
                            <image src="image/<?php echo $_SESSION['anh'] ?>" alt="" class="mr-2 rounded-circle" width="50px" height="50px"></i>
                            <span style="font-weight: 500; font-size: 15px"><?php echo $_SESSION['username'] ?></span>
                        </a>
                        <?php 
                            if($_SESSION['role_user'] != "normal") {
                                echo "<a href='admin.php' class='list-group-item list-group-item-action p-3 pl-4' style='border: none'>Trang quản lý</a>";
                            }
                        ?>
                        <a href="B007.php" class="list-group-item list-group-item-action p-3 pl-4" style="border: none">Khảo sát</a>
                        <a href="server.php?logout='1'" class="list-group-item list-group-item-action p-3 pl-4" style="border: none">Đăng xuất</a>
                        <button id="button_add_post" class="btn btn-outline-primary ml-4 mt-4"
                        style="width: 80%" 
                        onclick="document.getElementById('new_post').style.display='block';">
                        <i class="material-icons mr-1" style="font-size: 20px; position: relative; top: 4px;">add</i>
                        Thêm bài viết
                        </button>
                        
                    </div>
                </div>
                <div id="middle-content" class="col-7">
                    <div id="load_post"></div>
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
        <div id="new_post">
            <form method="post" action="" enctype="multipart/form-data" id="post_form" style="background-color: rgba(255, 255, 255, 0.911); border-radius: 5px;">
                <div class="input-group">
                    <input name="title_post" type="text" class="p-2 mb-3 border-0 w-100" placeholder="Tiêu đề bài viết" style="font-size: 22px; font-weight: 500; border-top-left-radius: 5px; border-top-right-radius: 5px">
                </div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image_post" style="border-radius: 0;" class="custom-file-input" id="inputGroupFile">
                        <div class="progress">
                        <label style="border-radius: 0; font-weight: 500;" class="progress-bar progress-bar-striped progress-bar-animated custom-file-label p-2" for="inputGroupFile" style="width: 10%">Choose Image</label></div>
                    </div>
                </div>
                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                        <span style="border-radius: 0; font-size: 22px; font-weight: 500;" class="input-group-text pl-4 pr-4">Nội dung</span>
                    </div>
                    <textarea name="content_post" style="border-radius: 0;" class="form-control mt-0" rows="18" aria-label="Nội dung"></textarea>
                </div>
                <div class="d-flex">
                    <button type="submit" name="button_add_post" style="border-radius: 0;" class="border-0 btn btn-outline-primary ml-auto">Đăng bài</button>
                    <button type="button" style="border-radius: 0;" class="border-0 btn btn-outline-danger pl-3 pr-3"
                    onclick="document.getElementById('new_post').style.display='none'">Hủy</button>
                </div>
            </form>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $("#close_chat").on("click", function() {
                $("#tinnhan").hide();
            })
            setInterval(function() {
                $("#user_status").load("load_user.php").fadeIn();
            }, 500);
            setInterval(function() {
                $("#load_post").load("load_post.php").fadeIn("slow");
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
        var check_nav = 1;
        function show_hideNav(event) {
            if(check_nav == 1) {
                $("#left-content").css("left", "-17%");
                $("#middle-content").css("left", "3%");
                $("#load_post").css({
                    "width": "130%",
                    "marginTop": "20px"
                });
                $(event).parent().css("borderColor", "white");
                check_nav = 0;
            }
            else {
                $("#left-content").css("left", "0");
                $("#middle-content").css("left", "20%");
                $("#load_post").css({
                    "width": "100%",
                    "marginTop": "0px"
                });
                $(event).parent().css("borderColor", "#4CAF50");
                check_nav = 1;
            }
        }
    </script>
</html>
