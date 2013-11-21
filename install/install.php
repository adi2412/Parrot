<?php if (!file_exists(PATH . 'config' . EXT)) : ?>
	<!DOCTYPE html>
	<html>
		<head>
			<!-- meta -->
			<title>Install Parrot</title>
			<style type="text/css">
				html {
					height: 100%;
				}

				body {
					font-family: "Helvetica Neue", sans-serif;
					margin: 0px;
					padding: 0px;
					height: 100%;
					background-color: #4A4A4A;
				}

				hr {
					width: 100%;
					border-style: solid;
					height: 3px;
					border-width: 0px;
					border-top-width: 2px;
					border-top-color: #4A4A4A;
					border-bottom-width: 1px;
					border-bottom-color: #E8E8E8;
					margin-top: 20px;
					margin-bottom: 20px;
				}

				h1 {
					font-weight: 400;
					font-size: 14px;
					text-decoration: none;
					text-align: left;
					color: #E8E8E8;
					margin-bottom: 20px;
				}

				h2 {
					margin: 0px;
					margin-top: 10px;
					margin-bottom: 5px;
					font-size: 13px;
					text-align: left;
					text-decoration: none;
					color: #B8B8B8;
					font-weight: 300;
				}

				input {
					padding: 8px;
					border-width: 1px;
					border-style: solid;
					border-color: #C4C4C4;
					border-radius: 3px;
					margin-bottom: 10px;
					width: 100%;
					color: #B8B8B8;
					-webkit-box-sizing: border-box;
				    -moz-box-sizing: border-box;
				    box-sizing: border-box;
				}

				input:focus {
					background-color: #B8B8B8;
					color: #fff;
				}

				.group {
					background-color: #7A7A7A;
					border-width: 0px;
					border-radius: 3px;
					padding: 25px;
					margin: 20px;
					width: inherit;
				}

				.submit {
					background-color: #7A7A7A;
					color: #F5FFFF;
					padding: 12px;
					width: inherit;
					border-width: 0px;
					cursor: pointer;
					float: right;
					display: inline-block;
					margin: 20px;
					margin-top: 0px;
					-webkit-box-sizing: border-box;
				    -moz-box-sizing: border-box;
				    box-sizing: border-box;
				}

				.wrap {
					display: table;
					min-width: 280px;
					max-width: 400px;
					width: 40%;
					margin: 0 auto;
					padding-top: 50px;
					padding-bottom: 50px;
					overflow: auto;
				}

				.wrap>.inner {
					display: table-cell;
					vertical-align: middle;
					text-align: center;
				}
			</style>
		</head>
		<body>
			<div class="wrap">
				<div class="inner">
					<form name="input" action="./install/setup.php" method="post">
						<div class="group">
							<h1>Forum</h1>
							<h2>Name</h2>
							<input name="forumname"/><br/>
							<h2>Description</h2>
							<input name="forumdescription"/><br/>
						</div>
						<div class="group">
							<h1>Your Account</h1>
							<h2>Username</h2>
							<input name="username"/><br/>
							<h2>Real name</h2>
							<input name="name"/><br/>
							<h2>Email</h2>
							<input name="email"/><br/>
							<h2>Password</h2>
							<input name="password" type="password"/><br/>
						</div>
						<div class="group">
							<h1>Database</h1>
							<h2>Name</h2>
							<input name="DBname"/><br/>
							<h2>Username</h2>
							<input name="DBuser"/><br/>
							<h2>URL</h2>
							<input name="DBURL"/><br/>
							<h2>Password</h2>
							<input name="DBpassword" /><br/>
							<h2>Table prefix</h2>
							<input name="DBprefix" value="parrot_"/><br/>
						</div>
						<input type="hidden" value="<?php echo getenv(DOMAIN_NAME) . BASE; ?>" name="url"/>
						<input type="submit" class="submit" value="Let's Fly"/>
					</form>
				</div>
			</div>
		</body>
	</html>
<?php else : ?>
	<?php header('Location: http://' . getenv(DOMAIN_NAME) . BASE); ?>
<?php endif; ?>