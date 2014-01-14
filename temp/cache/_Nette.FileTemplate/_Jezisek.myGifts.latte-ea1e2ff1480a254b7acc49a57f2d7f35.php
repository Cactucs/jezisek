<?php //netteCache[01]000378a:2:{s:4:"time";s:21:"0.90339500 1388474965";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:58:"/var/www/jezisek/nette/app/templates/Jezisek/myGifts.latte";i:2;i:1388474944;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:28:"$WCREV$ released on $WCDATE$";}}}?><?php

// source file: /var/www/jezisek/nette/app/templates/Jezisek/myGifts.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'lm45e3s0h3')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb58be05e9a9_content')) { function _lb58be05e9a9_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<div>
		<h2>Moje přání</h2>
		<p><a class="texty" href="<?php echo htmlSpecialChars($_control->link("jezisek:addGift")) ?>
"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span>   Přidat přání</button></a></p>
	
<?php $iterations = 0; foreach ($myGifts as $gift) { ?>
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><?php echo Nette\Templating\Helpers::escapeHtml($gift['name'], ENT_NOQUOTES) ?></h3>
				</div>
				<div class="panel-body">
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-default">
								<a class="texty" href="<?php echo htmlSpecialChars($_control->link("jezisek:editGift", array($gift['id']))) ?>
">
									<span class="glyphicon glyphicon-pencil"></span>
								</a>
							</button>
							<button type="button" class="btn btn-default">
								<a class="texty" href="<?php echo htmlSpecialChars($_control->link("jezisek:deleteGift", array($gift['id']))) ?>
">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</button>
						</div>
					<ul>
<?php if ($gift['description']) { ?>						<li><?php echo $template->linklinks(Nette\Templating\Helpers::escapeHtml($gift['description'], ENT_NOQUOTES)) ?></li>
<?php } ?>
						<li><?php echo Nette\Templating\Helpers::escapeHtml($gift['plurality'] ? 'Možno více' : 'Jeden', ENT_NOQUOTES) ?></li>
					</ul>

				</div>
			</div>
<?php $iterations++; } ?>
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