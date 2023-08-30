# PHP-MySQL User Management System
This is a PHP & MySQL (MVC model) User Management System with Login and Registration.

## How to Start

1. Install XAMPP
2. Database Configuration:
- Create database
- Open the models/Database.php file and update the hostname, db_name, username, and password variables to match your MySQL server configuration.
3. Import Database Schema:
- You can find the schema of the users database in the users.sql file located in the database directory. Import this SQL file into your database using a tool like phpMyAdmin.
4. Running the Project:
- Start XAMPP and ensure Apache and MySQL services are running.
- Open your web browser and navigate to:
- Main Page: http://localhost/php-oop/views/mainView.php
- Login Page: http://localhost/php-oop/views/loginView.php
- Register Page: http://localhost/php-oop/views/registerView.php
- Admin Page: http://localhost/php-oop/views/adminView.php
* Default Admin Account is `username: peter` `password: 1234`
- Profile Page: http://localhost/php-oop/views/profileView.php
