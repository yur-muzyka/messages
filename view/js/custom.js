$(document).ready(function () {
    $("#pac_form").submit(Send);
    $("#pac_text").focus();
    setInterval("Load();", 2000);
	Load();
});

function Send() {
    // Выполняем запрос к серверу с помощью jquery ajax: $.post(адрес, {параметры запроса}, функция которая вызывается по завершению запроса)
    $.post("ajax.php",  
	{
        act: "send",  // указываем скрипту, что мы отправляем новое сообщение и его нужно записать
        name: $("#pac_name").val(), // имя пользователя
        text: $("#pac_text").val() //  сам текст сообщения
    },
     Load ); // по завершению отправки вызвовем функцию загрузки новых сообщений Load()

    $("#pac_text").val(""); // очистим поле ввода сообщения
    $("#pac_text").focus(); // и поставим на него фокус
    
    return false; // очень важно из Send() вернуть false. Если этого не сделать то произойдёт отправка нашей формы, те страница перезагрузится
}

var last_message_id = 0; // номер последнего сообщения, что получил пользователь
var load_in_process = false; // можем ли мы выполнять сейчас загрузку сообщений. Сначала стоит false, что значит - да, можем

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
