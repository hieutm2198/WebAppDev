var check1 = true;
var check2 = true;

$("#tanglike").click(function(){
	if(check1){
		$(this).css("color","green");
		$("#giamlike").css("color","rgb(84, 84, 84)");
		if(check1 && check2) $("#like").html(parseInt($("#like").text()) + 1);
		else if(!check2) $("#like").html(parseInt($("#like").text()) + 2);
		check1 = false;
		check2 = true;
	}
	else{
		$(this).css("color","rgb(84, 84, 84)");
		$("#like").html(parseInt($("#like").text()) - 1);
		check1 = true;
	}
});

$("#giamlike").click(function(){
	if(check2){
		$(this).css("color","green");
		$("#tanglike").css("color","rgb(84, 84, 84)");
		if(check1 && check2) $("#like").html(parseInt($("#like").text()) - 1);
		else $("#like").html(parseInt($("#like").text()) - 2);
		check1 = true;
		check2 = false;
	}
	else{
		$(this).css("color","rgb(84, 84, 84)");
		$("#like").html(parseInt($("#like").text()) + 1);
		check2 = true;
	}
});

$("#traloi").click(function(){
	$("#second-cm").append($("#frist-cm").html());
});