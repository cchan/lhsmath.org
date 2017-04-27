<?php
/*
 * About.php
 * LHS Math Club Website
 */


require_once '.lib/functions.php';
restrict_access('XRLA');


	//Privacy control.
	$benjamin_tidor = 'Benjamin T.';
	if (isSet($_SESSION['user_id']))
		$benjamin_tidor = '<a href="http://tidor.net" rel="external">Benjamin Tidor</a>';
	
	page_title('About');
?>
<h1>About</h1>

<h3>LHS Math Club Website</h3>
Written in <a href="https://php.net/" rel="external">PHP</a> 2008-2012 by <?=$benjamin_tidor?><br />
With design assistance from <a href="https://web.archive.org/web/20100823084639/http://teddomain.zzl.org" rel="external">Ted Zhu</a><br />
Heavily revised and updated by <a href="https://clive.io" rel="external">Clive Chan</a> 2013-present<br />
and well-maintained by all LHSMATH webmasters.<br />

<br />
All pages consist of <a href="https://validator.w3.org/check?uri=referer" rel="external">valid XHTML 1.0</a>
and <a href="https://jigsaw.w3.org/css-validator/check/referer?profile=css3" rel="external">CSS 3</a><br />

<br /><br />
<span class="b">Assorted Pieces of Code from:</span><div class="halfbreak"></div>
&nbsp;&nbsp;<a href="http://aidanlister.com/2004/04/calculating-a-directories-size-in-php/" rel="external">Aidan Lister</a><br />
&nbsp;&nbsp;<a href="http://www.celticproductions.net/articles/10/email/php+email+obfuscator.html" rel="external">Celtic Productions</a><br />
&nbsp;&nbsp;<a href="https://davidwalsh.name/php-calendar" rel="external">David Walsh</a><br />
&nbsp;&nbsp;<a href="https://fightingforalostcause.net/misc/2006/compare-email-regex.php" rel="external">James Watts and Francisco Jose Martin Moreno</a><br />
&nbsp;&nbsp;<a href="https://jquery.com/" rel="external">jQuery</a><br />
&nbsp;&nbsp;<a href="https://jqueryui.com/" rel="external">jQuery UI</a><br />
&nbsp;&nbsp;<a href="https://www.sitepoint.com/standards-compliant-world/" rel="external">Kevin Yank</a><br />
&nbsp;&nbsp;<a href="http://www.pat-burt.com/web-development/how-to-do-a-css-popup-without-opening-a-new-window/" rel="external">Patrick Burt</a><br />
&nbsp;&nbsp;<a href="https://prothemedesign.com/tools/circular-icons/" rel="external">Pro Theme Design</a><br />
&nbsp;&nbsp;<a href="https://raamdev.com/2008/adding-cc-recipients-with-pear-mail/" rel="external">Raam Dev</a><br />
&nbsp;&nbsp;<a href="https://www.google.com/recaptcha" rel="external">reCAPTCHA</a><br />
&nbsp;&nbsp;<a href="https://www.sitepoint.com/how-to-code-html-email-newsletters/" rel="external">Tim Slavin</a><br />
&nbsp;&nbsp;<a href="https://stackoverflow.com/" rel="external">StackOverflow</a><br />
&nbsp;&nbsp;<a href="https://meekro.com/" rel="external">MeekroDB</a><br />
&nbsp;&nbsp;<a href="http://swiftmailer.org/" rel="external">Swift Mailer</a><br />
&nbsp;&nbsp;and others...<br />
