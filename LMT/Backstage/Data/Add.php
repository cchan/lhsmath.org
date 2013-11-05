<?php
/*
 * LMT/Backstage/Data/Add.php
 * LHS Math Club Website
 *
 * Allows staff to add a school/team/individual
 * based on which of the GET parameters are specified:
 *  - School
 *  - Team
 *  - Individual
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_GET['School']))
	add_school();
else if (isSet($_GET['Team']))
	add_team();
else if (isSet($_GET['Individual']))
	add_individual();





function add_school() {
	$result = lmt_query('SELECT school_id FROM schools WHERE name="New School~" AND deleted="0"');
	$row = mysql_fetch_assoc($result);
	
	if (!$row) {
		lmt_query('INSERT INTO schools (name) VALUES ("New School~")');
		$result = lmt_query('SELECT school_id FROM schools WHERE name="New School~"');
		$row = mysql_fetch_assoc($result);
	}
	
	header('Location: School?ID=' . $row['school_id']);
	die;
}





function add_team() {
	$result = lmt_query('SELECT team_id FROM teams WHERE name="New Team~" AND deleted="0"');
	$row = mysql_fetch_assoc($result);
	
	if (!$row) {
		lmt_query('INSERT INTO teams (name) VALUES ("New Team~")');
		$result = lmt_query('SELECT team_id FROM teams WHERE name="New Team~"');
		$row = mysql_fetch_assoc($result);
	}
	
	header('Location: Team?ID=' . $row['team_id']);
	die;
}





function add_individual() {
	$result = lmt_query('SELECT id FROM individuals WHERE name="New Individual~" AND deleted="0"');
	$row = mysql_fetch_assoc($result);
	
	if (!$row) {
		lmt_query('INSERT INTO individuals (name) VALUES ("New Individual~")');
		$result = lmt_query('SELECT id FROM individuals WHERE name="New Individual~"');
		$row = mysql_fetch_assoc($result);
	}
	
	header('Location: Individual?ID=' . $row['id']);
	die;
}