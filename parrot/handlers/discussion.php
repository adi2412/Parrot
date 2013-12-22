<?php

class discussions
{
    /**
     * This is the home page
     */
    function get()
    {
        // TODO: Make the theme name an option
        require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "index.php");
    }
}

class create_discussion
{
    /**
     * This is the create discussion page
     */
    function get()
    {
        require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "create.php");
    }
}

class delete_discussion
{
    function get($slug)
    {
        discussion::delete($slug);
    }
}

class edit_discussion
{
    /**
     * This is the edit discussion page
     */
    function get($slug)
    {
        global $discussion_title;
        $database = Parrot::getInstance()->database();
        $discussion_title = discussion::decode_title($slug);
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $discussion_title, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $author;
        $locked;
        foreach ($rows as $row) {
            $author = $row["author"];
            $locked = $row["locked"];
        }
        if ($author == auth::getCurrentUser() && $locked == 0 || auth::isAdmin() && $locked == 0 || auth::isMod() && $locked == 0) {
            require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "edit.php");
        } else {
            header("Location: " . Parrot::getInstance()->getUrl());
        }
    }
}

class edit_submit_discussion
{
    /**
     * This is the submit discussion function
     */
    function post()
    {
        if (auth::isLoggedIn()) {
            if (preg_match("/^[A-Za-z0-9\s]+$/", $_POST['title'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];
                discussion::edit($title, $content);
            } else {
                global $messages;
                $messages = 'Only include spaces, letters and numbers in the title';
                require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "index.php");
            }
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}

class reply_discussion
{
    function post($slug)
    {
        $content = $_POST['content'];
        discussion::reply($content, discussion::decode_title($slug));
        header("Location: " . Parrot::getInstance()->getUrl("discussion/" . $slug));
    }
}

class stick_discussion {
    function get($slug) {
        discussion::stick($slug);
    }
}

class lock_discussion
{
    function get($slug)
    {
        discussion::lock($slug);
    }
}

class submit_discussion
{
    /**
     * This is the submit discussion function
     */
    function post()
    {
        if (auth::isLoggedIn()) {
            if (preg_match("/^[A-Za-z0-9\s]+$/", $_POST['title'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $category = $_POST['category'];
                discussion::submit($title, $content, $category);
            } else {
                global $messages;
                $messages = 'Only include spaces, letters and numbers in the title';
                require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "create.php");
            }
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}

class view_discussion
{
    /**
     * This is the indivigual discussion page
     */
    function get($slug)
    {
        global $discussion_title;
        $discussion_title = discussion::decode_title($slug);
        require_once(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "discussion.php");
    }
}

class reply_delete
{
    /**
     * This is the delete reply page
     */
    function get($slug)
    {
        discussion::delete_reply($slug);
    }
}
