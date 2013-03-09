<?
require "config.php";
require "model/user.php";
require "model/auth.php";
require "model/template.php";  
require "model/message.php";

session_start();
$user = Auth::current_user();

var_dump($user->get_messages(3));


?>
