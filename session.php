<?
session_start();

if($_GET["logout"] == true) {
    session_destroy();
    header("Location: /");
}
// when params recieved from login form
$is_logged = Auth::is_logged($login, $password);
if ($is_logged) {
    $_SESSION["login"] = $login;
    $_SESSION["password"] = $password;

    $user = Auth::current_user();
    unset($user->location);
    $user->save();
} 
// when session disable
if (!Auth::is_logged($_SESSION["login"], $_SESSION["password"])) {
    $template->get_tpl("view/auth/login_register.tpl");
    echo $template->html;                                                
    die();
}
?>
