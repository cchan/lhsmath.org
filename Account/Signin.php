<?php
/*
 * Account/Signin.php
 * LHS Math Club Website
 *
 * Shows the login page and processes the form.
 */

global $being_included;
$being_included = true;	// this page can be INCLUDE'd into another page, so, for example
							// when a user wants to access /Scores but isn't logged in, they
							// are shown a login form *without* being redirected.
if (!defined('FUNCTIONSPHP')) {
	require_once '../.lib/functions.php';
	$being_included = false;
}
else{
	DB::useDB('lhsmath');
}

restrict_access('X'); // Will restrict to non-logged-in: redirects logged in users back home.

page_title('Log In');

if (isSet($_POST['do_login']))
	process_login_form();
else
	show_login_form('');

global $DB_DATABASE;//I don't know why we need this when in the global scope, but we do
DB::useDB($DB_DATABASE);//Because it can be included from lmt pages, which uses db $LMT_DATABASE.



/*
 * show_login_form($email)
 *
 * Shows the login page, keeping the email from the previous login attempt if specified.
 */
function show_login_form($email) {
	// Assemble the page, and send.
	echo <<<HEREDOC
      <h1>Log In</h1>
      <form id="login" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>Email Address:&nbsp;</td>
            <td><input type="text" name="email" size="25" value="$email" class="focus"/></td>
          </tr><tr>
            <td>Password:</td>
            <td>
              <input type="password" name="pass" size="25" value=""/><br />
              <a href="Password_Reset" class="small">Forgot your password?</a>
            </td>
          </tr><tr>
            <td></td>
            <td><input type="submit" name="do_login" value="Sign In"/></td>
          </tr>
        </table>
      </form>
      
      <br /><br /><br />
      <div class="alert neut">Don't have an account? <a href="Register">Register here</a>.</div>
HEREDOC;
}





/*
 * process_login_form()
 *
 * Processes the login form and, if the credentials are correct, logs the user in.
 */
function process_login_form() {
	$email = strtolower($_POST['email']);
	$passhash = hash_pass($email, $_POST['pass']);
	
	// Check to see if the user/ip is temporarily banned:
	//   An IP is banned when 10 unsuccessful attempts are made to log in from a single IP/email within 10 minutes, 
	//   regardless of whether any successful attempts were made.
	$attempts = DBExt::queryCount('login_attempts',array('successful=0','(remote_ip=%s OR email=%s)',DBExt::timeInInterval('request_time','-10m','')),$_SERVER['REMOTE_ADDR'],$email);
	if($attempts > 10){
		log_attempt($email, false);
		alert('You have been temporarily locked out. Please wait 10 minutes before attempting to sign in again.',-1);
		show_login_form('');
		return;
	}
	
	
	// Check for super-user login:
	// (the account LHSMATH and password set in CONFIG
	if ($email == 'lhsmath') {
		global $LHSMATH_PASSWORD;
		if ($passhash == $LHSMATH_PASSWORD) {	// $LHSMATH_PASSWORD is pre-hashed
			log_attempt('LHSMATH', true);
			session_destroy();
			session_name('Session');
			session_start();
			session_regenerate_id(true);
			
			$_SESSION['user_name'] = 'LHSMATH Super-Admin';
			$_SESSION['permissions'] = '+';
			
			$_SESSION['login_time'] = time();
			$_SESSION['user_id'] = '-999';
			
			header('Location: ' . URL::root() . '/Admin/Super_Admin');
			die();
		}
	}
	
	
	// Validate credentials
	$id = DB::queryFirstField('SELECT id FROM users WHERE LOWER(email)=%s AND passhash=%s LIMIT 1',$email,$passhash);
	
	if (is_null($id)) {
		log_attempt($email, false);
		show_login_form($email);
		alert('Incorrect email address or password',-1);
		return;
	}
	
	
	// ** CREDENTIALS ARE VALIDATED AT THIS POINT ** //
	log_attempt($email, true);
	set_login_data($id);
	
	alert('Logged in!',1);
	
	//If this page was being included, redirect back.
	global $being_included;
	if ($being_included)
		header('Location: ' . $_SERVER['REQUEST_URI']);
	else
		header('Location: ../Home');
}

?>