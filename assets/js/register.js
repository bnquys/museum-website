$(document).ready(function () {
	$("#btn-show-create-account").click(function () {
		$("#create-account").removeClass("d-none");
		$("#fill-out").addClass("d-none");
	});

	$("#btn-back-to-fill-out").click(function () {
		$("#create-account").addClass("d-none");
		$("#fill-out").removeClass("d-none");
	});
});
