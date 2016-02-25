<?php
/*
 * Contact.php
 * LHS Math Club Website
 *
 * Shows information on how to contact the Math Club.
 */



require_once '.lib/functions.php';


if (user_access('RLA'))
	show_page_for_members();
else
	show_public_page();





function show_public_page() {
	// Make certain links open in a new tab/window
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	page_header('Contact');
	
	global $PUBLIC_EMAIL, $WEBMASTER_EMAIL, $ADVISOR_NAME;
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
          c/o {$ADVISOR_NAME}<br />
          <a href="http://lhs.lexingtonma.org/" rel="external">Lexington High School</a><br />
          251 Waltham Street, Lexington, MA 02421<br />
          <br />
        </li>
        <li>
          <div>$email_the_webmaster</div>
        </li>
      </ul>
HEREDOC;
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
		  <br />
        </li>

HEREDOC;
	
	// Fetch Data
	$query = 'SELECT name, email, cell FROM users WHERE permissions="C"';
	$result = DB::queryRaw($query);
	
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		echo  "        <li>\n"
			. "          <span class=\"b\">{$row['name']}</span><br />\n"
			. "          <a href=\"mailto:{$row['email']}\" rel=\"external\">{$row['email']}</a><br />\n";
		
		$cell = format_phone_number($row['cell']);
		if ($cell != 'None')
			echo "          $cell<br />\n";
		
		echo "        </li>\n";
		
		$row = mysqli_fetch_assoc($result);
	}
	
	echo <<<HEREDOC
        <br><li>
          If you experience difficulty using this site, please
          <a href="mailto:$WEBMASTER_EMAIL" rel="external">
          email the Webmaster</a>
        </li>
      </ul>
      <br />
HEREDOC;
}

?>