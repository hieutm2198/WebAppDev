<?php
    include('server.php');
    if(isset($_SESSION['password'])) {
        $password = $_SESSION['password'];

    }
    else {
        $password = '01656830900';
    }
?>
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
                        <img class="img-fluid" 
                        src="<?php 
                            if(isset($_SESSION['anh'])) {
                                echo 'image/' .$_SESSION['anh'];
                            }
                            else {
                                echo 'image/fiora.jpg';
                            }?>" alt="Image_User"><br>
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
                    <a href="server.php?logout='1'" class="list-group-item list-group-item-action">Đăng xuất</a>
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
                                    <td>
                                    <?php 
										if(isset($_SESSION['username'])) {
											if($_SESSION['check_user'] != 1) {
												echo $_SESSION['username'];
											}
										}
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giới tính:</th>
                                    <td>
                                    <?php 
										if(isset($_SESSION['gioitinh'])) {
											echo $_SESSION['gioitinh'];
										}
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mã sinh viên:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['msv'])) {
                                            echo $_SESSION['msv'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['ngaysinh'])) {
                                            echo substr($_SESSION['ngaysinh'], 8, 2). "/" 
                                            .substr($_SESSION['ngaysinh'], 5, 2). "/" .substr($_SESSION['ngaysinh'], 0, 4);
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Quê quán:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['quequan'])) {
                                            echo $_SESSION['quequan'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>SĐT:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['sdt'])) {
                                            echo $_SESSION['sdt'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['email'])) {
                                            echo $_SESSION['email'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['diachi'])) {
                                            echo $_SESSION['diachi'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giới thiệu:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['gioithieu'])) {
                                            echo $_SESSION['gioithieu'];
                                        }
                                    ?>
                                    </td>
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
                            <table class="info_course">
                                <tr>
                                    <th>Niên khóa:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['nienkhoa'])) {
                                            echo $_SESSION['nienkhoa'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lớp quản lý:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['lopquanly'])) {
                                            echo $_SESSION['lopquanly'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngành học:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['nganhhoc'])) {
                                            echo $_SESSION['nganhhoc'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Chương trình đào tạo:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['chuongtrinhdaotao'])) {
                                            echo $_SESSION['chuongtrinhdaotao'];
                                        }
                                    ?>
                                    </td>
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
                            <table class="info_account">
                                <tr>
                                    <th>Tên tài khoản:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['name_account'])) {
                                            echo $_SESSION['name_account'];
                                        }
                                    ?>
                                    </td>
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
                                    <td>
                                    <?php
                                        if(isset($_SESSION['ngaytao'])) {
                                            echo substr($_SESSION['ngaytao'], 11, 8). " " 
                                            .substr($_SESSION['ngaytao'], 8, 2). "/" .substr($_SESSION['ngaytao'], 5, 2). "/" 
                                            .substr($_SESSION['ngaytao'], 0, 4); 
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Đăng nhập gần nhất:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['dangnhapgannhat'])) {
                                            echo substr($_SESSION['dangnhapgannhat'], 11, 8). " " 
                                            .substr($_SESSION['dangnhapgannhat'], 8, 2). "/" .substr($_SESSION['dangnhapgannhat'], 5, 2). "/" 
                                            .substr($_SESSION['dangnhapgannhat'], 0, 4); 
                                        }
                                    ?>
                                    </td>
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
                                    <td>
                                    <?php
                                        if(isset($_SESSION['batdau'])) {
                                            echo substr($_SESSION['batdau'], 8, 2). "/" 
                                            .substr($_SESSION['batdau'], 5, 2). "/" .substr($_SESSION['batdau'], 0, 4);
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Công ty:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['congty'])) {
                                            echo $_SESSION['congty'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['email_cpn'])) {
                                            echo $_SESSION['email_cpn'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Loại hình:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['loaihinh'])) {
                                            echo $_SESSION['loaihinh'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Vị trí:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['vitri'])) {
                                            echo $_SESSION['vitri'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mức lương:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['mucluong'])) {
                                            echo $_SESSION['mucluong'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['diachi_cpn'])) {
                                            echo $_SESSION['diachi_cpn'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div id="border_edit_info_user" style="position: absolute;">
                <form method="post" action="#" id="edit_info_user" enctype="multipart/form-data">
                    <div>
                        <label for="image_user">Ảnh đại diện</label>
                        <input type="file" name="image_user">
                    </div>
                    <div>
                        <label for="name_user">Họ và tên</label>
                        <input type="text" name="name_user" 
                        value="<?php 
                            if(isset($_SESSION['username'])) {
                                if($_SESSION['check_user'] != 1) {
                                    echo $_SESSION['username'];
                                }
                            }
                        ?>"
                        style="width: 40%;">
                    </div>
                    <div>
                        <label for="bd_user">Ngày sinh</label>
                        <input type="date" name="bd_user" value="<?php echo $_SESSION['ngaysinh'];?>">
                    </div>
                    <div>
                        <label for="gender_user">Giới tính</label>
                        <select name="gender_user" style="width: auto; padding: 3px; border-radius: 3px;">
                            <option <?php if(isset($_SESSION['gioitinh']) && $_SESSION['gioitinh'] == 'Nam') echo "selected";?> 
                            value="Nam">Nam</option>
                            <option <?php if(isset($_SESSION['gioitinh']) && $_SESSION['gioitinh'] == 'Nữ') echo "selected";?> 
                            value="Nữ">Nữ</option>
                            <option <?php if(isset($_SESSION['gioitinh']) && $_SESSION['gioitinh'] == 'Khác') echo "selected";?>
                            value="Khác">Khác</option>
                        </select><br>
                    </div>
                    <div>
                        <label for="home_user">Quê quán</label>
                        <input type="text" name="home_user" style="width: 60%;" 
                        value="<?php if(isset($_SESSION['quequan'])) echo $_SESSION['quequan'];?>">
                    </div>
                    <div>
                        <label for="pn_user">SĐT</label>
                        <input type="text" name="pn_user" 
                        value="<?php if(isset($_SESSION['sdt'])) echo $_SESSION['sdt'];?>">
                    </div>
                    <div>
                        <label for="email_user">Email</label>
                        <input type="email" name="email_user" style="width: 35%;" 
                        value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>">
                    </div>
                    <div>
                        <label for="adr_user">Địa chỉ</label>
                        <input type="text" name="adr_user" style="width: 60%;" 
                        value="<?php if(isset($_SESSION['diachi'])) echo $_SESSION['diachi'];?>">
                    </div>
                    <div>
                        <label for="time_study">Niên khóa</label>
                        <input type="text" name="time_study" 
                        value="<?php if(isset($_SESSION['nienkhoa'])) echo $_SESSION['nienkhoa'];?>">
                    </div>
                    <div>
                        <label for="class_user">Lớp quản lý</label>
                        <input type="text" name="class_user" style="width: 35%;" 
                        value="<?php if(isset($_SESSION['lopquanly'])) echo $_SESSION['lopquanly'];?>">
                    </div>
                    <div>
                        <label for="field_user">Ngành học</label>
                        <input type="text" name="field_user" style="width: 35%;" 
                        value="<?php if(isset($_SESSION['nganhhoc'])) echo $_SESSION['nganhhoc'];?>">
                    </div>
                    <div>
                        <label for="type_study">Đào tạo</label>
                        <select name="type_study" style="width: auto; padding: 3px; border-radius: 3px;">
                            <option <?php if(isset($_SESSION['chuongtrinhdaotao']) && $_SESSION['chuongtrinhdaotao'] == 'Chuẩn') echo "selected";?> 
                            value="Chuẩn">Chuẩn</option>
                            <option <?php if(isset($_SESSION['chuongtrinhdaotao']) && $_SESSION['chuongtrinhdaotao'] == 'Chất lượng cao') echo "selected";?>
                            value="Chất lượng cao">Chất lượng cao</option>
                        </select>
                    </div>
                    <div>
                        <label id="dc_user" for="dc_user">Giới thiệu</label>
                        <textarea name="dc_user" rows="2" cols="40" style="width: 60%;"><?php if(isset($_SESSION['gioithieu'])) echo $_SESSION['gioithieu']; ?></textarea>
                    </div>
                    <div>
                        <label for="name_company">Công ty</label>
                        <input type="text" name="name_company" style="width: 35%;" 
                        value="<?php if(isset($_SESSION['congty'])) echo $_SESSION['congty']; ?>">
                    </div>
                    <div>
                        <label for="email_company">Email</label>
                        <input type="email" name="email_company" style="width: 35%;" 
                        value="<?php if(isset($_SESSION['email_cpn'])) echo $_SESSION['email_cpn']; ?>">
                    </div>
                    <div>
                        <label for="type_company">Loại hình</label>
                        <select name="type_company" style="width: auto; padding: 3px; border-radius: 3px;">
                            <option <?php if(isset($_SESSION['loaihinh']) && $_SESSION['loaihinh'] == 'Product') echo "selected";?>
                            value="Product">Product</option>
                            <option <?php if(isset($_SESSION['loaihinh']) && $_SESSION['loaihinh'] == 'Outsourcing') echo "selected";?>
                            value="Outsourcing">Outsourcing</option>
                            <option <?php if(isset($_SESSION['loaihinh']) && $_SESSION['loaihinh'] == 'Other') echo "selected";?>
                            value="Other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="time_start">Làm từ</label>
                        <input type="date" name="time_start" style="width: 35%;" 
                        value="<?php echo $_SESSION['batdau'];?>">
                    </div>

                    <div>
                        <label for="position_user">Vị trí</label>
                        <input type="text" name="position_user" style="width: 35%;" 
                        value="<?php if(isset($_SESSION['vitri'])) echo $_SESSION['vitri'];?>">
                    </div>
                    <div>
                        <label for="salary_user">Mức lương</label>
                        <input type="text" name="salary_user" 
                        value="<?php if(isset($_SESSION['mucluong'])) echo $_SESSION['mucluong'];?>">
                    </div>
                    <div>
                        <label for="adr_company">Địa chỉ</label>
                        <input type="text" name="adr_company" style="width: 60%;" 
                        value="<?php if(isset($_SESSION['diachi_cpn'])) echo $_SESSION['diachi_cpn'];?>">
                    </div>


                    <button type="submit" name="upload" class="btn btn-primary" style="padding: 8px 30px; margin: 18px 10px 20px 20%;">Lưu</button>
                    <button type="button" class="btn btn-primary" style="padding: 8px 30px; margin: 18px 10px 20px 0;"
                        onclick="document.getElementById('border_edit_info_user').style.display='none';
                            document.getElementById('introduce').style.display='block';
                            document.getElementById('introduce_title').innerHTML='QUẢN LÝ TÀI KHOẢN';">Trở
                        lại</button>
                </form>
            </div>
            <div id="border_change_psw" style="position: absolute;">
                <form method="post" action="#" id="change_psw">
                    <div>
                        <label for="old_psw">Mật khẩu hiện tại</label>
                        <input id="old_psw" type="password" name="old_psw" onkeyup="check_old_psw()" style="width: 35%;">
                        <i id="check_old_psw_user" class="fas fa-exclamation ml-3" style="padding: 5px 8px; color: red; font-size: 15px; letter-spacing: 1px;
                        word-spacing: 2px; border: 1px solid red; border-radius: 3px; display: none;"></i>
                    </div>
                    <div>
                        <label for="new_psw">Mật khẩu mới</label>
                        <input id="new_psw" type="password" name="new_psw" onkeyup="check_new_psw()" style="width: 35%;">
                        <i id="check_new_psw_user" class="fas fa-exclamation ml-3" style="padding: 5px 8px; color: red; font-size: 15px; letter-spacing: 1px;
                        word-spacing: 2px; border: 1px solid red; border-radius: 3px; display: none"></i>
                    </div>
                    <div>
                        <label for="cf_new_psw">Nhập lại mật khẩu mới</label>
                        <input id="cf_new_psw" type="password" name="cf_new_psw" onkeyup="check_cf_new_psw()" style="width: 35%;">
                        <i id="check_cf_new_psw_user" class="fas fa-exclamation ml-3" style="padding: 5px 8px; color: red; font-size: 15px; letter-spacing: 1px;
                        word-spacing: 2px; border: 1px solid red; border-radius: 3px; display: none"></i>
                    </div>
                    <button type="submit" name="button_change_psw" class="btn btn-primary" style="padding: 8px 30px; margin: 18px 10px 20px 30%;">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        var success = 0;
        function check_old_psw() {
            var old_psw = document.getElementById("old_psw").value;
            var psw_user = <?php echo json_encode($password)?>;
            if(old_psw != psw_user) {
                document.getElementById("check_old_psw_user").style.display = 'inline-block';
            }
            else {
                document.getElementById("check_old_psw_user").style.display = 'none';
            }
            if(old_psw == '') {
                document.getElementById("check_old_psw_user").style.display = 'none';
            }
        }
        function check_new_psw() {
            var new_psw = document.getElementById("new_psw").value;
            var cf_new_psw = document.getElementById("cf_new_psw").value;
            if((new_psw == '') && (cf_new_psw == '')) {
                document.getElementById("check_cf_new_psw_user").style.display = 'none';
            }
            if((new_psw != cf_new_psw) && (cf_new_psw != '')) {
                if(success == 1) {
                    $("#check_cf_new_psw_user").removeClass("fas fa-check");
                    $("#check_cf_new_psw_user").addClass("fas fa-exclamation");
                    $("#check_cf_new_psw_user").css({
                        "color": "red",
                        "border-color": "red"
                    });
                }
                success = 0;
                document.getElementById("check_cf_new_psw_user").style.display = 'inline-block';
            }
            if((new_psw == cf_new_psw) && (success == 0) && (cf_new_psw != '')) {
                success = 1;
                $("#check_cf_new_psw_user").removeClass("fas fa-exclamation");
                $("#check_cf_new_psw_user").addClass("fas fa-check");
                $("#check_cf_new_psw_user").css({
                    "color": "green",
                    "border-color": "green"
                });
                document.getElementById("check_cf_new_psw_user").style.display = 'inline-block';
            }
        }
        function check_cf_new_psw() {
            var new_psw = document.getElementById("new_psw").value;
            var cf_new_psw = document.getElementById("cf_new_psw").value;
            if(new_psw != cf_new_psw) {
                if(success == 1) {
                    $("#check_cf_new_psw_user").removeClass("fas fa-check");
                    $("#check_cf_new_psw_user").addClass("fas fa-exclamation");
                    $("#check_cf_new_psw_user").css({
                        "color": "red",
                        "border-color": "red"
                    });
                }
                document.getElementById("check_cf_new_psw_user").style.display = 'inline-block';
                success = 0;
            }
            else {
                success = 1;
                $("#check_cf_new_psw_user").removeClass("fas fa-exclamation");
                $("#check_cf_new_psw_user").addClass("fas fa-check");
                $("#check_cf_new_psw_user").css({
                    "color": "green",
                    "border-color": "green"
                });
                document.getElementById("check_cf_new_psw_user").style.display = 'inline-block';
            }
            if(cf_new_psw == '') {
                document.getElementById("check_cf_new_psw_user").style.display = 'none';
            }
        }
    </script>
</body>
</html>