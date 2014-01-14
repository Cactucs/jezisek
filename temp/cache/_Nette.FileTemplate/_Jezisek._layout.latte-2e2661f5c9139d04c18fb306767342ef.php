<?php //netteCache[01]000378a:2:{s:4:"time";s:21:"0.43922700 1388474497";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:58:"/var/www/jezisek/nette/app/templates/Jezisek/@layout.latte";i:2;i:1388412201;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:28:"$WCREV$ released on $WCDATE$";}}}?><?php

// source file: /var/www/jezisek/nette/app/templates/Jezisek/@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'h3prh4kdim')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbba0b297892_title')) { function _lbba0b297892_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Ježíšek<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb3d5843dd78_head')) { function _lb3d5843dd78_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb7f654268c4_content')) { function _lb7f654268c4_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	</div>



</body>
</html>
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
<?php if (isset($robots)) { ?>	<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>">
<?php } ?>

	<title><?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->upper($template->striptags(ob_get_clean()))  ?></title>

	<link rel="stylesheet" href="<?php echo htmlSpecialChars($template->safeurl($basePath)) ?>/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($template->safeurl($basePath)) ?>/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($template->safeurl($basePath)) ?>/css/style.css"> 
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($template->safeurl($basePath)) ?>/favicon.ico">
	<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>


	<script src="<?php echo htmlSpecialChars($template->safeurl($basePath)) ?>/js/jquery.js"></script>
	<script src="<?php echo htmlSpecialChars($template->safeurl($basePath)) ?>/js/netteForms.js"></script>
	<script src="<?php echo htmlSpecialChars($template->safeurl($basePath)) ?>/js/main.js"></script>
	<script src="<?php echo htmlSpecialChars($template->safeurl($basePath)) ?>/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

	<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsable">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="/"><span class="glyphicon glyphicon-gift"></span>   Ježíšek</a>
	  </div>
		<div class="collapse navbar-collapse" id="navbar-collapsable">
		  <ul class="nav navbar-nav">
		  	<li><a href="<?php echo htmlSpecialChars($_control->link("jezisek:default")) ?>
">Přání jiných</a></li>
		  	<li><a href="<?php echo htmlSpecialChars($_control->link("jezisek:myGifts")) ?>
">Moje přání</a></li>
		  	<li><a href="<?php echo htmlSpecialChars($_control->link("jezisek:gives")) ?>
">Dávám</a></li>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
<?php if (isset($jezisek)) { if ($jezisek != 'nikdo') { ?>				<p class="navbar-text">Jsi ježíšek pro <?php echo Nette\Templating\Helpers::escapeHtml($jezisek, ENT_NOQUOTES) ?></p>
<?php } if ($jezisek == 'nikdo') { ?>				<p class="navbar-text">Ještě nejsi ježíškem.</p>
<?php } } ?>
		  	<li><a href="<?php echo htmlSpecialChars($_control->link("settings:")) ?>">Nastavení</a></li>
		  	<li><a href="<?php echo htmlSpecialChars($_control->link("sign:out")) ?>">Odhlásit se</a></li>
		  </ul>
		</div><!--/.nav-collapse -->
	  </div>
	</nav>

	
<?php Nette\Latte\Macros\CoreMacros::includeTemplate('../components/flashes.latte', $template->getParameters(), $_l->templates['h3prh4kdim'])->render() ?>



	<div id="content">


<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 