<?php
/*
 * Files.php
 * LHS Math Club Website
 */


require_once '.lib/functions.php';

show_page();





function show_page() {
	page_header('Files');
	echo <<<HEREDOC
      <h1>Files</h1>
      <br />
	  <div style='font-weight:bold'>2010-2013 files have been archived to <a href='https://www.dropbox.com/sh/6wo6f5i8il42m1c/RxpAYq6Pb1'>the Dropbox</a>.</div>
      <br />

HEREDOC;
	
	
	$admin_sql = '';
	if (user_access('A'))
		$admin_sql = ' OR files.permissions="A"';
	if (isSet($_SESSION['is_captain']))
		$admin_sql .= ' OR files.permissions="C"';
	
	$query = 'SELECT files.file_id, files.name, files.category, file_categories.name AS category_name, files.permissions FROM files'
		. ' INNER JOIN file_categories ON files.category=file_categories.category_id'
		. ' WHERE ( files.permissions="P" OR files.permissions="M"' . $admin_sql . ' ) '
		. ' AND ( files.category <> 2 && files.category <> 5 && files.category <> 8 && files.category <> 9 ) '//temporary
		. ' ORDER BY category_name, category_id, order_num';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	$current_category = -1;
	while ($row) {
		$category_name = $row['category_name'];
		// If this row is the beginning of a new category
		if ($row['category'] != $current_category) {
			if ($current_category != -1)
				echo '      </table><br />' . "\n";
			echo <<<HEREDOC
      <h4 class="smbottom">{$category_name}</h4>
      <table class="contrasting files">

HEREDOC;
			$current_category = $row['category'];
		}
		
		// Normal stuff
		$admin_only_styling = ($row['permissions'] == 'A') ? ' class="i"' : '';
		echo '        <tr><td' . $admin_only_styling . '><a href="Download?ID=' . $row['file_id'] . '">'
			. $row['name'] . '</a></td></tr>' . "\n";
		
		$row = mysqli_fetch_assoc($result);
	}
	
	// Last footer
	if ($current_category != -1)
		echo '      </table>' . "\n";
	
	// Misc. table
	$query = 'SELECT * FROM files WHERE category="0"'
		. ' AND (files.permissions="P" OR files.permissions="M"' . $admin_sql
		. ') ORDER BY order_num';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) > 0) {
		echo <<<HEREDOC
      <h4 class="smbottom">Miscellaneous</h4>
      <table class="contrasting files">

HEREDOC;
		$row = mysqli_fetch_assoc($result);
		while ($row) {
			$admin_only_styling = ($row['permissions'] == 'A') ? ' class="i"' : '';
			echo '        <tr><td' . $admin_only_styling . '><a href="Download?ID=' . $row['file_id'] . '">'
				. $row['name'] . '</a></td></tr>' . "\n";
			$row = mysqli_fetch_assoc($result);
		}
		echo '      </table>' . "\n";
	}
}

?>