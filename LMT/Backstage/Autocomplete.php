<?php
/*
 * LMT/Backstage/Autocomplete.php
 * LHS Math Club Website
 *
 * Powers autocomplete results in the search boxes
 *
 * term:		the term to search for
 * School:		search school names
 * Team:		search team names
 * Coach:		search coach email addresses
 * Individual:	search all individual names
 * Unaffiliated:search unaffiliated individual names
 */

require_once '../../.lib/lmt-functions.php';
backstage_access();

generate_results();





/*
 * generate_results()
 *
 * Fetches, parses and presents the data for Autocomplete.
 */
function generate_results() {
	if ($_GET['term'] == '')
		die();
		
	$query = mysqli_real_escape_string(DB::get(),$_GET['term']);
	$query = str_replace(" ", "%", $query);
	
	$comma = "";
	echo "[";
	
	if (isSet($_GET['Individual'])) {
		$result = DB::queryRaw('SELECT DISTINCT name FROM individuals WHERE name LIKE "%' . $query . '%" OR id="' . $query .'" AND deleted="0" LIMIT 5');
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			echo $comma . "\n" . ' { "label": "' . $row['name'] . '", "category": "Individuals" }';
			$comma = ",";
			$row = mysqli_fetch_assoc($result);
		}
	}
	else if (isSet($_GET['Unaffiliated'])) {
		$result = DB::queryRaw('SELECT DISTINCT name FROM individuals WHERE name LIKE "%' . $query . '%" OR id="' . $query .'" AND email <> "" AND deleted="0" LIMIT 5');
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			echo $comma . "\n" . ' { "label": "' . $row['name'] . '", "category": "Individuals" }';
			$comma = ",";
			$row = mysqli_fetch_assoc($result);
		}
	}
	
	if (isSet($_GET['Team'])) {
		$result = DB::queryRaw('SELECT DISTINCT name FROM teams WHERE name LIKE "%' . $query . '%" OR team_id="' . $query .'" AND deleted="0" LIMIT 5');
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			echo $comma . "\n" . ' { "label": "' . $row['name'] . '", "category": "Teams" }';
			$comma = ",";
			$row = mysqli_fetch_assoc($result);
		}
	}
	
	if (isSet($_GET['School'])) {
		$result = DB::queryRaw('SELECT DISTINCT name FROM schools WHERE name LIKE "%' . $query . '%" OR school_id="' . $query .'" AND deleted="0" LIMIT 5');
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			echo $comma . "\n" . ' { "label": "' . $row['name'] . '", "category": "Schools" }';
			$comma = ",";
			$row = mysqli_fetch_assoc($result);
		}
	}
	
	if (isSet($_GET['Coach'])) {
		$result = DB::queryRaw('SELECT DISTINCT coach_email FROM schools WHERE coach_email LIKE "%' . $query . '%" AND deleted="0" LIMIT 5');
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			echo $comma . "\n" . ' { "label": "' . $row['coach_email'] . '", "category": "Coaches" }';
			$comma = ",";
			$row = mysqli_fetch_assoc($result);
		}
	}

	echo "\n]";
}

?>