<?
require "config.php";
require "model/user.php";
require "model/auth.php";
require "model/template.php";  
require "model/message.php";

session_start();

$message = Message::get_messages(2, 3, 19);
echo count($message);
?>
