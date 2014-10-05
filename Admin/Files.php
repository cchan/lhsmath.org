<?php
/*
 * Admin/Files.php
 * LHS Math Club Website
 *
 * Allows Admins to edit the file list and
 * upload new files
 */

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


show_main_page();





function show_main_page() {
	$add_msg = '';
	if (isSet($_SESSION['FILE_category_added'])) {
		$add_msg = "\n        <div class=\"alert\">{$_SESSION['FILE_category_added']}</div><br />\n";
		unset($_SESSION['FILE_category_added']);
	}
	$edit_msg = '';
	if (isSet($_SESSION['FILE_category_edited'])) {
		$edit_msg = "\n        <div class=\"alert\">{$_SESSION['FILE_category_edited']}</div><br />\n";
		unset($_SESSION['FILE_category_edited']);
	}
	$delete_msg = '';
	if (isSet($_SESSION['FILE_category_deleted'])) {
		$delete_msg = "\n        <div class=\"alert\">{$_SESSION['FILE_category_deleted']}</div><br />\n";
		unset($_SESSION['FILE_category_deleted']);
	}
	$f_add_msg = '';
	if (isSet($_SESSION['FILE_added'])) {
		$f_add_msg = "\n        <div class=\"alert\">{$_SESSION['FILE_added']}</div><br />\n";
		unset($_SESSION['FILE_added']);
	}
	$f_edit_msg = '';
	if (isSet($_SESSION['FILE_edited'])) {
		$f_edit_msg = "\n        <div class=\"alert\">{$_SESSION['FILE_edited']}</div><br />\n";
		unset($_SESSION['FILE_edited']);
	}
	$f_delete_msg = '';
	if (isSet($_SESSION['FILE_deleted'])) {
		$f_delete_msg = "\n        <div class=\"alert\">{$_SESSION['FILE_deleted']}</div><br />\n";
		unset($_SESSION['FILE_deleted']);
	}
	
	$total_space = size_readable(dirsize('../.content/uploads'));
	
	page_header('File List');
	echo <<<HEREDOC
      <h1>File List</h1>
      $add_msg$edit_msg$delete_msg$f_add_msg$f_edit_msg$f_delete_msg
      <span class="b">Total Space Used:&nbsp;&nbsp;</span>$total_space
	  
	  <br /> <br />
	  <div style='font-weight:bold'>2010-2013 files have been archived to <a href='https://www.dropbox.com/sh/6wo6f5i8il42m1c/RxpAYq6Pb1'>the Dropbox</a>.</div>
      
      <br /><br />
      <a href="Edit_File_Category?Add">+ Add a Category</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Edit_File?Add">+ Upload a File</a><br />
      <br />

HEREDOC;
	
	
	$query = 'SELECT files.*, file_categories.name AS category_name, file_categories.category_id FROM files'
		. ' RIGHT JOIN file_categories ON files.category=file_categories.category_id '
		. ' WHERE ( files.category <> 2 && files.category <> 5 && files.category <> 8 && files.category <> 9 ) '//temporary
		. ' ORDER BY category_name, category_id, order_num';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	$current_category = -1;
	$has_files = false;
	while ($row) {
		$filename = $row['filename'];
		@$file_size = filesize('../.content/uploads/' . $filename);
		if ($file_size === false)
			$file_size = '?';
		else
			$file_size = size_readable($file_size);
		$visibility = $row['permissions'];
		if ($visibility == 'P')
			$visibility = 'Public';
		else if ($visibility == 'M')
			$visibility = 'Member';
		else
			$visibility = 'Admin';
		
		if ($row['category_id'] != $current_category) {
			if ($current_category != -1) {
				if ($has_files)
					echo "      </table><br /><br />\n";
				else
					echo "        &nbsp;&nbsp;&nbsp;No Files<br /><br />\n";
			}
			$current_category = $row['category_id'];
			$has_files = false;
			echo <<<HEREDOC

      <h4>{$row['category_name']}&nbsp;&nbsp;<span class="small">(<a href="Edit_File_Category?ID={$row['category_id']}">Edit</a>)</span></h4>

HEREDOC;
			if ($filename != '') {
				echo <<<HEREDOC
      <table class="contrasting">
        <tr>
          <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <th>File Name</th>
          <th>Size</th>
          <th>Visibility</th>
          <th></th>
        </tr>

HEREDOC;
			}
		}
		
		if ($filename != '') {
			$up = <<<HEREDOC
            <td class="text-centered"><a href="Edit_File?Up&amp;ID={$row['file_id']}&amp;xsrf_token={$_SESSION['xsrf_token']}" class="nounderline">&uarr;</a></td>

HEREDOC;
			$down = <<<HEREDOC
            <td class="text-centered"><a href="Edit_File?Down&amp;ID={$row['file_id']}&amp;xsrf_token={$_SESSION['xsrf_token']}" class="nounderline">&darr;</a></td>

HEREDOC;
			if (!$has_files)
				$up = '<td></td>';
			$has_files = true;
			$file_id = $row['file_id'];
			$name = $row['name'];
			
			$row = mysqli_fetch_assoc($result);
			if ($row['category'] != $current_category)
				$down = "<td></td>";
			
			echo <<<HEREDOC
        <tr>$up$down
          <td><a href="../Download?ID=$file_id">$name</a></td>
          <td>$file_size</td>
          <td>$visibility</td>
          <td><a href="Edit_File?ID=$file_id">Edit</a></td>
        </tr>

HEREDOC;
		} else
			$row = mysqli_fetch_assoc($result);
	}
	
	if ($current_category != '') {
		if ($has_files)
			echo "      </table><br /><br />\n";
		else
			echo "        &nbsp;&nbsp;&nbsp;No Files<br /><br />\n";
	}
	
	$query = 'SELECT * FROM files WHERE category="0" ORDER BY order_num';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	if (mysqli_num_rows($result) > 0) {
		$first = true;
		echo <<<HEREDOC
      <br /><br />
      <h4>Miscellaneous</h4>
      <table class="contrasting">
        <tr>
          <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <th>File Name</th>
          <th>Size</th>
          <th>Visibility</th>
          <th></th>
        </tr>

HEREDOC;
		while ($row) {
			$up = <<<HEREDOC
            <td class="text-centered"><a href="Edit_File?Up&amp;ID={$row['file_id']}&amp;xsrf_token={$_SESSION['xsrf_token']}" class="nounderline">&uarr;</a></td>

HEREDOC;
			$down = <<<HEREDOC
            <td class="text-centered"><a href="Edit_File?Down&amp;ID={$row['file_id']}&amp;xsrf_token={$_SESSION['xsrf_token']}" class="nounderline">&darr;</a></td>

HEREDOC;
			if ($first)
				$up = '<td></td>';
			$first = false;
			$file_id = $row['file_id'];
			$name = $row['name'];
			$filename = $row['filename'];
			@$file_size = filesize('../.content/uploads/' . $filename);
			if ($file_size === false)
				$file_size = '?';
			else
				$file_size = size_readable($file_size);
			$visibility = $row['permissions'];
			if ($visibility == 'P')
				$visibility = 'Public';
			else if ($visibility == 'M')
				$visibility = 'Member';
			else
				$visibility = 'Admin';
			
			$row = mysqli_fetch_assoc($result);
			if (!$row)
				$down = "<td></td>";
			echo <<<HEREDOC
        <tr>$up$down
          <td><a href="../Download?ID=$file_id">$name</a></td>
          <td>$file_size</td>
          <td>$visibility</td>
          <td><a href="Edit_File?ID=$file_id">Edit</a></td>
        </tr>

HEREDOC;
		}
		echo "      </table>\n";
	}
	
	admin_page_footer('Files');
}

?>