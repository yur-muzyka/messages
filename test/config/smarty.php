<?
require_once "../smarty/libs/Smarty.class.php";

class Test_Message extends Smarty {

   function Test_Message() {
        $this->__construct();
        $this->template_dir = 'view/templates/';
        $this->compile_dir = 'view/templates_c/';
        $this->config_dir = 'view/configs/';
        $this->cache_dir = 'view/cache/';
        //$this->caching = true;
        $this->assign('app_name', '-= Messages =-');
   }
}
?>
