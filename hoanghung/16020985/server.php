<?php
    session_start();
    $urn_sign_up = "";
    $psw_sign_up = "";
    $cf_psw_sign_up = "";
    $error = array();
    $db = mysqli_connect("localhost", "hvhung", "hoangviethung", "quanlycuusv");
    if(isset($_POST['register'])) {
        $urn_sign_up = mysqli_real_escape_string($db, $_POST['urn_sign_up']);
        $psw_sign_up = mysqli_real_escape_string($db, $_POST['psw_sign_up']);
        $cf_psw_sign_up = mysqli_real_escape_string($db, $_POST['cf_psw_sign_up']);
        $check_sign_up = "SELECT * FROM user WHERE username = '$urn_sign_up'";
        if(($psw_sign_up == $cf_psw_sign_up) && (preg_match('/^[a-zA-Z0-9]{5,}$/', $urn_sign_up))) {
            $psw_sign_up = md5($psw_sign_up);
            $sql = "INSERT INTO user(username, password_user) VALUES ('$urn_sign_up', '$psw_sign_up')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $urn_sign_up;
            header("location: error.php");
        }
    }
    if(isset($_POST['button_login'])) {
        $urn_sign_in = mysqli_real_escape_string($db, $_POST['urn_login']);
        $psw_sign_in = mysqli_real_escape_string($db, $_POST['psw_login']);
        $psw_sign_in = md5($psw_sign_in);
        $query = "SELECT * FROM user WHERE username = '$urn_sign_in' AND password_user = '$psw_sign_in'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $urn_sign_in;
            header("location: C001.php");
        }
        else {
            array_push($error, "Username or Password is incorrect");
        }
    }
?>