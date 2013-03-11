$(document).ready(function () {
    $("#m_form").submit(Send);
    //$("#m_text").focus();    
}); 



$(function() {
     $(".btnSubmit").click(function(){
         if ($(this).val() == "Cancel") {
            editScrollTop = $(window).scrollTop();

            $.post("controller/message.php", {
                action: "edit",
                id:  $("#m_id").val(),
                text: $("#text").val()
            }),



            //$("#ajax").empty();
            //last_message_id = 0;  
            edit = "false";
            Load(); 
         } else if ($(this).val() == "Save") { 
            $.post("controller/message.php", {
                action: "edit",
                id:  $("#m_id").val(),
                text: $("#text").val()
            }),
         editScrollTop = $(window).scrollTop();
         $("#ajax").empty();
         last_message_id = 0;  
         edit = "false";
         Load(); 
         }
         return false;
    });  
});

$(function() {
    $(".remote").click(function() {
        parameters = $(this).attr('href').split('?')[1];
		$.get( $(this).attr('href'), function() {
        });
        editScrollTop = $(window).scrollTop();
                    //$("#ajax").replaceWith("lol");


var str = $("#ajax").html();
var regex = /a/gi;
$("#ajax").html(str.replace(regex, "\n"));



        //$("#ajax").empty();
        //$("#header").empty();
        //$("#footer").empty();
        //layout = false;
        //last_message_id = 0;
        edit = parseParams(parameters)["edit"];
        Load();
		return false;
    }); 
});     

function parseParams(aURL) {
	var vars = {};
	var hashes = aURL.slice(aURL.indexOf('#') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
       var hash = hashes[i].split('=');
       if(hash.length > 1) {
    	   vars[hash[0]] = hash[1];
       } else {
     	  vars[hash[0]] = null;
       }      
    }
    return vars;
}

