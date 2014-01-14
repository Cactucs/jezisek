<?php //netteCache[01]000378a:2:{s:4:"time";s:21:"0.36643900 1388474730";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:58:"/var/www/jezisek/nette/app/templates/components/form.latte";i:2;i:1388334372;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:28:"$WCREV$ released on $WCDATE$";}}}?><?php

// source file: /var/www/jezisek/nette/app/templates/components/form.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ara63wmng6')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = is_object($form) ? $form : $_control[$form], array()) ;if ($form->ownErrors) { ?><ul class=error>
<?php $iterations = 0; foreach ($form->ownErrors as $error) { ?>	<li><?php echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
</ul>
<?php } ?>

<table>
<?php $iterations = 0; foreach ($form->controls as $input) { ?><tr<?php if ($_l->tmp = array_filter(array($input->required ? 'required' : NULL))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>
	<th><?php $_input = is_object($input) ? $input : $_form[$input]; if ($_label = $_input->getLabel()) echo $_label  ?></th>
	<td>
		<div class="input-group">
<?php $_input = is_object($input) ? $input : $_form[$input]; echo $_input->getControl()->addAttributes(array('class' => 'form-control')) ?>
			
		</div>
<?php ob_start() ?>		<span class=error><?php ob_start() ;echo Nette\Templating\Helpers::escapeHtml($input->error, ENT_NOQUOTES) ;$_ifcontent = ob_get_length(); ob_end_flush() ?></span>
<?php $_ifcontent ? ob_end_flush() : ob_end_clean() ?>
	</td>
</tr>
<?php $iterations++; } ?>
</table>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>

