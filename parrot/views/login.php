<!DOCTYPE html>
<html>
	<head>
		<!-- meta -->
		<title><?php echo siteinfo('title'); ?> :: Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo admin_stylesheet(); ?>">
	</head>
	<body>
		<div class="wrap">
			<div class="inner">
				<?php msg_read(); ?>
				<div class="group">
					<form name="input" action="<?php echo login_verifyURL(); ?>" method="post">
						<input placeholder="Username" name="username" class="full"/><br/>
						<input placeholder="Password" name="password" type="password" class="full"/><br/>
						<input type="submit" class="submit" value="Login"/>
					</form>
					<a href="<?php echo admin_signupLink(); ?>"><button class="light">Signup</button></a><br/><br/>
					<a href="<?php echo get_site_url(); ?>" class="small">&larr; Back to <?php echo siteinfo('title'); ?></a>
				</div>
			</div>
		</div>
	</body>
</html>
