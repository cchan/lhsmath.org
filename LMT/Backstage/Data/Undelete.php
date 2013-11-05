<?php
/*
 * LMT/Backstage/Data/Undelete.php
 * LHS Math Club Website
 *
 * Allows staff to undelete items from the database
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_GET['Individual']))
	do_individual();
else if (isSet($_GET['Team']))
	do_team();
else if (isSet($_GET['School']))
	do_school();
else
	show_page();





function show_page() {
	lmt_page_header('Undelete');
	echo <<<HEREDOC
      <h1><span class="dontMess">**</span>Undelete</h1>
      
      <h3>Individuals</h3>

HEREDOC;
	
	$result = lmt_query('SELECT id, name FROM individuals WHERE deleted="1"');
	$row = mysql_fetch_assoc($result);
	while ($row) {
		echo '      <a href="Undelete?Individual=' . htmlentities($row['id'])
			. '">' . htmlentities($row['name']) . '</a><br />' . "\n";
		$row = mysql_fetch_assoc($result);
	}
	
	echo "\n      <h3>Teams</h3>\n";
	
	$result = lmt_query('SELECT team_id, name FROM teams WHERE deleted="1"');
	$row = mysql_fetch_assoc($result);
	while ($row) {
		echo '      <a href="Undelete?Team=' . htmlentities($row['team_id'])
			. '">' . htmlentities($row['name']) . '</a><br />' . "\n";
		$row = mysql_fetch_assoc($result);
	}
	
	echo "\n      <h3>Schools</h3>\n";
	
	$result = lmt_query('SELECT school_id, name FROM schools WHERE deleted="1"');
	$row = mysql_fetch_assoc($result);
	while ($row) {
		echo '      <a href="Undelete?School=' . htmlentities($row['school_id'])
			. '">' . htmlentities($row['name']) . '</a><br />' . "\n";
		$row = mysql_fetch_assoc($result);
	}
	lmt_backstage_footer('');
}





function do_individual() {
	lmt_query('UPDATE individuals SET deleted="0" WHERE id="' . mysql_real_escape_string($_GET['Individual']) . '" LIMIT 1');
	
	global $LMT_DB;
	if (mysql_affected_rows($LMT_DB) != 1)
		trigger_error('Individual not found', E_USER_ERROR);
	
	header('Location: Individual?ID=' . $_GET['Individual']);
}





function do_team() {
	lmt_query('UPDATE teams SET deleted="0" WHERE team_id="' . mysql_real_escape_string($_GET['Team']) . '" LIMIT 1');
	
	global $LMT_DB;
	if (mysql_affected_rows($LMT_DB) != 1)
		trigger_error('Team not found', E_USER_ERROR);
	
	header('Location: Team?ID=' . $_GET['Team']);
}





function do_school() {
	lmt_query('UPDATE schools SET deleted="0" WHERE school_id="' . mysql_real_escape_string($_GET['School']) . '" LIMIT 1');
	
	global $LMT_DB;
	if (mysql_affected_rows($LMT_DB) != 1)
		trigger_error('School not found', E_USER_ERROR);
	
	header('Location: School?ID=' . $_GET['School']);
}

?>