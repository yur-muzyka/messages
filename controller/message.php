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
$action = $_POST["action"];
$id = $_POST["id"];
$text = $_POST["text"];
$delete = $_GET["delete"];

if ($action && $action == "edit") {
    $message = Message::find($id);
    $message->text = $text;
    $message->save();
}

if ($delete) {
    Message::delete($delete, $user->id);
}    
?>
