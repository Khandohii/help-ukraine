<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset') ?>">
		<!-- Переключение IE в последнию версию, на случай если в настройках пользователя стоит меньшая -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Адаптирование страницы для мобильных устройств -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- Запрет распознования номера телефона -->
		<meta name="format-detection" content="telephone=no">
		<meta name="SKYPE_TOOLBAR" content ="SKYPE_TOOLBAR_PARSER_COMPATIBLE">

		<!-- Заголовок страницы -->
		<title><?php echo get_bloginfo() ?></title>

		<!-- Данное значение часто используют(использовали) поисковые системы -->
		<meta name="description" content="<?php echo get_bloginfo('description') ?>">
		<meta name="keywords" content="">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

		<?php wp_head(); ?>
	</head>

	<body>
		<div class="wrap">
			<div class="main">