<?php

class discussion
{
    /**
     * Create a discussion
     */
    public function submit($title, $content, $category)
    {
        $database = Parrot::getInstance()->database();

        // check if logged in again as a safety net
        // the first check is mainly just to redirect
        // pesky users
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $title, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $checkTitle = "";
        foreach ($rows as $row) {
            $checkTitle = $row["title"];
        }
        if (auth::isLoggedIn()) {
            if ($checkTitle !== $title) {
                // strip the HTML tags... Markdown only
                $title = strip_tags($title);
                $content = strip_tags($content);
                $session = auth::getSession();
                $query = "SELECT * FROM " . $database->getTableName("Users") . " WHERE `session` = ?";
                $statement = $database->newStatement($query);
                $statement->bindParam(1, $session, PDO::PARAM_STR);
                $statement->execute();
                $rows = $statement->fetchAll();
                $username;
                foreach ($rows as $row) {
                    $username = $row['username'];
                }
                $date = date('jS F, Y');
                $query = "INSERT INTO " . $database->getTableName("Discussion") . " (`title`, `author`, `content`, `time`, `category`, `timestamp`, `sticky`, `locked`) VALUES (?, ?, ?, '" . $date . "', ?, NULL, 0, 0)";
                $statement = $database->newStatement($query);
                $statement->bindParam(1, $title, PDO::PARAM_STR);
                $statement->bindParam(2, $username, PDO::PARAM_STR);
                $statement->bindParam(3, $content, PDO::PARAM_STR);
                $statement->bindParam(4, $category, PDO::PARAM_STR);
                $statement->execute();
                header("Location: " . Parrot::getInstance()->getUrl("discussion/" . str_replace(" ", "-", $title)));
            } else {
                global $messages;
                $messages = 'Please choose another title';
                require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "create.php");
            }
        } else {
            // the user should have already been re-directed to the login page by now
            global $messages;
            $messages = 'Please login to post';
            require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "create.php");
        }
    }

    /**
     * Get all discussions
     */
    public function get_discussions()
    {
        // ugly, but gets the job done
        $discuss_array;
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " ORDER BY `sticky` DESC, `timestamp` DESC";
        $statement = $database->newStatement($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $count = count($rows);
        for($i = 0; $i < $count; $i++) {
            $discuss_array[$i]['title'] = $rows[$i]['title'];
            $discuss_array[$i]['content'] = $rows[$i]['content'];
            $discuss_array[$i]['author'] = $rows[$i]['author'];
            $discuss_array[$i]['time'] = $rows[$i]['time'];
            //$discuss_array[$i]['replies'] = $rows[$i]['replies'];
            $discuss_array[$i]['category'] = $rows[$i]['category'];
            $discuss_array[$i]['sticky'] = $rows[$i]['sticky'] == 1 ? true : false;
            $discuss_array[$i]['locked'] = $rows[$i]['locked'] == 1 ? true : false;
        }
        return $discuss_array;
    }

    /**
     * Get individual discussion details
     */
    public function get_discussion($title)
    {
        $database = Parrot::getInstance()->database();
        $decodedTitle = discussion::decode_title($title);
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $decodedTitle, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $discuss_array = array();
        foreach ($rows as $row) {
            $discuss_array[0]['title'] = $row['title'];
            $discuss_array[0]['content'] = $row['content'];
            $discuss_array[0]['author'] = $row['author'];
            $discuss_array[0]['time'] = $row['time'];
            //$discuss_array[0]['replies'] = $row['replies'];
            $discuss_array[0]['category'] = $row['category'];
            $discuss_array[0]['sticky'] = $row['sticky'] == 1 ? true : false;
            $discuss_array[0]['locked'] = $row['locked'] == 1 ? true : false;
        }
        return $discuss_array;
    }

    /**
     * Get a user's discussions
     */
    public function user_discussion($author)
    {
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `author` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $author, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $discuss_array = array();
        $i = 0;
        foreach ($rows as $row) {
            $discuss_array[$i]['title'] = $row['title'];
            $discuss_array[$i]['content'] = $row['content'];
            $discuss_array[$i]['author'] = $row['author'];
            $discuss_array[$i]['time'] = $row['time'];
            //$discuss_array[$i]['replies'] = $row['replies'];
            $discuss_array[$i]['category'] = $row['category'];
            $discuss_array[$i]['sticky'] = $row['sticky'] == 1 ? true : false;
            $discuss_array[$i]['locked'] = $row['locked'] == 1 ? true : false;
            $i++;
        }
        return $discuss_array;
    }

    /**
     * Get a user's replies
     */
    public function user_reply($author)
    {
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Replies") . " WHERE `author` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $author, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $replies_array = array();
        $i = 0;
        foreach ($rows as $row) {
            $replies_array[$i]['title'] = $row['discussionTitle'];
            $replies_array[$i]['content'] = $row['content'];
            $replies_array[$i]['author'] = $row['author'];
            $replies_array[$i]['time'] = $row['time'];
            //$discuss_array[$i]['replies'] = $row['replies'];
            // $discuss_array[$i]['category'] = $row['category'];
            // $discuss_array[$i]['sticky'] = $row['sticky'] == 1 ? true : false;
            // $discuss_array[$i]['locked'] = $row['locked'] == 1 ? true : false;
            // echo $discuss_array[$i]['title'] = $row['discussionTitle'].
            // $discuss_array[$i]['content'] = $row['content'].
            // $discuss_array[$i]['author'] = $row['author'].
            // $discuss_array[$i]['time'] = $row['time'];
            $i++;
        }
        return $replies_array;
    }

    /**
     * Reply to a discussion
     */
    public function reply($content, $discussionTitle)
    {
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $discussionTitle, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $locked;
        foreach ($rows as $row) {
            $locked = $row['locked'];
        }
        if (auth::isLoggedIn() && $locked == 0) {
            $content = strip_tags($content);
            $session = auth::getSession();
            $author = auth::getCurrentUser();
            $time = date('jS F, Y');
            $id = auth::generateRandomString(15);
            $query = "INSERT INTO " . $database->getTableName("Replies") . " (`discussionTitle`, `content`, `author`, `time`, `approved`, `id`, `timestamp`) VALUES (?, ?, ?, '" . $time . "', 'true', ?, NULL)";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $discussionTitle, PDO::PARAM_STR);
            $statement->bindParam(2, $content, PDO::PARAM_STR);
            $statement->bindParam(3, $author, PDO::PARAM_STR);
            $statement->bindParam(4, $id, PDO::PARAM_STR);
            $statement->execute();
        } else {
            // no user logged in
        }
    }

    /**
     * Gets the replies for a discussion
     */
    public function get_replies($title)
    {
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Replies") . " WHERE `discussionTitle` = ? ORDER BY `timestamp` ASC";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $title, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $replies = array();
        for ($i = 0; $i < count($rows); $i++) {
            $replies[$i]['content'] = $rows[$i]['content'];
            $replies[$i]['author'] = $rows[$i]['author'];
            $replies[$i]['time'] = $rows[$i]['time'];
            $replies[$i]['id'] = $rows[$i]['id'];
        }
        return $replies;
    }

    /**
     * Delete a discussion
     */
    public function delete($title)
    {
        // check if logged in again as a safety net
        // the first check is mainly just to redirect
        // pesky users
        $title = discussion::decode_title($title);
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $title, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $author;
        foreach ($rows as $row) {
            $author = $row["author"];
        }

        $currentUser = auth::getCurrentUser();

        if ($author == $currentUser || auth::isAdmin() || auth::isMod()) {
            $database->getPDO()->beginTransaction();

            $query1 = "DELETE FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
            $statement1 = $database->newStatement($query1);
            $statement1->bindParam(1, $title, PDO::PARAM_STR);

            $query2 = "DELETE FROM " . $database->getTableName("Replies") . " WHERE `discussionTitle` = ?";
            $statement2 = $database->newStatement($query2);
            $statement2->bindParam(1, $title, PDO::PARAM_STR);

            $statement1->execute();
            $statement2->execute();

            $database->getPDO()->commit();
            header("Location: " . Parrot::getInstance()->getUrl());
        } else {
            // not the same person
        }
    }

    /**
     * Delete a reply
     */
    public function delete_reply($id)
    {
        // check if logged in again as a safety net
        // the first check is mainly just to redirect
        // pesky users
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Replies") . " WHERE `id` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        $rows = $statement->fetchAll();
        $author;
        $title;
        foreach ($rows as $row) {
            $author = $row["author"];
            $title = $row["discussionTitle"];
        }
        $query = "SELECT * FROM " . $database->getTableName("Replies") . " WHERE `discussionTitle` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $title, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $locked;
        foreach ($rows as $row) {
            $locked = $row['locked'];
        }
        $currentUser = auth::getCurrentUser();
        if ($author == $currentUser || auth::isAdmin() || auth::isMod() && $locked == 0) {
            $query = "DELETE FROM " . $database->getTableName("Replies") . " WHERE `id` = ?";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $id);
            $statement->execute();
            header("Location: " . Parrot::getInstance()->getUrl("discussion/" . discussion::encode_title($title)));
        } else {
            // not the same person
        }
    }

    /**
     * Toggles the stick of a discussion
     */
    public function stick($title)
    {
        $title = discussion::decode_title($title);
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $title, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $cur_val;
        foreach ($rows as $row) {
            $cur_val = $row['sticky'];
        }

        $query = "UPDATE " . $database->getTableName("Discussion") . " SET `sticky` = ? WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $stickyVal, PDO::PARAM_INT);
        $statement->bindParam(2, $title, PDO::PARAM_STR);
        if ($cur_val == 1) {
            // set sticky to false
            $stickyVal = 0;
        } else {
            // set sticky to true
            $stickyVal = 1;
        }
        $statement->execute();
        header("Location: " . Parrot::getInstance()->getUrl("discussion/" . discussion::encode_title($title)));
    }

    /**
     * Toggles the lock of a discussion
     */
    public function lock($title)
    {
        $database = Parrot::getInstance()->database();
        $title = discussion::decode_title($title);
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $title, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $cur_val;
        foreach ($rows as $row) {
            $cur_val = $row['locked'];
        }

        $query = "UPDATE " . $database->getTableName("Discussion") . " SET `locked` = ? WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $lockVal, PDO::PARAM_INT);
        $statement->bindParam(2, $title, PDO::PARAM_STR);
        if ($cur_val == 1) {
            // set sticky to false
            $lockVal = 0;
        } else {
            // set sticky to true
            $lockVal = 1;
        }
        $statement->execute();
        header("Location: " . Parrot::getInstance()->getUrl("discussion/" . discussion::encode_title($title)));
    }

    /**
     * Edits a discussion
     */
    public function edit($title, $content)
    {
        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Discussion") . " WHERE `title` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $title, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $author;
        $locked;
        foreach ($rows as $row) {
            $author = $row['author'];
            $locked = $row['locked'];
        }
        if ($author == auth::getCurrentUser() && $locked == 0 || auth::isAdmin() && $locked == 0 || auth::isMod() && $locked == 0) {
            $query = "UPDATE " . $database->getTableName("Discussion") . " SET `title` = ?, `content` = ? WHERE `title` = ?";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $title, PDO::PARAM_STR);
            $statement->bindParam(2, $content, PDO::PARAM_STR);
            $statement->bindParam(3, $title, PDO::PARAM_STR);
            $statement->execute();
            header("Location: " . Parrot::getInstance()->getUrl("discussion/" . discussion::encode_title($title)));
        } else {
            header("Location: " . Parrot::getInstance()->getUrl());
        }
    }

    /**
     * Encodes a title for URL
     */
    public function encode_title($title)
    {
        return str_replace(' ', '-', $title);
    }

    /**
     * Decodes a title for URL
     */
    public function decode_title($title)
    {
        return str_replace('-', ' ', $title);
    }
}
