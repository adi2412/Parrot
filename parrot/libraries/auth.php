<?php

class auth
{
    /**
     * Checks if the request to login is valid
     */
    public function verify($username, $password)
    {
        $database = Parrot::getInstance()->database();

        $query = "SELECT * FROM " . $database->getTableName("Users") . " WHERE `username` = ? AND `password` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $username, PDO::PARAM_STR);
        $statement->bindParam(2, $password, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        if (count($rows) == 1) {
            // OMG OMG OMG...
            // it's a real user... create a session for them and redirect
            // cookie expires on one hour
            $randString = auth::generateRandomString(15);
            setcookie("parrotSession", $randString, time() + 3600, Parrot::getInstance()->config()->getConfig("app/basepath"));
            $query = "UPDATE " . $database->getTableName("Users") . " SET `session` = ? WHERE `username` = ?";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $randString, PDO::PARAM_STR);
            $statement->bindParam(2, $username, PDO::PARAM_STR);
            $statement->execute();
            header("Location: " . Parrot::getInstance()->getUrl());
        } else {
            global $messages;
            $messages = 'Incorrect username or password.';
            require(APP . 'views' . DS . 'login.php');
        }
    }

    /**
     * Checks if the current user is logged in
     */
    public function isLoggedIn()
    {
        if (isset($_COOKIE["parrotSession"])) {
            $cookie = $_COOKIE["parrotSession"];
        } else {
            return false;
        }

        $database = Parrot::getInstance()->database();
        $query = "SELECT * FROM " . $database->getTableName("Users") . " WHERE `session` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $cookie, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll();
        $matches = false;
        foreach ($rows as $row) {
            $matches = true;
        }
        if ($matches == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates an account
     */
    public function createAccount($username, $password, $email, $name)
    {
        if (!empty($username) && !empty($password) && !empty($email) && !empty($name)) {
            $database = Parrot::getInstance()->database();
            $query = "SELECT * FROM " . $database->getTableName("Users") . " WHERE `username` = ?";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $username, PDO::PARAM_STR);
            $statement->execute();
            $rows = $statement->fetchAll();
            if (count($rows) == 0) {
                // woo! username is not taken
                if (preg_match("/^[A-Za-z0-9-_\s]+$/", $username)) {
                    $query = "INSERT INTO " . $database->getTableName("Users") . " (`session`, `username`, `password`, `name`, `email`, `role`)";
                    $query .= " VALUES (NULL, ?, ?, ?, ?, 1)";
                    $statement = $database->newStatement($query);
                    $statement->bindParam(1, $username, PDO::PARAM_STR);
                    $statement->bindParam(2, $password, PDO::PARAM_STR);
                    $statement->bindParam(3, $name, PDO::PARAM_STR);
                    $statement->bindParam(4, $email, PDO::PARAM_STR);
                    $statement->execute();
                } else {
                    global $messages;
                    $messages = 'Please only use numbers and letters in your username';
                    require(APP . 'views' . DS . 'signup.php');
                }
            } else {
                global $messages;
                $messages = 'Username is already taken';
                require(APP . 'views' . DS . 'signup.php');
            }
        } else {
            global $messages;
            $messages = 'Please fill out all fields';
            require(APP . 'views' . DS . 'signup.php');
        }
    }

    /**
     * Deletes an account
     */
    public function deleteAccount($username)
    {
        // check if logged in again as an admin as a
        // safety net the first check is mainly just
        //to redirect pesky users
        if (auth::isAdmin()) {
            if (auth::getCurrentUser() !== $username) {
                $database = Parrot::getInstance()->database();
                $query = "DELETE FROM " . $database->getTableName("Users") . " WHERE `username` = ?";
                $statement = $database->newStatement($query);
                $statement->bindParam(1, $username, PDO::PARAM_STR);
                $statement->execute();
                header("Location: " . Parrot::getInstance()->getUrl("admin"));
            } else {
                global $messages;
                $messages = 'You cannot delete your own account';
                require(APP . 'views' . DS . 'admin' . DS . 'index.php');
            }
        } else {
            // not an admin
        }
    }

    /**
     * Demotes an account
     */
    public function demoteAccount($username)
    {
        // check if logged in again as an admin as a
        // safety net the first check is mainly just
        //to redirect pesky users
        if (auth::isAdmin()) {
            if (auth::getCurrentUser() !== $username) {
                $database = Parrot::getInstance()->database();
                $query = "SELECT * FROM " . $database->getTableName("Users") . "WHERE `username` = ?";
                $statement = $database->newStatement($query);
                $statement->bindParam(1, $username, PDO::PARAM_STR);
                $statement->execute();
                $rows = $statement->fetchAll();
                $role;
                foreach ($rows as $row) {
                    $role = $row['role'];
                }
                if ($role > 1) {
                    $role--;
                } else {
                    // can't go any less
                }
                $query = "UPDATE " . $database->getTableName("Users") . " SET `role` = ? WHERE `username` = ?";
                $statement = $database->newStatement($query);
                $statement->bindParam(1, $role, PDO::PARAM_STR);
                $statement->bindParam(2, $username, PDO::PARAM_STR);
                $statement->execute();
                header("Location: " . Parrot::getInstance()->getUrl("admin"));
            } else {
                global $messages;
                $messages = 'You cannot change your own status';
                require(APP . 'views' . DS . 'admin' . DS . 'index.php');
            }
        } else {
            // not an admin
        }
    }

    /**
     * Promotes an account
     */
    public function promoteAccount($username)
    {
        // check if logged in again as an admin as a
        // safety net the first check is mainly just
        //to redirect pesky users
        if (auth::isAdmin()) {
            if (auth::getCurrentUser() !== $username) {
                $database = Parrot::getInstance()->database();
                $query = "SELECT * FROM " . $database->getTableName("Users") . " WHERE `username` = ?";
                $statement = $database->newStatement($query);
                $statement->bindParam(1, $username, PDO::PARAM_STR);
                $statement->execute();
                $rows = $statement->fetchAll();
                $role;
                foreach ($rows as $row) {
                    $role = $row['role'];
                }
                if ($role < 3) {
                    $role++;
                } else {
                    // can't go any more
                }
                $query = "UPDATE " . $database->getTableName("Users") . " SET `role` = ? WHERE `username` = ?";
                $statement = $database->newStatement($query);
                $statement->bindParam(1, $role, PDO::PARAM_STR);
                $statement->bindParam(2, $username, PDO::PARAM_STR);
                $statement->execute();
                header("Location: " . Parrot::getInstance()->getUrl("admin"));
            } else {
                global $messages;
                $messages = 'You cannot change your own status';
                require(APP . 'views' . DS . 'admin' . DS . 'index.php');
            }
        } else {
            // not an admin
        }
    }

    /**
     * Gets the session cookie
     */
    public function getSession()
    {
       return $_COOKIE['parrotSession'];
    }

    /**
     * Gets the username of the current user
     */
    public function getCurrentUser()
    {
        if (isset($_COOKIE["parrotSession"])) {
            $cookie = $_COOKIE['parrotSession'];
            $database = Parrot::getInstance()->database();
            $query = "SELECT `username` FROM " . $database->getTableName("Users") . " WHERE `session` = ?";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $cookie, PDO::PARAM_STR);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if (!empty($row["username"])) {
                return $row["username"];
            }
        }
        return null;
    }

    /**
     * Checks if the current user is an admin
     */
    public function isAdmin() {
        if (auth::getCurrentUserNumRole() == 3) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if the given username is an admin
     */
    public function checkAdmin($username) {
        if (auth::getUserNumRole($username) == 3) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if the current user is a moderator
     */
    public function isMod() {
        if (auth::getCurrentUserNumRole() == 2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if the given username is an moderator
     */
    public function checkMod($username) {
        if (auth::getUserNumRole($username) == 2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if the current user is a participant
     */
    public function isParticipant() {
        if (auth::getCurrentUserNumRole() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets the numeric role of the current user
     */
    private function getCurrentUserNumRole()
    {
        if (isset($_COOKIE["parrotSession"])) {
            $cookie = $_COOKIE["parrotSession"];
            $database = Parrot::getInstance()->database();
            $query = "SELECT `role` FROM " . $database->getTableName("Users") . " WHERE `session` = ?";
            $statement = $database->newStatement($query);
            $statement->bindParam(1, $cookie, PDO::PARAM_STR);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row["role"];
        } else {
            return null;
        }
    }

    /**
     * Gets the numeric role of a user
     */
    public function getUserNumRole($username)
    {
        $database = Parrot::getInstance()->database();
        $query = "SELECT `role` FROM " . $database->getTableName("Users") . " WHERE `username` = ?";
        $statement = $database->newStatement($query);
        $statement->bindParam(1, $username, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row["role"];
    }

    /**
     * Generates a random alpha-num string
     */
    public function generateRandomString($length = 10)
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randomString = "";
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}
