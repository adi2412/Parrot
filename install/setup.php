<?php
if (!file_exists(PATH . 'config' . EXT)) {
	$forumname = $_POST['forumname'];
	$forumdescription = $_POST['forumdescription'];

	$username = $_POST['username'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$DBname = $_POST['DBname'];
	$DBuser = $_POST['DBuser'];
	$DBpassword = $_POST['DBpassword'];
	$DBURL = $_POST['DBURL'];
	$DBprefix = $_POST['DBprefix'];

	/**
	 * Create tables
	 */
	$DB = mysqli_connect($DBURL, $DBuser, $DBpassword, $DBname);
	if (mysqli_connect_errno()) {
  		echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
  		echo '<br/>';
  		echo 'Change your connection settings in the /install/config.php file. ;)';
  	}

  	$query = "CREATE TABLE " . $DBprefix . "Discussion(title TEXT(20000), content TEXT(20000), author TEXT(20000), time TEXT(20000), category TEXT(20000) NULL, timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP , sticky text(20000))";
  	mysqli_query($DB, $query);

  	$query = "CREATE TABLE " . $DBprefix . "Replies(discussionTitle TEXT(20000), content TEXT(20000), author TEXT(20000), time TEXT(20000), approved TEXT(20000), timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP, id TEXT(20000))";
  	mysqli_query($DB, $query);

  	$query = "CREATE TABLE " . $DBprefix . "Users(session TEXT(20000), username TEXT(20000), password TEXT(20000), name TEXT(20000), email TEXT(20000), role TEXT(20000))";
  	mysqli_query($DB, $query);

  	$query = "CREATE TABLE " . $DBprefix . "Category(title TEXT(20000))";
  	mysqli_query($DB, $query);

  	$query = "CREATE TABLE " . $DBprefix . "Meta(title TEXT(20000), description TEXT(20000), theme TEXT(20000))";
  	mysqli_query($DB, $query);

  	// create a new user
  	// use this lib, because DB lib won't work yet
  	$DB = mysqli_connect($DBURL, $DBuser, $DBpassword, $DBname);
  	mysqli_query($DB, "INSERT INTO " . $DBprefix . "Users(session, username, password, name, email, role)VALUES (NULL, '$username', '$password', '$name', '$email', '3')");
  	$date = date('jS F, Y');
  	mysqli_query($DB, "INSERT INTO " . $DBprefix . "Discussion(title, content, author, time, category, timestamp, sticky) VALUES('Hello World', 'This is your first discussion.', '$username', '$date', 'Uncategorized', NULL, 'false')");
  	mysqli_query($DB, "INSERT INTO " . $DBprefix . "Category(title) VALUES('Uncategorized')");
  	mysqli_query($DB, "INSERT INTO " . $DBprefix . "Meta(title, description, theme) VALUES('$forumname', '$forumdescription', 'default')");

	file_put_contents(dirname(__FILE__) . '/' . 'config.php', "<?php ", FILE_APPEND);

	// file_put_contents(dirname(__FILE__) . '/' . 'config.php', "define('FORUM_NAME', '" . $forumname . "');", FILE_APPEND);
	// file_put_contents(dirname(__FILE__) . '/' . 'config.php', "define('FORUM_DESCRIPTION', '" . $forumdescription . "');", FILE_APPEND);

	file_put_contents(dirname(__FILE__) . '/' . 'config.php', "define('DB_NAME', '" . $DBname . "');", FILE_APPEND);
	file_put_contents(dirname(__FILE__) . '/' . 'config.php', "define('DB_USER', '" . $DBuser . "');", FILE_APPEND);
	file_put_contents(dirname(__FILE__) . '/' . 'config.php', "define('DB_PASSWORD', '" . $DBpassword . "');", FILE_APPEND);
	file_put_contents(dirname(__FILE__) . '/' . 'config.php', "define('DB_URL', '" . $DBURL . "');", FILE_APPEND);
	file_put_contents(dirname(__FILE__) . '/' . 'config.php', "define('DB_PREFIX', '" . $DBprefix . "');", FILE_APPEND);

	file_put_contents(dirname(__FILE__) . '/' . 'config.php', " ?>", FILE_APPEND);

	header('Location: http://' . $_POST['url'] . 'login');
}
?>