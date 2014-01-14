<?php //netteCache[01]000376a:2:{s:4:"time";s:21:"0.24280100 1388474958";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:56:"/var/www/jezisek/nette/app/templates/Jezisek/gives.latte";i:2;i:1388474950;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:28:"$WCREV$ released on $WCDATE$";}}}?><?php

// source file: /var/www/jezisek/nette/app/templates/Jezisek/gives.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'fuq25xo38p')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb04180003b9_content')) { function _lb04180003b9_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<div>
		<h2>Plním přání:</h2>
		<ul>
<?php $iterations = 0; foreach ($gives as $gift) { ?>
				<li><?php echo Nette\Templating\Helpers::escapeHtml($gift['user'], ENT_NOQUOTES) ?>
: <?php echo Nette\Templating\Helpers::escapeHtml($gift['name'], ENT_NOQUOTES) ?></li>
				<ul>
<?php if ($gift['description']) { ?>					<li><?php echo $template->linklinks(Nette\Templating\Helpers::escapeHtml($gift['description'], ENT_NOQUOTES)) ?></li>
<?php } if ($gift['plurality']) { ?>					<li><?php echo Nette\Templating\Helpers::escapeHtml($gift['plurality'] ? 'Možno více' : NULL, ENT_NOQUOTES) ?></li>
<?php } ?>
					<li><a href="<?php echo htmlSpecialChars($_control->link("jezisek:deleteGive", array($gift['id']))) ?>
">Nesplním!</a></li>
				</ul>
<?php $iterations++; } ?>
		</ul>
	</div><?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 