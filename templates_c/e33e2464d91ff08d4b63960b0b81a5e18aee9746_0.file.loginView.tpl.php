<?php
/* Smarty version 3.1.39, created on 2021-05-04 17:33:44
  from 'C:\Serwery i inne szmery\xamp\htdocs\projekt10_bd\app\views\loginView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60916958575767_77532476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e33e2464d91ff08d4b63960b0b81a5e18aee9746' => 
    array (
      0 => 'C:\\Serwery i inne szmery\\xamp\\htdocs\\projekt10_bd\\app\\views\\loginView.tpl',
      1 => 1619462498,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_60916958575767_77532476 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8039577266091695856f4d3_75356583', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'content'} */
class Block_8039577266091695856f4d3_75356583 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_8039577266091695856f4d3_75356583',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


        <div class="box">
	<div class="content">
            <h2 class="align-center">Logowanie</h2>
            <hr />
            <div class="l-box-lrg pure-u-1 pure-u-med-2-5" style="width:30%;margin: 2em auto;">
		<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
login" method="post">
                    <fieldset>
		<div class="field half first">
                    <label for="id_login">Login:</label>
                    <input name="login" id="id_login" type="text" placeholder="login" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->login;?>
">
		</div>
		<div class="field half">
                    <label for="id_pass">Hasło:</label>
                    <input name="pass" id="id_pass" type="password" placeholder="hasło" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->pass;?>
">
		</div>
		<ul class="actions align-center">
                    <li><input value="Zaloguj" class="button special" type="submit"></li>
		</ul>
                    </fieldset>
		</form>
	</div>
    </div>
    </div>

<?php $_smarty_tpl->_subTemplateRender('file:messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php
}
}
/* {/block 'content'} */
}
