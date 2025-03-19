$(document).ready(function () {
	var listItems = $("#navbarSupportedContent li").clone();
	listItems.addClass("dropdown-item");
	listItems.find("a").removeClass("px-3");
	listItems.find("a").addClass("fs-4 drop-menu d-block text-center p-3");
	$("#dropdown-menu").append(listItems);

});
