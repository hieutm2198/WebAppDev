<?php 
    include("database.php");
   
    //TODO Kiểm tra quyền sở hữu
    if(isset($_GET['khaosat'])) {
        $MaKS = $_GET['khaosat'];    
    } else {
        header("location: 404.php");
    }    

    // Lấy ra thông tin bài khảo sát
    $sql = "select TieuDe from khaosat where MaKS = " . $MaKS . " and MaNguoiTao = " . $_SESSION['MaSV'] . ";";
    $result = $connection -> query($sql);
    $tieuDe = ($result -> fetch_assoc())['TieuDe'];
    if(!$tieuDe) {
        header("location: 404.php");
    }
    
    // Lấy ra danh sách các câu hỏi trong bài khảo sát
    $sql = "select * from khaosat join cauhoi on khaosat.MaKS = cauhoi.MaKS where khaosat.MaKS = " . $MaKS . ";";
    $result = $connection -> query($sql);
    $noiDungCauHoi = array();
    $maCauHoi = array();
    if($result -> num_rows > 0) {
        while($row = $result -> fetch_assoc()) {
            $noiDungCauHoi[] = $row['NoiDungCH'];
            $maCauHoi[] = $row['MaCH'];
        }
    }

    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>B009 - Survey detail</title>
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

        <script>
<?php
    echo 'var surveyId = ' . $_GET['khaosat'] . ';';
?>
        </script>
        <script src="js/B009.js"></script>
        
        <link rel="stylesheet" href="css/B009.css">
        <!-- Google chart -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
<?php
            
            $count = count($maCauHoi);
            for($i = 0; $i < $count; ++$i) {
                echo 'var data' . $maCauHoi[$i] . ' = new google.visualization.DataTable();';
                echo 'data' . $maCauHoi[$i] . '.addColumn("string", "Lựa chọn");';
                echo 'data' . $maCauHoi[$i] . '.addColumn("number", "Số lượng");';

                $danhSachLuaChon = array();                
                $danhSachMaLuaChon = array(); 
                $sql = "select * from (khaosat join cauhoi on khaosat.MaKS = cauhoi.MaKS) join luachon on cauhoi.MaCH = luachon.MaCH where cauhoi.MaCH = " . $maCauHoi[$i] . ";";
                $result = $connection -> query($sql);
                if($result -> num_rows > 0) {
                    while($row = $result -> fetch_assoc()) {
                        $danhSachLuaChon[] = $row['NoiDungLC'];   
                        $danhSachMaLuaChon[] = $row['MaLC'];   
                    }
                }

                

                echo 'data' . $maCauHoi[$i] . '.addRows([';
                for($j = 0; $j < count($danhSachLuaChon); ++$j) {
                    $sql = 'select count(traloicauhoi.MaLC) as SoNguoiLuaChon from (traloicauhoi join luachon on traloicauhoi.MaLC = luachon.MaLC) where traloicauhoi.MaLC = ' . $danhSachMaLuaChon[$j];
                    $result = $connection -> query($sql);
                    $row = $result -> fetch_assoc();
                    echo '["' . $danhSachLuaChon[$j] . '", ' . $row['SoNguoiLuaChon'] . ']';
                    if($j < count($danhSachLuaChon) - 1) {
                        echo ',';
                    }
                }
                echo ']);';
                echo 'var options ={"width": 400, "height": 300};';
                echo '
                    var chartPie' . $maCauHoi[$i] . ' = new google.visualization.PieChart(document.getElementById("pie-' . $maCauHoi[$i] . '"));
                ';
                echo '
                    chartPie' . $maCauHoi[$i] . '.draw(data' . $maCauHoi[$i] . ', options);
                ';
                echo '
                    var chartBar' . $maCauHoi[$i] . ' = new google.visualization.BarChart(document.getElementById("bar-' . $maCauHoi[$i] . '"));
                ';
                echo '
                    chartBar' . $maCauHoi[$i] . '.draw(data' . $maCauHoi[$i] . ', options);
                ';
            }
?>
        }
        </script>


    </head>
    <body>
        <?php include("navbar.php") ?>

        <div class="container-fluid">
            <div class="row">
                <?php include("leftbar.php") ?>
                <div class="col-6 bg-light">
                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-outline-primary" onclick="window.location.replace('B007.php')">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Trở về
                        </button>
                       <div class="btn-group" id="action-buttons">
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-recycle mr-1"></i>
                                Dùng lại
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-pause mr-1"></i>
                                Ngừng
                            </button>
                            <button class="btn btn-outline-danger" onclick="deleteSurvey()">
                                <i class="fas fa-trash-alt mr-1"></i>
                                Xóa
                            </button>
                       </div>
                    </div>
                    <div class="bg-white rounded shadow-sm mt-3 p-3">
                        <div class="pb-2 border-bottom border-grey d-flex justify-content-between">
                            <div id="thong-tin-chung">Thông tin chung</div>
                            <!-- <span class="small" onclick="hideInfo()">
                                <i class="fas fa-caret-up mr-1"></i>
                                Thu gọn
                            </span> -->
                        </div>
                        <div id="info">
                            <div class="mt-3">
                                <h6>
                                <i class="fas fa-tag mr-1"></i>
                                <?php echo $tieuDe; ?></h6>
                            </div>

                            <div class="mt-3">
                                <i class="fas fa-hashtag mr-1"></i>
                                <?php echo $MaKS; ?>
                            </div>

                            <div class="mt-3">
                                <i class="fas fa-calendar-alt mr-2"></i>20/10/2018 - 1/1/2019
                                <span class="ml-1 text-success">
                                    (Đang tiến hành)
                                </span>
                            </div>
                            <div class="mt-3">
                                <i class="fas fa-pen-nib mr-2"></i>
<?php
                                $sql = 'select count(distinct thuchienkhaosat.MaSV) as SoNguoiDaKhaoSat from traloicauhoi join thuchienkhaosat on traloicauhoi.MaTH = thuchienkhaosat.MaTH where thuchienkhaosat.MaKS = ' . $MaKS;
                                echo ($connection -> query($sql) -> fetch_assoc())['SoNguoiDaKhaoSat']
?>
                                người đã tham gia
                            </div>
                            <!-- <div class="mt-3">
                                <i class="fas fa-paper-plane mr-2"></i>Gửi tới:
                                <ul class="list-group list-group-flush mx-4 mt-1">
                                    <li class="list-group-item">
                                        <i class="fas fa-code mr-1"></i>
                                        Sinh viên khoa CNTT
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-code mr-1"></i>
                                        Sinh viên khoa CNTT
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-code mr-1"></i>
                                        Sinh viên khoa CNTT
                                    </li>
                                    <li class="list-group-item d-flex justify-content-center">
                                        <i class="fas fa-ellipsis-h mr-1"></i>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                    <div class="bg-white rounded shadow-sm mt-3 p-3">
                            <div class="pb-2 border-bottom border-grey d-flex justify-content-between">
                                <div>Các câu hỏi</div>
                                <!-- <span class="small" onclick="hideQuestions()" id="hideQuestionsBtn">
                                    <i class="fas fa-caret-up mr-1"></i>
                                    Thu gọn
                                </span> -->
                            </div>
                            <div id="questions">
<?php
                            $count = count($maCauHoi);
                            for($i = 0; $i < $count; ++$i) {
                                echo '<div class="mt-3 pb-3 border-bottom border-grey">';
                                echo '<h6>' . $noiDungCauHoi[$i] . '</h6>';
                                
                                $danhSachLuaChon = array();
                                
                                $sql = "select * from (khaosat join cauhoi on khaosat.MaKS = cauhoi.MaKS) join luachon on cauhoi.MaCH = luachon.MaCH where cauhoi.MaCH = " . $maCauHoi[$i] . ";";
                                
                                $result = $connection -> query($sql);
                                if($result -> num_rows > 0) {
                                    
                                    while($row = $result -> fetch_assoc()) {
                                        $danhSachLuaChon[] = $row['NoiDungLC'];
                                        
                                    }
                                }

                                if(true) { //TODO Tùy theo loại câu hỏi, in ra checkbox hoặc radio
                                    $countLuaChon = count($danhSachLuaChon);
                                    
                                    for($j = 0; $j < $countLuaChon; ++$j) {
                                        
                                        echo '<div class="form-check">';        
                                            //TODO Đặt name cho input
                                            echo '<input type="radio" class="form-check-input" name="cauHoi' . $maCauHoi[$i] . '">';
                                            echo '<label class="form-check-label">';
                                                echo $danhSachLuaChon[$j];
                                            echo '</label>';
                                        echo "</div>";    
                                    }
                                    
                                    
                                }

                                echo '
                                <div class="nav nav-pills mt-3" role="tablist">
                                    <a class="nav-link" id="pills-bar-tab-' . $maCauHoi[$i] .'" data-toggle="pill" href="#bar-' . $maCauHoi[$i] .'" aria-controls="bar-' . $maCauHoi[$i] .'" aria-selected="false">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Số lượng
                                    </a>   
                                    <a class="nav-link" id="pills-pie-tab-' . $maCauHoi[$i] .'" data-toggle="pill" href="#pie-' . $maCauHoi[$i] .'" aria-controls="pie-' . $maCauHoi[$i] .'" aria-selected="false">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Tỷ lệ
                                    </a>
                                   
                                </div>
                                <div class="tab-content" id="infoPane-1">
                                    <div class="tab-pane fade" id="pie-' . $maCauHoi[$i] .'" role="tabpanel" aria-labelledby="pills-pie-tab-1"></div>
                                    <div class="tab-pane fade" id="bar-'. $maCauHoi[$i] .'" role="tabpanel" aria-labelledby="pills-bar-tab-1"></div>
                                </div>
                                ';

                                echo '</div>';

                            }
                            
?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-4">
                            <a class="btn btn-outline-secondary" href="#action-buttons">
                            <i class="fas fa-angle-up mr-1"></i>
                            Lên đầu
                            </a>
                    </div>
                </div>
                <?php include("rightbar.php") ?>
            </div>
        </div>
    </body>
</html>