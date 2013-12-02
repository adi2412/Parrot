<?php

class auth {
    /**
     * Checks if the request to login is valid
     */
	public function verify($username, $password) {
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `username`='$username' AND `password`='$password'");
    	$rows = $query->fetchAll();
        if (count($rows) == 1) {
            // OMG OMG OMG...
            // it's a real user... create a session for them and redirect
            // cookie expires on one hour
            $randString = auth::generateRandomString(15);
            setcookie('parrotSession', $randString, time()+3600, BASE);
            $query = database::getInstance()->query("UPDATE `" . DB_PREFIX . "Users` SET `session`='$randString' WHERE `username`='$username'");
            $query->execute();
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE);
        } else {
            global $messages;
            $messages = 'Incorrect username or password.';
            require(APP . 'views' . DS . 'login' . EXT);
        }
	}

    /**
     * Checks if the current user is logged in
     */
    public function isLoggedIn() {
        $cookie = $_COOKIE['parrotSession'];
        $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `session`='$cookie'");
        $rows = $query->fetchAll();
        $matches = false;
        foreach ($rows as $row) {
            $matches = true;
        }
        if (isset($_COOKIE['parrotSession']) && $matches == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates an account
     */
    public function createAccount($username, $password, $email, $name) {
       if (!empty($username) && !empty($password) && !empty($email) && !empty($name)) {
            $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `username`='$username'");
            $rows = $query->fetchAll();
            if (count($rows) == 0) {
                // woo! username is not taken
                if (preg_match("/^[A-Za-z0-9-_\s]+$/", $username)) {
                    $query = database::getInstance()->query("INSERT INTO `" . DB_PREFIX . "Users` (session, username, password, name, email, role) VALUES (NULL, '$username', '$password', '$name', '$email', 1)");
                } else {
                    global $messages;
                    $messages = 'Please only use numbers and letters in your username';
                    require(APP . 'views' . DS . 'signup' . EXT);
                }
            } else {
                global $messages;
                $messages = 'Username is already taken';
                require(APP . 'views' . DS . 'signup' . EXT);
            }
       } else {
            global $messages;
            $messages = 'Please fill out all fields';
            require(APP . 'views' . DS . 'signup' . EXT);
       }
    }

    /**
     * Deletes an account
     */
    public function deleteAccount($username) {
        // check if logged in again as an admin as a 
        // safety net the first check is mainly just 
        //to redirect pesky users
        if (auth::isAdmin()) {
            if (auth::getCurrentUser() !== $username) {
                $query = database::getInstance()->query("DELETE FROM `" . DB_PREFIX . "Users` WHERE `username`='$username'");
                $query->execute();
                header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'admin');
            } else {
                global $messages;
                $messages = 'You cannot delete your own account';
                require(APP . 'views' . DS . 'admin' . DS . 'index' . EXT);
            }
        } else {
            // not an admin
        }
    }

    /**
     * Demotes an account
     */
    public function demoteAccount($username) {
        // check if logged in again as an admin as a 
        // safety net the first check is mainly just 
        //to redirect pesky users
        if (auth::isAdmin()) {
            if (auth::getCurrentUser() !== $username) {
                $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `username`='$username'");
                $rows = $query->fetchAll();
                $role;
                foreach ($rows as $row) {
                    $role = $row['role'];
                }
                if ($role > 1) {
                    $role--;
                } else {
                    // can't go any less
                }
                database::getInstance()->query("UPDATE `" . DB_PREFIX . "Users` SET `role` = '$role' WHERE `username` = '$username'");
                header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'admin');
            } else {
                global $messages;
                $messages = 'You cannot change your own status';
                require(APP . 'views' . DS . 'admin' . DS . 'index' . EXT);
            }
        } else {
            // not an admin
        }
    }

    /**
     * Promotes an account
     */
    public function promoteAccount($username) {
        // check if logged in again as an admin as a 
        // safety net the first check is mainly just 
        //to redirect pesky users
        if (auth::isAdmin()) {
            if (auth::getCurrentUser() !== $username) {
                $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `username`='$username'");
                $rows = $query->fetchAll();
                $role;
                foreach ($rows as $row) {
                    $role = $row['role'];
                }
                if ($role < 3) {
                    $role++;
                } else {
                    // can't go any more
                }
                database::getInstance()->query("UPDATE `" . DB_PREFIX . "Users` SET `role` = '$role' WHERE `username` = '$username'");
                header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'admin');
            } else {
                global $messages;
                $messages = 'You cannot change your own status';
                require(APP . 'views' . DS . 'admin' . DS . 'index' . EXT);
            }
        } else {
            // not an admin
        }
    }

    /**
     * Gets the session cookie
     */
    public function getSession() {
       return $_COOKIE['parrotSession'];
    }

    /**
     * Gets the username of the current user
     */
    public function getCurrentUser() {
        $cookie = $_COOKIE['parrotSession'];
        $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `session`='$cookie'");
        $rows = $query->fetchAll();
        foreach ($rows as $row) {
            return $row['username'];
        }
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
    private function getCurrentUserNumRole() {
        $cookie = $_COOKIE['parrotSession'];
        $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `session`='$cookie'");
        $rows = $query->fetchAll();
        foreach ($rows as $row) {
            return $row['role'];
        }
    }

    /**
     * Gets the numeric role of a user
     */
    public function getUserNumRole($username) {
        $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `username`='$username'");
        $rows = $query->fetchAll();
        foreach ($rows as $row) {
            return $row['role'];
        }
    }

    /**
     * Generates a random alpha-num string
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}

?>