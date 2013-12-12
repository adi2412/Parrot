<?php

class admin
{
    function get()
    {
        /**
         * This is the admin page
         */
        if (auth::isLoggedIn() && auth::isAdmin()) {
            require(APP . 'views' . DS . 'admin' . DS . 'index.php');
        } else {
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

class admin_cat_create {
    function post() {
        /**
         * This is the submit category function
         */
        if (auth::isLoggedIn() || auth::isAdmin()) {
            if (preg_match("/^[A-Za-z0-9\s]+$/", $_POST['title'])) {
                $title = $_POST['title'];
                category::submit($title);
                header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'admin');
            } else {
                global $messages;
                $messages = 'Only include spaces, letters and numbers in the name.';
                require(APP . 'views' . DS . 'admin' . DS . 'index.php');
            }
        } else {
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

class admin_cat_delete {
    function get($slug) {
        /**
         * This is the delete category page
         */
        if (auth::isLoggedIn() && auth::isAdmin()) {
            category::delete($slug);
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'admin');
        } else {
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

class admin_info_update {
    function post() {
        /**
         * This is the submit category function
         */
        if (auth::isLoggedIn() || auth::isAdmin()) {
            if (preg_match("/^[A-Za-z0-9\s]+$/", $_POST['title'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $theme = $_POST['theme'];
                info::update($title, $description, $theme);
                header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'admin');
            } else {
                global $messages;
                $messages = 'Only include spaces, letters and numbers in the name.';
                require(APP . 'views' . DS . 'admin' . DS . 'index.php');
            }
        } else {
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

class admin_user_delete {
    function get($slug) {
        /**
         * This is the delete user page
         */
        if (auth::isLoggedIn() && auth::isAdmin()) {
            auth::deleteAccount($slug);
        } else {
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

class admin_user_demote {
    function get($slug) {
        /**
         * This is the demote user page
         */
        if (auth::isLoggedIn() && auth::isAdmin()) {
            auth::demoteAccount($slug);
        } else {
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

class admin_user_promote {
    function get($slug) {
        /**
         * This is the premote user page
         */
        if (auth::isLoggedIn() && auth::isAdmin()) {
            auth::promoteAccount($slug);
        } else {
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}
