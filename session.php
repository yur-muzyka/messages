<?
// when params recieved from login form
$is_logged = Auth::is_logged($login, $password);
if ($is_logged) {
    $_SESSION["login"] = $login;
    $_SESSION["password"] = $password;
} 
// when session disable
if (!Auth::is_logged($_SESSION["login"], $_SESSION["password"])) {
    $smarty->display("auth/login_register.tpl");
    die();
}
?>
