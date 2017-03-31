<p align="center">
  <img src="click-delivery.png">
</p>

<p align="center">

## Requiremnents
* MySQL 5.7                        
* PHP 5.6                        
* Symfony Framework 3                        
* PhpUnit 6                      
* Doctrine 2.3
* Facebook-sdk
## Installing

* MySQL: create a database named **Umsjobappdb**, and execute the following script:
<pre>
 UMSJobApp/resources/Database/Umsjobappdb.sql
</pre>

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

then open a terminal and type 

<pre>
  cd job_a-p-p_c-l-i-c-kd-eliv
</pre>


## External libs used
* Add libs here
## License

This project is based in Symfony http://symfony.com/
