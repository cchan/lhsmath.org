<?php
/*
 * LMT/Backstage/Guts/Extra.php
 *
 * Produces a list of results (LMT 2011 only)
 */

require_once '../../../lib/lmt-functions.php';
backstage_access();

if (isSet($_GET['Download']))
	download_csv();
else
	show_page();





function show_page() {
	lmt_page_header('Guts Extra');
	echo <<<HEREDOC
      <h1>Guts Extra</h1>
      
      <span class="b">Average x:</span> 
HEREDOC;
	
	$c_sub = "SELECT (SELECT AVG(guts_ans_c) FROM teams WHERE deleted=\"0\") as avg";
	$row = DB::queryFirstRow($c_sub);
	$avg = $row['avg'];
	if ($avg == '' || is_null($avg))
		$avg = '0';
	
	echo $avg;
}





function download_csv() {
	// Get Data
	$file = "Team ID,Team Name,School,Answer\n";
	
	$result = DB::queryRaw('SELECT team_id, guts_ans_c, teams.name AS team_name, schools.name AS school_name FROM teams '
		. 'LEFT JOIN schools ON teams.school=schools.school_id WHERE teams.deleted="0" ORDER BY team_id');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$id = htmlentities($row['team_id']);
		$team_name = htmlentities($row['team_name']);
		$school_name = htmlentities($row['school_name']);
		$ans = substr($row['guts_ans_c'], 1);
		$ans = substr($ans, 0, -1);
		$ans = str_replace('/', ', ', $ans);
		if ($school_name == '')
			$school_name = 'None';
		
		$file .= $id . "," . $team_name . "," . $school_name . ",\"" . $ans . "\"\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	// Download File
	header('Content-Description: File Transfer');
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="Team List.csv"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . strlen($file));
	cancel_templateify();
	ob_clean();
	flush();
	echo $file;
}

?>