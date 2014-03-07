<?php
/*
 * Admin/Post_Message.php
 * LHS Math Club Website
 *
 * Allows Admins to post an message
 */


$path_to_root = '../';
require_once $path_to_root.'lib/functions.php';
restrict_access('A');


if (isSet($_POST['do_preview_message']))
	preview_message();
else if (isSet($_POST['do_post_message']))
	post_message();
else if (isSet($_POST['do_reedit_message']))
	reedit_message();
else
	show_page('');





/*
 * show_page($err)
 *
 * Shows the window where Admins compose the message
 */
function show_page($err) {
	// Put the cursor in the first field
	global $body_onload, $use_rel_external_script;
	$body_onload = 'document.forms[\'composeMessage\'].subject.focus();externalLinks();';
	$use_rel_external_script = true;
	
	page_header('Post Message');
	
	$message_sent_msg="";
	if (isSet($_SESSION['MESSAGE_sent_id'])) {
		$message_sent_msg = "\n        <div class=\"alert\">Your message has been posted. <a href='../Messages?View=".intval($_SESSION['MESSAGE_sent_id'])."'>View</a></div><br />\n";
		unset($_SESSION['MESSAGE_sent_id']);
	}
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// Get info for the byline
	$query = 'SELECT name, email FROM users WHERE id="' . $_SESSION['user_id'] . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$by_line = $row['name'] . ' &lt;' . $row['email'] . '&gt;';
	
	// Previously-filled data?
	global $subject, $body, $post_through, $email;
	
	
	$email_checked=array('','','');
	if($email=='yes-captains')
		$email_checked[0] = ' checked="checked"';
	elseif($email=='no')
		$email_checked[2] = ' checked="checked"';
	else//if($email=='yes-you')//default
		$email_checked[1] = ' checked="checked"';
	
	// Assemble Page
	echo <<<HEREDOC
<h1>Post a Message</h1>
$err$message_sent_msg
<form id="composeMessage" method="post" action="{$_SERVER['REQUEST_URI']}">
<table class="spacious">
  <tr>
	<td>By:</td>
	<td>
	  <span class="b">$by_line</span><br />
	</td>
  </tr><tr>
	<td>Subject:</td>
	<td><input type="text" name="subject" value="$subject" size="45" maxlength="75"/></td>
  </tr><tr>
	<td>Body:</td>
	<td>
	  <textarea name="body" rows="25" cols="80">$body</textarea>
	  <div class="small">You may use bold, italic, underline, named links and images with
	  <a href="http://www.bbcode.org/reference.php" rel="external">bbCode</a>.</div>
	  <br /><br />
	</td>
  </tr><tr>
	<td>Mailing:&nbsp;</td>
	<td>
	  <input type="radio" name="email" value="yes-captains"{$email_checked[0]}/> Send to the mailing list, reply-to all captains, and post online<br />
	  <input type="radio" name="email" value="yes-you"{$email_checked[1]}/> Send to the mailing list, reply-to only you, and post online<br />
	  <input type="radio" name="email" value="no"{$email_checked[2]}/> Post online only<br /><br />
	</td>
  </tr><tr>
	<td></td>
	<td>
	  <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
	  <input type="submit" name="do_preview_message" value="Preview Message"/>
	</td>
  </tr>
</table>
</form>
HEREDOC;
	admin_page_footer('Post a Message');
}





function preview_message() {
	if (!validate_message())
		return;
	
	global $subject, $bb_body, $body, $email, $use_rel_external_script;
	$use_rel_external_script = true;
	
	// Get info for the byline
	$by_line = $_SESSION['user_name'].' <'.$_SESSION['email'].'>';
	
	$mailing_message = '';
	if($email=='yes-captains')
		$mailing_message = 'Send to the mailing list, reply-to all captains, and post online';
	elseif($email=='no')
		$mailing_message = 'Post online only';
	else//if($email=='yes-you')//default
		$mailing_message = 'Send to the mailing list, reply-to only you, and post online';
	
	page_header('Post Message');
	
	echo <<<HEREDOC
<h1>Post a Message</h1>

<table class="spacious">
<tr>
  <td>By:</td>
  <td><span class="b">$by_line</span></td>
</tr><tr>
  <td>Subject:</td>
  <td><span class="b">[Math Club] $subject</span><br /><br /></td>
</tr><tr>
  <td>Body:</td>
  <td>$bb_body<br /><br /></td>
</tr><tr>
  <td>Mailing:&nbsp;</td>
  <td><span class="b">$mailing_message</span><br /><br /></td>
</tr><tr>
  <td></td>
  <td>
	<form id="composeMessage" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
	  <input type="hidden" name="subject" value="$subject"/>
	  <input type="hidden" name="body" value="$body"/>
	  <input type="hidden" name="email" value="$email"/>
	  <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
	  <input type="submit" name="do_reedit_message" value="Back to Editing"/>
	  <input type="submit" name="do_post_message" value="Post Message"/>
	</div></form>
  </td>
</tr><tr>
  <td></td>
  <td><span class="small">Please do not click the &quot;Post Message&quot; button twice!</span></td>
</tr>
</table>
HEREDOC;

	admin_page_footer('Post a Message');
}





function reedit_message() {
	if (!validate_message())
		return;
	show_page('');
}





function post_message() {
	if (!validate_message())
		return;
	
	global $subject, $bb_body, $body, $email, $use_rel_external_script, $database;
	
	// Insert into database
	$database->query('INSERT INTO messages (author, subject, body) VALUES (%0%,%1%,%2%)',array($_SESSION['user_id'],$subject,$bb_body));
	$msg_insert_id = $database->insert_id;
	
	
	// Send email
	if ($email != 'no') {
		if($email == 'yes-captains')
			$reply_to = 'captains@lhsmath.org';
		else//if($email == 'yes-you') //default
			$reply_to = array($_SESSION['email']=>$_SESSION['user_name']);
		
		$site_url = str_replace(array('http://www.','http://'), '', get_site_url());
		//$list_id = '<members.' . $site_url . '>';
		
		// remove bbCode from text-only version
		$search = array(
			'@\[(?i)b\](.*?)\[/(?i)b\]@si',
			'@\[(?i)i\](.*?)\[/(?i)i\]@si',
			'@\[(?i)u\](.*?)\[/(?i)u\]@si',
			'@\[(?i)img\](.*?)\[/(?i)img\]@si',
			'@\[(?i)url=(.*?)\](.*?)\[/(?i)url\]@si',
			'@\[(?i)div=(.*?)\](.*?)\[/(?i)div\]@si',
			'@\[(?i)span=(.*?)\](.*?)\[/(?i)span\]@si'
		);
		$replace = array(
			'\\1',
			'\\1',
			'\\1',
			'\\1',
			'\\1',
			'\\2',
			'\\2'
		);
		$txt_body = htmlentities($body);
		$txt_body = preg_replace($search, $replace, $txt_body);
		
		$html_body = $bb_body;
		
		// send all emails
		$result=$database->query('SELECT id, name, email FROM users WHERE mailings="1" AND permissions!="T" AND approved="1" AND email_verification="1"');
		
		$bcc_list = array();
		while ($row = $result->fetch_assoc())
			//if ($row['id'] != $_SESSION['user_id'])	// don't send it to yourself
				$bcc_list[] = $row['email'];
		
		send_email($bcc_list, $subject, $txt_body, $reply_to, '', "LHS Math Club\nTo unsubscribe from this list, visit [$site_url/Account/My_Profile]");
	}
	
	$_SESSION['MESSAGE_sent_id'] = $msg_insert_id;
	header('Location: Post_Message');
}





/*
 * validate_message()
 *
 * Validates the form
 */
function validate_message() {
	// Check XSRF token
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	// Get data
	global $subject, $body, $bb_body, $email;
	$subject = htmlentities($_POST['subject']);
	
	$search = array(
		'@\[(?i)b\](.*?)\[/(?i)b\]@si',
		'@\[(?i)i\](.*?)\[/(?i)i\]@si',
		'@\[(?i)u\](.*?)\[/(?i)u\]@si',
		'@\[(?i)img\](.*?)\[/(?i)img\]@si',
		'@\[(?i)url=(.*?)\](.*?)\[/(?i)url\]@si'
	);
	$replace = array(
		'<span style="font-weight: bold;">\\1</span>',
		'<span style="font-style: italic;">\\1</span>',
		'<span style="text-decoration: underline;">\\1</span>',
		'<img src="\\1" alt=""/>',
		'<a href="\\1" target="_blank">\\2</a>'
	);
	$bb_body = htmlentities($_POST['body']);
	$bb_body = preg_replace($search, $replace, $bb_body);
	$bb_body = nl2br($bb_body);
	
	$body = htmlentities($_POST['body']);
	$email = htmlentities($_POST['email']);
	
	// Validate Data
	
	// Maximum lengths on subject, body
	if (strlen($subject) == 0) {
		show_page('Please enter a subject.');
		return false;
	}
	
	if (strlen($subject) > 75) {
		show_page('Your subject is too long!?');
		return false;
	}
	
	if (strlen($body) == 0) {
		show_page('Please enter a message.');
		return false;
	}
	
	if (strlen($body) > 5000) {
		show_page('Please limit your message to 5000 characters.');
		return false;
	}
	
	return true;
}





function send_multipart_list_email($bcc_list, $subject, $txt_body, $html_body, $reply_to, $list_id) {
	global $EMAIL_ADDRESS, $EMAIL_USERNAME, $EMAIL_PASSWORD,
		$SMTP_SERVER, $SMTP_SERVER_PORT;
	require_once('Mail.php');
	require_once('Mail/mime.php');
	
	$from = 'LHS Math Club Mailbot <'.$EMAIL_ADDRESS.'>';
	$to = 'LHS Math Club Mailbot <' . $EMAIL_ADDRESS . '>';
	$subject = '[Math Club] ' . $subject;
	
	$site_url = get_site_url();
	$txt_body .= <<<HEREDOC


---
LHS Math Club
To unsubscribe from this list, visit [$site_url/Account/My_Profile]
HEREDOC;

	$html_body =  <<<HEREDOC
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  </head>
  <body>
$html_body
    <br />
    <br />
    ---<br />
    LHS Math Club<br />
    To unsubscribe from this list, visit [$site_url/Account/My_Profile]
  </body>
HEREDOC;
	
	
	/*
	//It has been noted that PHP mail() is not a very efficient function for sending bulk mail,
	//but since ~90 is not very "bulk" it doesn't really matter.
	//This eliminates the complexity and overhead of PEAR::* stuff.
	
	$headers ='MIME-Version: 1.0' . "\r\n";
	$headers.='Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers.="From: $from"."\r\n";
	$headers.="To: $to"."\r\n";
	$headers.="Reply-To: $reply_to"."\r\n";
	$headers.="Subject: $subject"."\r\n";
	$headers.="Precedence: bulk"."\r\n";
	$headers.="List-Id: $list_id"."\r\n";
	$headers.="List-Unsubscribe: <$site_url/Account/My_Profile>"."\r\n";
	$headers.="Bcc: $bcc_list"."\r\n";
	
	$txt_body=str_replace("\n.", "\n..", wordwrap($txt_body, 70, "\r\n"));//As recommended by php.net
	
	if(!mail($to,$subject,$txt_body,$headers))trigger_error('Error sending email: ' . $subject, E_USER_ERROR);
	*/
	//Actually, the above didn't work, so we're back to PEAR::*. And probably NSFN will make us pay to use email, so using Gmail SMTP is probably better.
	
	$headers = array('From' => $from,
		'To' => $to,
		'Reply-To' => $reply_to,
		'Subject' => $subject,
		'Precedence' => 'bulk',
		'List-Id' => $list_id,
		'List-Unsubscribe' => '<' . $site_url . '/Account/My_Profile>');
	
	$mime = new Mail_mime();
	$mime->setTXTBody($txt_body);
	$mime->setHTMLBody($html_body);
	$body = $mime->get();
	$headers = $mime->headers($headers);
	
	//Connect to our secret mailbot@lhsmath.org Gmail account.
	$smtp = Mail::factory('smtp',
		array('host' => 'ssl://'.$SMTP_SERVER,
			'port' => $SMTP_SERVER_PORT,
			'auth' => true,
			'username' => $EMAIL_USERNAME,
			'password' => $EMAIL_PASSWORD));
	$mail = $smtp->send($bcc_list, $headers, $body);
	
	if (PEAR::isError($mail))
		trigger_error('Error sending email: ' . $mail->getMessage(), E_USER_ERROR);
}

?>