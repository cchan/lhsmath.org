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

if (isSet($_POST['do_login']))
	process_login_form();
else
	show_login_form('','');





/*
 * show_login_form($err,$email)
 *
 * Shows the login page with an error message, if specified, and keeping the email from the previous login attempt, if specified.
 */
function show_login_form($err,$email) {
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'login\'].email.focus()';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// Assemble the page, and send.
	page_header('Log In');
	echo <<<HEREDOC
      <h1>Log In</h1>
      $err
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
      <div class="alert regalert">Don't have an account? <a href="Register">Register here</a>.</div>
HEREDOC;
	default_page_footer('Member Login');
}





/*
 * process_login_form()
 *
 * Processes the login form and, if the credentials are correct, logs the user in.
 */
function process_login_form() {
	$email = mysql_real_escape_string(strtolower($_POST['email']));
	$passhash = mysql_real_escape_string(hash_pass($email, $_POST['pass']));
	
	// Check to see if the user/ip is temporarily banned:
	//   a certain IP is banned from attempting to log in to
	//   a specific account for 10 minutes after 10 login failures;
	//   the counter is reset after a successful login.
	// --todo-- this creates unnecessary db queries; log to file instead.
	$query = 'SELECT COUNT(*) AS attempts FROM login_attempts WHERE successful = 0'
		. ' AND remote_ip="' . $_SERVER['REMOTE_ADDR']
		. '" AND request_time > (NOW() - INTERVAL 10 MINUTE)';// ORDER BY request_time';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	/* //Used to be up to "10 since last successful within timespan" now it's just up to "10 within timespan", far more efficient
	$attempts = 0;
	$row = mysql_fetch_assoc($result);
	while ($row) {
		if ($row['successful'] == '1')
			$attempts = 0;
		else
			$attempts++;
		$row = mysql_fetch_assoc($result);
	}
	if ($attempts >= 10) {
	*/
	
	$row = mysql_fetch_assoc($result);
	if($row["attempts"]>10){
		show_login_form('You have been temporarily locked out. Please wait 10 minutes before attempting to sign in again.','');
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
	$result = DB::queryFirstField('SELECT COUNT(*) FROM users WHERE LOWER(email)=%s AND passhash=%s LIMIT 1',$email,$passhash);
	
	if ($result == 0) {
		log_attempt($email, false);
		show_login_form('Incorrect email address or password',$email);
		return;
	}
	
	
	// ** CREDENTIALS ARE VALIDATED AT THIS POINT ** //
	log_attempt($email, true);
	$row = $result->fetch_assoc();
	set_login_data($row['id']);
	
	login_redirect();
}





/*
 * login_redirect()
 *
 * After a user is logged in, this function redirects them to the page
 * that they were trying to visit.
 */
function login_redirect() {
	global $being_included;
	
	if ($being_included)
		header('Location: ' . $_SERVER['REQUEST_URI']);
	else
		header('Location: ../Home');
}

?>