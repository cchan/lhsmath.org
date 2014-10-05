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
	
	$code = '<h3>Results</h3>';
	
	score_guts();
	
	// INDIVIDUAL ROUND
	
	$indiv_query = 'SELECT individuals.name AS name, (SELECT name FROM schools WHERE school_id=teams.school) AS school_name, IFNULL(%l,0) AS score FROM (individuals LEFT JOIN teams ON team=teams.team_id) WHERE individuals.deleted="0" AND teams.deleted="0" AND individuals.attendance="1" ORDER BY score DESC, RAND()';
	$rankings = array(
		array('Top Individuals in Individual Round',str_replace('%l','score_individual',$indiv_query),					5),
		array('Top Individuals in Theme Round',		str_replace('%l','score_theme',$indiv_query),						5),
		array('Top Individuals Overall',			str_replace('%l','(score_individual + score_theme)',$indiv_query),	10)
	);
	foreach($rankings as $rankparams){
		$title = $rankparams[0];
		$query = $rankparams[1];
		$maxrank = $rankparams[2];
		
		$code.='<h4>'.htmlentities($title).'</h4><table class="contrasting"><tr><th>Place</th><th>Name</th><th>School</th><th>Score</th></tr>';
		$result = DB::query($query);
		
		$prev_score = NULL; //Null never equals anything.
		foreach($result as $ind => $row){
			$name = htmlentities($row['name']);
			$school = htmlentities($row['school_name']);
			if ($school == '')
				$school = '<span class="i">None</span>';
			$score = intval($row['score']);
			
			//Finding the rank
			if($prev_score != $score)$prev_rank = $rank = $ind;//If score is below, set it to the actual ranking.
			//If it's tied, leave the ranking as it was.
			$prev_score = $score;//update previous score.
			
			if($rank > $maxrank) break;//Only specified number of top places.
			
			$code .= "<tr><td>$rank</td><td>$name</td><td>$school</td><td>$score</td></tr>";
		}
		$code .= "</table>\n";
	}
	//selecting individuals' name, school, individual score, from individuals left-joined with teams
	
	// TEAM ROUND
	$code .= '<h4>Top Teams in Team Round</h4><table class="contrasting"><tr><th>Place</th><th>Team</th><th>School</th><th>Score</th></tr>';
	
	$query = 'SELECT name, IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0) AS score_team, (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name, RAND() AS rand FROM teams WHERE deleted="0" ORDER BY score_team DESC, rand';
	$result = DB::queryRaw($query);
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
	$result = DB::queryRaw($query);
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
	$result = DB::queryRaw($query);
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