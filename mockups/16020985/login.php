<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Login css -->
    <link rel="stylesheet" href="login.css" type="text/css">
    <!-- Login js -->
    <script src="login.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- Awesome Icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
        crossorigin="anonymous">
    <!-- Google Font -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <!-- Google Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div id="layout">
        <div id="login_header">
            WEBSITE QUẢN LÝ CỰU SINH VIÊN
        </div>
        <div id="login_content">
            <form method="post" onsubmit="return(displayError());">
                <div id="login">SIGN IN</div>
                <div class="input-group">
                    <input type="text" name="urn_login" placeholder="Username" 
                    onfocus="document.getElementById('error_sign_in').style.display = 'none'; hiddenError_User();">
                    <div class="input-group-append">
                        <div class="input-group-text error_login">Username is required</div>
                        <span id="user_login_warn" class="input-group-text icon_warn"><i class="fas fa-exclamation"></i></span>
                        <span id="user_login_icon" class="input-group-text icon_login"><i class="fa fa-user"></i></span>
                    </div>
                </div>
                <div class="input-group">
                    <input type="password" name="psw_login" placeholder="Password" 
                    onfocus="document.getElementById('error_sign_in').style.display = 'none'; hiddenError_Psw();">
                    <div class="input-group-append">
                        <div class="input-group-text error_login">Password is required</div>
                        <span id="psw_login_warn" class="input-group-text icon_warn"><i class="fas fa-exclamation"></i></span>
                        <span id="psw_login_icon" class="input-group-text icon_login"><i class="fa fa-unlock"></i></span>
                    </div>
                </div>
                <div id="error_sign_in">
                    <?php
                        if(count($error) > 0) {
                            foreach($error as $error) {
                                echo "<i class='fas fa-exclamation'> " .$error. "</i>";
                            }
                        }
                    ?>  
                </div>
                
                <button type="submit" name="button_login" id="button_login">Login</button>
                <p><span>New To Website? </span><a href="#" onclick="document.getElementById('subscribe').style.display='block';">Create
                        an account.</a></p>
            </form>
        </div>
        <div id="login_footer">
            <p>&copy; 2018 Website Quản Lý Cựu Sinh Viên | Design By Porn Hub Team</p>
        </div>
    </div>
    <div id="subscribe">
        <form method="post" action="#" id="form_sign_up" style="height: 510px">
            <div id="sign_up"><span style="visibility: hidden">SIGN UP</span></div>
            <div id="bg_sign_up"></div>
            <div id="font_sign_up">SIGN UP</div>
            <div class="input-group" style="position: relative; top: -190px;">
                <input type="text" onkeyup="Urn_SignUp_Error()" name="urn_sign_up" placeholder="Username" required>
                <div class="input-group-append">
                    <span class="input-group-text icon_sign_up"><i class="fa fa-user"></i></span>
                </div>
            </div>
            <div class="input-group" style="position: relative; top: -180px;">
                <input type="password" onkeyup="Error_Psw_SignUp()" name="psw_sign_up" placeholder="Password" required>
                <div class="input-group-append">
                    <span class="input-group-text icon_sign_up"><i class="fa fa-unlock"></i></span>
                </div>
            </div>
            <div class="input-group" style="position: relative; top: -170px;">
                <input type="password" onkeyup="Psw_SignUp_Error()" name="cf_psw_sign_up" placeholder="Confirm Password" required>
                <div class="input-group-append">
                    <span class="input-group-text icon_sign_up"><i class="fa fa-unlock"></i></span>
                </div>
            </div>
            <div id="error_sign_up">
                <i class="fas fa-check" id="status_user" 
                style="font-size: 16px; color: green; position: relative; right: 0%; top: -50px; visibility: hidden;"></i><br>
                <i class="fas fa-check" id="status_psw" 
                style="font-size: 16px; color: green; position: relative; right: 0%; top: -40px; visibility: hidden;"></i><br>
                <i class="fas fa-exclamation" id="fail_user" 
                style="font-size: 16px; color: red; position: relative; right: 0%; top: -85px; visibility: hidden;"></i><br>
                <i class="fas fa-exclamation" id="fail_psw" 
                style="font-size: 16px; color: red; position: relative; right: 0%; top: -80px; visibility: hidden;"></i><br>
            </div>
            <button type="button" id="cancel_sign_up" style="position: relative; top: -200px;" onclick="document.getElementById('subscribe').style.display='none';">Cancel</button>
            <button type="submit" name="register" id="submit_sign_up" style="position: relative; top: -200px;">Sign Up</button>
    </div>
    <script>
    function displayError() {
        var check_fail = 0;
        var username = document.getElementsByTagName("input")[0].value;
        var password = document.getElementsByTagName("input")[1].value;
        if (username == '') {
            document.getElementById("user_login_icon").style.visibility = 'hidden';
            document.getElementById("user_login_warn").style.visibility = 'visible';
            check_fail = 1;
        }
        if (password == '') {
            document.getElementById("psw_login_icon").style.visibility = 'hidden';
            document.getElementById("psw_login_warn").style.visibility = 'visible';
            check_fail = 1;
        }
        $(document).ready(function () {
            $("#user_login_warn").mouseenter(function () {
                document.getElementsByClassName("error_login")[0].style.visibility = 'visible';
            })
            $("#user_login_warn").mouseleave(function () {
                document.getElementsByClassName("error_login")[0].style.visibility = 'hidden';
            })
            $("#psw_login_warn").mouseenter(function () {
                document.getElementsByClassName("error_login")[1].style.visibility = 'visible';
            })
            $("#psw_login_warn").mouseleave(function () {
                document.getElementsByClassName("error_login")[1].style.visibility = 'hidden';
            })
        })
        if(check_fail == 1) {
            return false;
        }
        return true;
    }
    </script>
}
</body>

</html>