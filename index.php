<?
    require "config/config.php";
    require "model/table_create.php";
    require "model/user.php";
    require "model/auth.php";
    require "model/template.php";
    require "config/smarty.php";

    session_start();

    if ($_GET["logout"] == true) {
        session_destroy();
        header("Location: /");
    }

    $button = $_POST["send"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $logout = join('', file("view/auth/logout.tpl"));

    $smarty = new Smarty_Message();

    include "session.php";
    $smarty->assign("logout", $logout);
    $smarty->display("application.tpl");

?>
