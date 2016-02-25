<?php
/*
 * .lib/lmt-scoring.php
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
	if ($int_score > 85 || $int_score < 0)
		return 'Score must be between 0 and 70 + 15 inclusive';
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
 * All special answers (34-36) have to have been pre-screened using prescreen_guts()
 *
 * RULE: it's complicated. see comments.
 */
function score_guts() {
			// In this "case" statement are the point values per round.
			// BTW, round 12 has a maximum of 15 each, for
			//   a total of 300 possible points in Guts.
			// Multiples "score" out of 3 by the point value each problem_set has.
	DB::query("UPDATE teams SET score_guts = ((SELECT IFNULL(SUM(guts.score * (
				case guts.problem_set
					when 1 then 5
					when 2 then 5
					when 3 then 6
					when 4 then 6
					when 5 then 7
					when 6 then 7
					when 7 then 8
					when 8 then 8
					when 9 then 9
					when 10 then 11
					when 11 then 13
					else 0
				end
			)),0) FROM guts WHERE team=teams.team_id)".
		"+ IFNULL(GREATEST( 0, FLOOR(15 - 5*LOG10(guts_ans_a - 3090))), 0)". /*Scoring #34 */
		"+ IFNULL(GREATEST( 0, FLOOR(15 * LEAST(283086/guts_ans_b, guts_ans_b/283086))), 0)". /*Scoring #35 */
		"+ IFNULL(guts_ans_c, 0))"); /*Scoring #36 -- was done manually, because numbers are really big */
}

?>