<?php
/* Smarty version 4.0.4, created on 2022-04-04 17:48:41
  from '/Avalon/sites/FoxRadio/www/templates/default/main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.4',
  'unifunc' => 'content_624b0549999926_20489834',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a4c10ae53f47326fb4c756a9d8258011559274b' => 
    array (
      0 => '/Avalon/sites/FoxRadio/www/templates/default/main.tpl',
      1 => 1649083691,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:components/logo.tpl' => 1,
    'file:components/nav.tpl' => 1,
    'file:components/radioPlayer.tpl' => 1,
    'file:components/advert.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_624b0549999926_20489834 (Smarty_Internal_Template $_smarty_tpl) {
?><html>

	<?php $_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<body id="content">
		<?php echo $_smarty_tpl->tpl_vars['builtInJS']->value;?>

		<div class="animate__animated animate__BounceInRight animate__delay-1s menu-top">
			<?php $_smarty_tpl->_subTemplateRender('file:components/logo.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php $_smarty_tpl->_subTemplateRender('file:components/nav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</div>

		<main ID="mainCont" class="animate__animated animate__jackInTheBox animate__delay-2s">
				<div class="wrap">
					<div class="wrap-ribbon">
						<div class="ribbon">FEATURE!</div>
					</div>
				</div>
			<?php echo $_smarty_tpl->tpl_vars['profile']->value;?>

			<div class="animate__animated animate__backInUp animate__delay-3s contInner">
				<?php $_smarty_tpl->_subTemplateRender('file:components/radioPlayer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			</div>
		</main>
		<?php $_smarty_tpl->_subTemplateRender('file:components/advert.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</body>
	<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</html><?php }
}
