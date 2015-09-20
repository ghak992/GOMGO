
This project created by Gheith Hamood Alrawahi (alrawahi.gheith@gmail.com) using PHP/MySql over Laravel 5.1 framework. To run this project perfectly you need: 1. Make sure provide : 
 PHP >= 5.5.9  MySQL >= 5.6.21 
 OpenSSL PHP Extension 
 PDO PHP Extension 
 Mbstring PHP Extension 
 Tokenizer PHP Extension 
2. Set up database access information on .env file that located on project root folder. 
You need to modify this part from .env file : 
 DB_HOST=localhost   <= database host name 
 DB_DATABASE=gomgodb  <= database name 
 DB_USERNAME=  <= database username  
 DB_PASSWORD=  <= database password that provide by web host 
3. In the server create new database with same name that you set to DB_DATABASE on .env file on the step number 2, after create database import gomgodb.sql file that you find on project root folder to database 
4. Setup email service setting on .env file and if you want make change on the next line inside mail.php file on config folder on project root folder  
'from' => ['address' => "gomgo.system@gmail.com", 'name' => "GOMGO System"], 
5.  After upload project file to the host you can access to the project by access to http://projectdomain/public 
Use next account to access inside system  
Email : root@gomgo.com  
Password : ghak992 
I suggest to change this account email and password after first access. 
6. Set up the setting and create account for users how will use the system 7. More documentation will be provide on https://github.com/ghak992/GOMGO as soon as possible. 