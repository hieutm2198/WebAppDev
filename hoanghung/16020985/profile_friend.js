function info_user() {
    document.getElementById("introduce_title").innerHTML = 'QUẢN LÝ TÀI KHOẢN';
    document.getElementById("introduce").style.display = 'block';
    document.getElementById("post_user").style.display = 'none';
    $("#link_post").removeClass("active");
    $("#link_introduce").addClass("active");
}
function info_list_post() {
    document.getElementById("introduce_title").innerHTML = 'DANH SÁCH BÀI ĐĂNG';
    document.getElementById("post_user").style.display = 'block';
    document.getElementById("introduce").style.display = 'none';
    $("#link_introduce").removeClass("active");
    $("#link_post").addClass("active");
}