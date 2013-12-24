Parrot
======

Parrot is a discussion platform that is built to be fast, secure and simple. The process of installing Parrot is so quick that you will finally have time to feed Polly that cracker.

How do I use Parrot?
===

Parrot is currently under development. You can still use it, but it lacks features and may contain bugs that has to be addressed properly. We encourage *you not* to use Parrot in a production environment (available on the web, to users that is). Mean while you should definitely check out [this parrot](http://bit.ly/1jnMQ6S) if you like too!

Installation
===

The Installation is simple and fast, as promised. 

1. Start off by extracting the downloaded .zip folder to your web root. 
2. Download [Lory](https://github.com/GetParrot/Lory) (the default theme), extract it, and put its contents in the `themes/default` folder.
3. Next you need to copy the `system/config.sample.php` files content and save it as `config.php`. 
2. Open the config.php file and fill the details needed, database configuration, base url and base path. Be sure to save it.
3. Make sure the system/etc directory is writable by the web server **(chmod 777)**.
4. Open Parrot's URL in your browser and enjoy the world's best discussion platform!

The install process will be much more simple in the future, but right now it needs to remain this way to keep us developers sane.


## Requirements
  - >= PHP 5.4
  - The web server must be writable
  - On Apache, ```mod_rewrite``` must be enabled. This is to make sure the URL is mapped properly *(by the .htaccess file provided in the source).*
  
  
Why Parrot?
===

The reason you should consider Parrot is because of how lightweight it is. Parrot is easily extended, you can create your own themes and get awesome support whenever needed, just visit the [the forums](http://codingbean.com/parrot/)

Besides... It's crafted with love!

> Hey it looks good.<br/>
 \- @idiot
 

Contributing
=========

Parrot is a never finishing project, the source will be continually updated on a regular base to improve the quality and performance of the code, the documentation will filled with even more details and of course the User base will just keep coming bigger!

If you're interested in contributing, fork the project and get started coding! Not a coder? Parrot is always looking for designers to make customized themes and icons.

Have a look at the [documentation](http://parrot.docci.co/contribute) for more information on how you can contribute along with some instructions.
