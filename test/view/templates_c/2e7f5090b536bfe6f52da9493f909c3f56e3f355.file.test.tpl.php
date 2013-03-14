<?php /* Smarty version Smarty-3.1.13, created on 2013-03-14 17:02:12
         compiled from "view\templates\test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45325141d7d0435ca4-67760577%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e7f5090b536bfe6f52da9493f909c3f56e3f355' => 
    array (
      0 => 'view\\templates\\test.tpl',
      1 => 1363269727,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45325141d7d0435ca4-67760577',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5141d7d0646fa2_29128007',
  'variables' => 
  array (
    'go' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5141d7d0646fa2_29128007')) {function content_5141d7d0646fa2_29128007($_smarty_tpl) {?><center>
    <h1>Smarty!</h1>
</center>
<br>

  <?php echo $_smarty_tpl->tpl_vars['go']->value;?>



  <?php echo shuffle(array(3,5,1));?>

<?php }} ?>