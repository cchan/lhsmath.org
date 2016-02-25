<?php
/*
 * Admin/Tests.php
 * LHS Math Club Website
 *
 * Shows a list of tests and allows Admins to add and remove them.
 */


require_once '../.lib/functions.php';
restrict_access('A');
show_page();





function show_page() {
	page_header('Test List');
	
	$delete_msg = '';
	if (isSet($_SESSION['TEST_deleted'])) {
		$delete_msg = "\n        <div class=\"alert\">{$_SESSION['TEST_deleted']}</div><br />\n";
		unset($_SESSION['TEST_deleted']);
	}
	
	$add_msg = '';
	if (isSet($_SESSION['TEST_added'])) {
		$add_msg = "\n        <div class=\"alert\">{$_SESSION['TEST_added']}</div><br />\n";
		unset($_SESSION['TEST_added']);
	}
	
	$school_year = (int)date('Y');
	if ((int)date('n') <= 6) // before end of year
		$school_year -= 1;
	
	// If the user requests all data, or just this year's:
	$limiting_condition = ' WHERE archived="0" OR date > DATE(\'' . $school_year . '-07-01\')';
	$archived_tests_title = 'Archived Tests from This Year';
	$change_view_link = '<a href="Tests?ShowAll">Show All</a>';
	$archive_return = 'List';
	if (isSet($_GET['ShowAll'])) {
		$limiting_condition = '';
		$archived_tests_title = 'All Archived Tests';
		$change_view_link = '<a href="Tests">Limit to this year</a>';
		$archive_return = 'ListAll';
	}
	
	// Get Data
	$query = 'SELECT *,  DATE_FORMAT(date, "%a %b %e, %Y") AS formatted_date FROM tests' . $limiting_condition . ' ORDER BY archived ASC, date DESC';
	$result = DB::queryRaw($query);
	
	// Current List
	$test_list = <<<HEREDOC
      <form method="get" action="View_Scores"><div>
	  <input type="submit" name="View" value="Compare"/>
      <table class="contrasting">
        <tr>
          <th></th>
          <th>Test Name</th>
          <th>Date</th>
          <th>Points</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>

HEREDOC;
	$row = mysqli_fetch_assoc($result);
	$test_list_empty = true;
	while ($row) {
		if ($row['archived'] == '1')
			break;
		
		$test_list_empty = false;
		
		$test_id = $row['test_id'];
		$test_list .= <<<HEREDOC
        <tr>
		  <td><input type="checkbox" name="Test[]" value="$test_id"/></td>
          <td>{$row['name']}</td>
          <td>{$row['formatted_date']}</td>
          <td class="text-centered">{$row['total_points']}</td>
          <td><a href="Enter_Scores?ID=$test_id">Enter Scores</a></td>
          <td><a href="Edit_Test?Archive&amp;ID=$test_id&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=$archive_return">Archive</a></td>
          <td><a href="Edit_Test?Edit&amp;ID=$test_id&amp;Return=$archive_return">Edit</a></td>
        </tr>
HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	if ($test_list_empty)
		$test_list = 'No Current Tests<br />';
	else
		$test_list .= <<<HEREDOC
      </table>
      <br />
      <input type="submit" name="View" value="Compare"/>
      </div></form>
HEREDOC;
	
	
	// Archived List
	$archived_list = <<<HEREDOC
      <table class="contrasting">
        <tr>
          <th>Test Name</th>
          <th>Date</th>
          <th>Points</th>
          <th></th>
          <th></th>
        </tr>

HEREDOC;
	$archived_list_empty = true;
	while($row) {
		$archived_list_empty = false;
		
		$test_id = $row['test_id'];
		$archived_list .= <<<HEREDOC
        <tr>
          <td>{$row['name']}</td>
          <td>{$row['formatted_date']}</td>
          <td class="text-centered">{$row['total_points']}</td>
          <td><a href="Edit_Test?UnArchive&amp;ID=$test_id&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=$archive_return">Un-Archive</a></td>
          <td><a href="Edit_Test?Edit&amp;ID=$test_id&amp;Return=$archive_return">Edit</a></td>
        </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	if ($archived_list_empty)
		$archived_list = 'No Archived Tests<br />';
	else
		$archived_list .= '      </table>';
	
	
	echo <<<HEREDOC
      <h1>Test List</h1>
      $delete_msg$add_msg
      <h3>Current Tests</h3>
      <a href="Edit_Test?Add&amp;Return=$archive_return">+ Add a Test</a><br /><br />
$test_list
      <br />
      <br />
      <br />
      
      <h3>$archived_tests_title</h3>
$archived_list
      <br />
      $change_view_link
HEREDOC;
}

?>