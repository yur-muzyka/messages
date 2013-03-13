$(document).ready(function () {
    setInterval("Load();", 5000);
	Load();
});

function Send() {
    $.post("ajax.php", {
        act: "send",
        text: $("#m_text").val(),
        opponent_id: opponent_id
    },
    Load );
    $("#m_text").val("");
    $("#m_text").focus();
    return false;
}

var last_edit = null;
var action = null;
var m_id = null;
var m_text = null;
var last_message_id = 0;
var load_in_process = false;
var edit = null;
var layout = "true";
var tempScrollTop = 0;
var editScrollTop = 0;
var replace_from = null;
var replace_to = null;
var str = null;
var del = null;
var opponent_id = null;

function Load() {
    if (!load_in_process) {
	    load_in_process = true;
    	$.post("ajax.php", {
            last_message_id: last_message_id,
            edit: edit,
            del: del,
            layout: layout,
            action: action,
            m_id: m_id,
            m_text: m_text,
            opponent_id: opponent_id
        },
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
    if (edit || del) {
        str = $("#ajax").html();
        //$("#ajax").html(str.replace(new RegExp(replace_from, 'gi'), replace_to));
        $(replace_from).html(replace_to);
        edit = null;
        replace_from = null;
        replace_to = null;
        action = null;
        del = null;
    }
}

function replace_previous_edit() {
    $(last_edit[0]).html(last_edit[1]);
    last_edit = null;
}
