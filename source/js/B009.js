$(function () {
    $('[data-toggle="popover"]').popover()
});

var isInfoHiding = false;
var isQuestionsHiding = false;

function hideInfo() {
    if(isInfoHiding) {
        document.getElementById("info").style="";
        isInfoHiding = false;
    } else {
        document.getElementById("info").style="display: none";
        isInfoHiding = true;
    }
}

function hideQuestions() {
    if(isQuestionsHiding) {
        document.getElementById("questions").style="";
        isQuestionsHiding = false;
    } else {
        document.getElementById("questions").style="display: none";
        isQuestionsHiding = true;
    }
}

function deleteSurvey() {
    $.ajax({
        url: "deleteSurvey.php",
        type: "post",
        data: {
            surveyId: surveyId
        },
        success: function(response) {
            window.location.replace("B007.php");
        }
    });
}