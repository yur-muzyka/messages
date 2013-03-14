<?
    require "config/smarty.php";
    $smarty = new Test_Message();
    $smarty->assign("go", "go!");
    $smarty->display("test.tpl");   
?>
