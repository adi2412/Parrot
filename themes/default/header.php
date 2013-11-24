<!DOCTYPE html>
<html>
	<head>
		<!-- meta -->
		<title><?php echo siteinfo('title'); ?> :: <?php echo siteinfo('description'); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo the_stylesheet(); ?>">
	</head>
	<body>
		<header>
			<a href="<?php echo get_site_url(); ?>">
				<h1><?php echo siteinfo('title'); ?></h1>
			</a>
		</header>