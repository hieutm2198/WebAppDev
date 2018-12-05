function viewDetail(surveyId) {
    window.location.replace("B009.php?khaosat=" + surveyId);
}

function editSurvey(surveyId) {
    window.location.replace("B014.php?khaosat=" + surveyId);
}

function doNow(surveyId) {
    window.location.replace("C004.php?khaosat=" + surveyId);
}

$(document).ready(function() {
    $.ajax({
        url: "surveyList.php",
        type: "get",
        success: function(response){
            var result = JSON.parse(response);
            var requiredSurveyList = result["requiredSurvey"];
            var html = '';
            $('#list-required').empty();
            for(var i = 0; i < requiredSurveyList.length; ++i) {
                html += '<div class="card shadow-sm mb-3">';
                    html += '<div class="card-body">';
                        html += '<div class="card-title">';
                            html += '<h6>';
                                html += requiredSurveyList[i]["surveyTitle"];
                            html += '</h6>';
                        html += '</div>';
                        html += '<p class="card-text">';
                            html += '<small class="text-muted">';
                                html += requiredSurveyList[i]["creatorName"];
                            html += '</small>';
                        html += '</p>';
                        html += '<a href="C004.php?khaosat=' + parseInt(requiredSurveyList[i]["surveyId"]) + '" class="btn btn-sm btn-outline-success ml-auto">Thực hiện</a>';

                        html += '</a>';
                    html += '</div>';
                html += '</div>';
                console.log(html);
                $('#list-required').append(html);
            }
            
        }
    });
});