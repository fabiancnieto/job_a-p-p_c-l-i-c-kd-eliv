<p align="center">
  <img src="click-delivery.png">
</p>

##
This is a small project as a part of job application. The main objective of this solution is to build a User Management System

<p align="center">

## Requirements
* MySQL 5.7                        
* PHP 5.6
	- Mbstring PHP Extension                        
	- PDO PHP Estension
* Symfony Framework 3                        
* PhpUnit 6                      
* Doctrine 2.3
* Facebook-sdk

## Installing

* MySQL: create a database named **Umsjobappdb**, and execute the following script:
<pre>
 UMSJobApp/resources/Database/Umsjobappdb.sql
</pre>

* Web Server: Please setup the Webserver:
http://symfony.com/doc/current/setup/web_server_configuration.html

In the config file located in: UMSJobApp/app/config/parameters.yml make sure you have configured MySQL like this:
<pre>
parameters:
    database_host: localhost
    database_port: 3306
    database_name: UMSJobAppDb
    database_user: --- here put your database user
    database_password: --- here put your database user' password
</pre>

Source files: Please clone this repo (git clone https://github.com/fabiancnieto/job_a-p-p_c-l-i-c-kd-eliv.git)

Then open a terminal and type 
<pre>
  cd UMSJobApp
  php bin/console server:run
</pre>

##Documentation
This Asana project has some details about this project:
https://app.asana.com/-/share?s=303060576670139-gyzR4oVyH6lP6M2etMSgmJfoMPchfP3k3A04bVOaCay-88516083454272

## External libs used
* https://jquery.com/
* http://getbootstrap.com/
* https://developers.facebook.com/docs/reference/php
## License

This project is based in Symfony http://symfony.com/
