<?
    require "config.php";
    require "model/table_create.php";
    require "model/user.php";
    require "model/auth.php";
    require "model/template.php";
    
    $template = new Template();

    $button = $_POST["send"];
    $login = $_POST["login"];
    $password = $_POST["password"];

    
    if ($button == "Cancel") {
        header('Location: /');
        exit;
    }

        $logout = join('', file("view/auth/logout.tpl"));
        $template->set_value("logout", $logout);

        include "session.php";

        $template->get_tpl("view/application.tpl");
        $template->tpl_parse();
        echo $template->html;
?>
