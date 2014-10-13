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

if ((isSet($_POST["do_preview_message"]) || isSet($_POST["do_post_message"]) || isSet($_POST["do_reedit_message"])) && validate_message()){//POSTed.
	//Stuff was posted, AND it's validated & loaded into globals.
	if (isSet($_POST['do_preview_message']))
		preview_message();
	elseif (isSet($_POST['do_post_message']))
		post_message();
	else
		edit_message();//Re-edit!
}
else{
	edit_message();
	//nothing was POSTed (just got here and starting to post a msg), or error occurred in validation.
}




function edit_message() {
	page_header('Post Message');
	
	// Get info for the byline
	$row = DB::queryFirstRow('SELECT name, email FROM users WHERE id=%i',$_SESSION['user_id']);
	$by_line = $row['name'] . ' &lt;' . $row['email'] . '&gt;';
	
	// Previously-filled data?
	global $subject, $bb_body, $post_through, $email;
	
	$email_checked = array('yes-captains'=>'', 'yes-you'=>'', 'no'=>'');
	if(@$email_checked[$email] !== '')$email = 'yes-you';
	$email_checked[$email] = 'checked="checked"';
	
	// Assemble Page
?>
<h1>Post a Message</h1>
<form id="composeMessage" method="post">
<table class="spacious">
  <tr>
	<td>By:</td>
	<td>
	  <span class="b"><?=$by_line?></span><br />
	</td>
  </tr><tr>
	<td>Subject:</td>
	<td><input type="text" name="subject" value="<?=$subject?>" size="45" maxlength="75" class="focus"/></td>
  </tr><tr>
	<td>Body:</td>
	<td>
	  <textarea name="body" rows="10" cols="80"><?=$bb_body?></textarea>
	  <div class="small">LHSMATH features <a href="Captains#BBCode" target="_blank">bbCode-like syntax</a>.</div>
	  <br /><br />
	</td>
  </tr><tr>
	<td>Mailing:&nbsp;</td>
	<td>
	  <input type="radio" name="email" value="yes-captains" <?=$email_checked['yes-captains']?>/> Send to the mailing list, reply-to all captains, and post online<br />
	  <input type="radio" name="email" value="yes-you" <?=$email_checked['yes-you']?>/> Send to the mailing list, reply-to only you, and post online<br />
	  <input type="radio" name="email" value="no" <?=$email_checked['no']?>/> Post online only<br /><br />
	</td>
  </tr><tr>
	<td></td>
	<td>
	  <input type="hidden" name="xsrf_token" value="<?=$_SESSION['xsrf_token']?>"/>
	  <input type="submit" name="do_preview_message" value="Preview Message"/>
	</td>
  </tr>
</table>
</form>
<?php
	admin_page_footer('Post a Message');
}





function preview_message() {
	global $subject, $bb_body, $html_body, $email;
	
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
	
	$quot = function($t){return str_replace('"','\"',$t);}; //hax to make it able to put into {} in HEREDOC
?>
<h1>Post a Message</h1>

<table class="spacious">
<tr>
  <td>By:</td>
  <td><span class="b"><?=$by_line?></span></td>
</tr><tr>
  <td>Subject:</td>
  <td><span class="b">[LHS Math Club] <?=$subject?></span><br /><br /></td>
</tr><tr>
  <td>Body:</td>
  <td><?=$html_body?><br /><br /></td>
</tr><tr>
  <td>Mailing:&nbsp;</td>
  <td><span class="b"><?=$mailing_message?></span><br /><br /></td>
</tr><tr>
  <td></td>
  <td>
	<form id="composeMessage" method="post"><div>
	  <input type="hidden" name="subject" value="<?=$quot($subject)?>"/>
	  <input type="hidden" name="body" value="<?=$quot($bb_body)?>"/>
	  <input type="hidden" name="email" value="<?=$quot($email)?>"/>
	  <input type="hidden" name="xsrf_token" value="<?=$_SESSION['xsrf_token']?>"/>
	  <input type="submit" name="do_reedit_message" value="Back to Editing"/>
	  <input type="submit" name="do_post_message" value="Post Message"/>
	</div></form>
  </td>
</tr><tr>
  <td></td>
  <td><span class="small">Please do not click the &quot;Post Message&quot; button twice!</span></td>
</tr>
</table>
<?php
	admin_page_footer('Post a Message');
}




function post_message() {
	global $subject, $html_body, $email;
	
	// Insert into database
	DB::insert('messages',array('author'=>$_SESSION['user_id'], 'subject'=>$subject, 'body'=>$html_body));
	
	// Send email
	if ($email != 'no') {
		if($email == 'yes-captains'){
			$reply_to = array('captains@lhsmath.org'=>'LHS Math Club Captains');
			$m = " and emailed to everyone (reply-to all captains)";
		}
		else{ //if($email == 'yes-you')
			$reply_to = array($_SESSION['email']=>$_SESSION['user_name']);
			$m = " and emailed to everyone (reply-to you)";
		}
		
		send_list_email($subject, $html_body, $reply_to);
	}
	else $m = ", but not emailed out";
	
	alert("Your message has been posted$m. <a href='../Messages?View=".DB::insertId()."'>View</a>",1);
	location();
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
	global $subject, $bb_body, $html_body, $email;
	$subject = strip_tags($_POST['subject']);
	$bb_body = strip_tags($_POST['body']);
	$html_body = BBCode($bb_body);
	$email = strip_tags($_POST['email']);
	
	// Maximum lengths on subject, body
	if(($err=val_email_msg($subject,$bb_body))!==true){
		alert($err,-1);
		return false;
	}
	
	return true;
}

?>