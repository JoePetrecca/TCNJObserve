$(document).ready(function() {
	$.ajax({
		url: "upstatus.php",
		success: function(result) {
			$("#status").text(result);
		}
	});
});