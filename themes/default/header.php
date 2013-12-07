<!DOCTYPE html>
<html>
	<head>
		<title><?php echo siteinfo('title'); ?> :: <?php echo siteinfo('description'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo the_stylesheet(); ?>">
		<link rel="stylesheet" media="only screen and (max-width: 400px)" type="text/css" href="<?php echo get_theme_directory(); ?>small.css">
	</head>
	<body>
		<header>
			<a href="<?php echo get_site_url(); ?>">
				<h1><?php echo siteinfo('title'); ?></h1>
			</a>
		</header>