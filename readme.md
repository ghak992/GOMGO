
This project created by Gheith Hamood Alrawahi (alrawahi.gheith@gmail.com) using PHP/MySql over Laravel 5.1 framework. To run this project perfectly you need: 
<br><br>
1. Make sure provide : <br>
 PHP >= 5.5.9  MySQL >= 5.6.21 <br>
 OpenSSL PHP Extension <br>
 PDO PHP Extension <br>
 Mbstring PHP Extension <br>
 Tokenizer PHP Extension <br><br>
2. Set up database access information on .env file that located on project root folder. 
You need to modify this part from .env file : <br>
 DB_HOST=localhost   <= database host name <br>
 DB_DATABASE=gomgodb  <= database name <br>
 DB_USERNAME=  <= database username  <br>
 DB_PASSWORD=  <= database password that provide by web host <br><br>
3. In the server create new database with same name that you set to DB_DATABASE on .env file on the step number 2, after create database import gomgodb.sql file that you find on project root folder to database <br><br>
4. Setup email service setting on .env file and if you want make change on the next line inside mail.php file on config folder on project root folder  <br>
'from' => ['address' => "gomgo.system@gmail.com", 'name' => "GOMGO System"], <br><br>
5.  After upload project file to the host you can access to the project by access to http://projectdomain/public 
Use next account to access inside system  <br>
Email : root@gomgo.com  <br>
Password : ghak992 <br>
I suggest to change this account email and password after first access.  https://github.com/ghak992/GOMGO as soon as possible. 
