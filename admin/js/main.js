$(document).ready(function() {
	$('#bulkCheck').click(function() {
		if (this.checked) {
			$('.checkBoxes').each(function() {
				this.checked = true;
			});
		} else {
			$('.checkBoxes').each(function() {
				this.checked = false;
			});
		}
	});
	
	let div_box = "<div id='load-screen'><div id='loading'></div></div>";
	$("body").prepend(div_box);
	$('#load-screen').delay(500).fadeOut(600, function() {
		$(this).remove();
	});
});