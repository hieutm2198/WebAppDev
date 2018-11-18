<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>C001 - Dashboard (Normal user)</title>
        <!-- Bootstrap's dependcies -->
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/popper-1.14.3.js"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="js/bootstrap.js"></script>
        <!-- Roboto Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet"> 
        <!-- Awesome Icon -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
        <script src="js/C001.js"></script>
        <link rel="stylesheet" href="css/C001.css">
        <link rel="stylesheet" href="css/global.css">
    </head>
    <body>
        <?php
            if(isset($_SESSION['status'])) {
                echo "<script>";
                echo "alert('You are logged in');";
                echo "</script>";
                unset($_SESSION['status']);
            }
        ?>
        <?php include("navbar.php") ?>
        <div class="container-fluid">
            <div class="row">
            <?php
                    include("leftbar.php");
                ?>
                <div id="middle-content" class="col-6">
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-landmark mr-2"></i>
                                Lớp QH2016-I/CQ-C-D
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Hoàng Việt Hưng đã mở một thăm dò</h5>
                            <p class="card-text">Họp lớp nhân dịp đầu Xuân 2030.</p>
                            <p class="card-text"><small class="text-muted">3 ngày trước</small></p>
                            <a href="#" class="btn btn-outline-success">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-users mr-2"></i>
                                Sinh viên khóa K61
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Phòng Đào Tạo đã mở một khảo sát</h5>
                            <p class="card-text">Khảo sát về tỷ lệ sinh viên làm việc liên quan đến công tác giáo dục.</p>
                            <p class="card-text"><small class="text-muted">20/12/2029 (1 tháng trước)</small></p>
                            <a href="#" class="btn btn-outline-success">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-code mr-2"></i>
                                Sinh viên khoa CNTT
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Trần Văn Định đã trả lời bình luận của bạn</h5>
                            <p class="card-text">[RE#123][#189] Hôm nay có việc bận.</p>
                            <p class="card-text"><small class="text-muted">10 giờ trước</small></p>
                            <a href="#" class="btn btn-outline-success">Trả lời</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-landmark mr-2"></i>
                                Lớp QH2016-I/CQ-C-D
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Hoàng Việt Hưng đã mở một thăm dò</h5>
                            <p class="card-text">Họp lớp nhân dịp đầu Xuân 2030.</p>
                            <p class="card-text"><small class="text-muted">3 ngày trước</small></p>
                            <a href="#" class="btn btn-outline-success">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-users mr-2"></i>
                                Sinh viên khóa K61
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Phòng Đào Tạo đã mở một khảo sát</h5>
                            <p class="card-text">Khảo sát về tỷ lệ sinh viên làm việc liên quan đến công tác giáo dục.</p>
                            <p class="card-text"><small class="text-muted">20/12/2029 (1 tháng trước)</small></p>
                            <a href="#" class="btn btn-outline-success">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-code mr-2"></i>
                                Sinh viên khoa CNTT
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Trần Văn Định đã trả lời bình luận của bạn</h5>
                            <p class="card-text">[RE#123][#189] Hôm nay có việc bận.</p>
                            <p class="card-text"><small class="text-muted">10 giờ trước</small></p>
                            <a href="#" class="btn btn-outline-success">Trả lời</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-landmark mr-2"></i>
                                Lớp QH2016-I/CQ-C-D
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Hoàng Việt Hưng đã mở một thăm dò</h5>
                            <p class="card-text">Họp lớp nhân dịp đầu Xuân 2030.</p>
                            <p class="card-text"><small class="text-muted">3 ngày trước</small></p>
                            <a href="#" class="btn btn-outline-success">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-users mr-2"></i>
                                Sinh viên khóa K61
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Phòng Đào Tạo đã mở một khảo sát</h5>
                            <p class="card-text">Khảo sát về tỷ lệ sinh viên làm việc liên quan đến công tác giáo dục.</p>
                            <p class="card-text"><small class="text-muted">20/12/2029 (1 tháng trước)</small></p>
                            <a href="#" class="btn btn-outline-success">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-code mr-2"></i>
                                Sinh viên khoa CNTT
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Trần Văn Định đã trả lời bình luận của bạn</h5>
                            <p class="card-text">[RE#123][#189] Hôm nay có việc bận.</p>
                            <p class="card-text"><small class="text-muted">10 giờ trước</small></p>
                            <a href="#" class="btn btn-outline-success">Trả lời</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-landmark mr-2"></i>
                                Lớp QH2016-I/CQ-C-D
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Hoàng Việt Hưng đã mở một thăm dò</h5>
                            <p class="card-text">Họp lớp nhân dịp đầu Xuân 2030.</p>
                            <p class="card-text"><small class="text-muted">3 ngày trước</small></p>
                            <a href="#" class="btn btn-outline-success">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-users mr-2"></i>
                                Sinh viên khóa K61
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Phòng Đào Tạo đã mở một khảo sát</h5>
                            <p class="card-text">Khảo sát về tỷ lệ sinh viên làm việc liên quan đến công tác giáo dục.</p>
                            <p class="card-text"><small class="text-muted">20/12/2029 (1 tháng trước)</small></p>
                            <a href="#" class="btn btn-outline-success">Chi tiết</a>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <h5 class="card-header">
                                <i class="fas fa-code mr-2"></i>
                                Sinh viên khoa CNTT
                        </h5>
                        <div class="card-body">
                            <h5 class="card-title">Trần Văn Định đã trả lời bình luận của bạn</h5>
                            <p class="card-text">[RE#123][#189] Hôm nay có việc bận.</p>
                            <p class="card-text"><small class="text-muted">10 giờ trước</small></p>
                            <a href="#" class="btn btn-outline-success">Trả lời</a>
                        </div>
                    </div>
                </div>
                <?php
                    include("rightbar.php");
                ?>

            </div>
        </div>

    </body>
</html>
