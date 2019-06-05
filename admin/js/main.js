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

function loadUsersOnline(){
	$.get("includes/functions.php?usrsonline=result",function(data){
		$(".usrsonline").text(data);
	});  
}

setInterval(function(){
	loadUsersOnline();
},500);

