$(document).ready(function () {
    setInterval("Load();", 8000);
	Load();
});

function Send() {
    $.post("ajax.php", {
        act: "send",  // ��������� �������, ��� �� ���������� ����� ��������� � ��� ����� ��������
        text: $("#m_text").val() //  ��� ����� ���������
    },
     Load );

    $("#m_text").val("");
    $("#m_text").focus();
    
    return false;
}

var last_message_id = 0; 
var load_in_process = false;

function Load() {
    if(!load_in_process) {
	    load_in_process = true;
    	$.post("ajax.php", {
            last: last_message_id,
    	},
   	    function (result) {
		    eval(result);
		    load_in_process = false;
    	});
    }
}
