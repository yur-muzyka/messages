<?
require "config.php";
require "model/user.php";
require "model/auth.php";
require "model/template.php";
require "model/message.php";

session_start();
if (!Auth::is_logged($_SESSION["login"], $_SESSION["password"])) {
    die();
}

$user = Auth::current_user();

if ($_POST["act"] == "send") {
    $text = $_POST["text"];
    Message::create($text, $user->id, $user->location);
    die();
}

if (!$user->location) {      // groups view
    $all_users = User::find_all();
    $users_tpl = new Template();
    $users_tpl->get_tpl("view/_users.tpl");
    foreach ($all_users as $us) {
        if (Auth::current_user()->login == $us->login) {
            continue;
        }
        $count++;
        $users_tpl->set_value("login", $us->login);
        $users_tpl->set_value("count", $count);
        $users_tpl->set_value("mess_all", count(Message::get_messages($user->id, $us->id, 0)));
        $users_tpl->set_value("mess_new", count(Message::get_new_messages($user->id, $us->id)));
        $users_tpl->set_value("id", $us->id);
        $users_tpl->tpl_parse();
        $users_list .= $users_tpl->html;
    } 

    $js = 'var ajax = $("#ajax").empty();';
    $js .= 'ajax.append("'. mysql_real_escape_string($users_list) .'");';
    $js .= join('', file("view/js/remote.js"));
    echo $js;
} else {               // messages view
    $edit = $_POST["edit"];
    $action = $_POST["action"];
    $message_id = $_POST["m_id"];
    $message_text = $_POST["m_text"];
    $js .= 'var ajax = $("#ajax");';

    // header and footer(text_area)
    $layout = $_POST["layout"];

    $last_message_id = $_POST["last_message_id"];
    $messages = Message::get_messages($user->id, $user->location, $last_message_id);

    if ($layout == "null") {
        $header_tpl = new Template();
        $footer_tpl = new Template();
        $header_tpl->get_tpl("view/_messages_header.tpl");
        $header_tpl->set_value("opponent", User::find($user->location)->login);
        $header_tpl->tpl_parse();

        $footer_tpl->get_tpl("view/_text_area.tpl");

        $js .= 'var header = $("#header");';
        $js .= 'var footer = $("#footer");';
        $js .= 'header.append("'. mysql_real_escape_string($header_tpl->html) .'");';
        $js .= 'footer.append("'. mysql_real_escape_string($footer_tpl->html) .'");';
        $js .= 'layout=true;';
    }

    // messages load
    if (count($messages) > 0) {
        $message_tpl = new Template();
        foreach ($messages as $message) {
                if ($edit == $message->id) {
                    $message_tpl->get_tpl("view/_message_edit.tpl");
                } else {
                    $message_tpl->get_tpl("view/_message.tpl");
                }
            $author = User::find($message->author_id);
            $message_tpl->set_value("author", $author->login);
            $message_tpl->set_value("text", $message->text);
            $message_tpl->set_value("id", $message->id);
            $message_tpl->tpl_parse();
            $messages_list .= $message_tpl->html;
        } 
        $last_message_id = end($messages)->id;
        $js .= 'last_message_id='. $last_message_id .';';
        $js .= 'ajax.append("'. mysql_real_escape_string($messages_list) .'");';
    }
    
    $del = $_POST["del"];
    // ajax_replace
    if ($edit) {
        if ($action == "cancel" || $action == "save") {
            $message = Message::find($message_id);
            $author = User::find($message->author_id);
            $standard_text = $message->text;
            $replace_to = create_message_html("view/_message.tpl", $message_id, $author->login, $standard_text);
            $js .= 'replace_from = "#m_'.$message_id.'";';
            $js .= 'replace_to = "'. mysql_real_escape_string($replace_to) .'";';
        } else if ($del != "null") {
            $js .= 'replace_from = "#m_'. $del .'";';
            $js .= 'replace_to = "";';
        }
        
        
        
        else if ($edit != "null") {
            $message = Message::find($edit);
            $author = User::find($message->author_id);
            $replace_to = create_message_html("view/_message_edit.tpl", $edit, "", $message->text); 
            $last_edit = create_message_html("view/_message.tpl", $edit, $author->login, $message->text); 
            $js .= 'replace_from = "#m_'.$edit.'";';
            $js .= 'replace_to = "'. mysql_real_escape_string($replace_to) .'";';
            $js .= 'last_edit = ["#m_'.$edit. '", "'.mysql_real_escape_string($last_edit) .'"];'; 
        }
    }


    $js .= join('', file("view/js/remote.js"));
    echo $js;
}

function create_message_html($templ_path, $id, $author, $text) {
    $tpl = new Template();
    $tpl->get_tpl($templ_path);
    $tpl->set_value("author", $author);
    $tpl->set_value("text", $text);
    $tpl->set_value("id", $id);
    $tpl->tpl_parse();
    return $tpl->html;
}


?>
