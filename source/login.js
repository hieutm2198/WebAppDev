var check_psw = 0;
function hiddenError_User() {
    document.getElementById("user_login_icon").style.visibility = 'visible';
    document.getElementById("user_login_warn").style.visibility = 'hidden';
}
function hiddenError_Psw() {
    document.getElementById("psw_login_icon").style.visibility = 'visible';
    document.getElementById("psw_login_warn").style.visibility = 'hidden';
}
function Urn_SignUp_Error() {
    var username = document.getElementsByTagName("input")[2].value;
    
    if ((username.match(/^[a-zA-Z0-9]+$/) == null) && (username != '')){
        document.getElementById("fail_user").style.visibility = 'visible';
        document.getElementById("fail_user").innerHTML = " Username is invalid";
        document.getElementById("status_user").style.visibility = 'hidden';
    }
    if (username.match(/^[a-zA-Z0-9]+$/) != null) {
        document.getElementById("status_user").style.visibility = 'visible';
        document.getElementById("status_user").innerHTML = " Username is valid";
        document.getElementById("fail_user").style.visibility = 'hidden';
    }
    if (username == '') {
        document.getElementById("status_user").style.visibility = 'hidden';
        document.getElementById("fail_user").style.visibility = 'hidden';
    }
}
function Psw_SignUp_Error() {
    var password = document.getElementsByTagName("input")[3].value;
    var cf_password = document.getElementsByTagName("input")[4].value;
    if ((cf_password != password) && (cf_password != '')) {
        document.getElementById("fail_psw").style.visibility = 'visible';
        document.getElementById("fail_psw").innerHTML = " Two password is not match";
        document.getElementById("status_psw").style.visibility = 'hidden';
    }
    if(cf_password == password) {
        document.getElementById("status_psw").style.visibility = 'visible';
        document.getElementById("status_psw").innerHTML = " Two password is same";
        document.getElementById("fail_psw").style.visibility = 'hidden';
        check_psw = 1;
    }
    if(cf_password == '') {
        document.getElementById("status_psw").style.visibility = 'hidden';
        document.getElementById("fail_psw").style.visibility = 'hidden';
    }
}
function Error_Psw_SignUp() {
    var password = document.getElementsByTagName("input")[3].value;
    var cf_password = document.getElementsByTagName("input")[4].value;
    if ((password != cf_password) && (check_psw == 1)) {
        document.getElementById("fail_psw").style.visibility = 'visible';
        document.getElementById("fail_psw").innerHTML = " Two password is not match";
        document.getElementById("status_psw").style.visibility = 'hidden';
    }
    if ((password == cf_password) && (check_psw == 1)) {
        document.getElementById("status_psw").style.visibility = 'visible';
        document.getElementById("status_psw").innerHTML = " Two password is same";
        document.getElementById("fail_psw").style.visibility = 'hidden';
    }
    if((cf_password == '')) {
        document.getElementById("status_psw").style.visibility = 'hidden';
        document.getElementById("fail_psw").style.visibility = 'hidden';
    }
}

