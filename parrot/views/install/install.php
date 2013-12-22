<!DOCTYPE html>
<html>
    <head>
        <!-- meta -->
        <title>Install Parrot</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Parrot::getInstance()->getUrl("parrot/views/assets/css/install.css"); ?>" media="all" />
    </head>
    <body>
        <?php if (isset($error)): ?>
        <?php echo $error; ?>
        <?php endif; ?>
        <div class="wrap">
            <div class="inner">
                <form name="input" action="<?php echo Parrot::getInstance()->getUrl("system/setup.php"); ?>" method="post" align="left">
                    <div class="group">
                        <h1>Admin Account</h1>
                        <h2>Username</h2>
                        <input name="username" type="text" /><br/>
                        <h2>Real name</h2>
                        <input name="name" type="text" /><br/>
                        <h2>Email</h2>
                        <input name="email" type="text" /><br/>
                        <h2>Password</h2>
                        <input name="password" type="password"/><br/>
                    </div>
                    <div align="right"><input type="submit" class="submit" value="Let's Fly" /></div>
                </form>
            </div>
        </div>
    </body>
</html>
