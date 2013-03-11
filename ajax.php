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
        $users_tpl->set_value("mess_all", count(Message::get_messages($user->id, $us->id)));
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
    $js = 'var ajax = $("#ajax");';
    if ($_POST["edit"]) {
        $edit = $_POST["edit"];
        $js .= "edit=".$edit.";";
    }

    $last_message_id = $_POST["last_message_id"];

    $messages = Message::get_messages($user->id, $user->location, $last_message_id);
    //$main_tpl = new Template();
 
    if (count($messages) > 0) {
        $message_tpl = new Template();
        foreach ($messages as $message) {
                if ($edit == $message->id) {
                    $message_tpl->get_tpl("view/_message_edit.tpl");
                } else {
                    $message_tpl->get_tpl("view/_message.tpl");
                }
            $from = User::find($message->author_id);
            $message_tpl->set_value("author", $from->login);
            $message_tpl->set_value("text", $message->text);
            $message_tpl->set_value("id", $message->id);
            $message_tpl->tpl_parse();
            $messages_list .= $message_tpl->html;
        } 
        $last_message_id = end($messages)->id;
        $js .= 'last_message_id='. $last_message_id .';';
        $js .= 'ajax.append("'. mysql_real_escape_string($messages_list) .'");';
    }

    //$main_tpl->get_tpl("view/messages.tpl");
    //$main_tpl->set_value("messages", $messages_list);
    //$main_tpl->set_value("opponent", User::find($user->location)->login);
    //$main_tpl->set_value("text_area", join('', file("view/_text_area.html")));
    //$main_tpl->tpl_parse();
    

    $js .= join('', file("view/js/remote.js"));
    echo $js;
}
?>
