<?php
/*
 * restrict_access($levels)
 *  - $levels: what types of users can access this page:
 *    * 'A': Administrative (Advisor and Webmaster)
 *    * 'C': Captains
 *    * 'R': Regular (approved users)
 *    * 'P': Pending approval
 *    * 'B': Banned
 *    * 'E': Email verification pending
 *    * '+': Super-Admin (LHSMATH account)
 *    * 'L': Alumnus
 *    * 'X': Logged-out user
 *    * 'T': Temporary user (should not be able to log in)
 */
function restrict_access($levels) {
	global $path_to_root;
	
	if (!user_access($levels)) {
		// Access forbidden
		
		$user_level = $_SESSION['permissions'];
		
		if ($user_level == 'X') {
			alert('You need to log in to do that.',-1);
			require_once $path_to_root . 'Account/Signin.php';
			die();
		}
		else if ($user_level == 'E')
			location('Account/Verify_Email');
		else if ($user_level == 'P')
			location('Account/Approve');
		else if ($user_level == '+')
			location('Admin/Super_Admin');
		else if ($user_level == 'B')
			location('Account/Banned');
		else // Go home - e.g. if you're logged in and it's restrict_access('X') on Signin, you shouldn't be signing in again. It'll just bring you back home.
			location('Home');
	}
}
function user_access($levels){
	if (!array_key_exists('permissions',$_SESSION))
		$user_level = $_SESSION['permissions'] = 'X';
	else
		$user_level = $_SESSION['permissions'];
	return (stripos($levels, $user_level) !== false);
}





/*
 * set_login_data($id)
 *  - $row: the result of mysqli_fetch_assoc() on the query 'SELECT * FROM users WHERE id="..."'
 *
 * Sets the SESSION variables that contain a logged-in user's information
 * 
 * Note that this is an exceptionally vulnerable function, since calling set_login_data (some random id) will result in login.
 * I actually accidentally hijacked it, since DB query wasn't working, but it still logged in. O_o
 */
function set_login_data($id) {
	if (user_access('+'))	// if you're already logged in as the Super-Admin, this would mess things up cuz it's not in the database
		return;
	
	if (!isSet($_SESSION['user_id'])) {
		// ** THIS IS A LOG-IN, NOT A REFRESH OF EXISTING DATA, SO... ***
		session_destroy();  // clear any stored data
		session_name('Session');
		session_start();
		session_regenerate_id(true);  // change session id to prevent hijacking
	}
	
	$row = DB::queryFirstRow('SELECT id, name, permissions, email, approved, password_reset_code, email_verification FROM users WHERE id=%i LIMIT 1',$id);
	
	if(!$row){
		session_destroy();
		trigger_error("Authentication error",E_USER_ERROR);
	}
	
	$_SESSION['user_name'] = $row['name'];
	$_SESSION['permissions'] = $row['permissions'];
	$_SESSION['email'] = $row['email'];
	
	// SPECIAL PERMISSIONS
	if (user_access('C')) {	// Captain is a type of Administrator
		$_SESSION['permissions'] = 'A';
		$_SESSION['is_captain'] = true;
	}
	
	if ($row['approved'] == '-1')				// Banned status
		$_SESSION['permissions'] = 'B';
	else if ($row['email_verification'] != '1')	// "Email-Not-Yet-Verified" status
		$_SESSION['permissions'] = 'E';
	else if ($row['approved'] == '0')			// "Not-Yet-Approved" status
		$_SESSION['permissions'] = 'P';
	
	// Admins have an asterisk appended to their name
	if (user_access('A'))
		$_SESSION['user_name'] .= '*';
	
	// If a password reset has been requested, cancel it -
	// apparently, they remembered their password
	if ($row['password_reset_code'] != '0')
		DB::update('users',array('password_reset_code'=>0),'id=%i LIMIT 1',$row['id']);
	
	// REFRESH TIME
	$_SESSION['last_refresh'] = time();
	
	if (!isSet($_SESSION['user_id'])) {
		// ** THIS IS A LOG-IN, NOT A REFRESH OF EXISTING DATA, SO... ***
		$_SESSION['login_time'] = time();
		$_SESSION['user_id'] = $row['id'];	// the actual log-in
	}
}





/*
 * log_attempt($email, $success)
 *  - $email: the email address entered
 *  - $success: if the login attempt succeeded
 *
 * If a user attempts to log in, this is recorded in the database
 */
function log_attempt($email, $success) {
	if ($email == '')return;
	
	if ($success)$success = '1';
	else $success = '0';
	

	DB::insert('login_attempts',array(
		'email'=>strtolower($email),
		'remote_ip'=>strtolower($_SERVER['REMOTE_ADDR']),
		'successful'=>$success
	));
}





/*
 * hash_pass($email, $pass)
 *  - $email: the email address, used to salt the hash
 *  - $pass: the password that was entered
 *  - returns: a 128-character hash that is UNIQUE to this particular
 *      email/password combination
 *
 *  To protect the security of passwords in case the database is
 *  compromised, password are hashed before storage. To validate a
 *  email/password pair, hash them and then compare it to the stored
 *  passhash for that user.
 */
function hash_pass($email, $pass) {//--todo--Should implement key stretching, although that would entail a lot of painfulness.
	global $SECRET_SALT;
	$hash = hash('sha512', 'lhsmath $4S5KoOyu\'B5FRrg(*#%@22aM,jBxQjZIRwnY./\\[X2d$MDLGeUD)}:"mlAt9kekTiaET!mcmVQYTJlk;TdYZJS1aqo' . $email);
	$hash = hash('sha512', $hash . ' lhsmath 2BATHJ0G61o23#%zEHEw];.246893QW0SmXA@$#)bcjtPQI%&#RjjANLpyz' . $pass);
	return hash('sha512', $hash . ' lhsmath elEf\\0il(*@#%.*()eVvBO6' . $pass . ';Rjz@um3FbPj#$89WnYViPz\'XwiP7#C7x42M4hUFd' . $SECRET_SALT);
}





/*
 * generate_code($length)
 *  - $length: the length of the code to generate
 *  - returns: a random hexadecimal code of the given length
 */
function generate_code($length) {
	global $SECRET_SALT;
	$hash = hash('sha256', 'lhsmath L)(#%JHI}90LDNlkasjkaglkd08H#()qpowinfs;lidgn'
		. time() . $_SERVER['REMOTE_ADDR'] . $SECRET_SALT . rand());
	return substr($hash, 0, $length);
}



?>