// global functions
function request(url, data, callback) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);
	var loader = document.createElement('div');
	loader.className = 'loader';
	document.body.appendChild(loader);
	xhr.addEventListener('readystatechange', function() {
		if(xhr.readyState === 4) {
			if(callback) {
				callback(xhr.response);
			}
			loader.remove();
		}
	});

	var formdata = data ? (data instanceof FormData ? data : new FormData(document.querySelector(data))) : new FormData();

	var csrfMetaTag = document.querySelector('meta[name="csrf_token"]');
	if(csrfMetaTag) {
		formdata.append('csrf_token', csrfMetaTag.getAttribute('content'));
	}

	xhr.send(formdata);
}


// index.php
function logout() {
	request('inc/logout.php', false, function(data) {
		if(data === '0') {
			window.location = 'login';
		}
	});
}
function deleteAccount() {
	request('inc/deleteAccount.php', false, function(data) {
		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;
		switch(data) {
			case '0':
				window.location = 'register';
				break;
			case '1':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Failed to delete account. Please try again later.</div>';
				break;
			case '2':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Failed to connect to database. Please try again later.</div>';
				break;
			case '3':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">You are not logged in.</div>';
				break;
			case '4':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Invalid CSRF Token... Nice try</div>';
				break;
			default:
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">(1) An unknown error occurred. Please try again later.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}

// login.php
function login() {
	request('inc/login.php', '#loginForm', function(data) {
		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;
		switch(data) {
			case '0':
				window.location = './';
				break;
			case '1':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Incorrect username or password</div>';
				break;
			case '2':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Failed to connect to database. Please try again later.</div>';
				break;
			case '3':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">You have exceeded the max number of login attempts per hour. Try again in an hour.</div>';
				break;
			case '4':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Your email has not been validated. Please check your email for a validation link or <a href="./validateEmail.php">click here</a> to send another link</div>';
				break;
			default:
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">(2) An unknown error occurred. Please try again later.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}

// register.php
function register() {
	request('inc/register.php', '#registerForm', function(data) {
		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;
		try {
			data = JSON.parse(data);
			if(!(data instanceof Array)) {throw Exception('bad data');}

			//Show errors to user
			for(var i = 0;i < data.length;++i) {
				switch(data[i]) {
					case 0:
						document.getElementById('errs').innerHTML += '<div class="alert alert-success" role="alert">Your account has been created!</div><div>Please validate your email by checking your inbox for a validation link before logging in.</div>';
						document.getElementById('registerForm').reset();
						break;
					case 1:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Invalid name entered. (only use letters, spaces, and hyphens)</div>';
						break;
					case 2:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Invalid email entered.</div>';
						break;
					case 3:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Email does not exist. (This domain does not have a mail server)</div>';
						break;
					case 4:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Password must contain: <ul><li>At least 8 characters</li><li>At least one lower case letter</li><li>At least one upper case letter</li><li>At least one number</li><li>At least one special character (~?!@#$%^&*)</li></ul></div>';
						break;
					case 5:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Passwords do not match. Please re-enter your confirmed password.</div>';
						break;
					case 6:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Failed to add account to database. Please try again later.</div>';
						break;
					case 7:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">An account with this email already exists</div>';
						break;
					case 8:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Failed to connect to the database. Please try again later.</div>';
						break;
					case 9:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Invalid CSRF Token. Please try again later.</div>';
						break;
					case 10:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Failed to send email. Please try again later.</div>';
						break;
					case 11:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Failed to insert request into database. Please try again later.</div>';
						break;
					case 12:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">You have exceeded your number of allowed validation requests per day</div>';
						break;
					case 13:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">The user with this email is already validated</div>';
						break;
					case 14:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">A user with this email does not exist</div>';
						break;
					case 15:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">Failed to connect to database. Please try again later.</div>';
						break;
					default:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert">(3) An unknown error occurred. Please try again later.</div>';
				}
			}
		}
		catch(e) {
			document.getElementById('errs').innerHTML = '<div class="alert alert-danger" role="alert">(4) An unknown error occurred. '+e.message+' Please try again later.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}

// validateEmail.php
function sendValidateEmailRequest() {
	request('inc/sendValidationEmail.php', '#validateEmailForm', function(data) {
		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;

		switch(data) {
			case '0':
				document.getElementById('errs').innerHTML += '<div class="alert alert-success" role="alert" >Email Sent... Check your email and click the link in the email to validate your email.</div>';
				document.getElementById('validateEmailForm').reset();
				break;
			case '1':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Failed to send email. Please try again later.</div>';
				break;
			case '2':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Failed to insert request into database. Please try again later.</div>';
				break;
			case '3':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >You have exceeded your number of allowed validation requests per day</div>';
				break;
			case '4':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >The user with this email is already validated</div>';
				break;
			case '5':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >A user with this email does not exist</div>';
				break;
			case '6':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Failed to connect to database. Please try again later.</div>';
				break;
			default:
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >(5) An unknown error occurred. Please try again later.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}

// resetPassword.php
function passwordResetRequest() {
	request('inc/passwordResetRequest.php', '#resetPasswordForm', function(data) {
		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;

		switch(data) {
			case '0':
				document.getElementById('errs').innerHTML += '<div class="alert alert-success" role="alert" >An email has been sent if an account with that email exists</div>';
				document.getElementById('resetPasswordForm').reset();
				break;
			case '1':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Failed to send email. Please try again later.</div>';
				break;
			case '2':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Failed to insert request into database. Please try again later.</div>';
				break;
			case '3':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >You have exceeded your number of allowed reset requests per day. Try again later.</div>';
				break;
			case '4':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Failed to connect to database. Please try again later.</div>';
				break;
			case '5':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Invalid CSRF token</div>';
				break;
			case '6':
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >You must enter an email</div>';
				break;
			default:
				document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >(6) An unknown error occurred. Please try again later.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}
function changePassword() {
	request('inc/changePassword.php', '#changePasswordForm', function(data) {
		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;
		try {
			data = JSON.parse(data);
			if(!(data instanceof Array)) {throw Exception('bad data');}

			//Show errors to user
			for(var i = 0;i < data.length;++i) {
				switch(data[i]) {
					case 0:
						document.getElementById('errs').innerHTML += '<div class="alert alert-success" role="alert" >Your password has been reset! You can now <a href="./login">login</a></div>';
						document.getElementById('changePasswordForm').reset();
						break;
					case 1:
					case 2:
					case 7:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Invalid password reset request. If this is a mistake send a new request and click the link in the email.</div>';
						break;
					case 3:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Password must contain: <ul><li>At least 8 characters</li><li>At least one lower case letter</li><li>At least one upper case letter</li><li>At least one number</li><li>At least one special character (~?!@#$%^&*)</li></ul></div>';
						break;
					case 4:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Passwords do not match. Please re-enter your confirmed password.</div>';
						break;
					case 5:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Failed to update password in the database. Please try again later.</div>';
						break;
					case 6:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >This password reset request has expired. Please send another email.</div>';
						break;
					case 8:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Failed to connect to the database. Please try again later.</div>';
						break;
					case 9:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >Invalid CSRF Token. Please try again later.</div>';
						break;
					default:
						document.getElementById('errs').innerHTML += '<div class="alert alert-danger" role="alert" >(7) An unknown error occurred. Please try again later.</div>';
				}
			}
		}
		catch(e) {
			document.getElementById('errs').innerHTML = '<div class="alert alert-danger" role="alert" >(8) An unknown error occurred. Please try again later.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}