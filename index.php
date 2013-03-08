<?
    require "config.php";
    require "model/table_create.php";
    require "model/user.php";
    require "model/auth.php";
    require "model/template.php";
    
    $template = new Template();

    $login = $_POST["login"];
    $password = $_POST["password"];

        $logout = join('', file("view/auth/logout.tpl"));
        $template->set_value("logout", $logout);

        include "session.php";

        $template->get_tpl("view/application.tpl");
        $template->tpl_parse();
        echo $template->html;
?>
