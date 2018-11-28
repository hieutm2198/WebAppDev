<?php
    include("database.php");
    $sql = 'select * from khaosat where TrangThaiKS="published" and MaNguoiTao=' . $_SESSION['MaSV'] .';';
    $result = $connection -> query($sql);
    $publishedIdList = [];
    $publishedTitleList = [];
    while($row = $result -> fetch_assoc()) {
        $publishedIdList[] = $row['MaKS'];
        $publishedTitleList[] = $row['TieuDe'];
    }

    $sql = 'select * from khaosat where TrangThaiKS="saved" and MaNguoiTao=' . $_SESSION['MaSV'] .';';
    $result = $connection -> query($sql);
    $savedIdList = [];
    $savedTitleList = [];
    while($row = $result -> fetch_assoc()) {
        $savedIdList[] = $row['MaKS'];
        $savedTitleList[] = $row['TieuDe'];
    }

    $sql = 'select * from thuchienkhaosat join khaosat on thuchienkhaosat.MaKS = khaosat.MaKS where thuchienkhaosat.MaSV=' . $_SESSION['MaSV'] .';';
    $result = $connection -> query($sql);
    $completedIdList = [];
    $completedTitleList = [];
    while($row = $result -> fetch_assoc()) {
        $completedIdList[] = $row['MaKS'];
        $completedTitleList[] = $row['TieuDe'];
    }

    $sql = 'select khaosat.MaKS, khaosat.TieuDe from khaosat where MaKS NOT IN (select thuchienkhaosat.MaKS from thuchienkhaosat where MaSV='.$_SESSION['MaSV'].');';
    $result = $connection -> query($sql);
    $incompletedIdList = [];
    $incompletedTitleList = [];
    while($row = $result -> fetch_assoc()) {
        $incompletedIdList[] = $row['MaKS'];
        $incompletedTitleList[] = $row['TieuDe'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>B007 - Danh sách khảo sát</title>
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
        <script src="js/B007.js"></script>
        <link rel="stylesheet" href="css/B007.css">
        <link rel="stylesheet" href="css/global.css">
        <script>
            
        </script>

    </head>
    <body>
       
        <?php include("navbar.php") ?>

        <div class="container-fluid">
            <div class="row">
                <?php include("leftbar.php") ?>
                <div class="col-6 bg-light" id="middle-content">
                    <div class="d-flex justify-content-between mt-3">
                        <h4>Danh sách khảo sát</h4>
                        <button type="button" class="btn btn-success btn-sm" onclick="window.location.replace('B008.php')">
                            <i class="fas fa-plus"></i>
                            Tạo mới
                        </button>
                    </div>
                    <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-published-tab" data-toggle="pill" href="#pills-published" role="tab" aria-controls="pills-published" aria-selected="true">
                                <i class="fas fa-paper-plane mr-1"></i>
                                Đã phát hành
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-saved-tab" data-toggle="pill" href="#pills-saved" role="tab" aria-controls="pills-saved" aria-selected="false">
                                <i class="fas fa-save mr-1"></i>
                                Đã lưu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-incomplete-tab" data-toggle="pill" href="#pills-incomplete" role="tab" aria-controls="pills-incomplete" aria-selected="false">
                                <i class="fas fa-scroll mr-1"></i>
                                Chưa thực hiện
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-completed-tab" data-toggle="pill" href="#pills-completed" role="tab" aria-controls="pills-completed" aria-selected="false">
                                <i class="fas fa-check-square mr-1"></i>
                                Đã thực hiện
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-published" role="tabpanel" aria-labelledby="pills-published-tab">
                        <div class="my-3 d-flex justify-content-right font-weight-light text-right">
                        
                        <?php
                            echo 'Tổng số: ' . sizeof($publishedIdList) . '';
                        ?>
                        </div>

<?php
    for($i = 0; $i < sizeof($publishedIdList); ++$i) {
        echo '<div class="mb-3 py-2 px-3 rounded bg-white shadow-sm">';
            echo '<div class="">';
                echo $publishedTitleList[$i];
            echo '</div>';
            echo '<div class="pb-2 d-flex justify-content-between">';
                echo '<div class="small font-italic">';
$sql = 'select count(MaTH) as SoNguoiThamGia from thuchienkhaosat where MaKS = ' . $publishedIdList[$i] . ';';
                    echo (($connection -> query($sql)) -> fetch_assoc())['SoNguoiThamGia'] . ' người đã tham gia';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-secondary btn-sm" onclick="viewDetail(' . $publishedIdList[$i] . ')">';
                    echo 'Chi tiết';
                echo'</button>';
            echo '</div>';
        echo '</div>';
    }
?>
                        </div>
                        
                        <div class="tab-pane fade" id="pills-saved" role="tabpanel" aria-labelledby="pills-saved-tab">
                        <div class="my-3 d-flex justify-content-right font-weight-light text-right">
                        
                        <?php
                            echo 'Tổng số: ' . sizeof($savedIdList) . '';
                        ?>
                        </div>

<?php
    for($i = 0; $i < sizeof($savedIdList); ++$i) {
        echo '<div class="mb-3 py-2 px-3 rounded bg-white shadow-sm">';
            echo '<div class="">';
                echo $savedTitleList[$i];
            echo '</div>';
            echo '<div class="pb-2 d-flex justify-content-between">';
                echo '<div class="small font-italic">';
                    echo '16/11/2018 11:25';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-secondary btn-sm" onclick="editSurvey(' . $savedIdList[$i] . ')">';
                    echo 'Sửa';
                echo'</button>';
            echo '</div>';
        echo '</div>';
    }
?>
                        </div>
                        <div class="tab-pane fade" id="pills-incomplete" role="tabpanel" aria-labelledby="pills-incomplete-tab">

<div class="my-3 d-flex justify-content-right font-weight-light text-right">
                        
                        <?php
                            echo 'Tổng số: ' . sizeof($incompletedIdList) . '';
                        ?>
                        </div>

<?php
    for($i = 0; $i < sizeof($incompletedIdList); ++$i) {
        echo '<div class="mb-3 py-2 px-3 rounded bg-white shadow-sm">';
            echo '<div class="">';
                echo $incompletedTitleList[$i];
            echo '</div>';
            echo '<div class="pb-2 d-flex justify-content-between">';
                echo '<div class="small font-italic">';
$sql = 'select count(MaTH) as SoNguoiThamGia from thuchienkhaosat where MaKS = ' . $incompletedIdList[$i] . ';';
                    echo (($connection -> query($sql)) -> fetch_assoc())['SoNguoiThamGia'] . ' người đã tham gia';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-secondary btn-sm" onclick="doNow(' . $incompletedIdList[$i] . ')">';
                    echo 'Thực hiện';
                echo'</button>';
            echo '</div>';
        echo '</div>';
    }
?>

                        </div>
                        <div class="tab-pane fade" id="pills-completed" role="tabpanel" aria-labelledby="pills-completed-tab">
                        <div class="my-3 d-flex justify-content-right font-weight-light text-right">
                        
                        <?php
                            echo 'Tổng số: ' . sizeof($completedIdList) . '';
                        ?>
                        </div>
                        

<?php
    for($i = 0; $i < sizeof($completedIdList); ++$i) {
        echo '<div class="mb-3 py-2 px-3 rounded bg-white shadow-sm">';
            echo '<div class="">';
                echo $completedTitleList[$i];
            echo '</div>';
            echo '<div class="pb-2 d-flex justify-content-between">';
                echo '<div class="small font-italic">';
                    echo '16/11/2018 11:25';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-secondary btn-sm" onclick="viewDetail(' . $completedIdList[$i] . ')">';
                    echo 'Xem lại';
                echo'</button>';
            echo '</div>';
        echo '</div>';
    }
?>
                        </div>
                    </div>
                </div>
                <?php include("rightbar.php") ?>
            </div>
        </div>
    </body>
</html>