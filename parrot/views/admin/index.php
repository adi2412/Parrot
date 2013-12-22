<?php if (auth::isLoggedIn() && auth::isAdmin()) : ?>

<!DOCTYPE html>
<html>
    <head>
        <!-- meta -->
        <title><?php echo Parrot::getInstance()->config()->getConfig("forum/name"); ?> :: Admin</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Parrot::getInstance()->getUrl("parrot/views/assets/css/style.css"); ?>">
    </head>
    <body>
        <div class="bg">
            <div class="inner">
                <div class="content">
                    <div class="left"><h1 style="margin: 0px;"><a class="perma" href="<?php echo Parrot::getInstance()->getUrl(); ?>">Visit site</a></h1></div>
                    <div class="right"><h1 style="margin: 0px;">Hi, <?php echo auth::getCurrentUser(); ?></h1></div>
                </div>
                <hr>
                <div class="content">
                    <?php msg_read(); ?>
                    <div class="grid-33">
                        <div class="inner">
                            <h1>Categories</h1>
                            <?php while(have_category()) : thecategory() ?>
                                <a href="<?php echo cat_delete_link(); ?>"><h2 class="del"><?php echo cat_title(); ?></h2></a>
                            <?php endwhile; ?>
                                <form action="<?php echo Parrot::getInstance()->getUrl("admin/category/create"); ?>" method="post">
                                <input class="left-input" name="title" autocomplete="off"><input type="submit" class="right-button" value="+"/>
                            </form>
                        </div>
                    </div>
                    <div class="grid-33">
                        <div class="inner">
                            <h1>Meta</h1>
                            <form action="<?php echo Parrot::getInstance()->getUrl("admin/info/update"); ?>" method="post">
                                <h2>Name</h2>
                                <input name="title" value="<?php echo Parrot::getInstance()->config()->getConfig("forum/name"); ?>" class="full" autocomplete="off">
                                <h2>Description</h2>
                                <input name="description" value="<?php echo Parrot::getInstance()->config()->getConfig("forum/description"); ?>" class="full" autocomplete="off">
                                <h2>Theme</h2>
                                <select name="theme">
                                    <?php foreach (get_themes() as $theme) : ?>
                                        <option value="<?php echo $theme['title']; ?>">
                                            <?php
                                            $desc_raw = null;
                                            $desc_raw = $theme['description'];
                                            echo ucfirst($theme['title']);
                                            if ($desc_raw) {
                                                echo ' - ' . ucfirst($theme['description']);
                                            }
                                            ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="submit" class="submit" value="Update">
                            </form>
                        </div>
                    </div>
                    <div class="grid-33">
                        <div class="inner">
                            <h1>Users</h1>
                            <?php while(have_user()) : theuser() ?>
                                <div class="details">
                                    <div class="col">
                                        <?php if (!checkIfAdmin(user_username())) : ?>
                                            <a href="<?php echo user_delete_link(); ?>"><h2 class="del"><?php echo user_username(); ?></h2></a>
                                        <?php else : ?>
                                            <a href="<?php echo user_delete_link(); ?>"><h2 class="del important"><?php echo user_username(); ?></h2></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <a href="<?php echo user_promote_link(); ?>"><h2>Promote</h2></a>
                                    </div>
                                    <div class="col">
                                        <a href="<?php echo user_demote_link(); ?>"><h2>Demote</h2></a>
                                    </div>
                                    <div class="lastcol">
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="credit">
            <h1><a class="perma" href="https://github.com/GetParrot/Parrot">Powered by Parrot <?php echo VERSION; ?></a></h1>
        </div>
    </body>
</html>

<?php endif; ?>