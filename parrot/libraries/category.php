<?php

class category
{

    /**
     * Create a category
     */
    public function submit($title)
    {
        if (auth::isLoggedIn() && auth::isAdmin()) {
            $database = Parrot::getInstance()->database();
            // check if logged in again as a safety net
            // the first check is mainly just to redirect
            // pesky users
            $query = "SELECT * FROM " . $database->getTableName("Category") . " WHERE `title` = ?";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $title, PDO::PARAM_STR);
            $statement->execute();
            $rows = $statement->fetchAll();
            $checkTitle;
            foreach ($rows as $row) {
                $checkTitle = $row["title"];
            }
            if ($checkTitle !== $title) {
                // strip the HTML tags... Markdown only
                $title = strip_tags($title);
                $query = "INSERT INTO " . $database->getTableName("Category") . " (`title`) VALUES (?)";
                $statement = $database->newStatement($query);
                $statement->bindParam(1, $title, PDO::PARAM_STR);
                $statement->execute();
            }
        }
    }

    /**
     * Deletes a category
     */
    public function delete($slug)
    {
        // check if logged in again as an admin as a
        // safety net the first check is mainly just
        //to redirect pesky users
        if (auth::isAdmin()) {
            $title = discussion::decode_title($slug);
            $database = Parrot::getInstance()->database();
            $query = "DELETE FROM " . $database->getTableName("Category") . " WHERE `title` = ?";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $title, PDO::PARAM_STR);
            $statement->execute();
        } else {
            // not an admin
        }
    }
}
