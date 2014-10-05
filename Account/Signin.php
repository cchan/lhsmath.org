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
if (!isSet($path_to_root)) {
	$path_to_root = '../';
	$being_included = false;
}

require_once $path_to_root . 'lib/functions.php';
restrict_access('X');

page_title('Log In');

if (isSet($_POST['do_login']))
	process_login_form();
else
	show_login_form('');

DB::useDB($DB_DATABASE);//Because it can be included from lmt pages, which uses db $LMT_DATABASE.



/*
 * show_login_form($email)
 *
 * Shows the login page, keeping the email from the previous login attempt if specified.
 */
function show_login_form($email) {
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'login\'].email.focus()';
	
	if ($err != '')
		alert($err,-1);
	
	// Assemble the page, and send.
	echo <<<HEREDOC
      <h1>Log In</h1>
      <form id="login" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>Email Address:&nbsp;</td>
            <td><input type="text" name="email" size="25" value="$email"/></td>
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
	default_page_footer('Member Login');
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
	//   An IP is banned when 10 unsuccessful attempts are made to log in from a single IP within 10 minutes, 
	//   regardless of whether any successful attempts were made.
	$attempts = DB::queryFirstField('SELECT COUNT(*) FROM login_attempts WHERE successful=0 AND (remote_ip=%s OR email=%s) AND request_time>(NOW()-INTERVAL 10 MINUTE)',$_SERVER['REMOTE_ADDR'],$email);// ORDER BY request_time';
	if($attempts>10){
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
			
			global $path_to_root;
			header('Location: ' . $path_to_root . 'Admin/Super_Admin');
			die();
		}
	}
	
	
	// Validate credentials
	$id = DB::queryFirstField('SELECT id FROM users WHERE LOWER(email)=%s AND passhash=%s LIMIT 1',$email,$passhash);
	
	if (is_null($id)) {
		log_attempt($email, false);
		show_login_form(,$email);
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