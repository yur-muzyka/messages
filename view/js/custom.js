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

function load_groups() {
    if(!load_in_process) {
	    load_in_process = true;
    	$.post("ajax.php", {
      	    act: "load_groups",
    	},
   	    function (result) {
		    eval(result);
		    load_in_process = false;
    	});
    }
}

function Load() {
    // ��������� ����� �� �� ��������� ���������. ��� �������� ��� ����, ��� �� �� �� ������ �������� ������, ���� ������ �������� ��� �� �����������.
    if(!load_in_process)
    {
	    load_in_process = true; // �������� ��������
	    // �������� ������ �������, ������� ����� ��� javascript
    	$.post("ajax.php", 
    	{
      	    act: "load", // ��������� �� �� ��� ��� �������� ���������
      	    last: last_message_id, // ������� ����� ���������� ��������� ������� ������� ������������ � ������� ��������
      	    rand: (new Date()).getTime()
    	},
   	    function (result) { // � ��� ������� � �������� ��������� ��������� javascript ���, ������� �� ������ ���������
		    eval(result); // ��������� ������ ���������� �� �������
		    $(".chat").scrollTop($(".chat").get(0).scrollHeight); // ������������ ��������� ����
		    load_in_process = false; // ������� ��� �������� �����������, ����� ������ ������ ����� ��������
    	});
    }
}




$(function() {
    $("#change_status").click(function(e) {
        post();
      e.preventDefault();

    });
  });

  function post() {
    $.post("ajax.php", {
            act: "send" }, 
            Load );
  }

<!--<a id="change_status" href="/">jquery</a>-->
