var questionList = [];
var questionTypeList = [];
var answerList = [];

function addAnswer() {
    var newInputGroup = document.createElement("div");
    newInputGroup.className = "input-group mt-2";
    
    var newAnswerInput = document.createElement("input");
    newAnswerInput.className = "form-control answerOfNewQuestion";
    newAnswerInput.setAttribute("type", "text");
    newAnswerInput.setAttribute("placeholder", "Nội dung lựa chọn");
    
    var newInputGroupAppend = document.createElement("div");
    newInputGroupAppend.className = "input-group-append";

    var deleteAnswerButton = document.createElement("button");
    deleteAnswerButton.className = "btn btn-outline-secondary";
    deleteAnswerButton.onclick = function(event) {
        event.target.parentNode.parentNode.remove();
    }

    var deleteIcon = document.createElement("i");
    deleteIcon.className = "fas fa-times";

    deleteAnswerButton.append(deleteIcon);
    
    newInputGroupAppend.append(deleteAnswerButton);

    newInputGroup.append(newAnswerInput);
    newInputGroup.append(newInputGroupAppend);

    document.getElementById("inputAnswer").append(newInputGroup);
}

function addQuestion() {
    var newQuestion = document.getElementById("questionContentInput").value;
    questionList.push(newQuestion);
    var newQuestionContainer = document.createElement("div");
    newQuestionContainer.className = "mt-3 mb-2 pb-3 border-bottom border-gray question-container";
    var newQuestionElement = document.createElement("h5");
    var newQuestionElementText = document.createTextNode(newQuestion);
    
    newQuestionElement.append(newQuestionElementText);
    newQuestionContainer.append(newQuestionElement);

    document.getElementById("questionList").append(newQuestionContainer);
    var radios = document.getElementsByName("newQuestionType");
    for(var i = 0; i < radios.length; ++i) {
        if(radios[i].checked) {
            questionTypeList.push(radios[i].value);
        }
    }
    
    var answerContentOfNewQuestion = [];
    var listAnswerOfNewQuestion = document.getElementsByClassName("answerOfNewQuestion");
    for(var i = 0; i < listAnswerOfNewQuestion.length; ++i) {
        answerContentOfNewQuestion.push(listAnswerOfNewQuestion[i].value);
    }
    answerList.push(answerContentOfNewQuestion);
    
    for(var i = 0; i < listAnswerOfNewQuestion.length; ++i) {
        var formCheck = document.createElement("div");
        formCheck.className = "form-group form-check";
        var checkElement = document.createElement("input");
        if(questionTypeList[questionTypeList.length - 1] == "single") {
            
            checkElement.setAttribute("type", "radio");
            checkElement.setAttribute("name", "checkbox");

        } else if(questionTypeList[questionTypeList.length - 1] == "multi") {
            checkElement.setAttribute("type", "checkbox");
        } else { //TODO type: free

        }
        checkElement.className = "form-check-input";
        var answerContentLabel = document.createElement("label");
        answerContentLabel.className = "form-check-label";
        var answerContent = document.createTextNode(answerContentOfNewQuestion[i]);
        
        answerContentLabel.append(answerContent);
        formCheck.append(checkElement);
        formCheck.append(answerContentLabel);
        newQuestionContainer.append(formCheck);

    }

    var editButton = document.createElement("button");
    editButton.className = "btn btn-outline-secondary mr-2";
    editButton.append(document.createTextNode("Sửa"));
    editButton.onclick = function () {
        
    }
    var deleteButton = document.createElement("button");
    deleteButton.className = "btn btn-outline-danger";
    deleteButton.append(document.createTextNode("Xóa"));
    deleteButton.onclick = function (event) {
        var itemToDelete = event.target.parentNode;
        var questContainerArray = document.getElementsByClassName("question-container");
        for(var i = 0; i < questContainerArray.length; ++i) {
            if(itemToDelete === questContainerArray[i]) {
                itemToDelete.remove();
                questionList.splice(i, 1);
                questionTypeList.splice(i, 1);
                answerList.splice(i, 1);
                break;        
            }
        }
    }
    
    newQuestionContainer.append(editButton);
    newQuestionContainer.append(deleteButton);
    
}

function sendSurvey() {
    surveyTitle = document.getElementById("surveyTitle").value;
    var surveyStatus = 'published';
    $.ajax({
        url: "newSurvey.php",
        type: "post",
        // dataType: "text",
        data: {
            surveyTitle: surveyTitle,
            questionList: questionList,
            questionTypeList: questionTypeList,
            answerList: answerList,
            surveyStatus: surveyStatus
        },
        success: function (result) {                        
            detailPage = "B009.php?khaosat=" + result;
            window.location.replace(detailPage);
        }
    });
}

function saveSurvey() {
    surveyTitle = document.getElementById("surveyTitle").value;
    var surveyStatus = 'saved';
    $.ajax({
        url: "newSurvey.php",
        type: "post",
        // dataType: "text",
        data: {
            surveyTitle: surveyTitle,
            questionList: questionList,
            questionTypeList: questionTypeList,
            answerList: answerList,
            surveyStatus: surveyStatus
        },
        success: function (result) {                        
            detailPage = "B009.php?khaosat=" + result;
            window.location.replace(detailPage);
        }
    });
}

function deleteSurvey() {
    
}