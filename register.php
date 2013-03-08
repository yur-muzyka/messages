<?
    require "config.php";
    require "model/user.php";

    $login = $_POST["login"];
    $password = $_POST["password"];

    if (User::find_by_login($login)) {
        echo "Already in use";
    } else {
        User::create($login, $password);
        echo "ok";
    }
?>
