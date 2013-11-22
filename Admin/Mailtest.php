BTW if you haven't noticed already you really shouldn't be here.
<br>
<?php
$path_to_root = '../';
require_once $path_to_root.'lib/functions.php';
restrict_access('A');
$LOCAL_BORDER_COLOR = "#FF0000";
$SMTP_SERVER_PORT =			'465';
restore_error_handler();


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
send_multipart_list_email("doobahead@gmail.com","test","asdf","<b>asdfbold</b>","doobahead@gmail.com","asdf");
?>