<?
$host = "localhost";
$user = "root";
$password = "";
$db = "messages";

$connect = mysql_connect($host, $user, $password);
mysql_select_db($db, $connect);
?>
