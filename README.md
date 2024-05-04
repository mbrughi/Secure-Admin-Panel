# SecureAdminPanel
A secure PHP login system with Admin Panel and with protections against several common attacks

This code is designed to copy and paste it and should already work as it is, but you can customize the Administration panel as you like and if you want you can also completely modify the graphics by applying common panels such as those provided by Creative Tim, both for free that for a fee, or others of your liking.
The code is free to use and is provided as is in accordance with the GPL3 open source license. No assistance nor any compensation for damages can be provided for bug or other problems, much less on problems that apply only to your environment, however if you encounter a problem with the ACTUAL CODE you can report it to us on github, so that we can improve it.


### Features / Protections
- Login (protected against brute force/dictionary attacks)
- Sign Up
- password reset (done in a secure and friendly manner)
- Email Validation (ensure user has access to the email they used to make the account)
- CSRF protection for all features/forms
- Account Deletion 
- All features are protected from SQL Injection using PHP prepared statements
- XSS protection 
- All passwords are hashed so that even with access to the database attackers could not obtain users passwords (passwords are hashed and salted)
- Admin Dashboard graphics
- Bootstrap 5
- PHP 7.4.x tested

***Some features may not have been implemented yet, the code is still under development.***


### How to use
1. Download and install locally with MAMP/XAMPP or alternatively in cloud server with apache, mysql and php installed.
2. Make sure you are using an updated version of PHP. I have personally tested with version 7.4 and it works.
3. Copy and paste all files into the public directory
4. Modify config.php to match your environment and use case (may have to modify other files as well)
5. Start mysql and apache server services (look below for database structure)
6. Visit your website and test 


### Database Structure
Database structure defined in [tables.sql](/sql/tables.sql) which you can use to generate the necessary tables within your database.

### Thanks to
- [Code-Break0](https://github.com/Code-Break0) for tutorials and code base 
- [Creative Tim - Material Dashboard](https://github.com/creativetimofficial/material-dashboard) for graphics