$(document).ready(function () {
    setInterval("Load();", 2000);
	Load();
});

function Send() {
    $.post("ajax.php", {
        act: "send",  // указываем скрипту, что мы отправл€ем новое сообщение и его нужно записать
        text: $("#m_text").val() //  сам текст сообщени€
    },
     Load );

    $("#m_text").val("");
    $("#m_text").focus();
    
    return false;
}

var last_message_id = 0;
var post_params = {};
var load_in_process = false;
var edit = false;
var layout = "false";
var tempScrollTop = 0;
var editScrollTop = 0;

function Load() {
    if (!load_in_process) {
	    load_in_process = true;
    	$.post("ajax.php", {
            last_message_id: last_message_id,
            edit: edit,
            layout: layout
        },
                //post_params,
   	    function (result) {
            if (editScrollTop) {
                tempScrollTop = editScrollTop;
                editScrollTop = 0;
            } else {
                tempScrollTop = $(window).scrollTop();
            }
            eval(result);
		    load_in_process = false;
            $(window).scrollTop(tempScrollTop);
    	});
    }
}        

