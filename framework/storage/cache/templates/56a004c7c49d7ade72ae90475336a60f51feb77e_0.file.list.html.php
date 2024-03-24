<?php
/* Smarty version 4.4.1, created on 2024-03-08 15:05:35
  from 'D:\xampp\htdocs\MVC\3\catalog\view\customers\list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_65eb1b2fbd2988_49857917',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56a004c7c49d7ade72ae90475336a60f51feb77e' => 
    array (
      0 => 'D:\\xampp\\htdocs\\MVC\\3\\catalog\\view\\customers\\list.html',
      1 => 1709906686,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65eb1b2fbd2988_49857917 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers</title>
</head>
<body>


Total numbers = <?php echo $_smarty_tpl->tpl_vars['data']->value['customers_count'];?>
 <br /><br />
<?php
$__section_xyz_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['data']->value['customers_list']) ? count($_loop) : max(0, (int) $_loop));
$__section_xyz_0_total = $__section_xyz_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_xyz'] = new Smarty_Variable(array());
if ($__section_xyz_0_total !== 0) {
for ($__section_xyz_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_xyz']->value['index'] = 0; $__section_xyz_0_iteration <= $__section_xyz_0_total; $__section_xyz_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_xyz']->value['index']++){
echo $_smarty_tpl->tpl_vars['data']->value['customers_list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_xyz']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_xyz']->value['index'] : null)]['id'];?>
  --- <?php echo $_smarty_tpl->tpl_vars['data']->value['customers_list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_xyz']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_xyz']->value['index'] : null)]['name'];?>
<br>
<?php
}
}
?>
</body>
</html><?php }
}
