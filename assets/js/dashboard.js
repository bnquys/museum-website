$(document).ready(function () {
	var listItems = $("#list-group").clone();
	$("#offcanvas-body").append(listItems);
});

$(document).ready(function () {
	$("#btn-menu").click(function () {
		$("aside p").fadeToggle("slow");
	});
});
