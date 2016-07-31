# SCKid Web
####A parental and privacy control framework for empowering parents to manage the mobile device environments of children on android 5.1+

##Installation:
**Laravel makes it incredibly easy to deploy the SCkid Web Framework. Our web service has been created with the Laravel (5.2) PHP framework (https://laravel.com) Laravel focuses on MVC design patterns and includes excellent documentation**

##Prerequisites:
1. Download homestead Virtual Machine https://laravel.com/docs/homestead or setup your own environment
2. If you are not using homestead make sure you Install composer for PHP dependencies https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

## Windows Development:
1. Install your webserver, PHP, MySQL and Composer for PHP dependencies  
2. `git clone https://github.com/BenEdridge/OPCCloud.git`  
    Download repository into htdocs or html root 
3. Set up Apache root to point to /var/www/laravel/public
4. Create database table for web app
5. Edit or create a .env file for Laravel in root folder and configure database connections and SMTP servers set up API keys (use .env.example as a skeleton) use the above database table.
6. Edit /config/*.php files to configure any needed configurations required eg. Locales, etc
7. Set permissions so webserver can write to storage, bootstrap/cache `sudo chgrp www-data:www-data -R /var/www/html/laravel`
8. Setting up file storage for avatars etc. Create dir: `mkdir /var/www/html/opc/laravel/storage/app/dir`
Add files to dir: `touch /var/www/html/opc/laravel/storage/app/dir/newFile.txt`
`ln -s /var/www/html/opc/laravel/storage/app/dir /var/www/html/opc/laravel/public/dir`
File can then be accessed at: `http://localhost:8080/dir/newFile.txt`
9. Install all dependencies using composer in the root dir: `composer install`  
10. Regenerate the Laravel key to secure sessions and encrypted data via: `php artisan key:generate`
11. Once database is created create the Database Schema: `php artisan migrate`
12. Optionally: Seed the database with test values values are found in /database/seeders and /database/modelfactory
`php artisan db:seed` Login with: admin@example.com:123456
13. Optionally: Run phpunit tests on website to check all features are working correctly, this requires seed data.
`phpunit`
14. Navigate to your website you should see the SCKid welcome page at 127.0.0.1, if this fails read the common issues below or review the laravel setup instructions. If issues perist try using the homestead virtual machine
15. Set up API access using JWT https://github.com/tymondesigns/jwt-auth/wiki/Installation
16. `php artisan jwt:generate`
17. Make sure all paths are correct `composer dump-autoload`

## Mac OS Development:
Root Directory (Example): /Users/pippo/Desktop/OPCCloud/

1. Install your webserver, PHP, MySQL and Composer for PHP dependencies 
2. ENter into the root directory: `cd /Users/pippo/Desktop/OPCCloud`
3. Git Clone: `https://github.com/cecil0610/SCKidWeb.git` 
4. Set up Apache root to point to /Users/pippo/Desktop/OPCCloud/SCKidWeb/laravel/
5. Create MySQL database table (e.g. by using 'phpmyadmin')
6. Run this in your terminal to get the latest Composer version

		1). php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
		2). php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
		3). php composer-setup.php
		4). php -r "unlink('composer-setup.php');"

7. Move composer: `mv composer.phar /usr/local/bin/composer`
8. Install all dependencies using composer in the root dir: `composer install`
9. Edit or create a .env file: `cp .env.example .env`
10. Change local database name, username and password: `nano .env`
			
		DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=3306
		DB_DATABASE=homestead (note: your own database name)
		DB_USERNAME=root
		DB_PASSWORD=xxxx
			
11. Regenerate the Laravel key to secure sessions and encrypted data via:: `php artisan key:generate`
11. Once database is connected, create the Database Schema: `php artisan migrate`
13. Modify httpd.conf: `sudo nano /etc/apache2/httpd.conf`

		1). Change DocumentRoot "/Library/WebServer/Documents" to your user directory;
		2). Change the <Directory> tag reference right below the DocumentRoot line. This should also be changed to point to your new document root;
		3). In that same <Directory> block you will find an AllowOverride setting, this should be changed to: AllowOverride All;
		4). Change the value of "User&Group" for access permision.
		5). Apache restart: sudo apachectl -k restart
		
14. [Optional] Seed the database with test values
`php artisan db:seed` (e.g. Login with: admin@example.com:123456)
15. [Optional] Make sure all paths are correct `composer dump-autoload`


##Troubleshooting:
1. .env files not set up correctly, create .env file from the .env.example file
2. Webserver root should point to public dir
3. Setup permissions of directories if not using homestead VM `sudo chgrp -R www-data storage bootstrap/cache`
`sudo chmod -R ug+rwx storage bootstrap/cache`
4. Make sure all databases are migrated and seeded
5. Clear cache `php artisan cache:clear`


##Todo:
1. Realtime communication
2. Bidrectional Sync complexity

##Security Measures:
1. HTTPS access
2. JWT for API
3. No advertising or risky third party libaries
4. No storage of secure information
5. BCrypt password hashing
6. Policy creation using laravel API
7. Blade templating to protect from SQL injection and XSS

##Acknowledgements:
Developers Yuze Liu, Spencer Tang, Ben Edridge 
Laravel http://laravel.com/docs  
JWT AUTH tymon/jwt-auth (Restful API)
Facebook API https://github.com/facebook/facebook-php-sdk-v4  
SB Admin 2 Template http://startbootstrap.com/template-overviews/sb-admin-2/
Welcome Template html5up.net  
Socialite for API access https://github.com/laravel/socialite  
SocialiteProviders for extra access to(instagram and tumblr) http://socialiteproviders.github.io  
Google fonts
Font Awesome  

##Contact:
Any issues or problems please contact Ben Edridge  
Email: edridge.ben@gmail.com  
Skype: ben.edridge1  
