<?php
    session_start();
    $urn_sign_up = "";
    $psw_sign_up = "";
    $cf_psw_sign_up = "";
    $error = array();
    $db = mysqli_connect("localhost", "hvhung", "hoangviethung", "quanlycuusv");
	mysqli_set_charset($db, "utf8");
    if(isset($_POST['register'])) {
        $urn_sign_up = mysqli_real_escape_string($db, $_POST['urn_sign_up']);
        $psw_sign_up = mysqli_real_escape_string($db, $_POST['psw_sign_up']);
        $cf_psw_sign_up = mysqli_real_escape_string($db, $_POST['cf_psw_sign_up']);
        if(($psw_sign_up == $cf_psw_sign_up) && (preg_match('/^[a-zA-Z0-9]{5,}$/', $urn_sign_up))) {
            $sql = "INSERT INTO user(username, password_user) VALUES ('$urn_sign_up', '$psw_sign_up')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $urn_sign_up;
            header("location: error.php");
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
                $_SESSION['username'] = $arr_info_signin['username'];
                $_SESSION['password'] = $arr_info_signin['password_user']; 
                $_SESSION['check_user'] = 1;
            }
            else {
                session_unset();
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

            }
            $_SESSION['name_account'] = $arr_info_signin['username'];
            $_SESSION['ngaytao'] = $arr_info_signin['ngaytao'];
            $_SESSION['dangnhapgannhat'] = $arr_info_signin['dangnhapgannhat'];
            $_SESSION['status'] = "You are logged in";
            header("location: C001.php");
        }
        else {
            array_push($error, "Username or Password is incorrect");
        }
    }
    if(isset($_GET['profile'])) {
        header("location: profile.php");
    }
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
                }
            }
        }
        if(!empty($_POST['name_user'])) {
            $_SESSION['username'] = mysqli_real_escape_string($db, $_POST['name_user']);
            
        }
        if(!empty($_POST['bd_user'])) {
            $_SESSION['ngaysinh'] = mysqli_real_escape_string($db, $_POST['bd_user']);
        }
        $_SESSION['gioitinh'] = mysqli_real_escape_string($db, $_POST['gender_user']);
        if(!empty($_POST['home_user']) && ($_POST['home_user'] != $_SESSION['quequan'])) {
            $_SESSION['quequan'] = mysqli_real_escape_string($db, $_POST['home_user']);
            $quequan = $_SESSION['quequan'];
            $sql_check_quequan = "SELECT * FROM quequan WHERE tenquequan='$quequan'";
            $result11 = mysqli_query($db, $sql_check_quequan);
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
        if(!empty($_POST['pn_user'])) {
            $_SESSION['sdt'] = mysqli_real_escape_string($db, $_POST['pn_user']);
        }
        if(filter_var($_POST['email_user'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email'] = mysqli_real_escape_string($db, $_POST['email_user']);
        }
        if(!empty($_POST['dc_user'])) {
            $_SESSION['gioithieu'] = mysqli_real_escape_string($db, $_POST['dc_user']);
        }
        if(!empty($_POST['adr_user']) && ($_POST['adr_user'] != $_SESSION['diachi'])) {
            $_SESSION['diachi'] = mysqli_real_escape_string($db, $_POST['adr_user']);
            $diachi = $_SESSION['diachi'];
            $sql_check_diachi = "SELECT * FROM diachi WHERE tendiachi='$diachi'";
            $result16 = mysqli_query($db, $sql_check_diachi);
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
        if(!empty($_POST['time_study'])) {
            $_SESSION['nienkhoa'] = mysqli_real_escape_string($db, $_POST['time_study']);
        }
        if(!empty($_POST['class_user'])) {
            $_SESSION['lopquanly'] = mysqli_real_escape_string($db, $_POST['class_user']);
        }
        if(!empty($_POST['field_user'])) {
            $_SESSION['nganhhoc'] = mysqli_real_escape_string($db, $_POST['field_user']);
        }
        $_SESSION['chuongtrinhdaotao'] = mysqli_real_escape_string($db, $_POST['type_study']);
        $hoten = $_SESSION['username'];
        $ngaysinh = $_SESSION['ngaysinh'];
        $gioitinh = $_SESSION['gioitinh'];
        $sdt = $_SESSION['sdt'];
        $email = $_SESSION['email'];
        $gioithieu = $_SESSION['gioithieu'];
        $sql_update_user = "UPDATE cuusinhvien SET hoten='$hoten', ngaysinh='$ngaysinh', gioitinh='$gioitinh', sdt='$sdt', email='$email', gioithieu='$gioithieu' WHERE idcuusinhvien='$msv'";
        $result10 = mysqli_query($db, $sql_update_user);
        $nienkhoa = $_SESSION['nienkhoa'];
        $lopquanly = $_SESSION['lopquanly'];
        $sql_find_idnamhoc = "SELECT * FROM namhoc WHERE nienkhoa='$nienkhoa' AND lopquanly='$lopquanly'";
        $result21 = mysqli_query($db, $sql_find_idnamhoc);
        $new_idnamhoc = mysqli_fetch_array($result21)['idnamhoc'];
        $sql_update_idnamhoc = "UPDATE cuusinhvien SET idnamhoc='$new_idnamhoc' WHERE idcuusinhvien='$msv'";
        $result22 = mysqli_query($db, $sql_update_idnamhoc);
        if((!empty($_POST['name_company'])) && (filter_var($_POST['email_company'], FILTER_VALIDATE_EMAIL)) && (!empty($_POST['adr_company']))) {
            $_SESSION['congty'] = mysqli_real_escape_string($db, $_POST['name_company']);
            $_SESSION['email_cpn'] = mysqli_real_escape_string($db, $_POST['email_company']);
            $_SESSION['diachi_cpn'] = mysqli_real_escape_string($db, $_POST['adr_company']);
            $_SESSION['loaihinh'] = mysqli_real_escape_string($db, $_POST['type_company']);
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
        if(!empty($_POST['time_start'])) {
            $_SESSION['batdau'] = mysqli_real_escape_string($db, $_POST['time_start']);
        }
        if(!empty($_POST['position_user'])) {
            $_SESSION['vitri'] = mysqli_real_escape_string($db, $_POST['position_user']);
        }
        if(!empty($_POST['salary_user'])) {
            $_SESSION['mucluong'] = mysqli_real_escape_string($db, $_POST['salary_user']);
        }
        $batdau = $_SESSION['batdau'];
        $vitri = $_SESSION['vitri'];
        $mucluong = $_SESSION['mucluong'];
        $sql_update_congtac = "UPDATE congtac SET thoigian='$batdau', vitri='$vitri', mucluong='$mucluong' WHERE idcuusinhvien='$msv'";
        $result29 = mysqli_query($db, $sql_update_congtac);
        header("location: profile.php");
    }
    if(isset($_GET['logout'])) {
        $urn_sign_in = $_SESSION['name_account'];
        $sql_update_time = "UPDATE user SET dangnhapgannhat = NOW() WHERE username = '$urn_sign_in'";
        $result5 = mysqli_query($db, $sql_update_time);
        session_unset();
        session_destroy();
        mysqli_close($db);
        header("location: login.php");
    }
    if(isset($_POST['button_change_psw'])) {
        $username = $_SESSION['name_account'];
        $old_psw = mysqli_real_escape_string($db, $_POST['old_psw']);
        $new_psw = mysqli_real_escape_string($db, $_POST['new_psw']);
        $cf_new_psw = mysqli_real_escape_string($db, $_POST['cf_new_psw']);
        if(($old_psw == $_SESSION['password']) && ($new_psw == $cf_new_psw)) {
            $_SESSION['password'] = $new_psw;
            $sql_update_psw = "UPDATE user SET password_user='$new_psw' WHERE username='$username'";
            $result30 = mysqli_query($db, $sql_update_psw);
        }
        header("location: profile.php");
    }
?>