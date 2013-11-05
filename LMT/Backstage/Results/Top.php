<?php
/*
 * LMT/Backstage/Results/Top.php
 * LHS Math Club Website
 *
 * Displays a list of top scorers
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	if (scoring_is_enabled())
		$message = '<div class="error">Score entry is still enabled! Disable it <a href="../Scoring/Refrigerator">here</a>.</div><br />';
	
	lmt_page_header('Top Scorers');
	
	echo <<<HEREDOC
      <h1>Top Scorers</h1>
      $message
      <div class="text-centered b">
        <span class="noPrint">
          <a href="Full">Full Results</a>&nbsp;&nbsp;
          <a href="Print">Scores for Coaches</a>
          <br /><br />
        </span>
        <span class="red">Reminder: Do not copy data locally!</span><br />
        Ties are listed in random order.
        <br /><br />
      </div>
      
      <h2>Top 5 Individuals by Individual Round</h2>
      <table class="contrasting">
        <tr>
          <th>Place</th>
          <th>Name</th>
          <th>School</th>
          <th>Individual Round</th>
        </tr>
HEREDOC;
	
	score_guts();
	
	// INDIVIDUAL ROUND
	$query ='SELECT id, individuals.name AS name, (SELECT name FROM schools WHERE school_id=teams.school) AS school_name, '
		. 'RAND() AS rand, score_individual FROM individuals LEFT JOIN teams ON team=teams.team_id WHERE individuals.deleted="0" AND attendance="1" ORDER BY score_individual DESC, rand';
	$result = lmt_query($query);
	$row = mysql_fetch_assoc($result);
	$place = 0;
	$num = 0;
	$last_score = null;
	while ($row) {
		$num++;
		if ($row['score_individual'] != $last_score)
			$place = $num;
		$last_score = $row['score_individual'];
		if ($place > 5)
			break;
		$id = htmlentities($row['id']);
		$name = htmlentities($row['name']);
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = '<span class="i">None</span>';
		$score_individual = htmlentities($row['score_individual']);
		
		echo <<<HEREDOC
        <tr>
          <td>$place</td>
          <td><a href="../Data/Individual?ID=$id">$name</a></td>
          <td>$school</td>
          <td class="b">$score_individual</td>
        </tr>
HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	echo "      </table>\n";
	
	// Theme ROUND
	echo <<<HEREDOC
      <h2>Top 5 Individuals by Theme Round</h2>
      <table class="contrasting">
        <tr>
          <th>Place</th>
          <th>Name</th>
          <th>School</th>
          <th>Theme Round</th>
        </tr>
HEREDOC;
	$query ='SELECT id, individuals.name AS name, (SELECT name FROM schools WHERE school_id=teams.school) AS school_name, '
		. 'RAND() AS rand, score_theme FROM individuals LEFT JOIN teams ON team=teams.team_id WHERE individuals.deleted="0" AND attendance="1" ORDER BY score_theme DESC, rand';
	$result = lmt_query($query);
	$row = mysql_fetch_assoc($result);
	$place = 0;
	$num = 0;
	$last_score = null;
	while ($row) {
		$num++;
		if ($row['score_theme'] != $last_score)
			$place = $num;
		$last_score = $row['score_theme'];
		if ($place > 5)
			break;
		$id = htmlentities($row['id']);
		$name = htmlentities($row['name']);
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = '<span class="i">None</span>';
		$score_theme = htmlentities($row['score_theme']);
		
		echo <<<HEREDOC
        <tr>
          <td>$place</td>
          <td><a href="../Data/Individual?ID=$id">$name</a></td>
          <td>$school</td>
          <td class="b">$score_theme</td>
        </tr>
HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	echo "      </table>\n";
	
	// INDIVIDUAL COMPOSITE
	echo <<<HEREDOC
      <h2>Top 10 Individuals by Composite</h2>
      <table class="contrasting">
        <tr>
          <th>Place</th>
          <th>Name</th>
          <th>School</th>
          <th>Composite</th>
        </tr>
HEREDOC;
	$query = individual_composite('id, individuals.name AS name, (SELECT name FROM schools WHERE school_id=teams.school) AS school_name, '
		. 'RAND() AS rand,', 'LEFT JOIN teams ON team=teams.team_id WHERE individuals.deleted="0" AND attendance="1" ORDER BY score_composite DESC, rand');
	$result = lmt_query($query);
	$row = mysql_fetch_assoc($result);
	$place = 0;
	$num = 0;
	$last_score = null;
	while ($row) {
		$num++;
		if ($row['score_composite'] != $last_score)
			$place = $num;
		$last_score = $row['score_composite'];
		if ($place > 10)
			break;
		$id = htmlentities($row['id']);
		$name = htmlentities($row['name']);
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = '<span class="i">None</span>';
		$score_composite = htmlentities($row['score_composite']);
		
		echo <<<HEREDOC
        <tr>
          <td>$place</td>
          <td><a href="../Data/Individual?ID=$id">$name</a></td>
          <td>$school</td>
          <td class="b">$score_composite</td>
        </tr>
HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	echo "      </table>\n";
	
	
	// TEAM ROUND
	
	echo <<<HEREDOC
      <h2>Top 5 Teams by Team Round</h2>
      <table class="contrasting">
        <tr>
          <th>Place</th>
          <th>Team Name</th>
          <th>Team Round</th>
        </tr>
HEREDOC;
	
	$query = 'SELECT team_id, name, IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0) AS score_team, RAND() AS rand FROM teams WHERE deleted="0" ORDER BY score_team DESC, rand';
	$result = lmt_query($query);
	$row = mysql_fetch_assoc($result);
	$place = 0;
	$num = 0;
	$last_score = null;
	while ($row) {
		$num++;
		if ($row['score_team'] != $last_score)
			$place = $num;
		$last_score = $row['score_team'];
		if ($place > 5)
			break;
		$id = htmlentities($row['team_id']);
		$name = htmlentities($row['name']);
		$score_team = htmlentities($row['score_team']);
		
		if (is_null($row['score_team']))
			$score_team = '<span class="i">None</span>';
		
		echo <<<HEREDOC
        <tr>
          <td>$place</td>
          <td><a href="../Data/Team?ID=$id">$name</a></td>
          <td class="b">$score_team</td>
        </tr>
HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	echo "      </table>\n";
	
	
	// GUTS ROUND
	
	echo <<<HEREDOC
      <h2>Top 5 Teams by Guts Round</h2>
      <table class="contrasting">
        <tr>
          <th>Place</th>
          <th>Team Name</th>
          <th>Guts Round</th>
        </tr>
HEREDOC;
	
	$query = 'SELECT team_id, name, score_guts, RAND() AS rand FROM teams WHERE deleted="0" ORDER BY score_guts DESC, rand';
	$result = lmt_query($query);
	$row = mysql_fetch_assoc($result);
	$place = 0;
	$num = 0;
	$last_score = null;
	while ($row) {
		$num++;
		if ($row['score_guts'] != $last_score)
			$place = $num;
		$last_score = $row['score_guts'];
		if ($place > 5)
			break;
		$id = htmlentities($row['team_id']);
		$name = htmlentities($row['name']);
		$score_guts = htmlentities($row['score_guts']);
		
		if (is_null($row['score_guts']))
			$score_guts = '<span class="i">None</span>';
		
		echo <<<HEREDOC
        <tr>
          <td>$place</td>
          <td><a href="../Data/Team?ID=$id">$name</a></td>
          <td class="b">$score_guts</td>
        </tr>
HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	echo "      </table>\n";
	
	
	// TEAM COMPOSITE
	
	echo <<<HEREDOC
      <h2>Top 5 Teams by Composite</h2>
      <table class="contrasting">
        <tr>
          <th>Place</th>
          <th>Team Name</th>
          <th>Team Round</th>
          <th>Guts Round</th>
          <th>Composite</th>
        </tr>
HEREDOC;
	
	$query = team_composite('team_id, name, IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0) AS score_team, score_guts, RAND() AS rand,', 'WHERE deleted="0" ORDER BY team_composite DESC, rand');
	$result = lmt_query($query);
	$row = mysql_fetch_assoc($result);
	$place = 0;
	$num = 0;
	$last_score = null;
	while ($row) {
		$num++;
		if ($row['team_composite'] != $last_score)
			$place = $num;
		$last_score = $row['team_composite'];
		if ($place > 5)
			break;
		$id = htmlentities($row['team_id']);
		$name = htmlentities($row['name']);
		$score_team = htmlentities($row['score_team']);
		$score_guts = htmlentities($row['score_guts']);
		$score_composite = htmlentities($row['team_composite']);
		
		if (is_null($row['score_team']))
			$score_team = '<span class="i">None</span>';
		if (is_null($row['score_guts']))
			$score_guts = '<span class="i">None</span>';
		
		echo <<<HEREDOC
        <tr>
          <td>$place</td>
          <td><a href="../Data/Team?ID=$id">$name</a></td>
          <td>$score_team</td>
          <td>$score_guts</td>
          <td class="b">$score_composite</td>
        </tr>
HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	echo "      </table>\n";
	
	lmt_backstage_footer('Results');
	die;
}

?>