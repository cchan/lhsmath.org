<?php
/*
 * LMT/Backstage/Checkin/Team_List.php
 *
 * Produces a list of team id, team name and school
 * for inclusion in the Welcome Packet
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_GET['Download']))
	download_csv();
else
	show_page();





function show_page() {
	lmt_page_header('Team List');
	echo <<<HEREDOC
      <h1>Team List</h1>
      
      <table class="visible">
        <tr>
          <th>ID</th>
          <th>Team Name</th>
          <th>School</th>
        </tr>

HEREDOC;
	
	$result = lmt_query('SELECT team_id, teams.name AS team_name, schools.name AS school_name FROM teams '
		. 'LEFT JOIN schools ON teams.school=schools.school_id WHERE teams.deleted="0" ORDER BY team_id');
	$row = mysql_fetch_assoc($result);
	while ($row) {
		$id = htmlentities($row['team_id']);
		$team_name = htmlentities($row['team_name']);
		$school_name = htmlentities($row['school_name']);
		if ($school_name == '')
			$school_name = '<span class="i">None</span>';
		
		echo <<<HEREDOC
        <tr>
          <td>$id</td>
          <td>$team_name</td>
          <td>$school_name</td>
        </tr>
		
HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	
	echo '      </table>' . "\n" . '      <a href="Team_List?Download">Download</a>';
	
	lmt_backstage_footer('');
}





function download_csv() {
	// Get Data
	$file = "Team ID,Team Name,School\n";
	
	$result = lmt_query('SELECT team_id, teams.name AS team_name, schools.name AS school_name FROM teams '
		. 'LEFT JOIN schools ON teams.school=schools.school_id WHERE teams.deleted="0" ORDER BY team_id');
	$row = mysql_fetch_assoc($result);
	while ($row) {
		$id = htmlentities($row['team_id']);
		$team_name = htmlentities($row['team_name']);
		$school_name = htmlentities($row['school_name']);
		if ($school_name == '')
			$school_name = 'None';
		
		$file .= $id . "," . $team_name . "," . $school_name . "\n";
		$row = mysql_fetch_assoc($result);
	}
	
	// Download File
	header('Content-Description: File Transfer');
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="Team List.csv"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . strlen($file));
	ob_clean();
	flush();
	echo $file;
}

?>