<?php
/*
 * LMT/Backstage/Results/Print.php
 * LHS Math Club Website
 *
 * A page to print score sheets for coaches
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	global $header_noprint;
	$header_noprint = true;
	lmt_page_header('Score Sheets');
	if (scoring_is_enabled())
		$message = '<div class="error noPrint">Score entry is still enabled! Disable it <a href="../Scoring/Refrigerator">here</a>.</div><br />';
	echo <<<HEREDOC
      <h1 class="noPrint">Score Sheets</h1>
      $message
      
      <div class="text-centered b noPrint">
        <span class="b">
          <a href="Full">Full Results</a>&nbsp;&nbsp;
          <a href="Top">Top Scorers</a>
        </span>
        <br /><br />
        To generate results sheets for the coaches, please print<br />
        this page single-sided in portrait mode at normal size.
      </div>
      
      <div class="printOnly">

HEREDOC;
	
	$result = DB::queryRaw('SELECT team_id, IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0) AS score_team, score_guts, teams.name AS team_name, teams.school AS school_id,'
		. ' schools.name AS school_name FROM teams LEFT JOIN schools'
		. ' ON teams.school=schools.school_id WHERE teams.deleted="0" ORDER BY school_name, team_name');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$team_id = htmlentities($row['team_id']);
		$team_name = htmlentities($row['team_name']);
		$school = htmlentities($row['school_name']);
		$score_team = htmlentities($row['score_team']);
		$score_guts = htmlentities($row['score_guts']);
		
		if (is_null($row['score_team']))
			$score_team = '<span class="i">None</span>';
		if (is_null($row['score_guts']))
			$score_guts = '<span class="i">None</span>';
		
		echo <<<HEREDOC
        <h1 style="text-align: left; margin: 0;">$team_name</h1>
        <h3 class="i noMargin">$school</h3>
        <br />
        <span class="b">Team Round Score:</span> $score_team<br />
        <span class="b">Guts Round Score:</span> $score_guts
        <br /><br /><br />
HEREDOC;
		
		$result2 = DB::queryRaw('SELECT name, score_individual, score_theme FROM individuals WHERE team="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$team_id) . '" AND deleted="0" ORDER BY name');
		$row2 = mysqli_fetch_assoc($result2);
		if (!$row2)
			echo "\n" . '        <h3 class="text-centered">No Members</span>' . "\n\n";
		else
			echo <<<HEREDOC

        <table class="spaciousBig">
          <tr>
            <th>Name</th>
            <th>Individual Round</th>
            <th>Theme Round</th>
          </tr>
HEREDOC;
		while ($row2) {
			$name = htmlentities($row2['name']);
			$score_individual = htmlentities($row2['score_individual']);
			$score_theme = htmlentities($row2['score_theme']);
			
			if (is_null($row2['score_individual']))
				$score_individual = '<span class="i">None</span>';
			if (is_null($row2['score_theme']))
				$score_theme = '<span class="i">None</span>';
				
			echo "\n" . '          <tr><td>' . $name . '</td><td>' . $score_individual . '</td><td>' . $score_theme . '</td></tr>';
			$row2 = mysqli_fetch_assoc($result2);
		}
		echo "\n" . '        </table><div class="pageBreak"></div>' . "\n\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	echo "      </div>";
	lmt_backstage_footer('');
}

?>