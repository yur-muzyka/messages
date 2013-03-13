<?
    require "../config.php";
    require "../model/user.php";

    $login = $_POST["login"];
    $password = $_POST["password"];
    $button = $_POST["send"];

    if ($button == "Cancel") {
        header('Location: /');
        exit;
    }

    if (!$login || !$password) {
        echo "<center><br><br><br><br>fields can not be empty</center>";
    } elseif (User::find_by_login($login)) {
        echo "<center><br><br><br><br>Already in use</center>";
    } else {
        User::create($login, $password);
        echo "<center><br><br><br><br><h1><a href=\"/\">ok</a></h1>";
    }
?>
