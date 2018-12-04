<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chỉnh sửa khảo sát</title>
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
        <script src="js/B008.js"></script>
        <link rel="stylesheet" href="css/B008.css">
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
                       
                        <button class="btn btn-outline-danger" onclick="window.location.replace('B007.php')">
                            <i class="fas fa-times mr-1"></i>
                            Hủy
                        </button>
                       <div class="btn-group">
                            <button class="btn btn-outline-secondary" onclick="saveSurvey()">
                                <i class="fas fa-save mr-1"></i>
                                Lưu lại
                            </button>
                            <button class="btn btn-success" onclick="sendSurvey()">
                                <i class="fas fa-paper-plane mr-1"></i>
                                Phát hành
                            </button>
                       </div>
                    </div>
                    <div class="bg-white rounded shadow-sm mt-3 p-3">
                        <div class="pb-2 border-bottom border-grey d-flex justify-content-between">
                            <div>Thông tin chung</div>
                            <!-- <span class="small">
                                <i class="fas fa-caret-down mr-1"></i>
                                Thu gọn
                            </span> -->
                        </div>
                        
                        <div class="mt-3">
                            <!-- <i class="fas fa-tag mr-1"></i> -->
                            <input id="surveyTitle" type="text" class="form-control" placeholder="Tiêu đề bài khảo sát">
                        </div>
                        <!-- <div class="mt-3 d-flex justify-content-between">
                           
                            <input type="date" class="form-control mr-2">
                            <input type="date" class="form-control">
                                
                            </span>
                        </div> -->
                    </div>
                    <div class="bg-white rounded shadow-sm mt-3 p-3">
                        <div class="pb-2 border-bottom border-grey d-flex justify-content-between">
                            <div>Các câu hỏi</div>
                            <!-- <span class="small">
                                <i class="fas fa-caret-down mr-1"></i>
                                Thu gọn
                            </span> -->
                        </div>
                        <div id="questionList">
                            <div class="mt-3">
                                
                            </div>
                        </div>
                        <div class="d-flex justify-content-center my-2">
                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#addQuestionModal">
                                <i class="fas fa-plus mr-1"></i>
                                Thêm câu hỏi
                            </button>
                        </div>
                    </div>
                    
                </div>
                <?php include("rightbar.php") ?>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addQuestionModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nhập thông tin cho câu hỏi mới</h5>
                    </div>
                    <div class="modal-body">
                        <input id="questionContentInput" type="text" class="form-control mb-2" placeholder="Nội dung câu hỏi">
                        <span class="mr-2">Loại câu hỏi</span>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="newQuestionType" value="single" checked>
                            <label for="" class="form-check-label">Chọn một</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="newQuestionType" value="multi">
                            <label for="" class="form-check-label">Chọn nhiều</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="newQuestionType" value="free">
                            <label for="" class="form-check-label">Nhập câu trả lời</label>
                        </div>
                        <div id="inputAnswer">
                            <button type="button" class="btn mt-2" onclick="addAnswer()">Thêm lựa chọn</button>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="addQuestion()">Lưu lại</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                    </div>
                </div>  
               
            </div>
        </div>
    </body>
</html>