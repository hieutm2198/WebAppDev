<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!--Google Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Awesome Icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
        crossorigin="anonymous">
    <!-- Style css-->
    <link rel="stylesheet" href="profile.css" type="text/css">

</head>

<body>
    <nav id="navibar" class="navbar navbar-expand-sm navbar-dark bg-dark border-bottom border-dark">
        <a class="navbar-brand" href="#">
            <img src="image/logo_c9.svg" width="30" height="30" class="d-inline-block align-top" alt="">
            UET graduate forum
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a href="#" class="nav-link ml-4" data-trigger="focus" data-placement="bottom" data-container="#navibar"
                        data-html="true" title="">
                        <i class="fas fa-bell mr-2"></i>
                        Thông báo
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ml-4" data-trigger="focus" data-placement="bottom" data-container="#navibar"
                        data-html="true" title="">
                        <i class="fas fa-comment-alt mr-2"></i>
                        Tin nhắn
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ml-4">
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
        <div style="width: 22%; float: left;">
            <div id="border_profile_list">
                <div id="profile_list" class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action">
                        <img class="img-fluid" src="image/fiora.jpg" alt="fiora_image"><br>
                        <p>
                        <?php
                            if(isset($_SESSION['username'])) {
                                echo $_SESSION['username'];
                            }
                        ?>
                        </p>
                    </a>
                    <a href="#introduce" class="list-group-item list-group-item-action active">Quản
                        lý tài khoản</a>
                    <a href="#" class="list-group-item list-group-item-action">Bạn
                        bè</a>
                    <a href="#" class="list-group-item list-group-item-action">Danh
                        sách khảo sát</a>
                    <a href="#" class="list-group-item list-group-item-action">Danh sách
                        bài đăng</a>
                    <a href="#" class="list-group-item list-group-item-action">Danh sách
                        forum</a>
                    <a href="#" class="list-group-item list-group-item-action">Lịch sử</a>
                    <a href="#" class="list-group-item list-group-item-action">Đăng xuất</a>
                </div>
            </div>
        </div>
        <div class="right_content" style="float: left; position: relative;">
            <p id="introduce_title">QUẢN LÝ TÀI KHOẢN</p>
            <button id="button_change_info_user" class="btn btn-outline-primary" onclick="document.getElementById('border_edit_info_user').style.display='block';
                                                                                document.getElementById('introduce').style.display='none';
                                                                                document.getElementById('introduce_title').innerHTML='CẬP NHẬT TÀI KHOẢN';">
                <i class="material-icons" style="font-size: 17px;">mode_edit</i>
                Chỉnh sửa
            </button>
            <button id="button_view_account" class="btn btn-outline-primary" onclick="document.getElementById('introduce').style.display='block';
            document.getElementById('border_change_psw').style.display='none';
            document.getElementById('button_change_info_user').style.display='block';
            this.style.display='none';">
                <i class="fas fa-user mr-1" style="font-size: 15px;"></i>
                Xem tài khoản
            </button>
            <div id="introduce" class="container" style="float: left;"><br>
                <div id="card_info_left">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="float: left;">
                                <i class="material-icons mr-1" style="font-size: 18px;">account_box</i>
                                Giới thiệu
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="info_user">
                                <tr>
                                    <th>Họ và tên:</th>
                                    <td>Trần Minh Hiếu</td>
                                </tr>
                                <tr>
                                    <th>Mã sinh viên:</th>
                                    <td>1602xxxx</td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh:</th>
                                    <td>01/01/1998</td>
                                </tr>
                                <tr>
                                    <th>Quê quán:</th>
                                    <td>Hưng Yên 89</td>
                                </tr>
                                <tr>
                                    <th>SĐT:</th>
                                    <td>0123456789</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>hieutm@gmail.com</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ:</th>
                                    <td>165 Cầu Giấy, Hà Lội</td>
                                </tr>
                                <tr>
                                    <th>Giới thiệu:</th>
                                    <td>Auto gánh team</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card" id="card_info_courses">
                        <div class="card-header">
                            <h5>
                                <i class="material-icons mr-1" style="font-size: 17px;">date_range</i>
                                Khóa học
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="info_user">
                                <tr>
                                    <th>Niên khóa:</th>
                                    <td>2016-2020</td>
                                </tr>
                                <tr>
                                    <th>Lớp quản lý:</th>
                                    <td>QH-2016-I/CQ-C-D</td>
                                </tr>
                                <tr>
                                    <th>Ngành học:</th>
                                    <td>Công nghệ thông tin</td>
                                </tr>
                                <tr>
                                    <th>Chương trình đào tạo:</th>
                                    <td>Chuẩn</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="card_info_right">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="float: left;">
                                <i class="material-icons mr-1" style="font-size: 17px;">account_circle</i>
                                Tài khoản
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="info_user">
                                <tr>
                                    <th>Tên tài khoản:</th>
                                    <td>1602xxxx</td>
                                </tr>
                                <tr>
                                    <th>Mật khẩu:</th>
                                    <td><a href="#" onclick="document.getElementById('introduce').style.display='none';
                                    document.getElementById('border_change_psw').style.display='block';
                                    document.getElementById('introduce_title').innerHTML='ĐỔI MẬT KHẨU';
                                    document.getElementById('button_view_account').style.display='block';
                                    document.getElementById('button_change_info_user').style.display='none';">Đổi mật khẩu</a></td>
                                </tr>
                                <tr>
                                    <th>Ngày kích hoạt:</th>
                                    <td>02/09/1998</td>
                                </tr>
                                <tr>
                                    <th>Đăng nhập gần nhất:</th>
                                    <td>14:25:36 02/10/2018</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card" id="card_info_business">
                        <div class="card-header">
                            <h5 style="float: left">
                                <i class="material-icons mr-1" style="font-size: 17px;">settings_phone</i>
                                Công tác
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="info_business">
                                <tr>
                                    <th>Bắt đầu:</th>
                                    <td>06/07/2014</td>
                                </tr>
                                <tr>
                                    <th>Công ty:</th>
                                    <td>Facebook</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>facebook@gmail.com</td>
                                </tr>
                                <tr>
                                    <th>Loại hình:</th>
                                    <td>Product</td>
                                </tr>
                                <tr>
                                    <th>Vị trí:</th>
                                    <td>Giám đốc điều hành</td>
                                </tr>
                                <tr>
                                    <th>Mức lương:</th>
                                    <td>10000$</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ:</th>
                                    <td>Tầng 8, Menlo Park, California, Hoa Kỳ</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div id="border_edit_info_user" style="position: absolute;">
                <form action="#" id="edit_info_user">
                    <div>
                        <label for="image_user">Ảnh đại diện</label>
                        <input type="file" name="image_user">
                    </div>
                    <div>
                        <label for="name_user">Tên hiển thị</label>
                        <input type="text" name="name_user" style="width: 40%;">
                    </div>
                    <div>
                        <label for="bd_user">Ngày sinh</label>
                        <input type="date" name="bd_user">
                    </div>
                    <div>
                        <label for="gender_user">Giới tính</label>
                        <select name="gender_user" style="width: auto; padding: 3px; border-radius: 3px;">
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                            <option value="other">Khác</option>
                        </select><br>
                    </div>
                    <div>
                        <label for="home_user">Quê quán</label>
                        <input type="text" name="home" style="width: 60%;">
                    </div>
                    <div>
                        <label for="pn_user">SĐT</label>
                        <input type="text" name="pn_user">
                    </div>
                    <div>
                        <label for="email_user">Email</label>
                        <input type="email" name="email_user" style="width: 35%;">
                    </div>
                    <div>
                        <label for="adr_user">Địa chỉ</label>
                        <input type="text" name="adr_user" style="width: 60%;">
                    </div>
                    <div>
                        <label for="time_study">Niên khóa</label>
                        <input type="text" name="time_study">
                    </div>
                    <div>
                        <label for="class_user">Lớp quản lý</label>
                        <input type="text" name="class_user" style="width: 35%;">
                    </div>
                    <div>
                        <label for="field_user">Ngành học</label>
                        <input type="text" name="field_user" style="width: 35%;">
                    </div>
                    <div>
                        <label for="type_study">Đào tạo</label>
                        <select name="type_study" style="width: auto; padding: 3px; border-radius: 3px;">
                            <option value="normal">Chuẩn</option>
                            <option value="high_quality">Chất lượng cao</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>
                    <div>
                        <label id="dc_user" for="dc_user">Giới thiệu</label>
                        <textarea rows="2" cols="40" style="width: 60%;"></textarea>
                    </div>
                    <div>
                        <label for="name_company">Công ty</label>
                        <input type="text" name="name_company" style="width: 35%;">
                    </div>
                    <div>
                        <label for="email_company">Email</label>
                        <input type="email" name="email_company" style="width: 35%;">
                    </div>
                    <div>
                        <label for="type_company">Loại hình</label>
                        <select name="type_company" style="width: auto; padding: 3px; border-radius: 3px;">
                            <option value="product">Product</option>
                            <option value="outsourcing">Outsourcing</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="time_start">Làm từ</label>
                        <input type="text" name="time_start" style="width: 35%;">
                    </div>

                    <div>
                        <label for="position_user">Vị trí</label>
                        <input type="text" name="position_user" style="width: 35%;">
                    </div>
                    <div>
                        <label for="salary_user">Mức lương</label>
                        <input type="text" name="salary_user">
                    </div>
                    <div>
                        <label for="adr_company">Địa chỉ</label>
                        <input type="text" name="adr_company" style="width: 60%;">
                    </div>


                    <button type="submit" class="btn btn-primary" style="padding: 8px 30px; margin: 18px 10px 20px 20%;">Lưu</button>
                    <button type="button" class="btn btn-primary" style="padding: 8px 30px; margin: 18px 10px 20px 0;"
                        onclick="document.getElementById('border_edit_info_user').style.display='none';
                            document.getElementById('introduce').style.display='block';
                            document.getElementById('introduce_title').innerHTML='QUẢN LÝ TÀI KHOẢN';">Trở
                        lại</button>
                </form>
            </div>
            <div id="border_change_psw" style="position: absolute;">
                <form action="#" id="change_psw">
                    <div>
                        <label for="old_psw">Mật khẩu hiện tại</label>
                        <input type="password" name="old_psw" style="width: 35%;">
                    </div>
                    <div>
                        <label for="new_psw">Mật khẩu mới</label>
                        <input type="password" name="new_psw" style="width: 35%;">
                    </div>
                    <div>
                        <label for="cf_new_psw">Nhập lại mật khẩu mới</label>
                        <input type="password" name="cf_new_psw" style="width: 35%;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding: 8px 30px; margin: 18px 10px 20px 30%;">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>