WELCOME TO HELL!

INSTALL LARAVEL PROJECT ON PC
1.PREPRERATIONS:
web server (nginx)
php cgi server (php-fpm 7.4)
sql server (Mysql)
Http requests sender (Postman)

1.Install and connect web server to fastCGI server
-Install NGINX
-Install PHP fpm 7.4 with dependencies(php libapache2-mod-php php-mbstring php-xmlrpc php-soap php-gd php-xml php-cli php-zip php-bcmath php-tokenizer php-json php-pear php7.4-sqlite)
-Configure php fpm to use libraries
-Configure NGINX to work with ( you can use "laravel_connect" file by changing the data 
{server_name = your domain or any other resolved name with route
root = path to laravel project folder
logs = logs file for site
fastcgi_pass = path to php fpm socket file
}

2. In SQL server define the user for laravel project (create or use exists daemon-user) and create Database with name Laravel 
3.in Laravel project folder in .env file provide credentials for mysql database
4. Start servers and check if sql and web server are running.
5.Fill mysql db the data for posts & users
////
From this moment project is running an need to build views and refactoring
////
For testing the api please use postman tool ( already provided methods you can find in json "laravel api test.postman_collection.json") and start server by running php artisan serve on localhost(127.0.0.1) and port 8000

Explanation of work:
Project have some api routes
-apiregister(get & post)
-api/login(get & post)
-api/posts(get & post)
-api/(get)
by that routes  you can get access token and watch posts pages.
now pages doesnt work because lack of time
by postman you can register user -> get his token and copy to another request -> watch posts pages if in headers access_token is provided

AUTH middleware is not ready , AUTH if COMBINATION of controllers (Register controller & AuthTokens Models)

