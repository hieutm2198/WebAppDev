<?php
    include('server.php');
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
    <!-- Javascript file -->
    <script src='profile_friend.js'></script>
</head>

<body>
    <?php include('nav.php') ?>
    <div class="container-fluid">
        <div style="width: 22%; float: left;">
            <div id="border_profile_list">
                <div id="profile_list" class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action">
                        <img class="img-fluid" 
                        src="<?php 
                            if(isset($_SESSION['anh_friend'])) {
                                echo 'image/' .$_SESSION['anh_friend'];
                            }
                            else {
                                echo 'image/fiora.jpg';
                            }?>" alt="Image_User"><br>
                        <p>
                        <?php
                            if(isset($_SESSION['username_friend'])) {
                                echo $_SESSION['username_friend'];
                            }
                        ?>
                        </p>
                    </a>
                    <a id="link_introduce" onclick="info_user()" href="#" class="list-group-item list-group-item-action active">Tài khoản</a>
                    <a href="#" class="list-group-item list-group-item-action">Bạn
                        bè</a>
                    <a id="link_post" onclick="info_list_post()" href="#" class="list-group-item list-group-item-action">Danh sách
                        bài đăng</a>
                    <a href="#" class="list-group-item list-group-item-action">Danh
                        sách khảo sát</a>
                    <a href="#" class="list-group-item list-group-item-action">Danh sách
                        forum</a>
                    <a href="#" class="list-group-item list-group-item-action">Lịch sử</a>
                </div>
            </div>
        </div>
        <div class="right_content" style="float: left; position: relative;">
            <p id="introduce_title">TÀI KHOẢN</p>
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
										if(isset($_SESSION['username_friend'])) {
											echo $_SESSION['username_friend'];
										}
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giới tính:</th>
                                    <td>
                                    <?php 
										if(isset($_SESSION['gioitinh_friend'])) {
											echo $_SESSION['gioitinh_friend'];
										}
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mã sinh viên:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['msv_friend'])) {
                                            echo $_SESSION['msv_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['ngaysinh_friend'])) {
                                            echo substr($_SESSION['ngaysinh_friend'], 8, 2). "/" 
                                            .substr($_SESSION['ngaysinh_friend'], 5, 2). "/" .substr($_SESSION['ngaysinh_friend'], 0, 4);
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Quê quán:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['quequan_friend'])) {
                                            echo $_SESSION['quequan_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>SĐT:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['sdt_friend'])) {
                                            echo $_SESSION['sdt_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['email_friend'])) {
                                            echo $_SESSION['email_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['diachi_friend'])) {
                                            echo $_SESSION['diachi_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giới thiệu:</th>
                                    <td>
                                    <?php 
                                        if(isset($_SESSION['gioithieu_friend'])) {
                                            echo $_SESSION['gioithieu_friend'];
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
                                        if(isset($_SESSION['name_account_friend'])) {
                                            echo $_SESSION['name_account_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày kích hoạt:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['ngaytao_friend'])) {
                                            echo substr($_SESSION['ngaytao_friend'], 11, 8). " " 
                                            .substr($_SESSION['ngaytao_friend'], 8, 2). "/" .substr($_SESSION['ngaytao_friend'], 5, 2). "/" 
                                            .substr($_SESSION['ngaytao_friend'], 0, 4); 
                                        }
                                        else {
                                            echo "False";
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Đăng nhập gần nhất:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['dangnhapgannhat_friend'])) {
                                            echo substr($_SESSION['dangnhapgannhat_friend'], 11, 8). " " 
                                            .substr($_SESSION['dangnhapgannhat_friend'], 8, 2). "/" .substr($_SESSION['dangnhapgannhat_friend'], 5, 2). "/" 
                                            .substr($_SESSION['dangnhapgannhat_friend'], 0, 4); 
                                        }
                                        else {
                                            echo "False";
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
                                        if(isset($_SESSION['batdau_friend'])) {
                                            echo substr($_SESSION['batdau_friend'], 8, 2). "/" 
                                            .substr($_SESSION['batdau_friend'], 5, 2). "/" .substr($_SESSION['batdau_friend'], 0, 4);
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Công ty:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['congty_friend'])) {
                                            echo $_SESSION['congty_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['email_cpn_friend'])) {
                                            echo $_SESSION['email_cpn_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Loại hình:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['loaihinh_friend'])) {
                                            echo $_SESSION['loaihinh_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ:</th>
                                    <td>
                                    <?php
                                        if(isset($_SESSION['diachi_cpn_friend'])) {
                                            echo $_SESSION['diachi_cpn_friend'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>   
            <div id="post_user" style="width: 100%; display: none; padding-bottom: 20px;">
                <?php
                    $msv_friend = $_SESSION['msv_friend'];
                    $hoten_friend = $_SESSION['username_friend'];
                    $sql_info_post = "SELECT * FROM baidang WHERE idcuusinhvien='$msv_friend'";
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
                            $anh_user = $_SESSION['anh_friend'];
                            echo "<div class='card' style='margin-left: 2%; width: 80%; padding: 20px; margin-top: 20px;'>
                                    <div class='card-header' style='border-bottom: none; background: transparent; padding: 0;'>
                                        <div class='media'>
                                            <img src='image/" .$anh_user. "' alt='Image_User' class='mr-2 rounded-circle' style='width: 50px; height: 50px'>
                                            <div class='media-body'>
                                                <h6>" .$hoten_friend. "</h6>
                                                <p style='font-size: 12px; color: rgba(173, 172, 172, 0.8);'>"
                                                .substr($thoigian, 11, 8). " " 
                                                .substr($thoigian, 8, 2). "/" .substr($thoigian, 5, 2). "/" 
                                                .substr($thoigian, 0, 4). "</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body' style='padding: 0;'>
                                    <img class='img-fluid' src='image/" .$hinhanh. "' alt='Image_Post'> 
                                    <p class='mt-3'><a href='server1.php?detail_post=" .$idbaidang. "' style='text-decoration: none; font-size: 22px; font-weight: 500;'>" .$tieude. "</a></p>
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
</body>
</html>