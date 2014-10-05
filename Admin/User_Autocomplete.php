<?php
/*
 * Admin/User_Autocomplete.php
 * LHS Math Club Website
 *
 * Allows Admins to enter test scores for members
 *
 * Requires the GET parameter 'term'. If the GET parameter 'All' is set,
 * results will be shown across all users, instead of just approved, regular ones.
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');

generate_results();





/*
 * generate_results()
 *
 * Fetches, parses and presents the data for Autocomplete.
 */
function generate_results() {
	if ($_GET['term'] == '')
		die();
		
	$name = mysqli_real_escape_string(DB::get(),$_GET['term']);
	$name = str_replace(" ", "%", $name);
	
	$query = 'SELECT name, permissions, yog FROM users WHERE name LIKE "%' . $name . '%" AND (permissions="R" OR permissions="A" OR permissions="C") AND approved="1" LIMIT 10';
	
	if (isSet($_GET['All']))
		$query = 'SELECT name, permissions, yog FROM users WHERE name LIKE "%' . $name . '%" AND permissions!="T"';
		
	if (isSet($_GET['T']))
		$query = 'SELECT name, permissions, yog FROM users WHERE name LIKE "%' . $name . '%" AND approved="1"';
	
	$result = DB::queryRaw($query);
	
	echo "[";
	$row = mysqli_fetch_assoc($result);
	$comma = "";
	while ($row) {
		$seniorsYOG = (int)date('Y');
		if ((int)date('n') > 6)
			$seniorsYOG += 1;
		$grade = $seniorsYOG - $row['yog'] + 12;
		
		if ($grade >= 9 && $grade <= 12)
			echo $comma . "\n { \"value\" : \"" . $row['name'] . " (" . $grade . ")\" }";
		else if ($row['permissions'] == 'T')
			echo $comma . "\n { \"value\" : \"" . $row['name'] . " (T)\" }";
		else
			echo $comma . "\n { \"value\" : \"" . $row['name'] . "\" }";
		$comma = ",";
		$row = mysqli_fetch_assoc($result);
	}
	echo "\n]";
}

?>