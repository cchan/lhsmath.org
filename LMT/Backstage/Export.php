<?php
/*
 * LMT/Backstage/Export.php
 * LHS Math Club Website
 *
 * Produces HTML results for the website
 */

$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if(!$EXPORT_STR){
show_page();
}




function show_page() {
	global $EXPORT_STR;
	//$EXPORT_STR=true makes it return a string of all the code. (and not echo anything)
	if(!$EXPORT_STR){
		lmt_page_header('Export');
		echo <<<HEREDOC
<h1>Export</h1>

HEREDOC;
	}
	
	$code = <<<HEREDOC
<h3>Results</h3>
<h4>Top Individuals in Individual Round</h4>
<table class="contrasting">
  <tr>
    <th>Place</th>
    <th>Name</th>
    <th>School</th>
    <th>Score</th>
  </tr>

HEREDOC;
	
	score_guts();
	
	// INDIVIDUAL ROUND
	$query ='SELECT id, individuals.name AS name, (SELECT name FROM schools WHERE school_id=teams.school) AS school_name, '
		. 'RAND() AS rand, score_individual FROM individuals LEFT JOIN teams ON team=teams.team_id WHERE individuals.deleted="0" AND attendance="1" ORDER BY score_individual DESC, rand';
	$result = lmt_query($query);
	$row = mysqli_fetch_assoc($result);
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
		
		$code .= <<<HEREDOC
  <tr>
    <td>$place</td>
    <td>$name</td>
    <td>$school</td>
    <td>$score_individual</td>
  </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	$code .= "</table>\n";
	
	// Theme ROUND
	$code .= <<<HEREDOC
<h4>Top Individuals in Theme Round</h4>
<table class="contrasting">
  <tr>
    <th>Place</th>
    <th>Name</th>
    <th>School</th>
    <th>Score</th>
  </tr>

HEREDOC;
	$query ='SELECT id, individuals.name AS name, (SELECT name FROM schools WHERE school_id=teams.school) AS school_name, '
		. 'RAND() AS rand, score_theme FROM individuals LEFT JOIN teams ON team=teams.team_id WHERE individuals.deleted="0" AND attendance="1" ORDER BY score_theme DESC, rand';
	$result = lmt_query($query);
	$row = mysqli_fetch_assoc($result);
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
		
		$code .= <<<HEREDOC
  <tr>
    <td>$place</td>
    <td>$name</td>
    <td>$school</td>
    <td>$score_theme</td>
  </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	$code .= "</table>\n";
	
	// INDIVIDUAL COMPOSITE
	$code .= <<<HEREDOC
<h4>Top Individuals Overall</h4>
<table class="contrasting">
  <tr>
    <th>Place</th>
    <th>Name</th>
    <th>School</th>
    <th>Score</th>
  </tr>

HEREDOC;
	$query = individual_composite('id, individuals.name AS name, (SELECT name FROM schools WHERE school_id=teams.school) AS school_name, '
		. 'RAND() AS rand,', 'LEFT JOIN teams ON team=teams.team_id WHERE individuals.deleted="0" AND attendance="1" ORDER BY score_composite DESC, rand');
	$result = lmt_query($query);
	$row = mysqli_fetch_assoc($result);
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
		
		$code .= <<<HEREDOC
  <tr>
    <td>$place</td>
    <td>$name</td>
    <td>$school</td>
    <td>$score_composite</td>
  </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	$code .= "</table>\n";
	
	
	// TEAM ROUND
	
	$code .= <<<HEREDOC
<h4>Top Teams in Team Round</h4>
<table class="contrasting">
  <tr>
    <th>Place</th>
    <th>Team</th>
    <th>School</th>
    <th>Score</th>
  </tr>

HEREDOC;
	
	$query = 'SELECT team_id, name, IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0) AS score_team, (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name, RAND() AS rand FROM teams WHERE deleted="0" ORDER BY score_team DESC, rand';
	$result = lmt_query($query);
	$row = mysqli_fetch_assoc($result);
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
		$school_name = htmlentities($row['school_name']);
		$score_team = htmlentities($row['score_team']);
		
		if (is_null($row['score_team']))
			$score_team = '<span class="i">None</span>';
		
		$code .= <<<HEREDOC
  <tr>
    <td>$place</td>
    <td>$name</td>
    <td>$school_name</td>
    <td>$score_team</td>
  </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	$code .= "</table>\n";
	
	
	// GUTS ROUND
	
	$code .= <<<HEREDOC
<h4>Top Teams in Guts Round</h4>
<table class="contrasting">
  <tr>
    <th>Place</th>
    <th>Team</th>
    <th>School</th>
    <th>Score</th>
  </tr>

HEREDOC;
	
	$query = 'SELECT team_id, name, score_guts, (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name, RAND() AS rand FROM teams WHERE deleted="0" ORDER BY score_guts DESC, rand';
	$result = lmt_query($query);
	$row = mysqli_fetch_assoc($result);
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
		$school_name = htmlentities($row['school_name']);
		$score_guts = htmlentities($row['score_guts']);
		
		if (is_null($row['score_guts']))
			$score_guts = '<span class="i">None</span>';
		
		$code .= <<<HEREDOC
  <tr>
    <td>$place</td>
    <td>$name</td>
    <td>$school_name</td>
    <td>$score_guts</td>
  </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	$code .= "</table>\n";
	
	
	// TEAM COMPOSITE
	
	$code .= <<<HEREDOC
<h4>Top Teams Overall</h4>
<table class="contrasting">
  <tr>
    <th>Place</th>
    <th>Team</th>
    <th>School</th>
    <th>Score</th>
  </tr>

HEREDOC;
	
	$query = team_composite('team_id, name, IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0) AS score_team, score_guts, RAND() AS rand, (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name,', 'WHERE deleted="0" ORDER BY team_composite DESC, rand');
	$result = lmt_query($query);
	$row = mysqli_fetch_assoc($result);
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
		$school_name = htmlentities($row['school_name']);
		
		if (is_null($row['score_team']))
			$score_team = '<span class="i">None</span>';
		if (is_null($row['score_guts']))
			$score_guts = '<span class="i">None</span>';
		
		$code .= <<<HEREDOC
  <tr>
    <td>$place</td>
    <td>$name</td>
    <td>$school_name</td>
    <td>$score_composite</td>
  </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	$code .= "</table>\n";
	
	if($EXPORT_STR)return $code;
	else echo nl2br(str_replace(' ', '&nbsp;', htmlentities($code)));
	
	lmt_backstage_footer('Export');
}

?>