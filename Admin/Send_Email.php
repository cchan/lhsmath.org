<?php
require_once '../lib/functions.php';
restrict_access('A');

if(isSet($_POST["sendemail"])){
	if($_POST["pass"]!=="tidy_access_count")throw new Exception("Error.");
	if(array_key_exists("defaultto",$_POST)){
		send_list_email($_POST['subj'], $_POST['msg'], $_POST['repto']);
	}else{
		$to = preg_split( "/(\n|,)/", $_POST['to']);
		foreach($to as &$tmp)
			$tmp = trim($tmp);
		send_email($to, $_POST['subj'], $_POST['msg'], $_POST['repto'], "", "");
	}
	echo "<div><b>sent</b></div><br><br>";
}
?>
This is just for special use, if you want to send mail to activities fair signups or to LMT registration-is-opening, 
for example. If you don't know what you're doing, don't touch it.
<br>This is extremely security-vulnerable, so yeah. You need a password which is in the PHP code. 
Or ask the webmaster nicely and (s)he'll give it to you.
<br>All fields must be filled.
<style>
textarea,input{display:block;}
</style>
<form method="post" action="Send_Email">
	Security Code: <input type="text" name="pass" />
	Recipients (linebreak-or-comma-separated list): <textarea name="to"></textarea>
	Use the actual mailing list instead <input type="checkbox" name="defaultto" />
	
	Subject + Prefix: <input type="text" name="subj" />
	Message + Footer (BBCode acceptable): <textarea name="msg"></textarea>
	Reply-to: <input type="text" name="repto" />
	<input type="submit" name="sendemail" value="Send" />
</form>
