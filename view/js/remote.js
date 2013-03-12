$(document).ready(function () {
    $("#m_form").submit(Send);
    //$("#m_text").focus();    
    
}); 

function butt() {
     $(".btnSubmit").unbind('click');
     $(".btnSubmit").click(function(){
         if ($(this).val() == "Cancel") {
            editScrollTop = $(window).scrollTop();

            //$.post("ajax.php", {          
                action = "cancel";
                m_id = $("#m_id").val();
                m_text = $("#text").val();
                edit = "true";
            //}),
            Load(); 
         } else if ($(this).val() == "Save") { 
            $.post("controller/message.php", {
                action: "save",
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
}

function remote() {
    $(".remote").unbind('click');
    $(".remote").click(function() {
        parameters = $(this).attr('href').split('?')[1];
		$.get( $(this).attr('href'), function() {
        });
        editScrollTop = $(window).scrollTop();
        edit = parseParams(parameters)["edit"];
        Load();
		return false;
    }); 
}  

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

