jQuery(document).ready(function($) {
	$('#insLink').click(function(e) {
		e.preventDefault();
		$(this).fadeOut('fast', function() {
			$('#formIns').animate({
				top: "60px"},
				800
			).animate({
				top: "0"},
				1000
			);
		});
	});
	$('.alert').stop().delay(400).slideDown(500).delay(2500).slideUp(800);
});