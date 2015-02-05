<?php
/*
 * LMT/Backstage/Search.php
 * LHS Math Club Website
 *
 * Powers search results.
 *
 * Query:		the term to search for
 *
 * If Scope contains (one or more of):
 * 	"School":		search school names
 * 	"Team":			search team names
 * 	"Coach":		search coach email addresses
 * 	"Individual":	search all individual names
 * 	"Unaffiliated":	search unaffiliated individual names
 *
 * Return:		where to go afterwards
 * 	"Data":			the associated data page
 * 	"Checkin":		the checkin page
 *
 * From:		the page the query orignated from
 * 	"Data Home":	the data home page
 * 	"Checkin Home":	the checkin home page
 */

$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

do_search();





function do_search() {
	if ($_GET['Query'] == '') {
		header('Location: ' . back_link());
		die;
	}
	
	$result_table = '';
	$url = null;
	
	$urlbase = 'Data';
	if ($_GET['Return'] == 'Checkin')
		$urlbase = 'Checkin';
	
	$scope = ' ' . $_GET['Scope'];
	$return = $_GET['Return'];
	
	$query = mysqli_real_escape_string(DB::get(),$_GET['Query']);
	$query = str_replace(" ", "%", $query);
	
	if (strpos($scope, 'Individual') !== false) {
		$result = DB::queryRaw('SELECT individuals.*, teams.name AS team_name,'
			. ' (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name'
			. ' FROM individuals LEFT JOIN teams ON individuals.team=teams.team_id'
			. ' WHERE individuals.name LIKE "%' . $query . '%" AND individuals.deleted="0" ORDER BY individuals.name');
		$row = mysqli_fetch_assoc($result);
		
		$table = false;
		if ($row) {
			$result_table .= <<<HEREDOC
      <h3>Individuals</h3>
      <table class="indented contrasting">
        <tr>
          <th>Name</th>
          <th>Grade</th>
          <th>School</th>
          <th>Team</th>
        </tr>
HEREDOC;
			$table = true;
		}
		
		while ($row) {
			$label = htmlentities($row['name']);
			$grade = htmlentities($row['grade']);
			$school_name = htmlentities($row['school_name']);
			$team_name = htmlentities($row['team_name']);
			if ($row['team'] == -1) {
				$team_name = '<span class="i">Not Assigned</span>';
				$school_name = '<span class="i">Unaffiliated</span>';
			}
			$url = $urlbase . '/Individual?ID=' . htmlentities($row['id']);
			$result_table .= "        <tr><td><a href=\"$url\">$label</a></td><td class=\"text-centered\">$grade</td><td>$school_name</td><td>$team_name</td></tr>\n";
			$row = mysqli_fetch_assoc($result);
		}
		
		if ($table)
			$result_table .= "      </table>\n";
	} else if (strpos($scope, 'Unaffiliated') !== false) {
		$result = DB::queryRaw('SELECT individuals.*, teams.name AS team_name FROM individuals'
			. ' LEFT JOIN teams ON individuals.team=teams.team_id'
			. ' WHERE individuals.name LIKE "%' . $query . '%" AND email <> "" ORDER BY individuals.name');
		$row = mysqli_fetch_assoc($result);
		
		$table = false;
		if ($row) {
			$result_table .= <<<HEREDOC
      <h3>Unaffiliated Individuals</h3>
      <table class="indented contrasting">
        <tr>
          <th>Name</th>
          <th>Grade</th>
          <th>Team</th>
        </tr>
HEREDOC;
			$table = true;
		}
		
		while ($row) {
			$label = htmlentities($row['name']);
			$url = $urlbase . '/Individual?ID=' . htmlentities($row['id']);
			$grade = htmlentities($row['grade']);
			$team = htmlentities($row['team_name']);
			if ($row['team'] == -1)
				$team = '<span class="i">Not Assigned</span>';
			$result_table .= "        <tr><td><a href=\"$url\">$label</a></td><td class=\"text-centered\">$grade</td><td>$team</td></tr>\n";
			$row = mysqli_fetch_assoc($result);
		}
		
		if ($table)
			$result_table .= "      </table>\n";
	}
	
	if (strpos($scope, 'Team') !== false) {
		$result = DB::queryRaw('SELECT teams.team_id, teams.name, teams.school, schools.name AS school_name'
			. ' FROM teams LEFT JOIN schools ON teams.school=schools.school_id'
			. ' WHERE teams.name LIKE "%' . $query . '%" AND teams.deleted="0" ORDER BY teams.name');
		$row = mysqli_fetch_assoc($result);
		
		$table = false;
		if ($row) {
			$result_table .= <<<HEREDOC
      <h3>Teams</h3>
      <table class="indented contrasting">
        <tr>
          <th>Name</th>
          <th>School</th>
        </tr>
HEREDOC;
			$table = true;
		}
		
		while ($row) {
			$label = htmlentities($row['name']);
			$url = $urlbase . '/Team?ID=' . htmlentities($row['team_id']);
			$school = htmlentities($row['school_name']);
			$result_table .= "        <tr><td><a href=\"$url\">$label</a><td>$school</td></td></tr>\n";
			$row = mysqli_fetch_assoc($result);
		}
		
		if ($table)
			$result_table .= "      </table>\n";
	}

	if (strpos($scope, 'School') !== false) {
		$result = DB::queryRaw('SELECT school_id, name FROM schools WHERE name LIKE "%' . $query . '%" AND deleted="0"');
		$row = mysqli_fetch_assoc($result);
		
		$table = false;
		if ($row) {
			$result_table .= <<<HEREDOC
      <h3>Schools</h3>
      <table class="indented contrasting">
        <tr>
          <th>Name</th>
        </tr>
HEREDOC;
			$table = true;
		}
		
		while ($row) {
			$label = htmlentities($row['name']);
			$url = $urlbase . '/School?ID=' . htmlentities($row['school_id']);
			$result_table .= "        <tr><td><a href=\"$url\">$label</a></td></tr>\n";
			$row = mysqli_fetch_assoc($result);
		}
		
		if ($table)
			$result_table .= "      </table>\n";
	}

	if (strpos($scope, 'Coach') !== false) {
		$result = DB::queryRaw('SELECT school_id, name, coach_email FROM schools WHERE coach_email LIKE "%' . $query . '%" AND deleted="0"');
		$row = mysqli_fetch_assoc($result);
		
		$table = false;
		if ($row) {
			$result_table .= <<<HEREDOC
      <h3>Coaches</h3>
      <table class="indented contrasting">
        <tr>
          <th>Email</th>
          <th>School</th>
        </tr>
HEREDOC;
			$table = true;
		}
		
		while ($row) {
			$label = htmlentities($row['coach_email']);
			$url = $urlbase . '/School?ID=' . htmlentities($row['school_id']);
			$school = htmlentities($row['name']);
			$result_table .= "        <tr><td><a href=\"$url\">$label</a></td><td>$school</td></tr>\n";
			$row = mysqli_fetch_assoc($result);
		}
		
		if ($table)
			$result_table .= "      </table>\n";
	}
	
	if ($url === null) {
		// No Results
		lmt_page_header('No Results');
		$back_link = back_link();
		echo <<<HEREDOC
      <h1>No Results</h1>
      
      <div class="text-centered">
        No results were found.<br />
        <a href="$back_link">&larr; Go Back</a>
      </div>
HEREDOC;
		die;
	}
	
	if (strpos($result_table, '<a href', strpos($result_table, '<a href') + 1) === false) {
		header('Location: ' . $url);
		die;
	}
	
	
	
	// Multiple matches; show result list
	lmt_page_header('Search Results');
	$back_link = back_link();
	echo <<<HEREDOC
      <h1>Search Results</h1>
      
      <a href="$back_link">&larr; Go Back</a><br />
      <br />
$result_table
HEREDOC;
}





/*
 * back_link()
 *
 * Returns the relative URL of the page the search should return to
 */
function back_link() {
	if ($_GET['From'] == 'Data Home')
		return 'Data/Home';
	if ($_GET['From'] == 'School List')
		return 'Data/List?Schools';
	if ($_GET['From'] == 'Team List')
		return 'Data/List?Teams';
	if ($_GET['From'] == 'Unaffiliated List')
		return 'Data/List?Unaffiliated';
	if ($_GET['From'] == 'Individual List')
		return 'Data/List?Individuals';
	if ($_GET['From'] == 'Checkin Home')
		return 'Checkin/Home';
	
	// Unknown source
	if ($_GET['Return'] == 'Data')
		return 'Data/Home';
	
	return 'Data/Home';
}

?>