$(document).ready(function () {
    $("#pac_form").submit(Send);
    $("#pac_text").focus();
    setInterval("Load();", 2000);
	Load();
});

function Send() {
    // ��������� ������ � ������� � ������� jquery ajax: $.post(�����, {��������� �������}, ������� ������� ���������� �� ���������� �������)
    $.post("ajax.php",  
	{
        act: "send",  // ��������� �������, ��� �� ���������� ����� ��������� � ��� ����� ��������
        name: $("#pac_name").val(), // ��� ������������
        text: $("#pac_text").val() //  ��� ����� ���������
    },
     Load ); // �� ���������� �������� �������� ������� �������� ����� ��������� Load()

    $("#pac_text").val(""); // ������� ���� ����� ���������
    $("#pac_text").focus(); // � �������� �� ���� �����
    
    return false; // ����� ����� �� Send() ������� false. ���� ����� �� ������� �� ��������� �������� ����� �����, �� �������� ��������������
}

var last_message_id = 0; // ����� ���������� ���������, ��� ������� ������������
var load_in_process = false; // ����� �� �� ��������� ������ �������� ���������. ������� ����� false, ��� ������ - ��, �����

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
