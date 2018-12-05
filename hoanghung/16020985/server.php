<?php
    session_start();
    $urn_sign_up = "";
    $psw_sign_up = "";
    $cf_psw_sign_up = "";
    $error = array();
    $db = mysqli_connect("localhost", "root", "starman", "quanlycuusv");
    mysqli_set_charset($db, "utf8");
    if(isset($_POST['register'])) {
        $urn_sign_up = mysqli_real_escape_string($db, $_POST['urn_sign_up']);
        $psw_sign_up = mysqli_real_escape_string($db, $_POST['psw_sign_up']);
        $cf_psw_sign_up = mysqli_real_escape_string($db, $_POST['cf_psw_sign_up']);
        if(($psw_sign_up == $cf_psw_sign_up) && (preg_match('/^[a-zA-Z0-9]{5,}$/', $urn_sign_up))) {
            $sql = "INSERT INTO user(username, password_user) VALUES ('$urn_sign_up', '$psw_sign_up')";
            mysqli_query($db, $sql);
            session_unset();
            $_SESSION['username'] = $urn_sign_up;
            $_SESSION['check_user'] = 1;
            header("location: profile.php");
        }
    }
    if(isset($_POST['button_login'])) {
        $urn_sign_in = mysqli_real_escape_string($db, $_POST['urn_login']);
        $psw_sign_in = mysqli_real_escape_string($db, $_POST['psw_login']);
        $sql_status_signin = "SELECT * FROM user WHERE username = '$urn_sign_in' AND password_user = '$psw_sign_in'";
        $result = mysqli_query($db, $sql_status_signin);
        if(mysqli_num_rows($result) == 1) {
            $arr_info_signin = mysqli_fetch_array($result);
            if($arr_info_signin['idcuusinhvien'] == NULL) {
                if(isset($_SESSION['username'])) {
                    session_unset();
                }
                $_SESSION['role_user'] = $arr_info_signin['role_user'];
                $_SESSION['username'] = $arr_info_signin['username'];
                $_SESSION['password'] = $arr_info_signin['password_user'];
                $_SESSION['name_account'] = $arr_info_signin['username'];

                // Dòng này của Hiếu
                $_SESSION['MaSV'] = $_SESSION['name_account'];

                $_SESSION['ngaytao'] = $arr_info_signin['ngaytao'];
                $_SESSION['dangnhapgannhat'] = $arr_info_signin['dangnhapgannhat'];
                // $_SESSION['status'] = "You are logged in";
                $_SESSION['check_user'] = 1;
                if($_SESSION['role_user'] == "normal") {
                    header("location: profile.php");
                }
                if($_SESSION['role_user'] == "moderator" || $_SESSION['role_user'] == "admin") {
                    header("location: admin.php");
                }
            }
            else {
                session_unset();
                $_SESSION['role_user'] = $arr_info_signin['role_user'];
                $_SESSION['password'] = $arr_info_signin['password_user']; 
                $_SESSION['check_user'] = 0;
                $msv = $arr_info_signin['idcuusinhvien'];
                $sql_info_signin = "SELECT * FROM cuusinhvien WHERE idcuusinhvien = '$msv'";
                $result1 = mysqli_query($db, $sql_info_signin);
                $arr_info_user = mysqli_fetch_array($result1);
                $_SESSION['username'] = $arr_info_user['hoten'];
                $_SESSION['gioitinh'] = $arr_info_user['gioitinh'];
                $_SESSION['msv'] = $msv;
                $_SESSION['ngaysinh'] = $arr_info_user['ngaysinh'];
                $_SESSION['sdt'] = $arr_info_user['sdt'];
                $_SESSION['email'] = $arr_info_user['email'];
                $_SESSION['anh'] = $arr_info_user['anh'];
                if($_SESSION['anh'] == NULL) {
                    $_SESSION['anh'] = 'fiora.jpg';
                }
                $idquequan = $arr_info_user['idquequan'];
                $sql_info_home = "SELECT * FROM quequan WHERE idquequan = '$idquequan'";
                $result2 = mysqli_query($db, $sql_info_home);
                $arr_info_home = mysqli_fetch_array($result2);
                $_SESSION['quequan'] = $arr_info_home['tenquequan'];
                $iddiachi = $arr_info_user['iddiachi'];
                $sql_info_address = "SELECT * FROM diachi WHERE iddiachi = '$iddiachi'";
                $result3 = mysqli_query($db, $sql_info_address);
                $arr_info_address = mysqli_fetch_array($result3);
                $_SESSION['diachi'] = $arr_info_address['tendiachi'];
                if($arr_info_user['gioithieu'] == NULL) {
                    $_SESSION['gioithieu'] = "Sinh viên K61 CD";
                }
                else {
                    $_SESSION['gioithieu'] = $arr_info_user['gioithieu'];
                }
                $idnamhoc = $arr_info_user['idnamhoc'];
                $_SESSION['idnamhoc'] = $idnamhoc;
                $sql_info_course = "SELECT * FROM namhoc WHERE idnamhoc = '$idnamhoc'";
                $result4 = mysqli_query($db, $sql_info_course);
                $arr_info_course = mysqli_fetch_array($result4);
                $_SESSION['nienkhoa'] = $arr_info_course['nienkhoa'];
                $_SESSION['lopquanly'] = $arr_info_course['lopquanly'];
                $_SESSION['nganhhoc'] = $arr_info_course['nganhhoc'];
                $_SESSION['chuongtrinhdaotao'] = $arr_info_course['chuongtrinhdaotao'];
                $sql_info_business = "SELECT * FROM congtac WHERE idcuusinhvien = '$msv'";
                $result6 = mysqli_query($db, $sql_info_business);
                if(mysqli_num_rows($result6) == 1) {
                    $arr_info_business = mysqli_fetch_array($result6);
                    $idcoquan = $arr_info_business['idcoquan'];
                    $sql_info_company = "SELECT * FROM coquan WHERE idcoquan = '$idcoquan'";
                    $result7 = mysqli_query($db, $sql_info_company);
                    $arr_info_company = mysqli_fetch_array($result7);
                    $_SESSION['batdau'] = $arr_info_business['thoigian'];
                    $_SESSION['congty'] = $arr_info_company['tencoquan'];
                    $_SESSION['email_cpn'] = $arr_info_company['email_cpn'];
                    $_SESSION['loaihinh'] = $arr_info_company['loaihinh'];
                    $_SESSION['vitri'] = $arr_info_business['vitri'];
                    $_SESSION['mucluong'] = $arr_info_business['mucluong'];
                    $iddiachi_cpn = $arr_info_company['iddiachi'];
                    $sql_info_address_cpn = "SELECT * FROM diachi WHERE iddiachi = '$iddiachi_cpn'";
                    $result8 = mysqli_query($db, $sql_info_address_cpn);
                    $arr_info_address_cpn = mysqli_fetch_array($result8);
                    $_SESSION['diachi_cpn'] = $arr_info_address_cpn['tendiachi'];
                }
                $_SESSION['name_account'] = $arr_info_signin['username'];
                // Dòng này của Hiếu
                $_SESSION['MaSV'] = $_SESSION['name_account'];
                $_SESSION['ngaytao'] = $arr_info_signin['ngaytao'];
                $_SESSION['dangnhapgannhat'] = $arr_info_signin['dangnhapgannhat'];
                // $_SESSION['status'] = "You are logged in";
                $sql_change_online = "UPDATE cuusinhvien SET online='1' WHERE idcuusinhvien='$urn_sign_in'";
                $result43 = mysqli_query($db, $sql_change_online);
                if($_SESSION['role_user'] == "admin") {
                    $sql_change_online = "UPDATE cuusinhvien SET online='1' WHERE idcuusinhvien='2018'";
                    $result43 = mysqli_query($db, $sql_change_online);
                }
                if($_SESSION['role_user'] == "normal") {
                    header("location: C001.php");
                }
                else {
                    header("location: admin.php");
                }
            }
            // header("location: C001.php");
        }
        else {
            array_push($error, "Username or Password is incorrect");
        }
    }
    // if(isset($_GET['profile'])) {
    //     header("location: profile.php");
    // }
    if(isset($_POST['upload'])) {
        $msv = $_SESSION['msv'];
        if(isset($_FILES['image_user'])) {
            if($_FILES['image_user']['error'] == 0) {
                $target = "image/" .basename($_FILES['image_user']['name']);
                $image = $_FILES['image_user']['name'];
                $sql_upload_image = "UPDATE cuusinhvien SET anh = '$image' WHERE idcuusinhvien = '$msv'";
                $result9 = mysqli_query($db, $sql_upload_image);
                if(move_uploaded_file($_FILES['image_user']['tmp_name'], $target)) {
                    $_SESSION['anh'] = $image;
                    $content = "Bạn đã cập nhật ảnh mới";
                    $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
                    $result42 = mysqli_query($db, $lichsu);
                }
            }
        }
        $content_user = "Bạn đã cập nhật:<br>";
        if(!empty($_POST['name_user'])) {
            if($_POST['name_user'] != $_SESSION['username']) {
                $content_user .= "Tên từ " .$_SESSION['username']. " thành " .$_POST['name_user']. "<br>";
            }
            $_SESSION['username'] = mysqli_real_escape_string($db, $_POST['name_user']);
        }
        if(!empty($_POST['bd_user'])) {
            if($_POST['bd_user'] != $_SESSION['ngaysinh']) {
                $content_user .= "Ngày sinh từ " .$_SESSION['ngaysinh']. " thành " .$_POST['bd_user']. "<br>";
            }
            $_SESSION['ngaysinh'] = mysqli_real_escape_string($db, $_POST['bd_user']);
        }
        if($_POST['gender_user'] != $_SESSION['gioitinh']) {
            $content_user .= "Giới tính từ " .$_SESSION['gioitinh']. " thành " .$_POST['gender_user']. "<br>";
        }
        $_SESSION['gioitinh'] = mysqli_real_escape_string($db, $_POST['gender_user']);
        if(!empty($_POST['pn_user'])) {
            if($_POST['pn_user'] != $_SESSION['sdt']) {
                $content_user .= "SĐT từ " .$_SESSION['sdt']. " thành " .$_POST['pn_user']. "<br>";
            }
            $_SESSION['sdt'] = mysqli_real_escape_string($db, $_POST['pn_user']);
        }
        if(filter_var($_POST['email_user'], FILTER_VALIDATE_EMAIL)) {
            if($_POST['email_user'] != $_SESSION['email']) {
                $content_user .= "Email từ " .$_SESSION['email']. " thành " .$_POST['email_user']. "<br>";
            }
            $_SESSION['email'] = mysqli_real_escape_string($db, $_POST['email_user']);
        }
        if(!empty($_POST['dc_user'])) {
            if($_POST['dc_user'] != $_SESSION['gioithieu']) {
                $content_user .= "Giới thiệu từ " .$_SESSION['gioithieu']. " thành " .$_POST['dc_user']. "<br>";
            }
            $_SESSION['gioithieu'] = mysqli_real_escape_string($db, $_POST['dc_user']);
        }
        $hoten = $_SESSION['username'];
        $ngaysinh = $_SESSION['ngaysinh'];
        $gioitinh = $_SESSION['gioitinh'];
        $sdt = $_SESSION['sdt'];
        $email = $_SESSION['email'];
        $gioithieu = $_SESSION['gioithieu'];
        $sql_update_user = "UPDATE cuusinhvien SET hoten='$hoten', ngaysinh='$ngaysinh', gioitinh='$gioitinh', sdt='$sdt', email='$email', gioithieu='$gioithieu' WHERE idcuusinhvien='$msv'";
        $result10 = mysqli_query($db, $sql_update_user);
        if($content_user != 'Bạn đã cập nhật:<br>') {
            $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content_user')";
            $result45 = mysqli_query($db, $lichsu);
        }
        if(!empty($_POST['home_user']) && ($_POST['home_user'] != $_SESSION['quequan'])) {
            $content = "Bạn đã cập nhật quê quán từ " .$_SESSION['quequan']. " thành " .$_POST['home_user'];
            $_SESSION['quequan'] = mysqli_real_escape_string($db, $_POST['home_user']);
            $quequan = $_SESSION['quequan'];
            $sql_check_quequan = "SELECT * FROM quequan WHERE tenquequan='$quequan'";
            $result11 = mysqli_query($db, $sql_check_quequan);
            $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
            $result46 = mysqli_query($db, $lichsu);
            if(mysqli_num_rows($result11) == 1) {
                $new_idquequan = mysqli_fetch_array($result11)['idquequan'];
                $sql_update_idquequan = "UPDATE cuusinhvien SET idquequan='$new_idquequan' WHERE idcuusinhvien='$msv'";
                $result12 = mysqli_query($db, $sql_update_idquequan);
            }
            else {
                $sql_add_quequan = "INSERT INTO quequan(tenquequan) VALUES ('$quequan')";
                $result13 = mysqli_query($db, $sql_add_quequan);
                $sql_find_idquequan = "SELECT idquequan FROM quequan WHERE tenquequan='$quequan'";
                $result14 = mysqli_query($db, $sql_find_idquequan);
                $new_idquequan = mysqli_fetch_array($result14)['idquequan'];
                $sql_update_idquequan = "UPDATE cuusinhvien SET idquequan='$new_idquequan' WHERE idcuusinhvien='$msv'";
                $result15 = mysqli_query($db, $sql_update_idquequan);
            }
        }
        if(!empty($_POST['adr_user']) && ($_POST['adr_user'] != $_SESSION['diachi'])) {
            $content = "Bạn đã cập nhật địa chỉ từ " .$_SESSION['diachi']. " thành " .$_POST['adr_user'];
            $_SESSION['diachi'] = mysqli_real_escape_string($db, $_POST['adr_user']);
            $diachi = $_SESSION['diachi'];
            $sql_check_diachi = "SELECT * FROM diachi WHERE tendiachi='$diachi'";
            $result16 = mysqli_query($db, $sql_check_diachi);
            $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
            $result47 = mysqli_query($db, $lichsu);
            if(mysqli_num_rows($result16) == 1) {
                $new_iddiachi = mysqli_fetch_array($result16)['iddiachi'];
                $sql_update_iddiachi = "UPDATE cuusinhvien SET iddiachi='$new_iddiachi' WHERE idcuusinhvien='$msv'";
                $result17 = mysqli_query($db, $sql_update_iddiachi);
            }
            else {
                $sql_add_diachi = "INSERT INTO diachi(tendiachi) VALUES ('$diachi')";
                $result18 = mysqli_query($db, $sql_add_diachi);
                $sql_find_iddiachi = "SELECT iddiachi FROM diachi WHERE tendiachi='$diachi'";
                $result19 = mysqli_query($db, $sql_find_iddiachi);
                $new_iddiachi = mysqli_fetch_array($result19)['iddiachi'];
                $sql_update_iddiachi = "UPDATE cuusinhvien SET iddiachi='$new_iddiachi' WHERE idcuusinhvien='$msv'";
                $result20 = mysqli_query($db, $sql_update_iddiachi);
            }
        }
        $content_course = "Bạn đã cập nhật:<br>";
        if(!empty($_POST['time_study'])) {
            if($_POST['time_study'] != $_SESSION['nienkhoa']) {
                $content_course .= "Thời gian học từ " .$_SESSION['nienkhoa']. " thành " .$_POST['time_study']. "<br>";
            }
            $_SESSION['nienkhoa'] = mysqli_real_escape_string($db, $_POST['time_study']);
        }
        if(!empty($_POST['class_user'])) {
            if($_POST['class_user'] != $_SESSION['lopquanly']) {
                $content_course .= "Lớp đại học từ " .$_SESSION['lopquanly']. " thành " .$_POST['class_user']. "<br>";
            }
            $_SESSION['lopquanly'] = mysqli_real_escape_string($db, $_POST['class_user']);
        }
        if(!empty($_POST['field_user'])) {
            if($_POST['field_user'] != $_SESSION['nganhhoc']) {
                $content_course .= "Chuyên ngành từ " .$_SESSION['nganhhoc']. " thành " .$_POST['field_user']. "<br>";
            }
            $_SESSION['nganhhoc'] = mysqli_real_escape_string($db, $_POST['field_user']);
        }
        if($_POST['type_study'] != $_SESSION['chuongtrinhdaotao']) {
            $content_course .= "Hệ đào tạo từ " .$_SESSION['chuongtrinhdaotao']. " thành " .$_POST['type_study']. "<br>";
        }
        $_SESSION['chuongtrinhdaotao'] = mysqli_real_escape_string($db, $_POST['type_study']);
        $nienkhoa = $_SESSION['nienkhoa'];
        $lopquanly = $_SESSION['lopquanly'];
        $sql_find_idnamhoc = "SELECT * FROM namhoc WHERE nienkhoa='$nienkhoa' AND lopquanly='$lopquanly'";
        $result21 = mysqli_query($db, $sql_find_idnamhoc);
        $new_idnamhoc = mysqli_fetch_array($result21)['idnamhoc'];
        $sql_update_idnamhoc = "UPDATE cuusinhvien SET idnamhoc='$new_idnamhoc' WHERE idcuusinhvien='$msv'";
        $result22 = mysqli_query($db, $sql_update_idnamhoc);
        if($content_course != 'Bạn đã cập nhật:<br>') {
            $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content_course')";
            $result48 = mysqli_query($db, $lichsu);
        }
        if((!empty($_POST['name_company'])) && (filter_var($_POST['email_company'], FILTER_VALIDATE_EMAIL)) && (!empty($_POST['adr_company']))) {
            $content_cp = "Bạn đã cập nhật:<br>";
            if($_POST['name_company'] != $_SESSION['congty']) {
                $content_cp .= "Tên công ty từ " .$_SESSION['congty']. " thành " .$_POST['name_company']. "<br>";
            }
            $_SESSION['congty'] = mysqli_real_escape_string($db, $_POST['name_company']);
            if($_POST['email_company'] != $_SESSION['email_cpn']) {
                $content_cp .= "Email công ty từ " .$_SESSION['email_cpn']. " thành " .$_POST['email_company']. "<br>";
            }
            $_SESSION['email_cpn'] = mysqli_real_escape_string($db, $_POST['email_company']);
            if($_POST['adr_company'] != $_SESSION['diachi_cpn']) {
                $content_cp .= "Địa chỉ công ty từ " .$_SESSION['diachi_cpn']. " thành " .$_POST['adr_company']. "<br>";
            }
            $_SESSION['diachi_cpn'] = mysqli_real_escape_string($db, $_POST['adr_company']);
            if($_POST['type_company'] != $_SESSION['loaihinh']) {
                $content_cp .= "Loại hình công ty từ " .$_SESSION['loaihinh']. " thành " .$_POST['type_company']. "<br>";
            }
            $_SESSION['loaihinh'] = mysqli_real_escape_string($db, $_POST['type_company']);
            if($content_cp != "Bạn đã cập nhật:<br>") {
                $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content_cp')";
                $result49 = mysqli_query($db, $lichsu);
            }
            $congty = $_SESSION['congty'];
            $email_cpn = $_SESSION['email_cpn'];
            $diachi_cpn = $_SESSION['diachi_cpn'];
            $loaihinh = $_SESSION['loaihinh'];
            $sql_check_diachi_cpn = "SELECT iddiachi FROM diachi WHERE tendiachi='$diachi_cpn'";
            $result28 = mysqli_query($db, $sql_check_diachi_cpn);
            if(mysqli_num_rows($result28) == 1) {
                $new_iddiachi = mysqli_fetch_array($result28)['iddiachi'];
            }
            else {
                $sql_add_diachi = "INSERT INTO diachi(tendiachi) VALUES ('$diachi_cpn')";
                $result24 = mysqli_query($db, $sql_add_diachi);
                $new_iddiachi = mysqli_insert_id($db);
            }
            $sql_check_cpn = "SELECT * FROM coquan WHERE email_cpn='$email_cpn'";
            $result23 = mysqli_query($db, $sql_check_cpn);
            if(mysqli_num_rows($result23) == 1) {
                $new_idcoquan = mysqli_fetch_array($result23)['idcoquan'];
                $sql_update_iddiachi = "UPDATE coquan SET iddiachi='$new_iddiachi' WHERE email_cpn='$email_cpn'";
                $result26 = mysqli_query($db, $sql_update_iddiachi);
            }
            else {
                $sql_add_coquan = "INSERT INTO coquan(tencoquan, loaihinh, iddiachi, email_cpn)
                VALUES ('$congty', '$loaihinh', '$new_iddiachi', '$email_cpn')";
                $result25 = mysqli_query($db, $sql_add_coquan);
                $new_idcoquan = mysqli_insert_id($db);
            }
            $sql_update_idcoquan = "UPDATE congtac SET idcoquan='$new_idcoquan' WHERE idcuusinhvien='$msv'";
            $result27 = mysqli_query($db, $sql_update_idcoquan);
        }
        $content_business = "Bạn đã cập nhật:<br>";
        if(!empty($_POST['time_start'])) {
            if($_POST['time_start'] != $_SESSION['batdau']) {
                $content_business .= "Bắt đầu làm từ " .$_SESSION['batdau']. " thành " .$_POST['time_start']. "<br>";
            }
            $_SESSION['batdau'] = mysqli_real_escape_string($db, $_POST['time_start']);
        }
        if(!empty($_POST['position_user'])) {
            if($_POST['position_user'] != $_SESSION['vitri']) {
                $content_business .= "Vị trí từ " .$_SESSION['vitri']. " thành " .$_POST['position_user']. "<br>";
            }
            $_SESSION['vitri'] = mysqli_real_escape_string($db, $_POST['position_user']);
        }
        if(!empty($_POST['salary_user'])) {
            if($_POST['salary_user'] != $_SESSION['mucluong']) {
                $content_business .= "Tiền lương từ " .$_SESSION['mucluong']. " thành " .$_POST['salary_user']. "<br>";
            }
            $_SESSION['mucluong'] = mysqli_real_escape_string($db, $_POST['salary_user']);
        }
        if($content_business != "Bạn đã cập nhật:<br>") {
            $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content_business')";
            $result50 = mysqli_query($db, $lichsu);
        }
        $batdau = $_SESSION['batdau'];
        $vitri = $_SESSION['vitri'];
        $mucluong = $_SESSION['mucluong'];
        $sql_update_congtac = "UPDATE congtac SET thoigian='$batdau', vitri='$vitri', mucluong='$mucluong' WHERE idcuusinhvien='$msv'";
        $result29 = mysqli_query($db, $sql_update_congtac);
        header("location: profile.php");
    }
    if(isset($_POST['button_change_psw'])) {
        $username = $_SESSION['name_account'];
        $msv = $_SESSION['msv'];
        $old_psw = mysqli_real_escape_string($db, $_POST['old_psw']);
        $new_psw = mysqli_real_escape_string($db, $_POST['new_psw']);
        $cf_new_psw = mysqli_real_escape_string($db, $_POST['cf_new_psw']);
        if(($old_psw == $_SESSION['password']) && ($new_psw == $cf_new_psw)) {
            $_SESSION['password'] = $new_psw;
            $sql_update_psw = "UPDATE user SET password_user='$new_psw' WHERE username='$username'";
            $result30 = mysqli_query($db, $sql_update_psw);
            $content = "Bạn đã cập nhật mật khẩu mới";
            $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
            $result51 = mysqli_query($db, $lichsu);
        }
        header("location: profile.php");
    }
    if(isset($_POST['view_info_friend'])) {
        $msv = $_SESSION['msv'];
        $hoten = mysqli_real_escape_string($db, $_POST['name_friend']);
        $content = "Bạn đã ghé thăm trang cá nhân của " .$hoten;
        $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
        $result52 = mysqli_query($db, $lichsu);
        $_SESSION['username_friend'] = $hoten;
        $sql_info_friend = "SELECT * FROM cuusinhvien WHERE hoten='$hoten'";
        $result = mysqli_query($db, $sql_info_friend);
        if(mysqli_num_rows($result) == 1) {
            $arr_info_friend = mysqli_fetch_array($result);
            $_SESSION['anh_friend'] = $arr_info_friend['anh'];
            $_SESSION['username_friend'] = $arr_info_friend['hoten'];
            $_SESSION['gioitinh_friend'] = $arr_info_friend['gioitinh'];
            $_SESSION['msv_friend'] = $arr_info_friend['idcuusinhvien'];
            $_SESSION['ngaysinh_friend'] = $arr_info_friend['ngaysinh'];
            $_SESSION['sdt_friend'] = $arr_info_friend['sdt'];
            $_SESSION['email_friend'] = $arr_info_friend['email'];
            $_SESSION['gioithieu_friend'] = $arr_info_friend['gioithieu'];
            $idquequan = $arr_info_friend['idquequan'];
            $sql_info_home = "SELECT tenquequan FROM quequan WHERE idquequan='$idquequan'";
            $result31 = mysqli_query($db, $sql_info_home);
            $_SESSION['quequan_friend'] = mysqli_fetch_array($result31)['tenquequan'];
            $iddiachi = $arr_info_friend['iddiachi'];
            $sql_info_address = "SELECT tendiachi FROM diachi WHERE iddiachi='$iddiachi'";
            $result32 = mysqli_query($db, $sql_info_address);
            $_SESSION['diachi_friend'] = mysqli_fetch_array($result32)['tendiachi'];
            $msv_friend = $_SESSION['msv_friend'];
            $sql_info_account = "SELECT * FROM user WHERE idcuusinhvien='$msv_friend'";
            $result32 = mysqli_query($db, $sql_info_account);
            $arr_info_account = mysqli_fetch_array($result32);
            $_SESSION['name_account_friend'] = md5($arr_info_account['username']);
            $_SESSION['ngaytao_friend'] = $arr_info_account['ngaytao'];
            $_SESSION['dangnhapgannhat_friend'] = $arr_info_account['dangnhapgannhat'];
            $sql_info_business = "SELECT ct.thoigian thoigian_friend, cq.tencoquan tencoquan_friend, cq.loaihinh loaihinh_friend,
            cq.email_cpn email_cpn_friend, dc.tendiachi tendiachi_friend FROM
            congtac ct JOIN coquan cq ON ct.idcoquan=cq.idcoquan JOIN diachi dc ON cq.iddiachi=dc.iddiachi WHERE ct.idcuusinhvien='$msv_friend'";
            $result33 = mysqli_query($db, $sql_info_business);
            $arr_info_business = mysqli_fetch_array($result33);
            $_SESSION['batdau_friend'] = $arr_info_business['thoigian_friend'];
            $_SESSION['congty_friend'] = $arr_info_business['tencoquan_friend'];
            $_SESSION['email_cpn_friend'] = $arr_info_business['email_cpn_friend'];
            $_SESSION['loaihinh_friend'] = $arr_info_business['loaihinh_friend'];
            $_SESSION['diachi_cpn_friend'] = $arr_info_business['tendiachi_friend'];
        }
        header("location: profile_friend.php");
    }
    if(isset($_GET['detail_post'])) {
        $idbaidang = $_GET['detail_post'];
        $_SESSION['idbaidang'] = $idbaidang;
        $sql_info_post = "SELECT * FROM baidang WHERE idbaidang='$idbaidang'";
        $result34 = mysqli_query($db, $sql_info_post);
        $arr_info_post = mysqli_fetch_array($result34);
        $sql_count_cmt = "SELECT count(*) count_cmt FROM binhluan WHERE idbaidang='$idbaidang'";
        $result35 = mysqli_query($db, $sql_count_cmt);
        $_SESSION['cmt_baidang'] = mysqli_fetch_array($result35)['count_cmt'];
        $_SESSION['hinhanh'] = $arr_info_post['hinhanh'];
        $_SESSION['thoigian_dangbai'] = $arr_info_post['thoigian'];
        $_SESSION['tieude'] = $arr_info_post['tieude'];
        $_SESSION['noidung'] = $arr_info_post['noidung'];
        header("location: post.php");
    }
    if(isset($_POST['submit_comment'])) {
        $comment = mysqli_real_escape_string($db, $_POST['comment']);
        $idbaidang = $_SESSION['idbaidang'];
        $msv = $_SESSION['msv'];
        if($comment != '') {
            $sql_insert_cmt = "INSERT INTO binhluan(comment, idbaidang, idcuusinhvien) VALUES ('$comment', '$idbaidang', '$msv')";
            $result36 = mysqli_query($db, $sql_insert_cmt);
            $new_id_cmt = mysqli_insert_id($db);
            $new_like_cmt = "like_cmt" .$new_id_cmt;
            $new_dislike_cmt = "dislike_cmt" .$new_id_cmt;
            $sql_alter_like_cmt = "ALTER TABLE like_cmt ADD $new_like_cmt TINYINT NOT NULL DEFAULT '0',
            ADD $new_dislike_cmt TINYINT NOT NULL DEFAULT '0'";
            $result38 = mysqli_query($db, $sql_alter_like_cmt);
            $_SESSION['cmt_baidang'] += 1;
            $chu_post = "SELECT csv.idcuusinhvien msv_csv, csv.hoten hoten_csv, bd.tieude tieude_post FROM cuusinhvien csv JOIN baidang bd ON
            csv.idcuusinhvien=bd.idcuusinhvien WHERE bd.idbaidang='$idbaidang'";
            $result54 = mysqli_query($db, $chu_post);
            $info_post = mysqli_fetch_array($result54);
            $ten_chu_post = $info_post['hoten_csv'];
            $msv_chu_post = $info_post['msv_csv'];
            $tieude_post = $info_post['tieude_post'];
            if($msv == $msv_chu_post) {
                $content = "Bạn đã bình luận vào bài viết " .$tieude_post. " của bạn";
            }
            else {
                $content = "Bạn đã bình luận vào bài viết " .$tieude_post. " của " .$ten_chu_post;
                $message = $_SESSION['username']. " đã bình luận vào bài viết " .$tieude_post. " của bạn";
                $thongbao = "INSERT INTO thongbao(idcuusinhvien, idbaidang, noidung) VALUES ('$msv_chu_post', '$idbaidang', '$message')";
                $result59 = mysqli_query($db, $thongbao);
            }
            $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
            $result55 = mysqli_query($db, $lichsu);
            // header("location: post.php");
        }
    }
    if(isset($_POST['submit_rep_cmt'])) {
        $tieude_baidang = $_SESSION['tieude'];
        $idbaidang = $_SESSION['idbaidang'];
        $idbinhluan = $_POST['idbinhluan'];
        $rep_cmt = $_POST['rep_comment'];
        $msv = $_SESSION['msv'];
        if($rep_cmt != '') {
            $sql_insert_rep_cmt = "INSERT INTO traloi(idbinhluan, rep_cmt, idcuusinhvien) VALUES ('$idbinhluan', '$rep_cmt', '$msv')";
            $result37 = mysqli_query($db, $sql_insert_rep_cmt);
            $new_id_rep_cmt = mysqli_insert_id($db);
            $new_like_rep_cmt = "like_rep_cmt" .$new_id_rep_cmt;
            $new_dislike_rep_cmt = "dislike_rep_cmt" .$new_id_rep_cmt;
            $sql_alter_like_rep_cmt = "ALTER TABLE like_rep_cmt ADD $new_like_rep_cmt TINYINT NOT NULL DEFAULT '0',
            ADD $new_dislike_rep_cmt TINYINT NOT NULL DEFAULT '0'";
            $result39 = mysqli_query($db, $sql_alter_like_rep_cmt);
            $chu_cmt = "SELECT csv.hoten hoten_cmt, csv.idcuusinhvien msv_csv FROM cuusinhvien csv JOIN binhluan bl ON csv.idcuusinhvien=bl.idcuusinhvien
            WHERE bl.idbinhluan='$idbinhluan'";
            $result56 = mysqli_query($db, $chu_cmt);
            $info_chu_cmt = mysqli_fetch_array($result56);
            $ten_chu_cmt = $info_chu_cmt['hoten_cmt'];
            $msv_chu_cmt = $info_chu_cmt['msv_csv'];
            if($msv_chu_cmt == $msv) {
                $content = "Bạn đã trả lời 1 bình luận về bài viết " .$tieude_baidang. " trong bình luận của bạn";
                $sql_info_rep = "SELECT DISTINCT idcuusinhvien FROM traloi WHERE idbinhluan='$idbinhluan' AND idcuusinhvien!='$msv'";
                $result61 = mysqli_query($db, $sql_info_rep);
                if(mysqli_num_rows($result61) > 0) {
                    while($row=mysqli_fetch_assoc($result61)) {
                        $msv_nhan_tb = $row['idcuusinhvien'];
                        $message = $_SESSION['username']. " đã trả lời 1 bình luận trong bình luận của anh ấy ở bài viết " .$tieude_baidang;
                        $thongbao = "INSERT INTO thongbao(idcuusinhvien, idbaidang, noidung) VALUES ('$msv_nhan_tb', '$idbaidang', '$message')";
                        $result62 = mysqli_query($db, $thongbao);
                    }
                }
            }
            if($msv_chu_cmt != $msv) {
                $content = "Bạn đã trả lời bình luận của " .$ten_chu_cmt. " trong bài viết " .$tieude_baidang;
                $sql_info_rep1 = "SELECT DISTINCT idcuusinhvien FROM traloi WHERE idbinhluan='$idbinhluan' AND idcuusinhvien!='$msv' AND idcuusinhvien!='$msv_chu_cmt'";
                $result63 = mysqli_query($db, $sql_info_rep1);
                if(mysqli_num_rows($result63) > 0) {
                    while($row=mysqli_fetch_assoc($result63)) {
                        $msv_nhan_tb = $row['idcuusinhvien'];
                        $message = $_SESSION['username']. " đã trả lời 1 bình luận trong bình luận của " .$ten_chu_cmt. " ở bài viết " .$tieude_baidang;
                        $thongbao = "INSERT INTO thongbao(idcuusinhvien, idbaidang, noidung) VALUES ('$msv_nhan_tb', '$idbaidang', '$message')";
                        $result64 = mysqli_query($db, $thongbao);
                    }     
                }
                $message = $_SESSION['username']. " đã trả lời bình luận của bạn trong bài viết " .$tieude_baidang;
                $thongbao = "INSERT INTO thongbao(idcuusinhvien, idbaidang, noidung) VALUES ('$msv_chu_cmt', '$idbaidang', '$message')";
                $result60 = mysqli_query($db, $thongbao);
            }
            $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
            $result57 = mysqli_query($db, $lichsu);
            //header("location: post.php");
        }
    }
    if(isset($_POST['button_add_post'])) {
        $msv = $_SESSION['msv'];
        $tieude = $_POST['title_post'];
        $noidung = $_POST['content_post'];
        if(isset($_FILES['image_post'])) {
            if($_FILES['image_post']['error'] == 0) {
                $target = "image/" .basename($_FILES['image_post']['name']);
                $hinhanh = $_FILES['image_post']['name'];
                if($tieude != '' && $noidung != '') {
                    $sql_add_new_post = "INSERT INTO baidang(tieude, noidung, hinhanh, idcuusinhvien) VALUES ('$tieude', '$noidung', '$hinhanh', '$msv')";
                    $result40 = mysqli_query($db, $sql_add_new_post);
                    $new_id_baidang = mysqli_insert_id($db);
                    $new_like_baidang = "like_baidang" .$new_id_baidang;
                    $new_dislike_baidang = "dis" .$new_like_baidang;
                    $sql_alter_like_baidang = "ALTER TABLE like_baidang ADD $new_like_baidang TINYINT NOT NULL DEFAULT '0',
                    ADD $new_dislike_baidang TINYINT NOT NULL DEFAULT '0'";
                    $result41 = mysqli_query($db, $sql_alter_like_baidang);
                    if(move_uploaded_file($_FILES['image_post']['tmp_name'], $target)) {
                        echo "<script>alert('Đăng bài thành công');</script>";
                        $content = "Bạn đã đăng bài 1 bài mới";
                        $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
                        $result58 = mysqli_query($db, $lichsu);
                    }
                }
            }
        }
    }
    if(isset($_GET['detail_friend'])) {
        $msv = $_SESSION['msv'];
        $hoten = mysqli_real_escape_string($db, $_GET['detail_friend']);
        $content = "Bạn đã ghé thăm trang cá nhân của " .$hoten;
        $lichsu = "INSERT INTO lichsu(idcuusinhvien, noidung) VALUES ('$msv', '$content')";
        $result53 = mysqli_query($db, $lichsu);
        $_SESSION['username_friend'] = $hoten;
        $sql_info_friend = "SELECT * FROM cuusinhvien WHERE hoten='$hoten'";
        $result = mysqli_query($db, $sql_info_friend);
        if(mysqli_num_rows($result) == 1) {
            $arr_info_friend = mysqli_fetch_array($result);
            $_SESSION['anh_friend'] = $arr_info_friend['anh'];
            $_SESSION['username_friend'] = $arr_info_friend['hoten'];
            $_SESSION['gioitinh_friend'] = $arr_info_friend['gioitinh'];
            $_SESSION['msv_friend'] = $arr_info_friend['idcuusinhvien'];
            $_SESSION['ngaysinh_friend'] = $arr_info_friend['ngaysinh'];
            $_SESSION['sdt_friend'] = $arr_info_friend['sdt'];
            $_SESSION['email_friend'] = $arr_info_friend['email'];
            $_SESSION['gioithieu_friend'] = $arr_info_friend['gioithieu'];
            $idquequan = $arr_info_friend['idquequan'];
            $sql_info_home = "SELECT tenquequan FROM quequan WHERE idquequan='$idquequan'";
            $result31 = mysqli_query($db, $sql_info_home);
            $_SESSION['quequan_friend'] = mysqli_fetch_array($result31)['tenquequan'];
            $iddiachi = $arr_info_friend['iddiachi'];
            $sql_info_address = "SELECT tendiachi FROM diachi WHERE iddiachi='$iddiachi'";
            $result32 = mysqli_query($db, $sql_info_address);
            $_SESSION['diachi_friend'] = mysqli_fetch_array($result32)['tendiachi'];
            $msv_friend = $_SESSION['msv_friend'];
            $sql_info_account = "SELECT * FROM user WHERE idcuusinhvien='$msv_friend'";
            $result32 = mysqli_query($db, $sql_info_account);
            $arr_info_account = mysqli_fetch_array($result32);
            $_SESSION['name_account_friend'] = md5($arr_info_account['username']);
            $_SESSION['ngaytao_friend'] = $arr_info_account['ngaytao'];
            $_SESSION['dangnhapgannhat_friend'] = $arr_info_account['dangnhapgannhat'];
            $sql_info_business = "SELECT ct.thoigian thoigian_friend, cq.tencoquan tencoquan_friend, cq.loaihinh loaihinh_friend,
            cq.email_cpn email_cpn_friend, dc.tendiachi tendiachi_friend FROM
            congtac ct JOIN coquan cq ON ct.idcoquan=cq.idcoquan JOIN diachi dc ON cq.iddiachi=dc.iddiachi WHERE ct.idcuusinhvien='$msv_friend'";
            $result33 = mysqli_query($db, $sql_info_business);
            $arr_info_business = mysqli_fetch_array($result33);
            $_SESSION['batdau_friend'] = $arr_info_business['thoigian_friend'];
            $_SESSION['congty_friend'] = $arr_info_business['tencoquan_friend'];
            $_SESSION['email_cpn_friend'] = $arr_info_business['email_cpn_friend'];
            $_SESSION['loaihinh_friend'] = $arr_info_business['loaihinh_friend'];
            $_SESSION['diachi_cpn_friend'] = $arr_info_business['tendiachi_friend'];
        }
        header("location: profile_friend.php");
    }
    if(isset($_GET['view_thongbao'])) {
        $noidung_tb = mysqli_real_escape_string($db, $_GET['view_thongbao']);
        $sql_info_tb = "SELECT DISTINCT idbaidang FROM thongbao WHERE noidung='$noidung_tb'";
        $result65 = mysqli_query($db, $sql_info_tb);
        $arr_info_tb = mysqli_fetch_array($result65);
        $idbaidang = $arr_info_tb['idbaidang'];
        if($idbaidang != '') {
            $sql_info_csv = "SELECT csv.idcuusinhvien msv_csv, csv.hoten hoten_csv, csv.anh anh_csv FROM cuusinhvien csv JOIN baidang bd ON
            csv.idcuusinhvien=bd.idcuusinhvien WHERE bd.idbaidang='$idbaidang'";
            $result66 = mysqli_query($db, $sql_info_csv);
            $arr_info_csv = mysqli_fetch_array($result66);
            $msv_csv = $arr_info_csv['msv_csv'];
            if($msv_csv == $_SESSION['msv']) {
                $sql_info_baidang = "SELECT * FROM baidang WHERE idbaidang='$idbaidang'";
                $result67 = mysqli_query($db, $sql_info_baidang);
                $arr_info_baidang = mysqli_fetch_array($result67);
                $_SESSION['idbaidang'] = $idbaidang;
                $_SESSION['tieude'] = $arr_info_baidang['tieude'];
                $_SESSION['noidung'] = $arr_info_baidang['noidung'];
                $_SESSION['hinhanh'] = $arr_info_baidang['hinhanh'];
                $_SESSION['thoigian_dangbai'] = $arr_info_baidang['thoigian'];
                $sql_count_cmt = "SELECT count(*) count_cmt FROM binhluan WHERE idbaidang='$idbaidang'";
                $result68 = mysqli_query($db, $sql_count_cmt);
                $_SESSION['cmt_baidang'] = mysqli_fetch_array($result68)['count_cmt'];
                header("location: post.php");
            }
            else {
                $_SESSION['username_friend'] = $arr_info_csv['hoten_csv'];
                $_SESSION['anh_friend'] = $arr_info_csv['anh_csv'];
                $_SESSION['idbaidang'] = $idbaidang;
                $sql_info_baidang = "SELECT * FROM baidang WHERE idbaidang='$idbaidang'";
                $result69 = mysqli_query($db, $sql_info_baidang);
                $arr_info_baidang = mysqli_fetch_array($result69);
                $_SESSION['tieude'] = $arr_info_baidang['tieude'];
                $_SESSION['noidung'] = $arr_info_baidang['noidung'];
                $_SESSION['hinhanh'] = $arr_info_baidang['hinhanh'];
                $_SESSION['thoigian_dangbai'] = $arr_info_baidang['thoigian'];
                $sql_count_cmt = "SELECT count(*) count_cmt FROM binhluan WHERE idbaidang='$idbaidang'";
                $result70 = mysqli_query($db, $sql_count_cmt);
                $_SESSION['cmt_baidang'] = mysqli_fetch_array($result70)['count_cmt'];
                header("location: post_friend.php");
            }
        }
    }
    if(isset($_GET['logout'])) {
        $urn_sign_in = $_SESSION['name_account'];
        $sql_update_time = "UPDATE user SET dangnhapgannhat = NOW() WHERE username = '$urn_sign_in'";
        $result5 = mysqli_query($db, $sql_update_time);
        if(isset($_SESSION['msv'])) {
            if($_SESSION['role_user'] != "admin") {
                $sql_update_online = "UPDATE cuusinhvien SET online='0' WHERE idcuusinhvien='$urn_sign_in'";
                $result44 = mysqli_query($db, $sql_update_online);
            }
            else {
                $sql_update_online = "UPDATE cuusinhvien SET online='0' WHERE idcuusinhvien='2018'";
                $result44 = mysqli_query($db, $sql_update_online);
            }
        }
        session_unset();
        session_destroy();
        mysqli_close($db);
        header("location: login.php");
    }
?>