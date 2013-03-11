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

function Load(parameters) {
    if ((parameters && !parameters["edit"]) || !parameters) {
        post_params["edit"] = edit;
    } else {
        post_params["edit"] = parameters["edit"];
    } 

    post_params["last_message_id"] = last_message_id;

    if (!load_in_process) {
	    load_in_process = true;
    	$.post("ajax.php", 
                post_params,
   	    function (result) {
            var tempTextArea = $("#m_text").val();
            var tempScrollTop = $(window).scrollTop();
            

//var ss = $("#m_text").getSelection();
     //alert(ss);

            //$.getScript(result);
            eval(result);
		    load_in_process = false;
            $(window).scrollTop(tempScrollTop);
            $("#m_text").val(tempTextArea);
    	});
    }
}        

