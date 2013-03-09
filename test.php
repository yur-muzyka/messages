<?
require "config.php";
require "model/user.php";
require "model/auth.php";
require "model/template.php";  

session_start();
$user = Auth::current_user();
$user->password = "kuj";
$user->save();
?>
