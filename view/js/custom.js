$(document).ready(function () {
    setInterval("Load();", 5000);
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

var action = null;
var m_id = null;
var m_text = null;
var last_message_id = 0;
var post_params = {};
var load_in_process = false;
var edit = false;
var layout = "false";
var tempScrollTop = 0;
var editScrollTop = 0;
var replace_from = false;
var replace_to = false;
var str = null;

function Load() {
    if (!load_in_process) {
	    load_in_process = true;
    	$.post("ajax.php", {
            last_message_id: last_message_id,
            edit: edit,
            layout: layout,
            action: action,
            m_id: m_id,
            m_text: m_text
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
            ajax_replace();
            remote();
            butt();
		    load_in_process = false;
            $(window).scrollTop(tempScrollTop);
    	});
    }
}        

function ajax_replace() {
    if (edit) {
        str = $("#ajax").html();
        $(replace_from).html(replace_to);
        edit = false;
        replace_from = false;
        replace_to = false;
        action = null;
    }
}

