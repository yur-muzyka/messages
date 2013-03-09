<?
require "config.php";
require "model/user.php";
require "model/auth.php";
require "model/template.php";

session_start();
if (!Auth::is_logged($_SESSION["login"], $_SESSION["password"])) {
    die();
}

$user = Auth::current_user();

if (!$user->location) {
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
} else {
    $js = 'var ajax = $("#ajax").empty();';
    $js .= 'ajax.append("asd--------s");';
    echo $js;
}
?>
