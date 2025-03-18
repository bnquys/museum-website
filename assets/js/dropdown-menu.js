$(document).ready(function () {
	var listItems = $("#navbarSupportedContent li").clone();
	listItems.addClass("dropdown-item");
	listItems.find("a").addClass("ps-3 fs-4");
	$("#dropdown-menu").append(listItems);
});
