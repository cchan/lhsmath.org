<?php
/*
 * Admin/Edit_Page.php
 * LHS Math Club Website
 *
 * Alows an Admin to edit some of the webpages.
 */


require_once '../lib/functions.php';
restrict_access('A');


if (isSet($_POST['do_edit_page']))
	process_form();
else
	show_page('');

function show_page($err) {
	$file = '';
	$name = '';
	if (isSet($_GET['Home'])) {
		$file = '../.content/Home.txt';
		$name = 'Home';
	} else if (isSet($_GET['Contests'])) {
		$file = '../.content/Contests.txt';
		$name = 'Contests';
	} else
		trigger_error('Show: Unknown contest', E_USER_ERROR);
	
	$contents = '';
	if (!file_exists($file)) {
		$fh = fopen($file, 'a') or trigger_error('Could not create file', E_USER_ERROR);
		fclose($fh);
	}
	else if (isSet($_POST['text']))
		$contents = $_POST['text'];
	else
		$contents = htmlentities(file_get_contents($file));
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	page_header("Edit $name Page");
	echo <<<HEREDOC
      <h1>Edit $name Page</h1>
      
      <div class="instruction">You may use bold, italic, underline,
      named links and images with <a href="http://www.bbcode.org/reference.php" rel="external">bbCode</a>.</div>
      
      <h3>$name</h3>$err
      <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
        <textarea name="text" rows="30" cols="90">$contents</textarea>
        <br /><div class="halfbreak"></div>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_edit_page" value="Save Page"/>&nbsp;&nbsp;
        <a href="Dashboard">Cancel</a>
      </div></form>
HEREDOC;
}





function process_form() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$file = '';
	$name = '';
	if (isSet($_GET['Home'])) {
		$file = '../.content/Home.txt';
		$name = 'Home';
	} else if (isSet($_GET['Contests'])) {
		$file = '../.content/Contests.txt';
		$name = 'Contests';
	} else
		trigger_error('Show: Unknown contest', E_USER_ERROR);
	
	file_put_contents($file, $_POST['text']);
	
	page_header('Edit Page');
	echo <<<HEREDOC
      <h1>Edit Page</h1>
      
      <div class="alert">The $name page was saved successfully&nbsp;&nbsp;(<a href="../$name">View</a>)</div>
HEREDOC;
}

?>