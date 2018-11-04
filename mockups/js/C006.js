$(document).ready(function() {
	$("#listcd").hide();
	$("#dathamgia").hide();
	$("#listthanhvien").hide();
});

$("#chude").click(function () {
	$("#listcd").toggle(300);
});

$("#thamgia").click(function(){
	$(this).hide();
	$("#dathamgia").show(1000);
});

$("#thanhvien").click(function(){
	$("#listthanhvien").show(500);
	$("#dathamgia").hide();
	$("#thamgia").hide();
})

