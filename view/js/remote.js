$(document).ready(function () {
    $("#m_form").submit(Send);
    //$("#m_text").focus();    
    
}); 

function butt() {
    $(".btnSubmit").unbind('click');
    $(".btnSubmit").click(function(){
        if ($(this).val() == "Cancel") {
            editScrollTop = $(window).scrollTop();
            action = "cancel";
            m_id = $("#m_id").val();
            m_text = $("#text").val();
            edit = true;
        } else if ($(this).val() == "Save") { 
            $.post("controller/message.php", {
                action: "save",
                id: $("#m_id").val(), 
                text: $("#text").val() 
            }, function() {
                return false;
            });
            action = "save";
            m_id = $("#m_id").val();
            m_text = $("#text").val();
            edit = true;
        }
        editScrollTop = $(window).scrollTop();
        edit = "false";
        last_edit = null;
        Load(); 
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
        if (parseParams(parameters)["edit"]) {
            edit = parseParams(parameters)["edit"];
        } else if (parseParams(parameters)["delete"]) {
            del = parseParams(parameters)["delete"];
        }
        if (parseParams(parameters)["opponent_id"]) {
            layout="true";
            last_message_id = 0;
            $("#ajax").empty();
            $("#header").empty();
            $("#footer").empty();
            
            opponent_id = parseParams(parameters)["opponent_id"];
        }
        if (last_edit) {
            replace_previous_edit();
        }
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

