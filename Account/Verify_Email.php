<?php
/*
 * Account/Verify_Email.php
 * LHS Math Club Website
 *
 * After users register, they must click a link in a verification email in
 * order to activate their account. This page sends that email and gives
 * users the option of resending it.
 */


$path_to_root = '../';
require_once '../lib/functions.php';


if (isSet($_GET['code']))
	verify_code();
else if (isSet($_SESSION['ACCOUNT_do_send_verification_email']))
	send_verification_email();
else if (isSet($_POST['do_resend_verification_email']) && $_POST['xsrf_token'] == $_SESSION['xsrf_token'])
	send_verification_email();	// notice that the XSRF token is verified
else
	show_page();





/*
 * show_page($re_sent)
 *  - $re_sent: if the message has just been resent
 *
 *  Shows a message to users who have not yet verified their email address.
 */
function show_page() {
	restrict_access('E');
	
	// Fetch email
	$query = 'SELECT email FROM users WHERE id="' . $_SESSION['user_id'] . '"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	$email = $row['email'];
	
	// the message that's shown after you click the button
	$resent_text = '';
	if (isSet($_SESSION['ACCOUNT_resent_confirmation_email'])) {
		$resent_text = "\n        <div class=\"alert\">The verification email has just been re-sent</div><br /><br />\n        \n        ";
		unset($_SESSION['ACCOUNT_resent_confirmation_email']);
	}
	
	page_header('Verify Email');
	echo <<<HEREDOC
        <h1>Verify Your Email Address</h1>
        $resent_text
        To complete registration, you must verify your email address. A message has been sent to
        <span class="b">$email</span>. Please click on the link in the message to continue.<br />
        <br />
        <br />
        <form method="post" action="{$_SERVER['REQUEST_URI']}">
          <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
          <input type="submit" name="do_resend_verification_email" value="Resend the Verification Email"/>
        </form>
HEREDOC;
	
	$names[0] = 'Verify Email';
	$pages[0] = '';
	page_footer($names, $pages);
}





function send_verification_email() {
	restrict_access('E');
	
	global $WEBMASTER_EMAIL;
	
	// Fetch email and code
	$query = 'SELECT name, email, email_verification FROM users WHERE id="' . $_SESSION['user_id'] . '"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	$email = $row['email'];
	$verification_code = $row['email_verification'];
	
	// Generate the verification link
	$protocol = (@$_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
	$url_pieces = parse_url($_SERVER['REQUEST_URI']);
	$link = $protocol . '://' . $_SERVER['HTTP_HOST'] . dirname($url_pieces['path']) .
	'/Verify_Email?id=' . $_SESSION['user_id'] . '&code=' . $verification_code;
	
	// Assemble the email
	$to = $email; //'"' . $name . '" <' . $email . '>'; //For some reason this gives an error about RFC format.
	$subject = 'Verify your Email Address';
	//NOTE: in PHP Heredocs, apparently [] means something for variable interpolation,
		//so you need to wrap the variable in {}.
	$body = <<<HEREDOC
Welcome to the LHS Math Club website, {$name}!
Please click on the link below to verify your email address.

[b][url]{$link}[/url][/b]


If you didn't create an account, just ignore this email and nothing will happen.

To report abuse, please contact <{$WEBMASTER_EMAIL}>.
HEREDOC;

	send_email(array($to), $subject, $body, array($WEBMASTER_EMAIL));
	
	if (isSet($_SESSION['ACCOUNT_do_send_verification_email']))
		unset($_SESSION['ACCOUNT_do_send_verification_email']); // only send it once
	else
		$_SESSION['ACCOUNT_resent_confirmation_email'] = true; // so that the page says 'Email has been re-sent'
	header('Location: Verify_Email'); // reload the page so Refreshing won't resend
}





function verify_code() {
	$id = mysqli_real_escape_string(DB::get(),$_GET['id']);
	$query = 'SELECT id, name, permissions, email_verification FROM users WHERE id="' . $id . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('ID not found', E_USER_ERROR);
	
	$row = mysqli_fetch_assoc($result);
	if ($row['email_verification'] != mysqli_real_escape_string(DB::get(),$_GET['code']))
		trigger_error('Code does not match', E_USER_ERROR);
	
	// ** LINK VALIDATED AT THIS POINT **
	
	// mark the email address as validated
	$query = 'UPDATE users SET email_verification="1" WHERE id="' . $id . '" LIMIT 1';
	DB::queryRaw($query);
	
	set_login_data($id);	// LOG THEM IN
	
	// go to the approval page
	header('Location: Approve');
}

?>