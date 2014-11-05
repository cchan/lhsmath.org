<?php

function send_list_email($subject, $bb_body, $reply_to){
	$site_url = get_site_url();
	$stripped_url = str_replace(array('http://www.','http://'), '', $site_url);
	send_email(get_bcc_list(), $subject, $bb_body, $reply_to,
		NULL,
		"LHS Math Club\n$site_url\nTo unsubscribe from this list, visit [url]$site_url/Account/My_Profile[/url]",
		array(
			'Precedence' => 'bulk',
			'List-Id' => "<members.$stripped_url>",
			'List-Unsubscribe' => "<$site_url/Account/My_Profile>"
		)
	);
}

function val_email_msg($subject,$body){
	if (strlen($subject) == 0)
		return 'Please enter a subject.';
	if (strlen($subject) > 75)
		return 'Your subject is too long!?';
	if (strlen($body) == 0)
		return 'Please enter a message.';
	if (strlen($body) > 5000)
		return 'Please limit your message to 5000 characters.';
	return true;
}

/*
 * send_email($to, $subject, $bb_body, $reply_to)
 *  - $to: who to send the email to, as an string array of $email OR $email=>$name pairs
 *  - $subject: the subject line; $prefix is automatically prefixed
 *  - $body: the body of the message, in BBCode.
 *  - $reply_to: the email address to send replies to, if different from the TO address
 *
 *  NOTE: THIS FUNCTION REQUIRES THE SWIFT MAIL PACKAGE
 */
function send_email($bcc_list, $subject, $bb_body, $reply_to=NULL, $prefix=NULL, $footer=NULL, $headers=NULL) {
	global $EMAIL_ADDRESS, $EMAIL_USERNAME, $EMAIL_PASSWORD,
		$SMTP_SERVER, $SMTP_SERVER_PORT, $SMTP_SERVER_PROTOCOL, $LMT_EMAIL, $path_to_lmt_root;
		
	//Instead of using parameter default values, so we can pass NULL. And it's more readable.
	if(count($bcc_list)==0)return true;
	//--todo-- reply-to filtering doesn't work, and instead breaks when the empty string reaches SwiftMail.
	if(is_null($reply_to) || !filter_var($reply_to, FILTER_VALIDATE_EMAIL))$reply_to=array($EMAIL_ADDRESS=>'LHS Math Club Mailbot');
	if(is_null($prefix))$prefix='[LHS Math Club]';
	if(is_null($footer))$footer="LHS Math Club\n[url]".get_site_url()."[/url]\nTo stop receiving LHSMATH emails, contact [email]webmaster@lhsmath.org[/email].";
	if(is_null($headers))$headers=array();
	
	if(!is_array($bcc_list)||!is_string($subject)||!is_string($bb_body)||(!is_array($reply_to)&&!is_string($reply_to))||!is_string($prefix)||!is_string($footer)||!is_array($headers))
		return 'Invalid email parameters.';
	if(($error_msg = val_email_msg($subject,$bb_body))!==true)
		return $error_msg;
	
	$bb_body .= "\n\n\n---\n$footer\n"; //Attach footer.
	$html = BBCode($bb_body); //BBCode it.
	$subject = preg_replace("/[^\S ]/ui", '', strip_tags($prefix.' '.$subject));//"remove everything that's not [non-whitespace or space]"
	//preg_replace("/[^[:alnum][:space]]/ui", '', $string);?
	
	//Ok everything seems to be working, let's go ahead
	require_once __DIR__ . "/swiftmailer/swift_required.php";
	Swift_Preferences::getInstance()->setCacheType('array'); //Prevents a ton of warnings about SwiftMail's DiskKeyCache, thus actually speeding things up considerably.
	
	//Connect to the super-secret LHS Math Club Mailbot Gmail account
	$transport = Swift_SmtpTransport::newInstance($SMTP_SERVER,$SMTP_SERVER_PORT,$SMTP_SERVER_PROTOCOL)
	  ->setUsername($EMAIL_USERNAME)->setPassword($EMAIL_PASSWORD);
	
	//Make a Mailer that will send through that transport (limiting to 50/send)
	$mailer = Swift_Mailer::newInstance($transport);
	$mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(50, 1));//Max 50 emails per send, 1 sec delay between sends
	
	try{
		//Mush all info into the Mailer
		$message = Swift_Message::newInstance($subject)
			->setFrom(array($EMAIL_ADDRESS=>'LHS Math Club Mailbot'))
			->setBcc($bcc_list)
			->setContentType("text/html")
			->setBody($html)
			->setReplyTo($reply_to);
		
		foreach($headers as $field => $value)//Add custom headers, such as listserv stuff.
			$message->getHeaders()->addTextHeader($field,$value);
		
		//Send the message
		if(!$mailer->send($message))trigger_error('Error sending email', E_USER_ERROR);
	}
	catch(Exception $e){
		trigger_error('Email exception: '.$e->getMessage(),E_USER_ERROR);
	}
	return true;
}


/*
 * get_bcc_list()
 *
 * Gets the list of mailings-enabled people from the database, as an associative array $email=>$name for SwiftMail. Caches.
 */
function get_bcc_list(){
	static $list=0;//Caching, for efficiency.
	if($list === 0){
		$result = DB::query('SELECT name, email FROM users WHERE mailings="1" AND permissions!="T" AND email_verification="1"');
		//Doesn't have to be approved. Includes you.
		$list = DBHelper::verticalSlice($result,'name','email');
	}
	return $list;
}





/*
 * BBCode($string)
 * - parses a bbCode string
 *
 * Derived from http://www.pixel2life.com/forums/index.php?showtopic=10659
 */
function BBCode ($string, $strip_tags = false) {
	$search = array(
		'@\[b\](.*?)\[/b\]@si',
		'@\[i\](.*?)\[/i\]@si',
		'@\[u\](.*?)\[/u\]@si',
		'@\[img\](.*?)\[/img\]@si',
		'@\[url\](.*?)\[/url\]@si',
		'@\[url=(.*?)\](.*?)\[/url\]@si',
		'@\[email\](.*?)\[/email\]@si',
		'@\[heading\](.*?)\[/heading\]@si',
		'@\[subheading\](.*?)\[/subheading\]@si',
		'@\[bullets\](.*?)\[/bullets\]@si',
		'@\[item\](.*?)\[/item\]@si',
		'@\[pi\]@si',
		'@\[sqrt\]@si'
	);
	$replace = array(
		'<b>\\1</b>',
		'<i>\\1</i>',
		'<u>\\1</u>',
		'<img src="\\1" alt=""/>',
		'<a href="\\1" rel="external">\\1</a>',
		'<a href="\\1" rel="external">\\2</a>',
		'<a href="mailto:\\1" rel="external">\\1</a>',
		'<h2 class="smbottom">\\1</h2>',
		'<h3 class="smbottom">\\1</h3>',
		'<ul>\\1</ul>',
		'<li>\\1</li>',
		'&pi;',
		'&#8730;'
	);
	$strip_tags_replace = array(
		'\\1',
		'\\1',
		'\\1',
		'[\\1]',
		'[\\1]',
		'\\2 [\\1]',
		'[\\1]',
		'\\1',
		'\\1',
		'\\1',
		'\\1',
		'pi',
		'sqrt'
	);
	
	$string = htmlentities(strip_tags($string));
	if($strip_tags){
		$string = preg_replace($search, $strip_tags_replace, $string);
	}else{
		$string = preg_replace($search, $replace, $string);
		// $string = str_replace("</li><br />", "</li>", $string);
		// $string = str_replace("<br />\r\n<ul><br />", "<ul>", $string);
		// $string = str_replace("</ul><br />", "</ul>", $string);
		$string = nl2br($string);
	}
	
	//CHECK FOR EXTRA UNPARSED BBCODE - [] brackets with no spaces in them
	if(preg_match('@\[\S+\]@si',$string))
		alert('You may have unmatched or unrecognized BBCode tags!',-1);
	
	return $string;
}
function strip_BB_tags($s){
	return BBCode($s,true);
}

?>