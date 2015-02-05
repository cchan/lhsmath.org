<?php
/*
 * Admin/View_User.php
 * LHS Math Club Website
 *
 * Shows a detailed information page about a user
 *
 * Requires the GET parameter 'ID' (the user's id)
 */


require_once '../lib/functions.php';
restrict_access('A');


show_page();





function show_page() {
	// Get data about user
	$query = 'SELECT *, DATE_FORMAT(creation_date, "%M %e, %Y") AS formatted_creation FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);	// have MySQL format the date for us
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('User not found', E_USER_ERROR);
	
	// ** User Found, info valid at this point **
	
	$row = mysqli_fetch_assoc($result);
	
	
	// Page header
	global $use_rel_external_script;	// direct page_header to include some javascript that will make links
	$use_rel_external_script = true;	// marked as rel="external" open in a new tab while remaining XHTML-valid
	
	page_header($row['name']);	// the title of the page is the user's name; helpful if you open multiple users in different tabs
	
	echo <<<HEREDOC
      <h1>View User</h1>
      

HEREDOC;
	
	
	// Format Data
	$email_verified = 'No';
	if ($row['email_verification'] == '1')
		$email_verified = 'Yes';
		
	$cell = format_phone_number($row['cell']);
	
	$permissions = $row['permissions'];
	$account_type = 'Regular';
	if ($permissions == 'C')
		$account_type = 'Captain';
	else if ($permissions == 'A')
		$account_type = 'Non-Captain Admin';
	else if ($permissions == 'L')
		$account_type = 'Alumnus';
	else if ($permissions == 'T')
		$account_type = 'Temporary';
	
	// mailing list status
	$mailings = 'No';
	if ($row['mailings'] == '1')
		$mailings = 'Yes';
	
	
	// Format Approval Status line
	//
	// depending on whether the user is approved, banned, or in limbo, the link next to that
	// information needs to un-approve, un-ban, or approve/ban the user
	// eg. "Approval Status:     Approved  (to un-approve, click here)"
	if ($row['approved'] == '-1') {
		$approval_status = 'Banned';
		$approval_line = "&nbsp;<span class=\"small\">(<a href=\"Edit_User?Approve&amp;ID={$row['id']}&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=View\">approve</a> | <a href=\"Edit_User?Unapprove&amp;ID={$row['id']}&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=View\">make pending</a>)</span>";
	}
	else if ($row['approved'] == '0') {
		$approval_status = 'Pending';
		$approval_line = "&nbsp;<span class=\"small\">(<a href=\"Edit_User?Approve&amp;ID={$row['id']}&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=View\">approve</a> | <a href=\"Edit_User?Ban&amp;ID={$row['id']}&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=View\">ban</a>)</span>";
	}
	else if ($row['approved'] == '1') {
		$approval_status = 'Approved';
		$approval_line = "&nbsp;<span class=\"small\">(<a href=\"Edit_User?Ban&amp;ID={$row['id']}&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=View\">ban</a>)</span>";
	}
		
	echo <<<HEREDOC
      <table class="spacious">
        <tr>
          <td>Name:</td>
          <td>
            <span class="b">{$row['name']}</span>
            &nbsp;<span class="small">(<a href="Edit_User?Change_Name&amp;ID={$row['id']}&amp;Return=View">change</a>)</span>
          </td>
        </tr><tr>
          <td>Email Address:</td>
          <td class="b"><a href="mailto:{$row['email']}" rel="external">{$row['email']}</a></td>
        </tr><tr>
          <td>Cell Phone Number:&nbsp;</td>
          <td class="b">$cell</td>
        </tr><tr>
          <td>Year of Graduation:</td>
          <td>
            <span class="b">{$row['yog']}</span>
            &nbsp;<span class="small">(<a href="Edit_User?Change_YOG&amp;ID={$row['id']}&amp;Return=View">change</a>)</span>
            <br /><br />
          </td>
        </tr><tr>
          <td>ID:</td>
          <td><span class="b">{$row['id']}</span></td>
        </tr><tr>
          <td>Account Type:</td>
          <td>
            <span class="b">$account_type</span>
            &nbsp;<span class="small">(<a href="Edit_User?Change_Permissions&amp;ID={$row['id']}&amp;Return=View">change</a>)</span>
          </td>
        </tr><tr>
          <td>Mailing List:</td>
          <td><span class="b">$mailings</span></td>
        </tr><tr>
          <td>Approval Status:</td>
          <td>
            <span class="b">$approval_status</span>
            $approval_line
          </td>
        </tr><tr>
          <td>Email Verified:</td>
          <td class="b">$email_verified</td>
        </tr><tr>
          <td>Creation Date:</td>
          <td><span class="b">{$row['formatted_creation']}</span></td>
        </tr><tr>
          <td>Registered From:</td>
          <td class="b">{$row['registration_ip']}</td>
        </tr>
      </table>
      <br />
      <span class="small i">Only users are able to edit their email address and cell phone number.</span>
HEREDOC;
	
	// Show test scores
	$query = 'SELECT test_scores.score AS score, tests.name AS name, tests.total_points AS total, DATE_FORMAT(tests.date, "%M %e, %Y") AS formatted_date, test_scores.score_id AS score_id'
			. ' FROM test_scores'
			. ' INNER JOIN tests ON tests.test_id=test_scores.test_id'
			. ' WHERE test_scores.user_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" AND archived="0"'
			. ' ORDER BY tests.date DESC';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) > 0) {
		echo <<<HEREDOC

      
      <br /><br /><br /><br /><br />
      <h4>Recent Test Scores</h4>
      <table class="contrasting">
        <tr>
          <th>Test</th>
          <th>Score</th>
          <th>Maximum</th>
          <th>Date</th>
          <th></th>
        </tr>

HEREDOC;
		
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			echo <<<HEREDOC
        <tr>
          <td>{$row['name']}</td>
          <td class="text-centered">{$row['score']}</td>
          <td class="text-centered">{$row['total']}</td>
          <td>{$row['formatted_date']}</td>
          <td><a href="Delete_Score?ID={$row['score_id']}&amp;xsrf_token={$_SESSION['xsrf_token']}">Delete</a></td>
        </tr>

HEREDOC;
			$row = mysqli_fetch_assoc($result);
		}
		
		echo <<<HEREDOC
      </table>
HEREDOC;
	}
	
	$query = 'SELECT test_scores.score AS score, tests.name AS name, tests.total_points AS total, DATE_FORMAT(tests.date, "%M %e, %Y") AS formatted_date, test_scores.score_id AS score_id'
			. ' FROM test_scores'
			. ' INNER JOIN tests ON tests.test_id=test_scores.test_id'
			. ' WHERE test_scores.user_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" AND archived="1"'
			. ' ORDER BY tests.date DESC';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) > 0) {
		echo <<<HEREDOC

      
      <br /><br />
      <h4>Old Test Scores</h4>
      <table class="contrasting">
        <tr>
          <th>Test</th>
          <th>Score</th>
          <th>Maximum</th>
          <th>Date</th>
          <th></th>
        </tr>

HEREDOC;
		
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			echo <<<HEREDOC
        <tr>
          <td>{$row['name']}</td>
          <td class="text-centered">{$row['score']}</td>
          <td class="text-centered">{$row['total']}</td>
          <td>{$row['formatted_date']}</td>
          <td><a href="Delete_Score?ID={$row['score_id']}&amp;xsrf_token={$_SESSION['xsrf_token']}">Delete</a></td>
        </tr>

HEREDOC;
			$row = mysqli_fetch_assoc($result);
		}
		
		echo <<<HEREDOC
      </table>
HEREDOC;
	}
}

?>