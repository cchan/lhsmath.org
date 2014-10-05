<?php
/*
 * Admin/User_List.php
 * LHS Math Club Website
 *
 * Shows a list of users
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');
show_page();





function show_page() {
	global $use_rel_external_script;	// direct page_header to include some javascript that will make links
	$use_rel_external_script = true;	// marked as rel="external" open in a new tab while remaining XHTML-valid
	
	page_header('User List');
	
	// Generate code for the different tables of users included in the body
	
	$captains_table = generate_user_table('SELECT id, name, email, yog FROM users WHERE permissions="C" ORDER BY yog ASC, name');
	$other_admins_table = generate_user_table('SELECT id, name, email, yog FROM users WHERE permissions="A" ORDER BY yog ASC, name');
	$special_table = generate_user_table('SELECT id, name, email, yog FROM users WHERE permissions="S" ORDER BY yog ASC, name');
	$members_table = generate_user_table('SELECT id, name, email, yog FROM users WHERE permissions="R" AND approved="1" ORDER BY yog ASC, name');
	$alumni_table = generate_user_table('SELECT id, name, email, yog FROM users WHERE permissions="L" ORDER BY yog DESC, name');
	$banned_users_table = generate_user_table('SELECT id, name, email, yog, creation_date, DATE_FORMAT(creation_date, "%M %e, %Y") AS formatted_creation FROM users WHERE approved="-1" ORDER BY creation_date DESC');

	if (mysqli_num_rows($special_table) == 0)
		$special_table .= "        <tr><td colspan=\"5\" class=\"text-centered\">None</td></tr>\n";	

	// The Pending Approval Table is different
	$pending_approval_table = <<<HEREDOC
      <table class="contrasting">
        <tr>
          <th>Name</th>
          <th>Email Address</th>
          <th>YOG</th>
          <th>Account Creation</th>
          <th>Actions</th>
        </tr>

HEREDOC;
	
	$query = 'SELECT id, name, email, yog, TIMESTAMPDIFF(DAY, creation_date, CURRENT_TIMESTAMP) AS created_ago FROM users WHERE approved="0" ORDER BY created_ago DESC, name';
	$result = DB::queryRaw($query);
	
	$row = mysqli_fetch_assoc($result);
	
	if (mysqli_num_rows($result) == 0)
		$pending_approval_table .= "        <tr><td colspan=\"5\" class=\"text-centered\">None</td></tr>\n";	// if no results returned
	else {
		while ($row) {
			$trimmed_email = trim_email($row['email']);
			$pending_approval_table .= <<<HEREDOC
	        <tr>
	          <td><a href="View_User?ID={$row['id']}">{$row['name']}</a></td>
	          <td><a href="mailto:{$row['email']}" rel="external">$trimmed_email</a></td>
	          <td>{$row['yog']}</td>
	          <td>{$row['created_ago']} days ago</td>
	          <td>
	            <a href="Edit_User?Approve&amp;ID={$row['id']}&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=List" class="small">Approve</a><br />
	            <a href="Edit_User?Ban&amp;ID={$row['id']}&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=List" class="small">Ban</a>
	          </td>
	        </tr>
	
HEREDOC;
			$row = mysqli_fetch_assoc($result);
		}
	}
	
	$pending_approval_table .= "      </table><br />\n";
	
	
	// Assemble page
	echo <<<HEREDOC
      <h1>User List</h1>
      
      <span class="b">Captains</span>
      $captains_table
      <br />
      <br />
      
      <span class="b">Other Admins</span>
      $other_admins_table
      <br />
      <br />

      <span class="b">Besties</span>
      $members_table
      <br />
      <br />
      
      <span class="b">Members</span>
      $members_table
      <br />
      <br />
      
      <span class="b">Alumni</span>
      $alumni_table
      <br />
      <br />
      
      <span class="b">Pending Users</span>
      $pending_approval_table
      <br />
      <br />
      
      <span class="b">Banned Users</span>
      $banned_users_table
      <br />
      <br />
      
HEREDOC;
	admin_page_footer('User List');
}





/*
 * Generates an HTML table that displays the results
 * of the given query.
 *  - $query: The query to execute; must get id, name, email, yog
 *  - returns: HTML code for a table
 */
function generate_user_table($query) {
	// If the query includes FORMAT(creation_date, '...') AS formatted_creation, add that to the standard table
	// Note that this does not work for SELECT * - it searches for the string 'creation_date' in the query
	$creation_date_th = '';
	$add_creation_date = false;
	if (strpos($query, 'formatted_creation')) {
		$creation_date_th = "\n          <th>Account Creation</th>";
		$add_creation_date = true;
	}
	
	$html_table = <<<HEREDOC
      <table class="contrasting">
        <tr>
          <th>Name</th>
          <th>Email Address</th>
          <th>YOG</th>$creation_date_th
        </tr>

HEREDOC;
	
	$result = DB::queryRaw($query);
		
	if (mysqli_num_rows($result) == 0) {
		if ($add_creation_date)
			$html_table .= "        <tr><td colspan=\"4\" class=\"text-centered\">None</td></tr>\n";	// if no results returned
		else
			$html_table .= "        <tr><td colspan=\"3\" class=\"text-centered\">None</td></tr>\n";	// if no results returned
	}
	else {
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			$creation_date_td = '';
			$trimmed_email = trim_email($row['email']);
			if ($add_creation_date)
				$creation_date_td = "\n          <td>{$row['formatted_creation']}</td>";
			$html_table .= <<<HEREDOC
	        <tr>
	          <td><a href="View_User?ID={$row['id']}">{$row['name']}</a></td>
	          <td><a href="mailto:{$row['email']}" rel="external">$trimmed_email</a></td>
	          <td>{$row['yog']}</td>$creation_date_td
	        </tr>
	
HEREDOC;
			$row = mysqli_fetch_assoc($result);
		}
	}
	
	$html_table .= "      </table><br />\n";
	return $html_table;
}

?>