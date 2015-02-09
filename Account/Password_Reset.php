<?php
/*
 * Account/Password_Reset.php
 * LHS Math Club Website
 *
 * Provides a mechanism for users who forgot their passwords to reset
 * them.
 */


require_once '../lib/functions.php';


if (isSet($_POST['do_reset_new_password']))
	process_change_page();
else if (isSet($_GET['code']))
	verify_code();
else if (isSet($_POST['do_initiate_reset']))
	process_request_page();
else if (isSet($_SESSION['ACCOUNT_sent_password_reset']))
	show_email_sent_page();
else
	show_request_page('', 'email');





/*
 * show_request_page($err, $selected_field)
 *
 * Shows the page where users enter their email address to begin the
 * password reset process
 */
function show_request_page($err, $selected_field) {
	restrict_access('X');
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// Get the code for reCAPTCHA
	$recaptcha_code = recaptcha_get_html_f();
	
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'initiatePasswordReset\'].' . $selected_field . '.focus()';
	
	// make page
	page_header('Password Reset');
	echo <<<HEREDOC
      <h1>Password Reset</h1>
      
      If you forgot your password, use this form to reset it.<br />
      <br />
      $err
      <form id="initiatePasswordReset" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>Email Address:</td>
            <td><input type="text" name="email" value="{$_POST['email']}" size="25"/></td>
          </tr><tr>
            <td>Are you human?</td>
            <td>$recaptcha_code</td>
          </tr><tr>
            <td></td>
            <td>
              <input type="submit" name="do_initiate_reset" value="Continue"/>
              &nbsp;<a href="Signin">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
}






/*
 * process_request_page()
 *
 * Validates the above form. If everything is okay, it generates a password
 * reset code and sends a reset email to the user.
 */
function process_request_page() {
	restrict_access('X');
	
	// Check the reCaptcha
	$recaptcha_msg = validate_recaptcha();
	if($recaptcha_msg !== true){
		show_request_page($recaptcha_msg,'recaptcha_response_field');
		return;
	}
	
	// Check that an account with that email address exists.
	$email = mysqli_real_escape_string(DB::get(),strtolower($_POST['email']));
	
	$query = 'SELECT id, name, email, password_reset_code FROM users WHERE LOWER(email)="' . $email . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1) {
		show_request_page('An account with that email address does not exist.', 'email');
		return;
	}
	
	
	// ** INFORMATION VERIFIED AT THIS POINT **
	
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	
	// See if a password reset code has already been generated; if not, do so
	$reset_code = $row['password_reset_code'];
	if ($reset_code == '0') {
		$reset_code = generate_code(5);
		$query = 'UPDATE users SET password_reset_code="' . $reset_code . '" WHERE id="' . $id . '" LIMIT 1';
		DB::queryRaw($query);
	}
	
	// Generate the reset link
	$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
	$url_pieces = parse_url($_SERVER['REQUEST_URI']);
	$link = $protocol . '://' . $_SERVER['HTTP_HOST'] . dirname($url_pieces['path']) .
	'/Password_Reset?id=' . $id . '&code=' . $reset_code;
	
	// Assemble the email
	global $WEBMASTER_EMAIL;
	$to = $row['name'] . ' <' . $row['email'] . '>';
	$subject = 'Password Reset';
	$body = <<<HEREDOC
To reset your password, click this link:

$link


If you did not request a password reset, please contact <$WEBMASTER_EMAIL>.
HEREDOC;

	send_email($to, $subject, $body, $WEBMASTER_EMAIL);
	
	// Redirect back to prevent refreshing-resends
	$_SESSION['ACCOUNT_password_reset_email'] = $row['email'];
	$_SESSION['ACCOUNT_password_reset_time'] = time();
	$_SESSION['ACCOUNT_sent_password_reset'] = true;
	header('Location: Password_Reset');
}





/*
 * show_email_sent_page()
 *
 * Shows the page that says that an email has been sent.
 */
function show_email_sent_page() {
	restrict_access('X');
	
	if (time() >= $_SESSION['ACCOUNT_password_reset_time'] + 300) {	// that page stops being displayed after 5 minutes.
		unset($_SESSION['ACCOUNT_sent_password_reset']);			// On a public computer, you wouldn't want your email address
		unset($_SESSION['ACCOUNT_password_reset_time']);			// hanging around indefinitely.
		unset($_SESSION['ACCOUNT_password_reset_email']);
		
		show_request_page('', 'email');
		return;
	}
	
	page_header('Password Reset');
	echo <<<HEREDOC
      <h1>Password Reset</h1>
      
      A confirmation message has been sent to <span class="b">{$_SESSION['ACCOUNT_password_reset_email']}</span>.
      Please click on the link in the message to continue.
HEREDOC;
}





/*
 * verify_code()
 *
 * The confirmation link points to here; shows the reset form
 */
function verify_code() {
	$query = 'SELECT id, name, password_reset_code FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['id']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	// User not found
	if (mysqli_num_rows($result) != 1)
		trigger_error('User not found', E_USER_ERROR);
	
	// Incorrect code
	$row = mysqli_fetch_assoc($result);
	if ($row['password_reset_code'] != mysqli_real_escape_string(DB::get(),$_GET['code']))
		trigger_error('Incorrect code', E_USER_ERROR);
	
	// Code = "1"
	if (strlen($_GET['code']) != 5)
		trigger_error('No password reset requested', E_USER_ERROR);
	
	// ** LINK VERIFIED AT THIS POINT **
	
	// Set session variables
	session_destroy();  // clear any stored data...yes, you get logged out
	session_name('Session');
	session_start();
	session_regenerate_id(true);  // change session id to prevent hijacking
	
	$_SESSION['xsrf_token'] = generate_code(20);
	$_SESSION['ACCOUNT_passreset_name'] = $row['name'];
	$_SESSION['ACCOUNT_passreset_id'] = $row['id'];	// enables the password reset
	
	show_new_password_page('');
}





/*
 * show_new_password_page($err)
 */
function show_new_password_page($err) {
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'resetPassword\'].pass1.focus()';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	
	// SHOW PAGE
	page_header('Password Reset');
	echo <<<HEREDOC
      <h1>Password Reset</h1>
      
      Name: <span class="b">{$_SESSION['ACCOUNT_passreset_name']}</span><br /><br />
      $err
      <form id="resetPassword" method="post" action="{$_SERVER['REQUEST_URI']}">
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <table>
          <tr>
            <td>New Password:</td>
            <td><input type="password" name="pass1" size="25"/></td>
          </tr><tr>
            <td>Retype Password:</td>
            <td><input type="password" name="pass2" size="25"/></td>
          </tr><tr>
            <td></td>
            <td><input type="submit" name="do_reset_new_password" value="Change Password"/></td>
          </tr>
        </table>
      </form>
HEREDOC;
}





/*
 * process_change_page()
 *
 * Validates the new-password form, changes the password, and then logs the user in
 */
function process_change_page() {
	// Check the XSRF token
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF token invalid', E_USER_ERROR);
	
	// Check that the passwords match, meet minimum length requirement
	$pass = $_POST['pass1'];
	if ($pass != $_POST['pass2']) {
		show_new_password_page('The passwords that you entered do not match.', 'pass1');
		return;
	}
	if (strlen($pass) < 8) {
		show_new_password_page('Please choose a password that has at least 8 characters.', 'pass1');
		return;
	}
	
	// Check that the user is allowed to change thier password
	if (!isSet($_SESSION['ACCOUNT_passreset_id'])) {
		show_new_password_page('Error: You\'re not allowed to do this?!');
		return;
	}
	
	
	// ** PASSWORD IS VALIDATED AT THIS POINT **
	
	// Prevent from resubmitting this form
	$id = $_SESSION['ACCOUNT_passreset_id'];
	
	unset($_SESSION['ACCOUNT_passreset_id']);
	unset($_SESSION['ACCOUNT_passreset_name']);
	
	$query = 'SELECT email FROM users WHERE id="' . $id . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	// Change password
	$email = mysqli_real_escape_string(DB::get(),strtolower($row['email']));
	$passhash = hash_pass($email, $pass);
	
	$query = 'UPDATE users SET passhash="' . mysqli_real_escape_string(DB::get(),$passhash)
		. '", password_reset_code="0" WHERE id="' . $id . '" LIMIT 1';
	DB::queryRaw($query);
	
	// LOG IN
	set_login_data($id);
	
	
	// SHOW PAGE
	page_header('Password Reset');
	echo <<<HEREDOC
      <h1>Password Reset</h1>
      
      Your password has been changed successfully.
HEREDOC;
}

?>