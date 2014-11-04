<?php
/*
 * Admin/Alumni.php
 * LHS Math Club Website
 *
 * Marks all members who have graduated as alumni.
 */

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


if (isSet($_POST['do_set_alumni']))
	process_form();
else
	show_page();





function show_page() {
	$yog = (int)date('Y') - 1;
	if ((int)date('n') > 4)
		$yog++;
	
	$msg = '';
	if (isSet($_SESSION['ALUMNI_set'])) {
		$msg = "\n        <div class=\"alert\">The list of alumni has been updated</div><br />\n";
		unset($_SESSION['ALUMNI_set']);
	}
	
	page_header('Alumni');
	echo <<<HEREDOC
      <h1>Alumni</h1>
      $msg
      <div class="instruction">Members marked as Alumni retain access to the site, but do not have test scores
      and do not show up in some of the autocomplete lists. Making a user an Alumnus will also take them off of
      the mailing list, though they may rejoin later. Note that administrators are not automatically made
      Alumni.</div><br /><br />
      
      <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
      <span class="b">Mark all members in YOG $yog as Alumni:</span>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_set_alumni" value="Update"/>
      </div></form>
HEREDOC;
}





function process_form() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$yog = (int)date('Y') - 1;
	if ((int)date('n') > 4)
		$yog++;
	$yog++;	// because 'less than'
	
	$query = 'UPDATE users SET permissions="L", mailings="0" WHERE permissions="R" AND yog=' . $yog;
	DB::queryRaw($query);
	
	$_SESSION['ALUMNI_set'] = true;
	header('Location: Alumni');
}

?>