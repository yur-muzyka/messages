<?
    require "config.php";
    require "model/user.php";

    $login = $_POST["login"];
    $password = $_POST["password"];

    if (!$login || !$password) {
        echo "fields can not be empty";
    } elseif (User::find_by_login($login)) {
        echo "Already in use";
    } else {
        User::create($login, $password);
        echo "ok";
    }
?>
