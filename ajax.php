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
    foreach ($all_users as $user) {
        if (Auth::current_user()->login == $user->login) {
            continue;
        }
        $count++;
        $users_tpl->set_value("login", $user->login);
        $users_tpl->set_value("count", $count);
        $users_tpl->set_value("id", $user->id);
        $users_tpl->tpl_parse();
        $users_list .= $users_tpl->html;
    } 

    $js = 'var ajax = $("#ajax").empty();';
    $js .= 'ajax.append("'. mysql_real_escape_string($users_list) .'");';
    $js .= join('', file("view/js/remote.js"));
    echo $js;
} else {               // messages view
    $messages = $user->get_messages($user->location);

    $main_tpl = new Template();
    $messages_tpl = new Template();
    $messages_tpl->get_tpl("view/_messages.tpl");
    foreach ($messages as $message) {
        $from = User::find($message->author_id);
        $messages_tpl->set_value("author", $from->login);
        $messages_tpl->set_value("text", $message->text);
        $messages_tpl->tpl_parse();
        $messages_list .= $messages_tpl->html;
    } 
    $main_tpl->get_tpl("view/messages.tpl");
    $main_tpl->set_value("messages", $messages_list);
    $main_tpl->set_value("opponent", User::find($user->location)->login);
    $main_tpl->set_value("text_area", join('', file("view/_text_area.html")));
    $main_tpl->tpl_parse();
    

    $js = 'var ajax = $("#ajax").empty();';
    $js .= 'ajax.append("'. mysql_real_escape_string($main_tpl->html) .'");';
    $js .= join('', file("view/js/remote.js"));
    echo $js;
}
?>
