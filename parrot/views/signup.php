<!DOCTYPE html>
<html>
    <head>
        <!-- meta -->
        <title><?php echo Parrot::getInstance()->config()->getConfig("forum/name"); ?> :: Signup</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo Parrot::getInstance()->getUrl("parrot/views/assets/css/style.css"); ?>">
    </head>
    <body>
        <div class="wrap">
            <div class="inner">
                <?php msg_read(); ?>
                <div class="group">
                    <form name="input" action="<?php echo Parrot::getInstance()->getUrl("signup/submit"); ?>" method="post">
                        <input placeholder="Username" name="username" class="full"/><br/>
                        <input placeholder="Name" name="name" class="full"/><br/>
                        <input placeholder="Email" name="email" class="full"/><br/>
                        <input placeholder="Password" name="password" type="password" class="full"/><br/>
                        <input type="submit" class="submit" value="Signup"/>
                    </form>
                    <a href="<?php echo Parrot::getInstance()->getUrl("login"); ?>"><button class="light">Login</button></a><br/><br/>
                    <a href="<?php echo Parrot::getInstance()->getUrl(); ?>" class="small">&larr; Back to <?php echo Parrot::getInstance()->config()->getConfig("forum/name"); ?></a>
                </div>
            </div>
        </div>
    </body>
</html>
