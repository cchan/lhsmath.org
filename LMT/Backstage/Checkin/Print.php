<?php
/*
 * LMT/Backstage/Checkin/Print.php
 * LHS Math Club Website
 *
 * A page to print attendance sheets
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	global $header_noprint;
	$header_noprint = true;
	lmt_page_header('Attendance Sheets');
	echo <<<HEREDOC
      <h1 class="noPrint">Attendance Sheets</h1>
      
      <div class="text-centered b noPrint">To generate attendance sheets for the coaches, please print<br />
      this page single-sided in portrait mode at normal size.</div>
      
      <div class="printOnly">

HEREDOC;
	
	$result = lmt_query('SELECT team_id, teams.name AS team_name, teams.school AS school_id,'
		. ' schools.name AS school_name FROM teams LEFT JOIN schools'
		. ' ON teams.school=schools.school_id WHERE teams.deleted="0" ORDER BY school_name, team_name');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$team_id = htmlentities($row['team_id']);
		$team_name = htmlentities($row['team_name']);
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = 'None';
		
		echo <<<HEREDOC
		<h2 style="float: right;">$team_id</h2>
        <h1 style="text-align: left; margin: 0;">$team_name</h1>
        <h3 class="i noMargin">$school</h3>
        <br /><br />
HEREDOC;
		
		$result2 = lmt_query('SELECT name FROM individuals WHERE team="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$team_id) . '" AND deleted="0" ORDER BY name');
		$row2 = mysqli_fetch_assoc($result2);
		if (!$row2)
			echo "\n" . '        <h3 class="text-centered">No Members</span>' . "\n\n";
		
		while ($row2) {
			$name = htmlentities($row2['name']);
			echo "\n" . '        <div class="attendPerson"><div class="checkBox"></div>' . $name . '</div>';
			$row2 = mysqli_fetch_assoc($result2);
		}
		echo "\n" . '        <div class="pageBreak"></div>' . "\n\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	echo "      </div>";
	lmt_backstage_footer('');
}

?>