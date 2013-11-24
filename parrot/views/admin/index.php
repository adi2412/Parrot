<?php if (auth::isLoggedIn() && auth::isAdmin()) : ?>
<!DOCTYPE html>
<html>
	<head>
		<!-- meta -->
		<title><?php echo siteinfo('title'); ?> :: Admin</title>
		<link rel="stylesheet" type="text/css" href="<?php echo admin_stylesheet(); ?>">
	</head>
	<body class="lightbg">
		<div class="bg">
			<div class="inner">
				<div class="content">
					<div class="right"><h1>Hi, <?php echo auth::getCurrentUser(); ?></h1></div>
				</div>
				<hr>
				<div class="content">
					<div class="grid-33">
						<h1>Categories</h1>
						<?php while(have_category()) : thecategory() ?>
							<a href="<?php echo cat_delete_link(); ?>"><h2 class="del"><?php echo cat_title(); ?></h2></a>
						<?php endwhile; ?>
						<form name="input" action="<?php echo cat_create_link(); ?>" method="post">
							<input class="left-input" name="title"><input type="submit" class="right-button" value="+"/>
						</form>
					</div>
					<div class="grid-33">
						<h1>Categories</h1>
					</div>
					<div class="grid-33">
						<h1>Categories</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="credit">Powered by Parrot</div>
	</body>
</html>

<?php else : ?>


<?php endif; ?>