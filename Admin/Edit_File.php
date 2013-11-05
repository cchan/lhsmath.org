<?php
/*
 * Admin/Edit_File.php
 * LHS Math Club Website
 */

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');

if (isSet($_GET['Delete']))
	do_delete();
else if (isSet($_POST['do_add_file']))
	do_add();
else if (isSet($_POST['do_edit_file']))
	do_edit();
else if (isSet($_GET['Add']))
	show_add_page('');
else if (isSet($_GET['Up']))
	do_up();
else if (isSet($_GET['Down']))
	do_down();
else
	show_edit_page('');





function show_add_page($err) {
	global $body_onload;
	$body_onload = 'document.forms[\'addFile\'].name.focus()';
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$category_list = '';
	$query = 'SELECT * FROM file_categories ORDER BY name';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	while ($row) {
		$selected = '';
		$category_list .= "\n              <option value=\"{$row['category_id']}\"$selected>{$row['name']}</option>";
		$row = mysql_fetch_assoc($result);
	}
	
	page_header('Upload File');
	echo <<<HEREDOC
      <h1>Upload a File</h1>
      $err
      <form id="addFile" method="post" action="{$_SERVER['REQUEST_URI']}" enctype="multipart/form-data">
      <table class="spacious">
        <tr>
          <td>Display Name:&nbsp;&nbsp;</td>
          <td><input type="text" id="name" name="name" value="$name" size="25" maxlength="100"/></td>
        </tr><tr>
          <td>File:</td>
          <td>
            <input type="hidden" name="MAX_FILE_SIZE" value="8388608"/>
            <input type="file" name="upload" size="25"/><br />
            <span class="small">Maximum size: 5 MB</span>
          </td>
        </tr><tr>
          <td>Visibility:</td>
          <td>
            <select name="visibility">
              <option value="P">Public</option>
              <option value="M" selected="selected">Member</option>
              <option value="A">Administrator</option>
            </select>
          </td>
        </tr><tr>
          <td>Category:</td>
          <td>
            <select name="category">$category_list
              <option value="0"$ selected="selected">Miscellaneous</option>
            </select>
          </td>
        </tr><tr>
          <td></td>
          <td>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
            <input type="submit" name="do_add_file" value="Upload"/>
            &nbsp;&nbsp;<a href="Files">Cancel</a><br /><br /><br />
          </td>
        </tr>
      </table>
      </form>
    </div>
HEREDOC;
	admin_page_footer('');
}





function do_add() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$display_name = htmlentities($_POST['name']);
	if (strlen($display_name) > 100)
		trigger_error('Add: name > 100 characters', E_USER_ERROR);
	if ($display_name == '') {
		show_add_page('Display Name cannot be blank');
		return;
	}
	
	$visibility = $_POST['visibility'];
	if ($visibility != 'P' && $visibility != 'M' && $visibility != 'A')
		trigger_error('Add visibility not P, M or A', E_USER_ERROR);
	
	$category_id = htmlentities($_POST['category']);
	if ($category_id != '0') {
		$query = 'SELECT * FROM file_categories WHERE category_id="' . mysql_real_escape_string($category_id) . '"';
		$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
		if (mysql_num_rows($result) != 1)
			trigger_error('Add: Incorrect number of files match submitted ID', E_USER_ERROR);
	}
	
	if (!$_FILES['upload']['name']) {
		show_add_page('Please select a file to upload');
		return;
	}
	
	if ($_FILES['upload']['error'] != UPLOAD_ERR_OK) {
		show_add_page('An error occurred while uploading your file');
		return;
	}
	
	// Process File
	$filename = $_FILES['upload']['name'];
	$did_rename_file = false;
	if (file_exists('../.content/uploads/' . $filename)) {
		$path_info = pathinfo($filename);
		$filename = $path_info['filename'] . '-' . generate_code(4) . '.' . $path_info['extension'];
		$did_rename_file = true;
		if (file_exists('../.content/uploads/' . $filename)) {
			show_add_page('An error occurred while processing your file. Please try again.');
			return;
		}
	}
	
	if (!move_uploaded_file($_FILES['upload']['tmp_name'], '../.content/uploads/' . $filename)) {
		show_add_page('An error occurred while processing your file');
		return;
	}
	
	// VALIDATION COMPLETE
	
	$query = 'SELECT MAX(order_num) FROM files WHERE category="' . mysql_real_escape_string($category_id) . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$order = $row['MAX(order_num)'] + 1;
	
	$query = 'INSERT INTO files (name, filename, permissions, category, order_num) VALUES ("'
		. mysql_real_escape_string($display_name)
		. '", "' . mysql_real_escape_string($filename)
		. '", "' . mysql_real_escape_string($visibility)
		. '", "' . mysql_real_escape_string($category_id)
		. '", "' . mysql_real_escape_string($order) . '")';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	$_SESSION['FILE_added'] = 'The file &quot;' . $display_name . '&quot; has been added';
	if ($did_rename_file)
		$_SESSION['FILE_added'] .= '. Since a file with the same file name already exists, this one has been renamed to &quot;' . htmlentities($filename) . '&quot;.';
	header('Location: Files');
}





function show_edit_page($err) {
	$query = 'SELECT * FROM files WHERE file_id="' . mysql_real_escape_string($_GET['ID']) . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	if (mysql_num_rows($result) != 1)
		trigger_error('Edit: Incorrect number of categories match ID', E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	
	global $body_onload;
	$body_onload = 'document.forms[\'editFile\'].name.focus()';
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$name = $row['name'];
	if (isSet($_POST['name']))
		$name = htmlentities($_POST['name']);
	$filename = htmlentities($row['filename']);
	$visibility = $row['permissions'];
	if (isSet($_POST['visibility']))
		$visibility = $_POST['visibility'];
	$v_public_selected = '';
	$v_member_selected = '';
	$v_administrator_selected = '';
	if ($visibility == 'P')
		$v_public_selected = ' selected="selected"';
	else if ($visibility == 'M')
		$v_member_selected = ' selected="selected"';
	else if ($visibility == 'A')
		$v_administrator_selected = ' selected="selected"';
	$category_selected = $row['category'];
	if (isSet($_POST['category']))
		$category_selected = $_POST['category'];
	
	$category_list = '';
	$query = 'SELECT * FROM file_categories ORDER BY name';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	while ($row) {
		$selected = '';
		if ($row['category_id'] == $category_selected)
			$selected = ' selected="selected"';
		$category_list .= "\n              <option value=\"{$row['category_id']}\"$selected>{$row['name']}</option>";
		$row = mysql_fetch_assoc($result);
	}
	$misc_selected = '';
	if ($category_selected == '0')
		$misc_selected = ' selected="selected"';
	
	page_header('Edit File');
	echo <<<HEREDOC
      <h1>Edit File</h1>
      $err
      <form id="editFile" method="post" action="{$_SERVER['REQUEST_URI']}">
      <table class="spacious">
        <tr>
          <td>Display Name:&nbsp;&nbsp;</td>
          <td><input type="text" id="name" name="name" value="$name" size="25" maxlength="100"/></td>
        </tr><tr>
          <td>File:</td>
          <td class="b">$filename</td>
        </tr><tr>
          <td>Visibility:</td>
          <td>
            <select name="visibility">
              <option value="P"$v_public_selected>Public</option>
              <option value="M"$v_member_selected>Member</option>
              <option value="A"$v_administrator_selected>Administrator</option>
            </select>
          </td>
        </tr><tr>
          <td>Category:</td>
          <td>
            <select name="category">$category_list
              <option value="0"$misc_selected>Miscellaneous</option>
            </select>
          </td>
        </tr><tr>
          <td></td>
          <td>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
            <input type="submit" name="do_edit_file" value="Change"/>
            &nbsp;&nbsp;<a href="Files">Cancel</a><br /><br /><br />
          </td>
        </tr><tr>
          <td>Delete File:&nbsp;&nbsp;</td>
          <td>
            <a href="Edit_File?Delete&amp;ID={$_GET['ID']}&amp;xsrf_token={$_SESSION['xsrf_token']}" class="b">DELETE</a>
          </td>
        </tr>
      </table>
      </form>
    </div>
HEREDOC;
	admin_page_footer('');
}





function do_edit() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$display_name = htmlentities($_POST['name']);
	if (strlen($display_name) > 100)
		trigger_error('Edit: name > 100 characters', E_USER_ERROR);
	if ($display_name == '') {
		show_edit_page('Display Name cannot be blank');
		return;
	}
	
	$visibility = $_POST['visibility'];
	if ($visibility != 'P' && $visibility != 'M' && $visibility != 'A')
		trigger_error('Edit: visibility not P, M or A', E_USER_ERROR);
	
	$category_id = htmlentities($_POST['category']);
	if ($category_id != '0') {
		$query = 'SELECT * FROM file_categories WHERE category_id="' . mysql_real_escape_string($category_id) . '"';
		$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
		if (mysql_num_rows($result) != 1)
			trigger_error('Edit: Incorrect number of categories match submitted ID', E_USER_ERROR);
	}
	
	$query = 'SELECT category, order_num FROM files WHERE file_id="' . mysql_real_escape_string($_GET['ID']) . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	if (!$row)
		trigger_error('Edit: file not found', E_USER_ERROR);
	
	$old_category = $row['category'];
	$order = $row['order_num'];
	if ($old_category != $category_id) {
		$query = 'SELECT MAX(order_num) FROM files WHERE category="' . mysql_real_escape_string($category_id) . '"';
		$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
		$row = mysql_fetch_assoc($result);
		$order = $row['MAX(order_num)'] + 1;
	}
	
	// VALIDATION COMPLETE
	
	$query = 'UPDATE files SET name="' . mysql_real_escape_string($display_name)
		. '", permissions="' . mysql_real_escape_string($visibility)
		. '", category="' . mysql_real_escape_string($category_id)
		. '", order_num="' . mysql_real_escape_string($order)
		. '" WHERE file_id="' . mysql_real_escape_string($_GET['ID']) . '" LIMIT 1';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	$_SESSION['FILE_edited'] = 'The file &quot;' . $display_name . '&quot; has been edited';
	header('Location: Files');
}





function do_delete() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$query = 'SELECT name, filename FROM files WHERE file_id="' . mysql_real_escape_string($_GET['ID']) . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	if (mysql_num_rows($result) != 1)
		trigger_error('Delete: Incorrect number of files match ID', E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$name = $row['name'];
	
	$query = 'DELETE FROM files WHERE file_id="' . mysql_real_escape_string($_GET['ID']) . '" LIMIT 1';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	unlink('../.content/uploads/' . $row['filename']);
	
	$_SESSION['FILE_deleted'] = 'The file &quot;' . $name . '&quot; has been deleted';
	header('Location: Files');
}





function do_up() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$query = 'SELECT name, category, order_num FROM files WHERE file_id="' . mysql_real_escape_string($_GET['ID']) . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	if (mysql_num_rows($result) != 1)
		trigger_error('Up: Incorrect number of files match ID', E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$category = $row['category'];
	$order = $row['order_num'];
	
	$query = 'SELECT file_id, order_num FROM files WHERE category="'
		. $category . '" AND order_num < ' . $order . ' ORDER BY order_num DESC LIMIT 1';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	
	if (!$row) {	// no files above this one
		header('Location: Files');
		return;
	}
	
	$other_id = $row['file_id'];
	$new_order = (int)$order - 1;
	$query = 'UPDATE files SET order_num="' . $new_order . '" WHERE file_id="'
		. mysql_real_escape_string($_GET['ID']) . '" LIMIT 1';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$query = 'UPDATE files SET order_num="' . $order . '" WHERE file_id="'
		. $other_id . '" LIMIT 1';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	header('Location: Files');
}





function do_down() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$query = 'SELECT name, category, order_num FROM files WHERE file_id="' . mysql_real_escape_string($_GET['ID']) . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	if (mysql_num_rows($result) != 1)
		trigger_error('Down: Incorrect number of files match ID', E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	$category = $row['category'];
	$order = $row['order_num'];
	
	$query = 'SELECT file_id, order_num FROM files WHERE category="'
		. $category . '" AND order_num > ' . $order . ' ORDER BY order_num ASC LIMIT 1';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$row = mysql_fetch_assoc($result);
	
	if (!$row) {	// no files above this one
		header('Location: Files');
		return;
	}
	
	$other_id = $row['file_id'];
	$new_order = (int)$order + 1;
	$query = 'UPDATE files SET order_num="' . $new_order . '" WHERE file_id="'
		. mysql_real_escape_string($_GET['ID']) . '" LIMIT 1';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	$query = 'UPDATE files SET order_num="' . $order . '" WHERE file_id="'
		. $other_id . '" LIMIT 1';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	header('Location: Files');
}

?>