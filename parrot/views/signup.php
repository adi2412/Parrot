<!DOCTYPE html>
<html>
	<head>
		<!-- meta -->
		<title><?php echo siteinfo('title'); ?> :: Signup</title>
		<link rel="stylesheet" type="text/css" href="<?php echo admin_stylesheet(); ?>">
	</head>
	<body>
		<div class="wrap">
			<div class="inner">
				<?php msg_read(); ?>
				<div class="group">
					<form name="input" action="<?php echo signup_submitURL(); ?>" method="post">
						<input placeholder="Username" name="username" class="full"/><br/>
						<input placeholder="Name" name="name" class="full"/><br/>
						<input placeholder="Email" name="email" class="full"/><br/>
						<input placeholder="Password" name="password" type="password" class="full"/><br/>
						<input type="submit" class="submit" value="Signup"/>
					</form>
					<a href="<?php echo admin_loginLink(); ?>"><button class="light">Login</button></a><br/><br/>
					<a href="<?php echo get_site_url(); ?>" class="small">&larr; Back to <?php echo siteinfo('title'); ?></a>
				</div>
			</div>
		</div>
	</body>
</html>
