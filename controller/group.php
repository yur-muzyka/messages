<?
require "../config.php";
require "../model/user.php";
require "../model/auth.php";
require "../model/message.php";

session_start();
if (!Auth::is_logged($_SESSION["login"], $_SESSION["password"])) {
    die();
}

$user = Auth::current_user();
$delete = $_GET["delete"];

if ($delete) {
    Message::group_delete($delete, $user->id);
}    
?>
