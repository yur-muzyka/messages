$(function() {
    $(".change_location").click(function() {
		$.get( $(this).attr('href'));
		return false;
    });
});     