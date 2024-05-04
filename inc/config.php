<?php

	// Database Credentials
	define('DB_HOST', 'localhost');
	define('DB_DATABASE', 'dbname');
	define('DB_USERNAME', 'dbuser');
	define('DB_PASSWORD', 'password');

	// Email Credentials
	define('SMTP_HOST', 'smpt.server.xyz');
	define('SMTP_PORT', 465);
	define('SMTP_USERNAME', 'username');
	define('SMTP_PASSWORD', 'password');
	define('SMTP_FROM', 'mysmpt@email.xyz');
	define('SMTP_FROM_NAME', 'SMTP from');

	// Global Variables
	define('MAX_LOGIN_ATTEMPTS_PER_HOUR', 5);
	define('MAX_EMAIL_VERIFICATION_REQUESTS_PER_DAY', 3);
	define('MAX_PASSWORD_RESET_REQUESTS_PER_DAY', 3);
	define('PASSWORD_RESET_REQUEST_EXPIRY_TIME', 60*60);
	define('CSRF_TOKEN_SECRET', 'write_token_here');
	define('VALIDATE_EMAIL_ENDPOINT', 'http://example.com/validateEmail.php'); #Do not include trailing /
	define('RESET_PASSWORD_ENDPOINT', 'http://example.com/resetPassword.php'); #Do not include trailing /

	// Code we want to run on every page/script
	date_default_timezone_set('UTC'); 
	error_reporting(0);
	session_set_cookie_params(['samesite' => 'Strict']);
	session_start();
	

