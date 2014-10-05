<?php
/*MessagesContact.php
 * LHS Math Club Website
 *
 * Lists recent messages
 */

$path_to_root = '';
require_once 'lib/functions.php';
restrict_access('RLA');


if (isSet($_POST['do_delete_message']))
	do_delete();
else if (isSet($_GET['View']))
	view_message();
else if (isSet($_GET['Delete']))
	confirm_delete();
else
	show_message_list();





function show_message_list() {
	page_header('Messages');
	
	$delete_msg = '';
	if (isSet($_SESSION['MESSAGE_deleted'])) {
		$delete_msg = "\n        <div class=\"alert\">{$_SESSION['MESSAGE_deleted']}</div><br />\n";
		unset($_SESSION['MESSAGE_deleted']);
	}
	
	echo <<<HEREDOC
      <h1>Messages</h1>
      $delete_msg
      <h4 class="smbottom">Recent Messages</h4><div class="halfbreak"></div>

HEREDOC;
	
	$query = 'SELECT message_id, subject, DATE_FORMAT(post_date, "%a %b %e") AS formatted_post_date'
		. ' FROM messages WHERE post_date >= (NOW() - INTERVAL 7 DAY) ORDER BY post_date DESC';
	print_message_table($query);
	
	echo <<<HEREDOC
      <a name="Old"></a>
      <h4 class="smbottom">Old Messages</h4><div class="halfbreak"></div>

HEREDOC;
	
	$query = 'SELECT message_id, subject, DATE_FORMAT(post_date, "%a %b %e") AS formatted_post_date'
		. ' FROM messages WHERE post_date < (NOW() - INTERVAL 7 DAY) AND post_date >= (NOW() - INTERVAL 2 MONTH) ORDER BY post_date DESC';
	
	if (isSet($_GET['Older']))
		$query = 'SELECT message_id, subject, DATE_FORMAT(post_date, "%a %b %e") AS formatted_post_date'
			. ' FROM messages WHERE post_date < (NOW() - INTERVAL 7 DAY) ORDER BY post_date DESC';
	
	print_message_table($query);
	
	if (isSet($_GET['Older']))
		echo "\n      <br /><br /><a href=\"Messages#Old\">Hide Older Messages</a>";
	else
		echo "\n      <br /><br /><a href=\"Messages?Older#Old\">Show Older Messages</a>";
	
	default_page_footer('Messages');
}





function print_message_table($query) {
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	echo <<<HEREDOC
      <table class="indented contrasting">

HEREDOC;
	
	if (!$row)
		echo <<<HEREDOC
        <tr>
          <td>No Messages</td>
        </tr>
HEREDOC;
	
	while ($row) {
		echo <<<HEREDOC
        <tr>
          <td style="width: 425px;"><a href="Messages?View={$row['message_id']}">{$row['subject']}</a></td>
          <td>{$row['formatted_post_date']}</td>
        </tr>
HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	
	echo '      </table>' . "\n";
}





function view_message() {
	page_header('Messages');
	
	$query = 'SELECT messages.subject, DATE_FORMAT(messages.post_date, "%W, %M %e, %Y at %l:%i %p") AS formatted_post_date,'
		. ' messages.body, users.name FROM messages RIGHT JOIN users ON users.id=messages.author WHERE message_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['View']) . '"';
	$result = DB::queryRaw($query);
	if (mysqli_num_rows($result) != 1)
		trigger_error('Incorrect number of matches for message', E_USER_ERROR);
	$row = mysqli_fetch_assoc($result);
	
	$delete_link = '';
	if (user_access('A'))
		$delete_link = "\n        &nbsp;|&nbsp;&nbsp;<a href=\"Messages?Delete={$_GET['View']}\">DELETE</a>";
	
	echo <<<HEREDOC
      <h1>Messages</h1>
      
      <h3 class="smbottom">{$row['subject']}</h3>
      <span class="i">By: {$row['name']}</span><br />
      {$row['formatted_post_date']}
      <div class="small right">
        <a href="Messages">Return to Message List</a>$delete_link
      </div>
      <div class="halfbreak"></div>
      <hr/><div class="halfbreak"></div>
      {$row['body']}
HEREDOC;
	
	default_page_footer('');
}





function confirm_delete() {
	page_header('Messages');
	
	echo <<<HEREDOC
      <h1>Messages</h1>
      
      <h4>Are you sure that you want to delete this message?</h4>
      <form method="post" action="$request_uri"><div>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_delete_message" value="Delete"/>&nbsp;&nbsp;
        <a href="Messages?View={$_GET['Delete']}">Cancel</a>
      </div></form>
HEREDOC;
	
	default_page_footer('');
}





function do_delete() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$query = 'SELECT subject FROM messages WHERE message_id="' . mysqli_real_escape_string(DB::get(),$_GET['Delete']) . '"';
	$result = DB::queryRaw($query);
	if (mysqli_num_rows($result) != 1)
		trigger_error('Delete: Wrong number of results for ID', E_USER_ERROR);
	$row = mysqli_fetch_assoc($result);
	$subject = $row['subject'];
	
	$query = 'DELETE FROM messages WHERE message_id="' . mysqli_real_escape_string(DB::get(),$_GET['Delete']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	$_SESSION['MESSAGE_deleted'] = 'The message &quot;' . htmlentities($subject) . '&quot; has been deleted';
	
	header('Location: Messages');
}

?>