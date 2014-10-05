<?php
/*
 * lib/CONFIG.php
 * LHS Math Club Website
 *
 * This file is where information such as database connections, etc. are
 * specified. YOU MAY EDIT THIS FILE.
 */


// BASIC SITE INFORMATION:
$WEBMASTER_EMAIL =		'webmaster@lhsmath.org';// public
$PUBLIC_EMAIL =			'contact@lhsmath.org';	// public
$CAPTAIN_EMAIL =		'captains@lhsmath.org';	// address for all captains; shown to members only
$LMT_EMAIL =			'lmt@lhsmath.org';
$TIMEZONE =				'America/New_York';	// See [http://www.php.net/manual/en/timezones.php]
$ADVISOR_NAME =			'Wendy Cordero';


// DATABASE INFORMATION:
$DB_SERVER =			'lhsmath.db';  // to speficy a port, use 'hostname:port'
$DB_USERNAME =			'php';
$DB_PASSWORD =			'Dc8@O()oe.wmE7hhI?XYi1EP><';
$DB_DATABASE =			'lhsmath';	// the name of the database for the regular site
$LMT_DB_DATABASE =		'lmt';	// the LMT database name, should always be `lmt`
$PHP_MY_ADMIN_LINK =	'https://phpmyadmin.nearlyfreespeech.net/index.php';


// EMAIL ACCOUNT INFORMATION for the LHS Math Club Mailbot:
// get this from your email provider.
// SSL is used automatically.
$EMAIL_ADDRESS =			'mailbot@lhsmath.org';
$EMAIL_USERNAME =			'mailbot@lhsmath.org';
$EMAIL_PASSWORD =			']|S~)h,oQ`tIfv6L}Jd)1s-W(dvl.^G7O}Ex{qCdJCMF]PIusG7.Op+F7MH36E-'; //There CANNOT be any backslashes. Or quotes, duh.
$SMTP_SERVER =				'smtp.gmail.com';
$SMTP_SERVER_PORT =			'587';	//https://support.google.com/mail/answer/78775?hl=en
									//The source of a month of failed email sendings when it changed 587 to 465 for whatever reason.
									//Note to people: keep track of this number.
									//And one part of the cause of another month of failed lmt email sendings when 465 started timing out.
$SMTP_SERVER_PROTOCOL = 'tls';//tls for 587 and 25, ssl for 465


// INCLUDE PATH: This web application requires PEAR packages
// including Mail, Mail_MIME and Net_SMTP. If you need to add
// an include path, enter it here:
$ADD_INCLUDE_PATH =				'';


// SECRET SALT:
// set this to something random and LONG. Don't change it, or else all the
// passwords will stop working
$SECRET_SALT = 'msl18kandgnkoq90u4@3ye56ta*74u89iit guya@0p349pti#7hw5fuj90f';



// SUPER-ADMIN FEATURE:
// if you ever get locked out (no Admin accounts), login using
//   Username: lhsmath
//   Password: (set a password below)
// Once you're done, change the password back to being blank ('')
// - this disables the lhsmath account.
$LHSMATH_PASSWORD =		'';

// just ignore this part, lets you sign in with that password _____________
if ($LHSMATH_PASSWORD != '')
	$LHSMATH_PASSWORD = hash_pass('lhsmath', $LHSMATH_PASSWORD);
// ________________________________________________________________________



// This site uses reCAPTCHA to prevent bots from messing with it. You can
// get a key at http://recaptcha.net
$RECAPTCHA_PUBLIC_KEY =		'6LdVjr0SAAAAAILlPfF5-n11TmZE_NXsm6mlxz5_';
$RECAPTCHA_PRIVATE_KEY =	'6LdVjr0SAAAAAB3N6CCEL0rXiXfKohLF7MFpSqHI';

// This site also uses Mailhide. Get a key at:
// http://www.google.com/recaptcha/mailhide/apikey
$MAILHIDE_PUBLIC_KEY =		'01s6lIcYY72sXjHVrhhkEsXQ==';
$MAILHIDE_PRIVATE_KEY =		'658ab4cadf4c996208856ec5735b4aae';



// The site is monitored by Pingdom. Get a free account [http://pingdom.com]
// Add the Math Club website, then wait one day. Enable the Public Report
// and enter its URL below.
$PINGDOM_REPORT =			'http://stats.pingdom.com/wk0v6lomn491/225513';



// BANHAMMER: To ban an IP address, add it to this list.
// Please make all IPv6 addresses lowercase
$BANNED_IPS =	array(
				'999.999.999.999',
				'888.888.888.888',
				);





$CATCH_ERRORS = false;			// For website debugging. Should normally be set to TRUE,
								// which means it will just say "Whoops, something went wrong"
								// rather than talk about the error.
								
$LOCAL_BORDER_COLOR = 'transparent';//For local development versions to set to something else in CONFIG.local.php.
								
								
@include 'CONFIG.local.php';	// DEVELOPERS: to override certain values in your
								// testing environment, put them in 'CONFIG.local.php'
								// and DO NOT add it to source control.

?>