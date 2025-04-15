$(document).ready(function () {
	$("#show-next-steps").click(function () {
		$("#next-step").removeClass("d-none");
		$("#first-step").addClass("d-none");
	});

	// $("#btn-back").click(function () {
	// 	$("#next-step").addClass("d-none");
	// 	$("#first-step").removeClass("d-none");
	// });
});
