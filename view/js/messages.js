$(document).ready(function () {
    $("#pac_form").submit(Send);
    $("#pac_text").focus();
    setInterval("load_messages();", 2000);
});    
