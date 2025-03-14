$(document).ready(function () {
	var listItems = $("#navbarSupportedContent li").clone();

	listItems.addClass("dropdown-item");

	$("#btn-menu").append(listItems);
});
