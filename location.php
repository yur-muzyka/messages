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

if ($_GET["id"]) {
    $user->location = $_GET["id"];
    $user->save();
} elseif ($_GET["reset"]) {
    unset($user->location);
    $user->save();
}

?>
