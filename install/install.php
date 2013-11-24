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
					background-color: #EDF1F2;
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
					text-transform: uppercase;
					margin: 10px;
					text-decoration: none;
					color: #5B696E;
					margin-left: 0px;
					margin-bottom: 20px;
				}

				h2 {
					font-weight: 300;
					font-size: 13px;
					margin: 10px;
					text-decoration: none;
					color: #D6D6D6;
					margin-left: 0px;
				}

				input {
					padding: 6px;
					width: 250px;
					border-width: 1px;
					border-style: solid;
					border-color: #EDF1F2;
					border-radius: 3px;
					margin-bottom: 10px;
				    -webkit-box-sizing: border-box;
				    -moz-box-sizing: border-box;
				    box-sizing: border-box;
				    color: #EDF1F2;
				}

				input:focus {
					outline: none;
					background-color: #EDF1F2;
					color: #fff;
				}

				.group {
					background-color: #fff;
					border-width: 1px;
					border-radius: 3px;
					border-style: solid;
					border-color: #D6D6D6;
					width: inherit;
					margin: 40px;
					padding: 20px;
				}

				.submit {
					background-color: #fff;
					color: #5B696E;
					border-width: 1px;
					border-style: solid;
					border-radius: 3px;
					border-color: #EDF1F2;
					padding: 10px;
					padding-left: 16px;
					padding-right: 16px;
					font-size: 14px;
					font-weight: 300;
					cursor: pointer;
					width: inherit;
					margin: 40px;
					margin-top: 0px;
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
					<form name="input" action="./install/setup.php" method="post" align="left">
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
						<div align="right"><input type="submit" class="submit" value="Let's Fly"/></div>
					</form>
				</div>
			</div>
		</body>
	</html>
<?php else : ?>
	<?php header('Location: http://' . getenv(DOMAIN_NAME) . BASE); ?>
<?php endif; ?>