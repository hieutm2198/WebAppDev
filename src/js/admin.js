var selectedSurveyId = null;
var selectedUserId = null;
$(document).ready(function() {

    var surveyTable = $('#surveyTable').DataTable({
        "ajax": "surveyList.php",
        
        "columns": [
            {"data": "surveyId"},
            {"data": "surveyTitle"},
            {"data": "creatorId"},
            {"data": "creatorName"}
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Vietnamese.json"
        }
    });

    $('#surveyTable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('table-success') ) {
            $(this).removeClass('table-success');
            selectedSurveyId = null;
        }
        else {
            surveyTable.$('tr.table-success').removeClass('table-success');
            $(this).addClass('table-success');
            selectedSurveyId = parseInt(surveyTable.row( this ).data()["surveyId"]);
        }
    } );

    
    $('#deleteSurveyBtn').on('click', function() {
       if(selectedSurveyId === null) {
            $.ajax({
                url: "deleteSurvey.php",
                type: "post",
                data: {
                    surveyId: selectedSurveyId
                },
                success: function(response) {
                    surveyTable.ajax.reload();
                }
            });
       } else {
            //TODO notif
        }
    });

    $('#detailSurveyBtn').on('click', function() {
        if(selectedSurveyId !== null) {
            $.ajax({
                url: "surveyDetail.php",
                type: "post",
                data: {
                    surveyId: selectedSurveyId
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    console.log(result);
                    if(result["success"]) {
                        $('#surveyDetailTitle').html(result["surveyName"]);
                        $('#surveyDetailId').html(result["surveyId"]);
                        $('#surveyDetailCreatorName').html(result["surveyCreatorName"]);
                        $('#surveyDetailCreatorId').html(result["surveyCreatorId"]);
                        
                        $('#surveyDetailQuestionList').empty();

                        var questionList = result["question"];
                        
                        for(var i = 0; i < questionList.length; ++i) {
                            var html = '';
                            html += '<div class="mt-3 pb-3 border-bottom border-grey">';
                            html += '<h6>';
                            html += questionList[i]["questionContent"];
                            html += '</h6>';
                            var answerList = questionList[i]["answer"];
                            for(var j = 0; j < answerList.length; ++j) {
                                html += '<div class="form-check">';
                                if(questionList[i]["questionType"] === "single") {
                                    html += '<input type="radio" class="form-check-input" name="cauHoi' + questionList[i]["questionId"] + '">';
                                } else if(questionList[i]["questionType"] === "multi"){
                                    html += '<input type="checkbox" class="form-check-input" name="cauHoi' + questionList[i]["questionId"] + '">';
                                }
                                html += answerList[j]["answerContent"];
                                html += '</div>';
                            }
                            html += '</div>';
                            $('#surveyDetailQuestionList').append(html);
                        }

                        $('#surveyDetailModal').modal('show');
                    } else {

                    }

                }
            });
        } else {
            //TODO notif
        }
    });
    
    var userTable = $('#userTable').DataTable({
        "ajax":"userList.php",
        "columns": [
            {"data":"username"},
            {"data":"password"},
            {"data":"studentId"},
            {"data":"fullname"},
            {"data":"sex"},
            {"data":"dateofbirth"},
            {"data":"recentLogin"},
            {"data":"isAdmin"}
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Vietnamese.json"
        }
    });

    $('#userTable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('table-success') ) {
            $(this).removeClass('table-success');
            selectedSurveyId = null;
        }
        else {
            userTable.$('tr.table-success').removeClass('table-success');
            $(this).addClass('table-success');
            selectedUserId = parseInt(surveyTable.row(this).data()["userId"]);
        }
    } );
});