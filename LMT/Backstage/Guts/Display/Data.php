<?php
/*
 * LMT/Backstage/Guts/Display/Data.php
 * LHS Math Club Website
 *
 * Provides data for the LMT display application.
 * No access restritions
 */

$path_to_lmt_root = '../../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';

show_page();





function show_page() {
	score_guts();
	header('X-LMT-Guts-Data: 42');
	echo <<<HEREDOC
<meta http-equiv="refresh" content="10">
<style type="text/css">.school {font-style:italic;} .score{font-weight:bold;text-align:center;} .currProb{text-align:center;}</style>
<center>
<img src="../../../../res/lmt/header.png" alt="LMT" width="525" height="110">
<h2>Guts Round</h2><br><br>
<table border="0" cellspacing="5">
<tr><th></th><th>Team</th><th>School</th><th>Score</th><th>Current Set</th></tr>

HEREDOC;
	
	$result = lmt_query('SELECT name, guts_ans_a, (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name, '
		. '(SELECT MAX(problem_set) FROM guts WHERE team=team_id) AS current_problem, score_guts FROM teams WHERE deleted="0" ORDER BY score_guts DESC');
	
	$n = 1;
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$place = htmlentities($n++);
		$team = htmlentities($row['name']);
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = 'Individuals';
		$score = htmlentities($row['score_guts']);
		$curr = htmlentities($row['current_problem']);
		if ($curr == '')
			$curr = '0';
		if (!is_null($row['guts_ans_a']))
			$curr = '12';
		echo <<<HEREDOC
<tr><td>$place.</td><td class="team">$team</td><td class="school">$school</td><td class="score">$score</td><td class="currProb">$curr</td></tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	
	echo "</table></center>";
}

?>