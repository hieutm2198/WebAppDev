<script src="js/global.js"></script>
<nav id="navibar" class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-dark sticky-top">
            <a class="navbar-brand" href="#">
                <img src="img/logo_c9.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                UET graduate forum
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link active ml-4">
                                <i class="fas fa-home mr-2"></i>
                                Trang chủ
                            </a>
                        </li>
                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav-link ml-4"
                            data-toggle="popover"
                            data-trigger="focus"
                            data-placement="bottom"
                            data-container="#navibar"
                            data-html="true"
                            title=""
                            data-content="
                                <div class='media pt-2 pb-1 border-bottom border-gray'>
                                    <div class='media-body pb-1 mb-0 small lh-125'>
                                        <div class='d-flex justify-content-between align-items-center w-100'>
                                            <strong class='text-gray-dark'>
                                                <i class='fas fa-landmark mr-2'></i>Lớp QH2016-I/CQ-C-D
                                            </strong>
                                            <span class='d-block small'>3 ngày trước</span>
                                        </div>
                                        <span class='d-block'>Hoàng Việt Hưng đã mở một thăm dò</span>
                                    </div>
                                </div>

                                <div class='media pt-2 pb-1 border-bottom border-gray'>
                                    <div class='media-body pb-1 mb-0 small lh-125'>
                                        <div class='d-flex justify-content-between align-items-center w-100'>
                                            <strong class='text-gray-dark'>
                                                <i class='fas fa-users mr-2'></i>Sinh viên khóa K61
                                            </strong>
                                            <span class='d-block small'>1 tháng trước</span>
                                        </div>
                                        <span class='d-block'>Phòng Đào Tạo đã mở một khảo sát</span>
                                    </div>
                                </div>

                                <div class='media pt-2 pb-1 text-muted border-bottom border-gray'>
                                    <div class='media-body pb-1 mb-0 small lh-125'>
                                        <div class='d-flex justify-content-between align-items-center w-100'>
                                            <strong class='text-gray-dark'>
                                                <i class='fas fa-code mr-2'></i>Sinh viên khoa CNTT
                                            </strong>
                                            <span class='d-block small'>10 giờ trước</span>
                                        </div>
                                        <span class='d-block'>Trần Văn Định đã trả lời bình luận của bạn</span>
                                    </div>
                                </div>
                                
                                <span class='d-block small pt-2 pb-1 '>
                                    <i class='fas fa-caret-down mr-2 align-self-center'></i>
                                    Xem thêm
                                </span>
                            "
                        >
                            <i class="fas fa-bell mr-2"></i>
                            Thông báo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav-link ml-4"
                            data-toggle="popover"
                            data-trigger="focus"
                            data-placement="bottom"
                            data-container="#navibar"
                            data-html="true"
                            title=""
                            data-content="
                                <div class='media pt-2 pb-1 border-bottom border-gray'>
                                    <img src='img/ava_blue.svg' alt='32x32' class='mr-2 rounded' style='width: 32px; height: 32px;' data-holder-rendered='true'>
                                    <div class='media-body pb-1 mb-0 small lh-125'>
                                        <div class='d-flex justify-content-between align-items-center w-100'>
                                        <strong class='text-gray-dark'>Hoàng Việt Hưng</strong>
                                        <span class='d-block small'>1 giờ trước</span>
                                        </div>
                                        <span class='d-block'>Đi họp lớp không Hiếu?</span>
                                    </div>
                                </div>

                                <div class='media text-muted pt-2 pb-1 border-bottom border-gray'>
                                    <img src='img/ava_purple.svg' alt='32x32' class='mr-2 rounded' style='width: 32px; height: 32px;' data-holder-rendered='true'>
                                    <div class='media-body pb-1 mb-0 small lh-125'>
                                        <div class='d-flex justify-content-between align-items-center w-100'>
                                        <strong class='text-gray-dark'>Tuấn Hưng</strong>
                                        <span class='d-block small'>2 tuần trước</span>
                                        </div>
                                        <span class='d-block'>Đi hát đê em ei</span>
                                    </div>
                                </div>
                                <div class='media text-muted pt-2 pb-1 border-bottom border-gray'>
                                    <img src='img/ava_purple.svg' alt='32x32' class='mr-2 rounded' style='width: 32px; height: 32px;' data-holder-rendered='true'>
                                    <div class='media-body pb-1 mb-0 small lh-125'>
                                        <div class='d-flex justify-content-between align-items-center w-100'>
                                        <strong class='text-gray-dark'>Mỹ Tâm</strong>
                                        <span class='d-block small'>1 tháng trước</span>
                                        </div>
                                        <span class='d-block'>Xin chào Trần Minh Hiếu!</span>
                                    </div>
                                </div>
                                <span class='d-block small pt-2 pb-1 '>
                                    <i class='fas fa-caret-down mr-2 align-self-center'></i>
                                    Xem thêm
                                </span>
                            "
                        >
                            <i class="fas fa-comment-alt mr-2"></i>
                            <?php
                                if(isset($_SESSION['msv'])) {
                                    echo $_SESSION['msv'];
                                }
                            ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="server.php?profile='1'" class="nav-link ml-4">
                            <i class="fas fa-user mr-2"></i>
                            <?php
                                if(isset($_SESSION['username'])) {
                                    echo $_SESSION['username'];
                                }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>