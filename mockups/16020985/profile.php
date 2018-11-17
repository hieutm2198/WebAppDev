<?php
    include('server.php');
    $password = $_SESSION['password'];
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
    <?php include('nav.php'); ?>
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
                    <a id="link_introduce" onclick="info_user()" href="#" class="list-group-item list-group-item-action active">Quản
                        lý tài khoản</a>
                    <a id="link_friend" onclick="info_list_friend()" href="#" class="list-group-item list-group-item-action">Bạn
                        bè</a>
                    <a id="link_post" onclick="info_list_post()" href="#" class="list-group-item list-group-item-action">Danh sách
                        bài đăng</a>
                    <a href="#" class="list-group-item list-group-item-action">Danh
                        sách khảo sát</a>
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
            document.getElementById('introduce_title').innerHTML = 'QUẢN LÝ TÀI KHOẢN';
            document.getElementById('border_change_psw').style.display='none';
            document.getElementById('button_change_info_user').style.display='block';
            this.style.display='none';">
                <i class="fas fa-user mr-1" style="font-size: 15px;"></i>
                Xem tài khoản
            </button>
            <button id="button_add_post" class="btn btn-outline-primary" onclick="document.getElementById('new_post').style.display='block';"><i class="material-icons mr-1" style="font-size: 20px; position: relative; top: 4px;">add</i>Viết bài</button>
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
            <div id="list_friend" style="position: absolute; padding: 20px; display: none;">
                <table id="info_friend">
                <?php
                    $count_friend = 0;
                    if(isset($_SESSION['idnamhoc'])) {
                        $idnamhoc = $_SESSION['idnamhoc'];
                        $msv = $_SESSION['msv'];
                        $sql_list_friend = "SELECT hoten, anh, gioithieu FROM cuusinhvien WHERE idnamhoc='$idnamhoc' AND idcuusinhvien!='$msv'";
                        $result = mysqli_query($db, $sql_list_friend);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                if($count_friend % 2 == 0) {
                                    echo "<tr><td style='width: auto; padding-bottom: 20px;'><div class='media border rounded p-3'>
                                    <img src='image/" .$row['anh']. "' class='rounded mr-2' alt='Image_Friend' width='150px' height='120px'>
                                    <div class='media-body ml-2'>
                                    <form method='post'>
                                    <input type='text' name='name_friend' value='" .$row['hoten']. "' readonly style='border: none; background: transparent; font-weight: 500; color: black; font-size: 16px;'>
                                    <p><small><i>" .$row['gioithieu']. "</i></small></p>
                                    <button class='btn btn-outline-primary ml-5' type='submit' name='view_info_friend'>Xem</button></form></div></div></td>";
                                    $count_friend += 1;
                                }
                                else {
                                    echo "<td style='width: auto; padding-bottom: 20px;'><div class='media border rounded p-3 ml-5'>
                                    <img src='image/" .$row['anh']. "' class='rounded mr-2' alt='Image_Friend' width='150px' height='120px'>
                                    <div class='media-body ml-2'>
                                    <form method='post'>
                                    <input type='text' name='name_friend' value='" .$row['hoten']. "' readonly style='border: none; background: transparent; font-weight: 500; color: black; font-size: 16px;'>
                                    <p><small><i>" .$row['gioithieu']. "</i></small></p>
                                    <button class='btn btn-outline-primary ml-5' type='submit' name='view_info_friend'>Xem</button></form></div></div></td></tr>";
                                    $count_friend += 1;
                                }
                            }
                        }
                    }
                ?>
                </table>
            </div>
            <div id="post_user" style="width: 100%; display: none; padding-bottom: 20px;">
                <?php
                    $msv = $_SESSION['msv'];
                    $hoten = $_SESSION['username'];
                    $sql_info_post = "SELECT * FROM baidang WHERE idcuusinhvien='$msv'";
                    $result = mysqli_query($db, $sql_info_post);
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $idbaidang = $row['idbaidang'];
                            $tieude = $row['tieude'];
                            $hinhanh = $row['hinhanh'];
                            $yeuthich = $row['yeuthich'];
                            $thoigian = $row['thoigian'];
                            $sql_count_cmt = "SELECT count(*) count_cmt FROM binhluan WHERE idbaidang='$idbaidang'";
                            $result2 = mysqli_query($db, $sql_count_cmt);
                            $count_cmt = mysqli_fetch_array($result2)['count_cmt'];
                            $anh_user = $_SESSION['anh'];
                            echo "<div class='card' style='margin-left: 2%; width: 80%; padding: 20px; margin-top: 20px;'>
                                    <div class='card-header' style='border-bottom: none; background: transparent; padding: 0;'>
                                        <div class='media'>
                                            <img src='image/" .$anh_user. "' alt='Image_User' class='mr-2 rounded-circle' style='width: 50px; height: 50px;'>
                                            <div class='media-body'>
                                                <h6>" .$hoten. "</h6>
                                                <p style='font-size: 12px; color: rgba(173, 172, 172, 0.8);'>"
                                                .substr($thoigian, 11, 8). " " 
                                                .substr($thoigian, 8, 2). "/" .substr($thoigian, 5, 2). "/" 
                                                .substr($thoigian, 0, 4). "</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body' style='padding: 0;'>
                                    <img class='img-fluid' src='image/" .$hinhanh. "' alt='Image_Post'> 
                                    <p class='mt-3'><a href='server.php?detail_post=" .$idbaidang. "' style='text-decoration: none; font-size: 22px; font-weight: 500;'>" .$tieude. "</a></p>
                                    </div>    
                                    <div class='card-footer' style='border-top: none; background: transparent; padding: 0; position: relative'>
                                        <span>" .$yeuthich. "</span>
                                        <i class='fas fa-caret-up fa-2x ml-2' style='color: gray; font-size: 32px; position: relative; top: 5px;'></i>
                                        <i class='fas fa-caret-down fa-2x ml-1' style='color: gray; font-size: 32px; position: relative; top: 5px;'></i>
                                        <i class='fas fa-comment fa-lg' style='color: gray; position: absolute; right: 10%; bottom: 5px;'></i>
                                        <span style='position: absolute; right: 7%; bottom: 0px;'>" .$count_cmt. "</span>
                                    </div>
                                  </div>";
                        }
                    }
                ?>
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
        function info_user() {
            document.getElementById("introduce_title").innerHTML = 'QUẢN LÝ TÀI KHOẢN';
            document.getElementById("introduce").style.display = 'block';
            document.getElementById("border_edit_info_user").style.display = 'none';
            document.getElementById("border_change_psw").style.display = 'none';
            document.getElementById("list_friend").style.display = 'none';
            document.getElementById('button_view_account').style.display='none';
            document.getElementById('button_add_post').style.display='none';
            document.getElementById('button_change_info_user').style.display='block';
            document.getElementById("post_user").style.display = 'none';
            $("#link_friend").removeClass("active");
            $("#link_post").removeClass("active");
            $("#link_introduce").addClass("active");
        }
        function info_list_friend() {
            document.getElementById("introduce_title").innerHTML = 'DANH SÁCH BẠN BÈ';
            document.getElementById("introduce").style.display = 'none';
            document.getElementById("border_edit_info_user").style.display = 'none';
            document.getElementById("border_change_psw").style.display = 'none';
            document.getElementById("list_friend").style.display = 'block';
            document.getElementById('button_view_account').style.display='none';
            document.getElementById('button_change_info_user').style.display='none';
            document.getElementById('button_add_post').style.display='none';
            document.getElementById("post_user").style.display = 'none';
            $("#link_introduce").removeClass("active");
            $("#link_post").removeClass("active");
            $("#link_friend").addClass("active");
        }
        function info_list_post() {
            document.getElementById("introduce_title").innerHTML = 'DANH SÁCH BÀI ĐĂNG';
            document.getElementById("post_user").style.display = 'block';
            document.getElementById("introduce").style.display = 'none';
            document.getElementById("border_edit_info_user").style.display = 'none';
            document.getElementById("border_change_psw").style.display = 'none';
            document.getElementById("list_friend").style.display = 'none';
            document.getElementById('button_view_account').style.display='none';
            document.getElementById('button_change_info_user').style.display='none';
            document.getElementById('button_add_post').style.display='block';
            $("#link_introduce").removeClass("active");
            $("#link_friend").removeClass("active");
            $("#link_post").addClass("active");
        }
    </script>
</body>
</html>