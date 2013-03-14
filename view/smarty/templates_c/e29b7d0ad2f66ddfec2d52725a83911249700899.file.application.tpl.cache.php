<?php /* Smarty version Smarty-3.1.13, created on 2013-03-14 14:15:24
         compiled from "view\smarty\templates\application.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191565141af5eaa9ae4-98232629%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e29b7d0ad2f66ddfec2d52725a83911249700899' => 
    array (
      0 => 'view\\smarty\\templates\\application.tpl',
      1 => 1363259720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191565141af5eaa9ae4-98232629',
  'function' => 
  array (
  ),
  'cache_lifetime' => 3600,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5141af5ec3ccf1_33911217',
  'variables' => 
  array (
    'logout' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5141af5ec3ccf1_33911217')) {function content_5141af5ec3ccf1_33911217($_smarty_tpl) {?><html>
    <head>
        <title>Users</title>
        <link rel="stylesheet" type="text/css" media="screen" href="view/css/css.css" />
        <script type="text/javascript" src="view/js/jquery.js"></script>
        <script type="text/javascript" src="view/js/custom.js"></script>
    </head>
    <body>
    <center>
            <table style="width: 50%;">
                <tr>
                    <td align="right">
                        <?php echo $_smarty_tpl->tpl_vars['logout']->value;?>

                        <hr>
                    </td>
                </tr>
            </table>
        </center>
        <div id="header"></div>
        <div id="ajax"></div>
        <div id="footer"></div>
    </body>
</html>

<?php }} ?>