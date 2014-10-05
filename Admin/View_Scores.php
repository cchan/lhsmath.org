<?php
/*
 * Admin/View_Scores.php
 * LHS Math Club Website
 *
 * Shows a list of users and test scores.
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


if (isSet($_GET['View']))
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
	if (count($_GET['Test']) == 0) {
		header('Location: Tests');
		die;
	}
	
	page_header('View Scores');
	echo <<<HEREDOC
      <h1>View Scores</h1>
      
      <a href="Tests">&lt; Back</a>
      <table class="contrasting">
        <tr>
          <th>Name</th>
          <th>Total</th>
HEREDOC;

	// Get test names
	$query = 'SELECT test_id, name, total_points FROM tests WHERE';
	$or = '';
	foreach ($_GET['Test'] as $test_id) {
		$query .= $or . ' test_id="' . mysqli_real_escape_string(DB::get(),$test_id) . '"';
		$or = ' OR';
	}
	$query .= ' ORDER BY date DESC';
	$result = DB::queryRaw($query);
	
	$row = mysqli_fetch_assoc($result);
	$i = 0;
	$test_ids = array();
	while ($row) {
		$test_ids[$i++] = $row['test_id'];
		echo "\n          <th class=\"min-width\">" . htmlentities($row['name']) . ' [' . $row['total_points'] . ']</th>';
		$row = mysqli_fetch_assoc($result);
	}
	echo "\n        </tr>";
	
	// Get Scores
	$query = 'SELECT users.name, users.id';
	foreach ($test_ids as $test_id)
		$query .= ', MAX(IF(test_id="' . $test_id . '", score, NULL)) AS test_' . $test_id;
	$query .= ', SUM(score) FROM test_scores INNER JOIN users ON test_scores.user_id=users.id WHERE';
	$or = '';
	foreach ($test_ids as $test_id) {
		$query .= $or . ' test_id="' . $test_id . '"';
		$or = ' OR';
	}
	$query .= ' GROUP BY user_id ORDER BY SUM(score) DESC, name';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	while ($row) {
		echo "\n        <tr>\n          <td><a href=\"View_User?ID=" . $row['id'] . '">' . $row['name'] . "</a></td>\n          <td>" . $row['SUM(score)'] . "</td>";
		foreach ($test_ids as $test_id)
			echo "\n          <td>" . $row['test_' . $test_id] . '</td>';
		echo "\n        </tr>";
		$row = mysqli_fetch_assoc($result);
	}
	echo "\n      </table>";
	
	admin_page_footer('');
}

?>