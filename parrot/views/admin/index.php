<?php if (auth::isLoggedIn() && auth::isAdmin()) : ?>
<!DOCTYPE html>
<html>
	<head>
		<!-- meta -->
		<title><?php echo siteinfo('title'); ?> :: Admin</title>
		<link rel="stylesheet" type="text/css" href="<?php echo admin_stylesheet(); ?>">
	</head>
	<body>
		<div class="bg">
			<div class="inner">
				<div class="content">
					<div class="left"><h1 style="margin: 0px;"><a class="perma" href="http://<?php echo getenv(DOMAIN_NAME) . BASE; ?>">Visit site</a></h1></div>
					<div class="right"><h1 style="margin: 0px;">Hi, <?php echo auth::getCurrentUser(); ?></h1></div>
				</div>
				<hr>
				<div class="content">
					<?php msg_read(); ?>
					<div class="grid-33">
						<div class="inner">
							<h1>Categories</h1>
							<?php while(have_category()) : thecategory() ?>
								<a href="<?php echo cat_delete_link(); ?>"><h2 class="del"><?php echo cat_title(); ?></h2></a>
							<?php endwhile; ?>
							<form action="<?php echo cat_create_link(); ?>" method="post">
								<input class="left-input" name="title" autocomplete="off"><input type="submit" class="right-button" value="+"/>
							</form>
						</div>
					</div>
					<div class="grid-33">
						<div class="inner">
							<h1>Meta</h1>
							<form action="<?php echo info_update_link(); ?>" method="post">
								<h2>Name</h2>
								<input name="title" value="<?php echo siteinfo('title'); ?>" class="full" autocomplete="off">
								<h2>Description</h2>
								<input name="description" value="<?php echo siteinfo('description'); ?>" class="full" autocomplete="off">
								<h2>Theme</h2>
								<select name="theme">
									<?php foreach (get_themes() as $theme) : ?>
										<option value="<?php echo $theme['title']; ?>"><?php echo ucfirst($theme['title']); ?><?php echo ucfirst($theme['description']); ?></option>
									<?php endforeach; ?>
								</select>
								<input type="submit" class="submit" value="Update">
							</form>
						</div>
					</div>
					<div class="grid-33">
						<div class="inner">
							<h1>Users</h1>
							<?php while(have_user()) : theuser() ?>
								<div class="details">
									<div class="col">
										<a href="<?php echo user_delete_link(); ?>"><h2 class="del"><?php echo user_username(); ?></h2></a>
									</div>
									<div class="col">
										<a href="<?php echo user_premote_link(); ?>"><h2>Premote</h2></a>
									</div>
									<div class="col">
										<a href="<?php echo user_demote_link(); ?>"><h2>Demote</h2></a>
									</div>
									<div class="lastcol">
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="credit">
			<h1><a class="perma" href="https://github.com/Codingbean/Parrot">Powered by Parrot</a></h1>
		</div>
	</body>
</html>

<?php else : ?>


<?php endif; ?>