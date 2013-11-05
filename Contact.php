<?php
/*
 * Contact.php
 * LHS Math Club Website
 *
 * Shows information on how to contact the Math Club.
 */


$path_to_root = '';
require_once 'lib/functions.php';


if ($_SESSION['permissions'] == 'R' || $_SESSION['permissions'] == 'L' || $_SESSION['permissions'] == 'A')
	show_page_for_members();
else
	show_public_page();





function show_public_page() {
	// Make certain links open in a new tab/window
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	page_header('Contact');
	
	global $PUBLIC_EMAIL, $WEBMASTER_EMAIL;
	$public_captain_email = email_obfuscate($PUBLIC_EMAIL, null, 'at ');
	$email_the_webmaster = email_obfuscate($WEBMASTER_EMAIL, 'email the Webmaster', 'If you experience difficulty using this site, please ');
	
	echo <<<HEREDOC
      <h1>Contact</h1>
      
      <span class="b">Contact us...</span>
      <ul>
        <li>
          <span class="b">via email:</span><br />
          $public_captain_email<br />
          <br />
        </li>
        <li>
          <span class="b">via snail mail, at:</span><br />
          Math Club<br />
          c/o Albert Roos<br />
          <a href="http://lhs.lexingtonma.org/" rel="external">Lexington High School</a><br />
          251 Waltham Street, Lexington MA<br />
          <br />
        </li>
        <li>
          <div>$email_the_webmaster</div>
        </li>
      </ul>
HEREDOC;
	default_page_footer('Contact');
}





function show_page_for_members() {
	// Make certain links open in a new tab/window
	global $use_rel_external_script, $CAPTAIN_EMAIL, $WEBMASTER_EMAIL;
	$use_rel_external_script = true;
	
	page_header('Contact');
	
	echo <<<HEREDOC
      <h1>Contact</h1>
      
      <ul>
        <li>
          <span class="b">All Captains</span><br />
          <a href="mailto:$CAPTAIN_EMAIL" rel="external">$CAPTAIN_EMAIL</a><br />
          <br />
        </li>

HEREDOC;
	
	
	$url_for_validation = htmlspecialchars(get_site_url());
	
	// Fetch Data
	$query = 'SELECT name, email, cell FROM users WHERE permissions="C"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	$row = mysql_fetch_assoc($result);
	while ($row) {
		echo  "        <li>\n"
			. "          <span class=\"b\">{$row['name']}</span><br />\n"
			. "          <a href=\"mailto:{$row['email']}\" rel=\"external\">{$row['email']}</a><br />\n";
		
		$cell = format_phone_number($row['cell']);
		if ($cell != 'None')
			echo "          $cell<br />\n";
		
		echo  "          <br />\n"
			. "        </li>\n";
		
		$row = mysql_fetch_assoc($result);
	}
	
	echo <<<HEREDOC
        <li>
          If you experience difficulty using this site, please
          <a href="mailto:$WEBMASTER_EMAIL" rel="external">
          email the Webmaster</a>
        </li>
      </ul>
      <br />
HEREDOC;
	default_page_footer('Contact');
}

?>