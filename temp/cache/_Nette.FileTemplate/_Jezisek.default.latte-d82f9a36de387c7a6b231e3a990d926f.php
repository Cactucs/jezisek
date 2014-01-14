<?php //netteCache[01]000378a:2:{s:4:"time";s:21:"0.64103000 1388474837";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:58:"/var/www/jezisek/nette/app/templates/Jezisek/default.latte";i:2;i:1388474836;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:28:"$WCREV$ released on $WCDATE$";}}}?><?php

// source file: /var/www/jezisek/nette/app/templates/Jezisek/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'tt71e2ncft')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9567b1a3ce_content')) { function _lb9567b1a3ce_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<div>
		<h2>Přání blízkých</h2>

		<div class="panel-group" id="accordion">
<?php $iterations = 0; foreach ($gifts as $user => $usersGifts) { ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo htmlSpecialChars($template->safeurl($template->webalize($user))) ?>
" data-target="#<?php echo htmlSpecialChars($template->webalize($user)) ?>">
								<?php echo Nette\Templating\Helpers::escapeHtml($user, ENT_NOQUOTES) ?>

								<span class="badge"><?php echo Nette\Templating\Helpers::escapeHtml($template->count($usersGifts), ENT_NOQUOTES) ?> přání</span>
							</a>
						</h4>
					</div>
					<ul class="list-group panel-collapse collapse user-coll" id="<?php echo htmlSpecialChars($template->webalize($user)) ?>">
<?php $iterations = 0; foreach ($usersGifts as $gift) { ?>
							<li class="list-group-item"><a class="texty" data-toggle="collapse" data-target="#gift-more-<?php echo htmlSpecialChars($gift['id']) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($gift['name'], ENT_NOQUOTES) ?>

							<ul class="list-group collapse gift-description-list" id="gift-more-<?php echo htmlSpecialChars($gift['id']) ?>">
<?php if ($gift['description']) { ?>								<li class="list-group-item"><?php echo $template->linklinks(Nette\Templating\Helpers::escapeHtml($gift['description'], ENT_NOQUOTES)) ?></li>
<?php } if ($gift['plurality']) { ?>								<li class="list-group-item">Může být více</li>
<?php } if ($gift['isGiven']) { ?>								<li class="list-group-item"><?php echo Nette\Templating\Helpers::escapeHtml($gift['isGiven'] ? 'Už ho někdo dává' : 'Můžeš ho dát', ENT_NOQUOTES) ?></li>
<?php } if (!$gift['isGiven']) { ?>								<li class="list-group-item"><a href="<?php echo htmlSpecialChars($_control->link("jezisek:addGive", array($gift['id']))) ?>
">Chci splnit!</a></li>
<?php } ?>
							</ul></li>
<?php $iterations++; } ?>
					</ul>
				
									</div>
<?php $iterations++; } ?>
		<ul>
	</div>

<?php
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
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 