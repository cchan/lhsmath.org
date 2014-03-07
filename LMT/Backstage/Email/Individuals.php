<?php
/*
 * LMT/Backstage/Email/Individuals.php
 * LHS Math Club Website
 *
 * Allows Admins to send a message to all unaffiliated individuals
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
restrict_access('A');

if (isSet($_POST['lmti_do_preview_message']))
	preview_message();
else if (isSet($_POST['lmti_do_post_message']))
	post_message();
else if (isSet($_POST['lmti_do_reedit_message']))
	reedit_message();
else
	show_page('');





function show_page($err) {
	// Put the cursor in the first field
	global $body_onload, $use_rel_external_script;
	$body_onload = 'document.forms[\'lmtIndividualComposeMessage\'].subject.focus();externalLinks();';
	$use_rel_external_script = true;
	
	lmt_page_header('Email Individuals');
	
	$message_sent_msg = fetch_alert('msgIndiv');
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// Previously-filled data?
	global $subject, $body, $EMAIL_ADDRESS, $LMT_EMAIL;
	
	// Assemble Page
	echo <<<HEREDOC
      <h1>Email Individuals</h1>
      $err$message_sent_msg
      
      <div class="instruction">
        Use this page to send an email to all unaffiliated individuals (individuals with
        an email address on file).
      </div><br /><br />
      
      <form id="lmtIndividualComposeMessage" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table class="spacious">
          <tr>
            <td>From:</td>
            <td><span class="b">LMT Mailbot &lt;$EMAIL_ADDRESS&gt;</span><br /></td>
          </tr><tr>
            <td>Reply To:&nbsp;</td>
            <td><span class="b">$LMT_EMAIL</span></td>
          </tr><tr>
            <td>Subject:</td>
            <td><input type="text" name="subject" value="$subject" size="45" maxlength="75" /></td>
          </tr><tr>
            <td>Body:</td>
            <td>
              <textarea name="body" rows="25" cols="80">$body</textarea>
              <div class="small">You may use bold, italic, underline, named links and images with
              <a href="http://www.bbcode.org/reference.php" rel="external">bbCode</a>.</div>
              <br />
            </td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmti_do_preview_message" value="Preview Message" />
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	lmt_backstage_footer('Email Individuals');
}





function preview_message() {
	if (!validate_message())
		return;
	
	global $subject, $bb_body, $body, $email, $EMAIL_ADDRESS, $LMT_EMAIL;
	
	// Get info for the byline
	$query = 'SELECT name, email FROM users WHERE id="' . $_SESSION['user_id'] . '"';
	$result = lmt_query($query);
	$row = mysqli_fetch_assoc($result);
	$disp_subject = '[LMT ' . htmlentities(map_value('year')) . '] ' . $subject;
	
	lmt_page_header('Email Individuals');
	
	echo <<<HEREDOC
      <h1>Email Individuals</h1>
      
      <table class="spacious">
        <tr>
          <td>From:</td>
          <td><span class="b">LMT Mailbot &lt;$EMAIL_ADDRESS&gt;</span></td>
        </tr><tr>
          <td>Reply To:&nbsp;</td>
          <td><span class="b">$LMT_EMAIL</span><br /></td>
        </tr><tr>
          <td>Subject:</td>
          <td><span class="b">$disp_subject</span><br /><br /></td>
        </tr><tr>
          <td>Body:</td>
          <td>$bb_body<br /><br /></td>
        </tr><tr>
          <td></td>
          <td>
            <form id="composeMessage" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="hidden" name="subject" value="$subject" />
              <input type="hidden" name="body" value="$body" />
              <input type="hidden" name="email" value="$email" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmti_do_reedit_message" value="Back to Editing" />
              <input type="submit" name="lmti_do_post_message" value="Send Message" />
            </div></form>
          </td>
        </tr><tr>
          <td></td>
          <td><span class="small">Please do not click the &quot;Send Message&quot; button twice!</span></td>
        </tr>
      </table>
      

HEREDOC;
	
	lmt_backstage_footer('Email Individuals');
}





function reedit_message() {
	if (!validate_message())
		return;
	show_page('');
}





function post_message() {
	if (!validate_message())
		return;
	
	global $subject, $bb_body, $body, $email, $use_rel_external_script, $LMT_EMAIL;
	
	// SEND EMAIL
	$reply_to = $LMT_EMAIL;
	$site_url = str_replace('http://www.', '', get_site_url());
	$site_url = str_replace('http://', '', $site_url);
	$list_id = '<individuals.lmt.' . $site_url . '>';
	
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
	
	// send individual emails
	$result = lmt_query('SELECT name, email FROM individuals WHERE email != "" AND deleted="0"');
	
	$row = mysqli_fetch_assoc($result);
	$count = 0;
	$bcc_list = '';
	while ($row) {
		if ($count != 0)
			$bcc_list .= ', ';
		$bcc_list .= $row['name'] . ' <' . $row['email'] . ' >';
		
		if ($count++ > 90) {
			lmt_send_multipart_list_email($bcc_list, $subject, $txt_body, $html_body, $reply_to, $list_id);
			$count = 0;
		}
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($count != 0)
		lmt_send_multipart_list_email($bcc_list, $subject, $txt_body, $html_body, $reply_to, $list_id);
	
	add_alert('msgIndiv', 'Your message has been sent');
	header('Location: Individuals');
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

?>