<?php
/*
 * Admin/Invite_Members.php
 * LHS Math Club Website
 *
 * Allows Admins to send invitation emails
 * to new members
 */

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


if (isSet($_POST['do_invite_members']))
	process_form();
else
	show_page();





function show_page() {
	$msg = '';
	if (isSet($_SESSION['INVITE_done'])) {
		$msg = "\n        <div class=\"alert\">An invitation email has been sent. The addresses listed below are invalid or already exist.</div><br />\n";
		$invalid_members = $_SESSION['INVITE_done'];
		unset($_SESSION['INVITE_done']);
	}
	
	if (!isSet($invalid_members))
		$invalid_members = '';
	
	page_header('Invite Members');
	echo <<<HEREDOC
      <h1>Invite Members</h1>
      $msg
      
      <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
        To invite new members, enter one email address per line:<br /><br />
        
        <textarea name="new_members" rows="25" cols="50">$invalid_members</textarea><br />
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_invite_members" value="Send Invitations"/>
      </div></form>
HEREDOC;
	admin_page_footer('Invite Members');
}





function process_form() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$members = preg_split('#[\n\r\s]+#', $_POST['new_members'], PREG_SPLIT_NO_EMPTY);
	
	$invalid_emails = '';
	
	foreach ($members as $email) {
		$email = strtolower($email);
		$valid = true;
		
		// Check that address is valid
		if (!preg_match('/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]'
				.'+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i'
				, $email)) {
			$valid = false;
		}
		
		// Check that account does not already exist
		$sql_email = mysql_real_escape_string($email);
		$query = 'SELECT COUNT(*) FROM users WHERE LOWER(email)="' . $sql_email . '"';
		$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
		$row = mysql_fetch_assoc($result);
		if ($row['COUNT(*)'] != 0) {
			$valid = false;
		}
		
		if (!$valid) {
			$invalid_emails .= $email . "\n";
		}
		else {	// email address is valid; send invitation
			// Generate pre-approval code (the year and month are hashed in)
			global $SECRET_SALT;
			$code = sha1(hash_pass($email, $SECRET_SALT) . 'KJincsaio09j87po8h6CAlo8tesojesai' . date('YF'));
			
			// Generate link
			$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
			$url_pieces = parse_url($_SERVER['REQUEST_URI']);
			$dir = dirname(dirname($url_pieces['path']));
			if ($dir == '/')
				$dir = '';
			$link = $protocol . '://' . $_SERVER['HTTP_HOST'] . $dir . '/Account/Pre_Approval?email='
				. $email . '&approval=' . $code;
			
			// Send email
			global $WEBMASTER_EMAIL;
			$to = ' <' . $email . '>';
			$subject = 'Welcome';
			$body = <<<HEREDOC
Welcome to the LHS Math Club!

The Math Club website allows members to download handouts, view test scores, and
subscribe to the mailing list. To sign up for an account, click the link below:

$link
HEREDOC;
			send_email($to, $subject, $body, $WEBMASTER_EMAIL);
		}
	}
	
	$_SESSION['INVITE_done'] = $invalid_emails;
	header('Location: Invite_Members');
}

?>