<?php


$path_to_root = '../';
require_once $path_to_root.'lib/functions.php';
restrict_access('A');

if(isSet($_POST["sendemail"])){
	if($_POST["pass"]!=="tidy_access_count")throw new Exception("Error.");
	if($_POST["defaultto"]){
		$to = get_bcc_list();
	}
	else {
		$to = explode("\n",$_POST['to']);
	}
	$subject = htmlentities($_POST['subj']);
	$msg = htmlentities($_POST['msg']);
	$repto = htmlentities($_POST['repto']);
	send_email($to, $subject, $msg, $repto, '[LHS Math Club] ', "LHS Math Club\nTo stop receiving LHSMATH emails, contact [webmaster@lhsmath.org].");
}
else{
?>
This is just for special use, if you want to send mail to activities fair signups, for example. If you don't know what you're doing, don't touch it.
<br>This is extremely security-vulnerable, so yeah. You need a password which is in the PHP code.
<br>All fields must be filled.
<style>
textarea,input{display:block;}
</style>
<form method="post" action="Send_Email.php">
	Security Code: <input type="text" name="pass" />
	Recipients (linebreak-separated list): <textarea name="to"></textarea>
	Use the default list instead <input type="checkbox" name="defaultto" />
	Subject: <input type="text" name="subj" />
	Message (no html is probably best): <textarea name="msg"></textarea>
	Reply-to: <input type="text" name="repto" />
	<input type="submit" name="sendemail" />
</form>
<?php }?>