<?
require_once "smarty/libs/Smarty.class.php";

class Smarty_Message extends Smarty {

   function Smarty_Message() {
        $this->__construct();
        $this->template_dir = 'view/smarty/templates/';
        $this->compile_dir = 'view/smarty/templates_c/';
        $this->config_dir = 'view/smarty/configs/';
        $this->cache_dir = 'view/smarty/cache/';
        //$this->caching = true;
        $this->assign('app_name', '-= Messages =-');
   }

}
?>
