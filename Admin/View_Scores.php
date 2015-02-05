<?php
/*
 * Admin/View_Scores.php
 * LHS Math Club Website
 *
 * Shows a list of users and test scores.
 */


require_once '../lib/functions.php';
restrict_access('A');

page_title('View Scores');

if (isSet($_GET['View']) && isSet($_GET['Test']) && count($_GET['Test']) > 0)
	show_scores();
else
	header('Location: Tests');





/*
 * show_scores()
 *
 * Shows members' scores for the selected tests in a grid,
 * sorted highest to lowest in total
 */
function show_scores() {
/*
//What's the difference between inner, right, left, and full?
//NO IDEA STILL.
SELECT * FROM (
    SELECT score_id, tests.test_id FROM (test_scores INNER JOIN tests ON tests.test_id = test_scores.test_id)
    UNION ALL
    SELECT score_id, tests.test_id FROM (test_scores RIGHT JOIN tests ON tests.test_id = test_scores.test_id)
) tbl
GROUP BY score_id HAVING COUNT(*) =1
*/

/*
//Valiant attempt:
SELECT tests.test_id, tests.name, tests.total_points, (test_scores.score - stats.average) / stats.st AS zvalue
FROM (test_scores
	INNER JOIN tests ON test_scores.test_id = tests.test_id
	CROSS JOIN (SELECT STDDEV(test_scores.score) AS st, AVG(test_scores.score) AS average) stats)
WHERE test_scores.test_id IN (1,2,3,4,5,6,7,8)
GROUP BY test_scores.test_id ORDER BY tests.date DESC
*/

	$teststats = DB::query('SELECT
			tests.test_id as test_id,
			tests.name as name,
			tests.total_points as total_points,
			STDDEV(test_scores.score) AS stddev,
			AVG(test_scores.score) AS avg
		FROM (test_scores INNER JOIN tests ON test_scores.test_id = tests.test_id)
		WHERE test_scores.test_id IN %li
		GROUP BY test_scores.test_id ORDER BY tests.date DESC',$_GET['Test']);
	
	$test_ids = DBHelper::verticalSlice($teststats,'test_id');
	
	$test_names = DBHelper::verticalSlice($teststats,'name','test_id');
	$avgs = DBHelper::verticalSlice($teststats,'avg','test_id');
	$stddevs = DBHelper::verticalSlice($teststats,'stddev','test_id');	
	
	/*
	Original, readable one:
	select users.name,
	  sum(case tests.test_id when 248 then score/12 end) as t1,
	  sum(case tests.test_id when 249 then score/16 end) as t2,
      sum(case tests.test_id when 248 then score/12 when 249 then score/16 end) as total
	from test_scores
	inner join tests
	  on test_scores.test_id = tests.test_id
    inner join users
      on test_scores.user_id = users.id
    where tests.test_id in (248, 249)
	group by test_scores.user_id
    order by sum(test_scores.score) desc, users.name asc
	*/
	
	//Generating HTML in my SQL. LOLZ.
	$query = "select users.name as name, ";
		$sums = "";
		$total = "sum(case tests.test_id ";
		foreach($test_ids as $test_id){
			$sums .= ",GROUP_CONCAT(
				case tests.test_id
				when {$test_id} then CONCAT('<div style=\'height:4em;\' onmouseover=\"$(this).find(\'small\').css({display:\'inline\'});\"><b>',score,'</b> <small style=\"float:right;display:none;\">(z: ',round((score-{$avgs[$test_id]})/{$stddevs[$test_id]},3),')</small></div>')
				else '' end SEPARATOR '') as t{$test_id} ";
			$total .= "when {$test_id} then (score-{$avgs[$test_id]})/{$stddevs[$test_id]} ";
		}
		$total .= "end ) as zsum,
			sum(case when score is null then 0 else 1 end) as count,
			sum(score) as sum";//zsum is bonkers
	$query .= "$total $sums from test_scores
	inner join tests
	  on test_scores.test_id = tests.test_id
    inner join users
      on test_scores.user_id = users.id
    where tests.test_id in %li
	group by test_scores.user_id";
	
	
	foreach($test_ids as $id){
		$test_names['t'.$id]=$test_names[$id]; unset($test_names[$id]);
		$avgs['t'.$id]=round($avgs[$id],3); unset($avgs[$id]);
		$stddevs['t'.$id]=round($stddevs[$id],3); unset($stddevs[$id]);
	}//Sets each assoc array key from ID to tID, just like in the SQL above.
	
	$headers = array('name'=>'Name','total'=>'Total') + $test_names;//Assoc array with key test_id and value test name
	
	$headdata = array();
	$headdata[] = array('name'=>'Average','total'=>'') + $avgs;
	$headdata[] = array('name'=>'Pop Std Dev','total'=>'') + $stddevs;
	$headdata[] = array();
	
	$querydata = DB::query($query, $test_ids);
	
	foreach($querydata as &$row){
		//The extra addition creates a significant bias toward people who have taken more tests.
		$row['finalscore'] = ($row['zsum'])/$row['count'] + $row['count']/2.5;
		$row['total'] = "score: <b>".round($row['finalscore'],3)."</b>"
			."<br>&Sigma;z: ".round($row['zsum'],3)."<br>&Sigma;x: ".$row['sum'];
	}
	unset($row);//php, why do I actually have to do this?
	
	usort($querydata,function($r1,$r2){
		if($r1['finalscore'] != $r2['finalscore'])//First in order of z-average
			return $r1['finalscore'] < $r2['finalscore'] ? 1 : -1;
		else//Then in random order.
			return mt_rand(-1000,1000);
	});
	
	$data = array_merge($headdata,$querydata);
	
	$namestr = '<div><b>Tests:</b> '.implode(', ',$test_names).'</div><br>';
	foreach($querydata as $row)
		$namestr .= $row['name'].'<br>';
	echo <<<HEREDOC
      <h1>View Scores</h1>
	  
	  <h3>TL;DR</h3>
	  <div>$namestr</div>
	  <br>
	  
	  <h3>Stats</h3>
      <p>Z-scores are a very good way of standardizing scores. It is sorted by a (slightly modified) z-average, which is the average of the <i>available</i> z-scores only. The final sorted-by score has a bit of weight placed toward attending more tryouts. Ties, as always, are broken in random order.</p>
	  
      <a href="Tests">&lt; Back</a>
HEREDOC
	. make_table('contrasting',$headers,$data);
}

?>