<?php
/*
 * LMT/Backstage/Guts/Display/Display.php
 * LHS Math Club Website
 *
 * New display thing :)
 */

$path_to_lmt_root = '../../../';
require_once $path_to_lmt_root . '../.lib/lmt-functions.php';

score_guts();
cancel_templateify();

header("Content-type:application/json");
?>
[<?php
	$result = DB::queryRaw('SELECT name, guts_ans_a, (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name, '
		. '(SELECT MAX(problem_set) FROM guts WHERE team=team_id) AS current_problem, score_guts FROM teams WHERE deleted="0" ORDER BY score_guts DESC');
	
	$n = 1;
  $prev_score = 10000000;
  $prev_place = 0;
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$place = $n++;
		$team = htmlentities($row['name']);
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = 'Individuals';
		$score = htmlentities($row['score_guts']);
		$set = htmlentities($row['current_problem']);
		if ($set == '')
			$set = '0';
		if (!is_null($row['guts_ans_a']))
			$set = '12';
    
    if($score == $prev_score)
      $place = $prev_place;
    $prev_place = $place;
    $prev_score = $score;
    
    if($n != 2)
      echo ",";
		?>
    {
      "place": <?=$place?>,
      "team": "<?=$team?>",
      "set": <?=$set?>,
      "school": "<?=$school?>",
      "score": <?=$score?>
    }
<?php
		$row = mysqli_fetch_assoc($result);
	}
?>]
