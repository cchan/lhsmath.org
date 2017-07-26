<?php
/*
 * LMT/Backstage/Email/Individuals.php
 * LHS Math Club Website
 *
 * Allows Admins to send a message to all unaffiliated individuals
 */

require_once '../../../.lib/lmt-functions.php';
restrict_access('A');

if (isSet($_POST['lmti_do_preview_message']))
	preview_message();
else if (isSet($_POST['lmti_do_post_message'])){
	if (($error_msg=lmt_send_individuals_email($_POST['subject'],$_POST['body']))!==true)
		show_page($error_msg);
	else{
		alert('Your message has been sent',1);
		header('Location: Individuals');//Reloads the page
	}
}
else if (isSet($_POST['lmti_do_reedit_message'])){
	if (($error_msg=val_email_msg($subject,$body))!==true)
		show_page($error_msg);
	else
		show_page('');
}
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
              <a href="https://www.bbcode.org/reference.php" rel="external">bbCode</a>.</div>
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
}





function preview_message() {
	// Get info for the byline
	$disp_subject = '[LMT ' . intval(map_value('year')) . '] ' . $_POST['subject'];
	
	lmt_page_header('Email Individuals');
	
	echo <<<HEREDOC
      <h1>Email Individuals</h1>
      
      <table class="spacious">
        <tr>
          <td>From:</td>
          <td><span class="b">LHS Math Club Mailbot &lt;$EMAIL_ADDRESS&gt;</span></td>
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
}

?>