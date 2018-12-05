function focus_cmt() {
	document.getElementById("comment").focus();
}
function input_rep_cmt(event) {
	var node_parent = event.parentNode;
	var hoten_cmt = node_parent.childNodes[1].innerHTML;
	var rep_cmt = hoten_cmt + "-";
	var next_sibling = node_parent.parentNode;
	$(document).ready(function(){
		$(next_sibling).next().show();
		var field_input = $(next_sibling).next().eq(0).children().eq(0).children().eq(0).children().eq(1);
		field_input.val(rep_cmt);
		field_input.focus();
	})
}
function input_rep_cmt2(event) {
	var node_cha = event.parentNode;
	var hoten_cmt = node_cha.childNodes[1].innerHTML;
	var rep_cmt = hoten_cmt + "-";
	var node_ong = node_cha.parentNode;
	var node_cu = node_ong.parentNode;
	var dich = node_cu.parentNode;
	$(document).ready(function(){
		$(dich).next().show();
		var field_input = $(dich).next().eq(0).children().eq(0).children().eq(0).children().eq(1);
		field_input.val(rep_cmt);
		field_input.focus();
	})
}







