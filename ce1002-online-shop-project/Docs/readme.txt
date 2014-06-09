Note : Please use Google Chrome browser since the website is designed and reviewed using Google Chrome

1. Database information :

We use "include config.php" command inside the PHP file and use $username and $password inside the config.php to access the database.
You can change the server name, username, and password in config.php to the username and password used in your computer.
If you do not change it, then it might not be able to access the database.

The default server name, username, and password :

Server name : localhost
Username : root
Password : (Empty)

2. Importing the database :

Unzip Project1.zip or Project1.rar containing the source code. The file project1.sql is in that zip/compressed file. We provide a zip file and a compressed file.
Both zip and compressed file comprise of the same files.

- Go to phpmyadmin
- Click on the "Database" tab on the top of the page
- Choose Import
- Browse for project1.sql
- Go!

The database is created with 3 tables inside which are books, userdetails, and userbaskets.

3. Source code :

Copy all the HTML, PHP, and CSS file found in the compressed/zip file into the server folder.
To open the homepage, use the following link : localhost/project1/home.php
Before you can go inside the website, to look for books, etc., you need to login first or register first if you do not have account yet.

However, there are two usernames we have pre-registered.

Username : admin
Password : admin
Type : Admin user

Username : john001
Password : abcd1234
Type : Normal user

Brief description of each file :
- Book's description with form to add books to user's basket :
	- 1.php
	- 2.php
	- 3.php
	- 4.php
	- 5.php
	- 6.php
	- 7.php
	- 8.php
	- 9.php
	- 10.php
	- 11.php
	- 12.php
	- 13.php
	- 14.php
	- 15.php
	- 16.php

- About page :
	- about1.html -> for those who do not login 
	- about2.php -> for those who login

- Admin pages :
	- adminbaskets.php -> page for admin to see what users have added to their basket
	- adminbooks.php -> to see the book's list and the quantity of the book's stock
	- adminusers.php  -> to see the table of registered users
	- deletebookadmin.php -> to delete a record from userbaskets table in the database if admin deletes an order using the form inside the adminbaskets.php
	- deleteuser.php -> to delete a record from userdetails table in the database if admin deletes an username using the form inside the adminusers.php

- Full list of books :
	- book1.php
	- book2.php
	- book3.php
	- book4.php

- List of books according to their genre :
	- autobiography.php
	- fantasy.php
	- fiction1.php
	- fiction2.php
	- romance.php
	- satire.php
	- sciencefiction.php
	- youngadult.php

- User's basket :
	- basket.php -> user can see what he/she has ordered, change the quantity of book ordered, and delete his/her order
	- changeqty.php -> PHP file which change the data in the userbaskets table in the database if user changes the quantity of books ordered using the form 
			   in the basket.php
	- deletebook.php -> PHP file used for deleting orders in the userbaskets table if user deletes the order using the form in the basket.php

- bookadd.php -> to add data to the userbasket table in the database as the user adds orders

- Changing password :
	- change_password.php -> the page where user can change their password
	- changepassword.php -> to change the password inside the userdetails table in the database

- Contact form :
	- contact1.php -> for those who want to send email to admin but they do not log in
	- contact2.php  -> for those who want to send email to admin and they have logged in
	- emailsend1.php -> PHP file used for sending email based on the form inside contact1.php
	- emailsend2.php -> PHP file used for sending email based on the form inside contact2.php

- Configuration file :
	- config.php -> consists only the username and password variable used for accessing the database. You should change this variable if 
                        your computer's username and password for the server is different.

- home.php -> the homepage of this website. Login form is also inside home.php

- login.php -> PHP file for verifying the username and password if a user wants to login. It also verifies whether the username exists or not. If the username does
	       not exist, it will open registration.html

- logout.php -> to destroy session when a user logs out

- List of new books :
	- new.php

- Registration :
	- registration.html -> form to register as a new user is inside this HTML file. It also has form validation using JavaScript function
	- registration.php -> to add a new user record to userdetails table if the username does not exist in the table (a new user)

- templatemo_style.css -> CSS file used for making the layout of the website and for decorating the site