function Send() {
    // ¬ыполн€ем запрос к серверу с помощью jquery ajax: $.post(адрес, {параметры запроса}, функци€ котора€ вызываетс€ по завершению запроса)
    $.post("ajax.php",  
	{
        act: "send",  // указываем скрипту, что мы отправл€ем новое сообщение и его нужно записать
        name: $("#pac_name").val(), // им€ пользовател€
        text: $("#pac_text").val() //  сам текст сообщени€
    },
     Load ); // по завершению отправки вызвовем функцию загрузки новых сообщений Load()

    $("#pac_text").val(""); // очистим поле ввода сообщени€
    $("#pac_text").focus(); // и поставим на него фокус
    
    return false; // очень важно из Send() вернуть false. ≈сли этого не сделать то произойдЄт отправка нашей формы, те страница перезагрузитс€
}

var last_message_id = 0; // номер последнего сообщени€, что получил пользователь
var load_in_process = false; // можем ли мы выполн€ть сейчас загрузку сообщений. —начала стоит false, что значит - да, можем

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
    // ѕровер€ем можем ли мы загружать сообщени€. Ёто сделанно дл€ того, что бы мы не начали загрузку заново, если стара€ загрузка ещЄ не закончилась.
    if(!load_in_process)
    {
	    load_in_process = true; // загрузка началась
	    // отсылаем запрос серверу, который вернЄт нам javascript
    	$.post("ajax.php", 
    	{
      	    act: "load", // указываем на то что это загрузка сообщений
      	    last: last_message_id, // передаЄм номер последнего сообщени€ который получил пользователь в прошлую загрузку
      	    rand: (new Date()).getTime()
    	},
   	    function (result) { // в эту функцию в качестве параметра передаЄтс€ javascript код, который мы должны выполнить
		    eval(result); // выполн€ем скрипт полученный от сервера
		    $(".chat").scrollTop($(".chat").get(0).scrollHeight); // прокручиваем сообщени€ вниз
		    load_in_process = false; // говорим что загрузка закончилась, можем теперь начать новую загрузку
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
