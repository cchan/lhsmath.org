<?php
/*
 * lib/lmt-scoring.php
 * LHS Math Club Website
 *
 * This file is where scoring algorithms for the LMT
 * are implemented.
 *
 * 
 */





/*
 * validate_individual_score($score)
 *
 * Checks that a score for the individual round is valid. If so, returns
 * true. Otherwise, returns an HTML error message.
 *
 * CURRENT RULE: any integer between 0 and 20, inclusive
 */
function validate_individual_score($score) {
	$int_score = (int) $score;
	if ((String)$int_score != $score)
		return 'Score must be an integer';
	if ($int_score > 20 || $int_score < 0)
		return 'Score must be between 0 and 20 inclusive';
	return true;
}





/*
 * validate_theme_score($score)
 *
 * See above. Not to be confused with the TEAM round.
 *
 * CURRENT RULE: any integer between 0 and 15, inclusive
 */
function validate_theme_score($score) {
	$int_score = (int) $score;
	if ((String)$int_score != $score)
		return 'Score must be an integer';
	if ($int_score > 15 || $int_score < 0)
		return 'Score must be between 0 and 15 inclusive';
	return true;
}





/*
 * validate_team_short_score($score)
 *
 * See above.
 *
 * CURRENT RULE: any integer between 0 and 70, inclusive
 */
function validate_team_short_score($score) {
	$int_score = (int) $score;
	if ((String)$int_score != $score)
		return 'Score must be an integer';
	if ($int_score > 70 || $int_score < 0)
		return 'Score must be between 0 and 70 inclusive';
	return true;
}





/*
 * validate_team_long_score($score)
 *
 * See above.
 *
 * CURRENT RULE: any integer between 0 and 130, inclusive
 */
function validate_team_long_score($score) {
	$int_score = (int) $score;
	if ((String)$int_score != $score)
		return 'Score must be an integer';
	if ($int_score > 130 || $int_score < 0)
		return 'Score must be between 0 and 130 inclusive';
	return true;
}





/*
 * prescreen_guts($problem, $value)
 *
 * $problem: 34, 35 or 36
 * $value: string of up to 100 characters
 *
 * Given a team's answer for one of the special guts problems,
 * returns either that same answer or a different string
 * of up to 100 characters; can be used to "blank out" invalid
 * answers to the problem before they are stored in the database.
 * Null values will be properly handled.
 *
 * RULES:
 * 	34:	Reasonable decimals (up to 14 digits?)
 * 	35: Reasonable decimals
 * 	36: Integers between 1 and 15, inclusive
 */
function prescreen_guts($problem, $value) {
	if ($problem == 34) {
		$new_value = (int) $value;
		if ((String)$new_value != $value)
			return '';
		
		return $new_value;
	}
	else if ($problem == 35) {
		$new_value = (int) $value;
		if ((String)$new_value != $value)
			return '';
		if ($new_value < 3091)
			return null;
		if ($new_value > 15)
			return null;
		return $new_value;
	}
	else if ($problem == 36) {
		$new_value = (int) $value;
		if ((String)$new_value != $value)
			return null;
		if ($new_value < 1)
			return null;
		if ($new_value > 15)
			return null;
		return $new_value;
	}
	else
		trigger_error('Guts Prescreen: invalid problem number', E_USER_ERROR);
}





/*
 * individual_composite($fields, $where)
 *
 * Returns a query string to calculate individual compsite scores. Allows
 * fields (ends in a comma if necessary) and a where clause. See example:
 *
 * [Ex.] return "SELECT $fields score_individual + score_theme AS score_composite FROM individuals WHERE $where";
 * 	  Note that $where may also contain an ORDER BY statement.
 *
 * RULE: sum individual and theme round scores
 */
function individual_composite($fields, $where) {
	return "SELECT $fields IFNULL(score_individual, 0)*3 + IFNULL(score_theme, 0)*4 AS score_composite FROM individuals $where";
}





/*
 * team_composite($fields, $where)
 *
 * Returns a query string to calculate team compsite scores. Allows
 * fields (ends in a comma if necessary) and a where clause. See example above.
 *
 * RULE: top 4 composite scores, multiply by 1.25
 * 			add: team round score * 1.5, guts round score
 */
function team_composite($fields, $where) {
	//$indiv_sum = 'IFNULL((SELECT SUM(score_individual) FROM individuals WHERE team=teams.team_id ORDER BY score_individual DESC LIMIT 4), 0)';
	//$theme_sum = 'IFNULL((SELECT SUM(score_theme) FROM individuals WHERE team=teams.team_id ORDER BY score_theme DESC LIMIT 4), 0)';
	
	$indiv[1] = 'IFNULL((SELECT score_individual FROM individuals WHERE team=teams.team_id ORDER BY score_individual DESC LIMIT 0,1), 0)';
	$indiv[2] = 'IFNULL((SELECT score_individual FROM individuals WHERE team=teams.team_id ORDER BY score_individual DESC LIMIT 1,1), 0)';
	$indiv[3] = 'IFNULL((SELECT score_individual FROM individuals WHERE team=teams.team_id ORDER BY score_individual DESC LIMIT 2,1), 0)';
	$indiv[4] = 'IFNULL((SELECT score_individual FROM individuals WHERE team=teams.team_id ORDER BY score_individual DESC LIMIT 3,1), 0)';
	
	$theme[1] = 'IFNULL((SELECT score_theme FROM individuals WHERE team=teams.team_id ORDER BY score_theme DESC LIMIT 0,1), 0)';
	$theme[2] = 'IFNULL((SELECT score_theme FROM individuals WHERE team=teams.team_id ORDER BY score_theme DESC LIMIT 1,1), 0)';
	$theme[3] = 'IFNULL((SELECT score_theme FROM individuals WHERE team=teams.team_id ORDER BY score_theme DESC LIMIT 2,1), 0)';
	$theme[4] = 'IFNULL((SELECT score_theme FROM individuals WHERE team=teams.team_id ORDER BY score_theme DESC LIMIT 3,1), 0)';
	
	$indiv_sum = "({$indiv[1]} + {$indiv[2]} + {$indiv[3]} + {$indiv[4]})";
	$theme_sum = "({$theme[1]} + {$theme[2]} + {$theme[3]} + {$theme[4]})";
	
	$score_team = "(IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0))";
	$score_guts = "IFNULL(score_guts, 0)";
	
	$query = <<<HEREDOC
  (($indiv_sum * 3 + $theme_sum * 4) * 1.25)
+ ( $score_team              * 1.5 )
+ ( $score_guts                    )
HEREDOC;
	
	$query = "SELECT $fields $query AS team_composite FROM teams $where";
	return $query;
}





/*
 * score_guts()
 *
 * Calculate every team's (integral) guts score and store it in the score_guts field.
 * All special answers (34-36) are guarenteed to be pre-screened using prescreen_guts
 *
 * RULE: it's complicated. see comments.
 */
function score_guts() {
	
	$N=283086;
	//15 * min($m/$N, $N/$m);
	
	
	// These are the point values per round.
	// BTW, round 12 has a maximum of 15, for
	//   a total of 200 points in Guts
	$points = array(1 => 5,
				2 => 5,
				3 => 6,
				4 => 6,
				5 => 7,
				6 => 7,
				7 => 8,
				8 => 8,
				9 => 9,
				10 => 11,
				11 => 13);
	// Answers for 34 & 35
	$ans_b = 283086;
	$ans_a = 3090;
	
	// Code to add up values for rounds 1 to 11
	$main = "( IFNULL((SELECT score FROM guts WHERE team=teams.team_id AND problem_set=1), 0) * {$points[1]})\n";
	for ($n = 2; $n <= 11; $n++)
		$main .= " + ( IFNULL((SELECT score FROM guts WHERE team=teams.team_id AND problem_set=$n), 0) * {$points[$n]})\n";
	
	// Code to score 34 & 35
	$a = "GREATEST( 0, FLOOR(15 - 5*LOG10(guts_ans_a - $ans_a)))";
    $b = "GREATEST( 0, FLOOR(MIN($ans_a/guts_ans_b, guts_ans_b/$ans_b)))";
	
	// Problem 36:
	//$c_sub = "SELECT (SELECT AVG(guts_ans_c) FROM teams WHERE deleted=\"0\") as avg";
	//$row = DB::queryFirstRow($c_sub);
	//$avg = $row['avg'];
	//if ($avg == '' || is_null($avg))
	//	$avg = '0';
	//
	//$c = "IF(  guts_ans_c > $avg,  0,  guts_ans_c)";
    $c = "guts_ans_c";
	
	
	$query = "$main + IFNULL($a, 0) + IFNULL($b, 0) + IFNULL($c, 0)";
	$query = "UPDATE teams SET score_guts=($query)";
	DB::queryRaw($query);
}

?>