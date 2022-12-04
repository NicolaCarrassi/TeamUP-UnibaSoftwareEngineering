# TeamUP - SoftwareEngineering exam at Uniba
In this page there is all the code for the TeamUp platform realized for software engineering exam of the Computer Science and software production technologies at the University of Bari.

## Requirements
- Php (we used version 7.4.5)
- MySql (port 3306)
- Composer

## Installation guide
1. Install all the required softwares, if needed
2. Execute on MySql the script named "script1.sql"
3. Uncomment the following lines (if needed) on the file php.ini:
  - extension_dir = "ext"
	- extension=pdo_mysql
	- extension=fileinfo
4. Open a terminal window in the project directory and execute the following commands:
	- composer update
	- php artisan config:cache
	- php artisan cache:clear
	- php artisan view:cache
	- php artisan route:cache
	- php artisan migrate
	- php artisan storage:link
5. Execute "script2.sql"
6. Exectue the command **php artisan serve** from terminal
7. Access to the platform from the link given by the last command (do not close the terminal window)


### Dummy account
To access to the moderator section of the platform it has been created an account with the following credentials:
		email: admin@admin.com
		password: password
