<!DOCTYPE html>
<html>
	<head>
		<!-- meta -->
		<title><?php echo meta_title(); ?> :: Signup</title>
		<link rel="stylesheet" type="text/css" href="<?php echo admin_stylesheet(); ?>">
	</head>
	<body>
		<div class="wrap">
			<div class="inner">
				<div class="group">
					<form name="input" action="<?php echo signup_submitURL(); ?>" method="post">
						<input placeholder="Username" name="username"/><br/>
						<input placeholder="Name" name="name"/><br/>
						<input placeholder="Email" name="email"/><br/>
						<input placeholder="Password" name="password" type="password"/><br/>
						<input type="submit" class="submit" value="Signup"/>
					</form>
					<a href="<?php echo admin_loginLink(); ?>"><button class="light">Login</button></a><br/>
					<a href="<?php echo meta_URL(); ?>" class="small">&larr; Back to <?php echo meta_title(); ?></a>
				</div>
			</div>
		</div>
	</body>
</html>
