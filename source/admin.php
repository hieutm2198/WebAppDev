<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<head>
    <meta charset="UTF-8">
    <title>Quản trị</title>
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
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tháng');
        data.addColumn('number', 'Số lượt truy cập');
        data.addColumn('number', 'Số lượng bài viết');
        data.addColumn('number', 'Số lượt tham gia khảo sát');
        data.addRows([
        ['1', 100, 50, 500],
        ['2', 200, 150, 300],
        ['3', 150, 60, 400],
        ['4', 300, 100, 100],
        ['5', 100, 100, 300],
        ['6', 500, 50, 400],
        ['7', 400, 200, 200],
        ['8', 100, 150, 150],
        ['9', 200, 30, 370],
        ['10', 300, 50, 333],
        ['11', 450, 40, 680],
        ['12', 230, 80, 300]
        
        ]);

        var options = {'title':'Biểu đồ tăng trưởng theo tháng', 'width':800, 'height':400, 'animation':{'duration': 1000, 'easing': 'out', 'startup': true}};

        var chart = new google.visualization.LineChart(document.getElementById('monthChart'));
        chart.draw(data, options);
    }

    </script>
    <link rel="stylesheet" href="admin.css">
    <script src="js/admin.js"></script>
</head>
<body>
    <?php include('nav.php'); ?>
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-3">
                <div class="list-group mt-3" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-overview-list" data-toggle="list" href="#list-overview" role="tab" aria-controls="overview">
                        <i class="fas fa-glasses mr-1"></i>
                        Tổng quan
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-user-list" data-toggle="list" href="#list-user" role="tab" aria-controls="user">
                        <i class="fas fa-users mr-1"></i>
                        Quản lý người dùng
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-survey-list" data-toggle="list" href="#list-survey" role="tab" aria-controls="survey">
                        <i class="fas fa-poll mr-1"></i>
                        Quản lý khảo sát
                    </a>
                </div>
            </div>
            <div class="col-9">
                    <div class="tab-content mt-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-overview" role="tabpanel" aria-labelledby="list-overview-list">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card text-white bg-secondary mx-3">
                                        <div class="card-header">
                                            Số lượng người dùng
                                        </div>
                                        <div class="card-body">
                                            <h5 id="count_user"></h5>
                                            <p id="count_user_online" class="card-text"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card text-white bg-success mx-3">
                                        <div class="card-header">
                                            Số lượng khảo sát
                                        </div>
                                        <div class="card-body">
                                            <h5 id="sl_khaosat"></h5>
                                            <p id="thamgia_khaosat" class="card-text"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card text-white bg-info mx-3">
                                        <div class="card-header">
                                            Số lượng bài đăng
                                        </div>
                                        <div class="card-body">
                                            <h5 id="sl_baidang"></h5>
                                            <p id="sl_cmt" class="card-text"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div id="monthChart"></div>
                        </div>
                        <div class="tab-pane fade" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
                            <div class="my-3 pb-3 border-bottom">
                                <button id="detailUserBtn" class="btn btn-info">
                                    Xem chi tiết
                                </button>
                                <button id="editUserBtn" class="btn">
                                    Chỉnh sửa
                                </button>
                                <button id="deleteUserBtn" class="btn btn-danger">
                                    <i class="fa fas-trash mr-1"></i>
                                    Xóa người dùng
                                </button>
<?php
    if($_SESSION['role_user'] == "admin") {
        echo '<button id="changeRole" class="btn btn-warning">Đặt/Xoá quyền quản trị</button>';
    }
?>
                                <button id="newUser" class="btn btn-success">
                                    Thêm người dùng
                                </button>
                            </div>
                            <table id="userTable" class="table table-sm table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            Tài khoản
                                        </th>
                                        <th>
                                            Mật khẩu
                                        </th>
                                        <th>
                                            Mã sinh viên
                                        </th>
                                        <th>
                                            Họ và tên
                                        </th>
                                        <th>
                                            Giới tính
                                        </th>
                                        <th>
                                            Ngày sinh
                                        </th>
                                        <th>
                                            Đăng nhập gần nhất
                                        </th>
                                        <th>
                                            Quyền
                                        </th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                        <div class="tab-pane fade" id="list-survey" role="tabpanel" aria-labelledby="list-survey-list">
                            <div class="my-3 pb-3 border-bottom">
                                <button id="detailSurveyBtn" class="btn btn-info mr-2">
                                    <i class="fas fa-chart-area"></i>
                                    Xem thống kê
                                </button>
                                <button id="editSurveyBtn" class="btn btn-grey mr-2">
                                    <i class="fas fa-pen mr-1"></i>
                                    Chỉnh sửa
                                </button>
                                <button id="deleteSurveyBtn" class="btn btn-danger mr-2">
                                    <i class="fas fa-trash mr-1"></i>
                                    Xóa khảo sát
                                </button>
                            </div>
                            <table id="surveyTable" class="table table-sm table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Mã khảo sát</th>
                                        <th>Tên khảo sát</th>
                                        <th>Mã người tạo</th>
                                        <th>Tên người tạo</th>
                                    </tr>
                                </thead>                               
                            </table>
                            
                        </div> 
                       
                    </div>
            </div>
        </div>
    </div>
    <div id="surveyDetailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="surveyDetailTitle"></h5>

                </div>
                <div class="modal-body">
                    <div>
                        <i class="fas fa-hashtag mr-1"></i>
                        <span id="surveyDetailId"></span>
                    </div>
                    <div>
                        <i class="fas fa-user-edit mr-1"></i>
                        <span id="surveyDetailCreatorName"></span> - <span id="surveyDetailCreatorId"></span>
                        <div id="surveyDetailQuestionList"></div>
                    </div>
                </div>
                <div class="modal-footer">
                
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $("#count_user").load("count_user.php").fadeIn();
                $("#count_user_online").load("count_user_online.php").fadeIn();
                $("#sl_khaosat").load("sl_khaosat.php").fadeIn();
                $("#thamgia_khaosat").load("thamgia_khaosat.php").fadeIn();
                $("#sl_baidang").load("sl_baidang.php").fadeIn();
                $("#sl_cmt").load("sl_cmt.php").fadeIn();
            }, 100);
        })
    </script>
</body>
</html>