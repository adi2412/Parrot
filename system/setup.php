<?php

/** Bootstrap the system. Initialise various things and load configuration. */
require_once(__DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php");

/** Check to see if Parrot has already been installed. */
if (file_exists(SYS . "etc" . DS . "install")) {
    // Parrot is already installed. Redirect to the home page.
    require(APP . "views" . DS . "install" . DS . "already.php");
    exit;
}

if (empty($_POST["username"]) || empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
    // The user didn't fill in the form completely. Make them do it again.
    $error = "You didn't fill in the form completely.";
    require(APP . "views" . DS . "install" . DS . "install.php");
    exit;
}

if (!is_writeable(SYS . "etc")) {
    $error = "Unable to perform installation because etc directory is not writeable by the web server.";
    require(APP . "views" . DS . "install" . DS . "install.php");
    exit;
}

$username = $_POST["username"];
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

$database = Parrot::getInstance()->database();

/** Create the database tables */
$discussionQuery = "CREATE TABLE " . $database->getTableName("Discussion") . " (`title` VARCHAR(250) NOT NULL, `content` TEXT, `author` VARCHAR(250), `time` TEXT, `category` VARCHAR(250) NULL, `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, `sticky` TINYINT(1), `locked` TINYINT(1))";
$discussionStatement = $database->newStatement($discussionQuery);
$discussionStatement->execute();

$repliesQuery = "CREATE TABLE " . $database->getTableName("Replies") . " (`discussionTitle` VARCHAR(250), `content` TEXT, `author` VARCHAR(250), `time` TEXT, `approved` TEXT, `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, `id` TEXT)";
$repliesStatement = $database->newStatement($repliesQuery);
$repliesStatement->execute();

$usersQuery = "CREATE TABLE " . $database->getTableName("Users") . " (`session` TEXT, `username` VARCHAR(250), `password` VARCHAR(250), `name` VARCHAR(250), `email` VARCHAR(250), `role` TEXT)";
$usersStatement = $database->newStatement($usersQuery);
$usersStatement->execute();

$categoryQuery = "CREATE TABLE " . $database->getTableName("Category") . " (`id` INT(5), `title` VARCHAR(250))";
$categoryStatement = $database->newStatement($categoryQuery);
$categoryStatement->execute();

// meta
$meta_title = "Parrot";
$meta_description = "Minimalist discussion platform.";
$meta_theme = "default";

$metaQuery = "CREATE TABLE " . $database->getTableName("Meta") . " (`title` VARCHAR(250), `description` TEXT, `theme` VARCHAR(250))";
$metaStatement = $database->newStatement($metaQuery);
$metaStatement->execute();

$insertMetaQuery = "INSERT INTO " . $database->getTableName("Meta") . " (`title`, `description`, `theme`) VALUES ('$meta_title', '$meta_description', '$meta_theme')";
$insertMetaStatement = $database->newStatement($insertMetaQuery);
$insertMetaStatement->execute();
// end of meta

$insertAdminUserQuery = "INSERT INTO " . $database->getTableName("Users") . " (`session`, `username`, `password`, `name`, `email`, `role`) VALUES (NULL, ?, ?, ?, ?, 3)";
$insertAdminUserStatement = $database->newStatement($insertAdminUserQuery);
$insertAdminUserStatement->bindParam(1, $username, PDO::PARAM_STR);
$insertAdminUserStatement->bindParam(2, $password, PDO::PARAM_STR);
$insertAdminUserStatement->bindParam(3, $name, PDO::PARAM_STR);
$insertAdminUserStatement->bindParam(4, $email, PDO::PARAM_STR);
$insertAdminUserStatement->execute();

$insertCategoryQuery = "INSERT INTO " . $database->getTableName("Category") . " (`title`) VALUES ('Uncategorized')";
$insertCategoryStatement = $database->newStatement($insertCategoryQuery);
$insertCategoryStatement->execute();

$insertDiscussionQuery = "INSERT INTO " . $database->getTableName("Discussion") . " (`title`, `content`, `author`, `time`, `category`, `timestamp`, `sticky`, `locked`) VALUES ('Hello World', 'This is your first discussion.', ?, '$date', 'Uncategorized', NULL, 0, 0)";
$insertDiscussionStatement = $database->newStatement($insertDiscussionQuery);
$insertDiscussionStatement->bindParam(1, $username, PDO::PARAM_STR);
$insertDiscussionStatement->execute();

file_put_contents(SYS . "etc" . DS . "install", "installed");

header("Location: " . Parrot::getInstance()->getUrl());

exit;