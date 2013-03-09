$(document).ready(function () {
    $("#m_form").submit(Send);
    $("#m_text").focus();
}); 

$(function() {
    $(".change_location").click(function() {
		$.get( $(this).attr('href'));
        Load();
		return false;
    });
});     


