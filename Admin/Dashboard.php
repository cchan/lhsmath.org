<?php
/*
 * Admin/Dashboard.php
 * LHS Math Club Website
 *
 * The front page of the Admin control panel
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


show_page();





function show_page() {
	page_header('Admin Dashboard');
	
	// Fetch Data
	$query = 'SELECT COUNT(*) FROM users WHERE approved="1"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_members = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM users WHERE permissions="C"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_captains = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM users WHERE permissions="A"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_assistants = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM users WHERE permissions="L"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_alumni = $row['COUNT(*)'];
	

	$query = 'SELECT COUNT(*) FROM users WHERE approved="0"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_pending_approval  = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM users WHERE approved="-1"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_banned = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM tests WHERE archived="0"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_tests = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM tests WHERE archived="1"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_old_tests = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM events WHERE date >= "' . date('Y') . '-' . date('m')
		. '-1" AND date <= "' . date('Y') . '-' . date('m') . date('t') . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_current_events = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM events WHERE date < "' . date('Y') . '-' . date('m') . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_past_events = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM events WHERE date > "' . date('Y') . '-' . date('m') . date('t') . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_future_events = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM files WHERE permissions="M"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_member_files = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM files WHERE permissions="P"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_public_files = $row['COUNT(*)'];
	
	$query = 'SELECT COUNT(*) FROM files WHERE permissions="A"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$num_admin_files = $row['COUNT(*)'];
	
	echo <<<HEREDOC
      <h1>Admin Dashboard</h1>
      
      <table cellspacing="10px">
        <tr>
          <td style="width: 25%">
            <h4>Accounts</h4>
            <ul>
              <li><span class="b">$num_members</span> members</li>
              <li><span class="b">$num_captains</span> captains</li>
              <li><span class="b">$num_assistants</span> other admins</li>
              <li><span class="b">$num_alumni</span> alumni<br /><br /></li>
              
              <li><span class="b">$num_pending_approval</span> users pending approval</li>
              <li><span class="b">$num_banned</span> banned users</li>
            </ul>
          </td>
          <td style="width: 25%">
            <h4>Tests</h4>
            <ul>
              <li><span class="b">$num_tests</span> current tests</li>
              <li><span class="b">$num_old_tests</span> archived tests</li>
            </ul>
          </td>
          <td style="width: 25%">
            <h4>Calendar</h4>
            <ul>
              <li><span class="b">$num_current_events</span> events this month</li>
              <li><span class="b">$num_past_events</span> past events</li>
              <li><span class="b">$num_future_events</span> future events</li>
            </ul>
          </td>
          <td style="width: 25%">
            <h4>Files</h4>
            <ul>
              <li><span class="b">$num_member_files</span> member files</li>
              <li><span class="b">$num_public_files</span> public files</li>
              <li><span class="b">$num_admin_files</span> admin files</li>
            </ul>
          </td>
        </tr>
      </table>
HEREDOC;
	admin_page_footer('Admin Dashboard');
}

?>