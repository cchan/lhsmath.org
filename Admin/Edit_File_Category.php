<?php
/*
 * Admin/Edit_File_Category.php
 * LHS Math Club Website
 */

require_once '../.lib/functions.php';
restrict_access('A');


if (isSet($_POST['do_add_file_category']))
	do_add();
else if (isSet($_POST['do_edit_file_category']))
	do_edit();
else if (isSet($_GET['Delete']))
	do_delete();
else if (isSet($_GET['Add']))
	show_add_page('');
else
	show_edit_page('');





function show_add_page($err) {
	global $body_onload;
	$body_onload = 'document.forms[\'addFileCategory\'].name.focus()';
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$name = htmlentities($_POST['name']);
	
	page_header('Add File Category');
	echo <<<HEREDOC
      <h1>Add a File Category</h1>
      $err
      <form id="addFileCategory" method="post" action="{$_SERVER['REQUEST_URI']}">
      <table class="spacious">
        <tr>
          <td>Category Name:&nbsp;&nbsp;</td>
          <td><input type="text" id="name" name="name" value="$name" size="25" maxlength="100"/></td>
        </tr><tr>
          <td></td>
          <td>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
            <input type="submit" name="do_add_file_category" value="Add"/>
            &nbsp;&nbsp;<a href="Files">Cancel</a>
          </td>
        </tr>
      </table>
      </form>
    </div>
HEREDOC;
}





function do_add() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$name = $_POST['name'];
	if (strlen($name) > 100)
		trigger_error('Add: length of name > 100', E_USER_ERROR);
	
	if ($name == '') {
		show_add_page('Category Name cannot be blank');
		return;
	}
	
	$name = htmlentities($name);
	$query = 'INSERT INTO file_categories (name) VALUES ("' . mysqli_real_escape_string(DB::get(),$name) . '")';
	DB::queryRaw($query);
	
	$_SESSION['FILE_category_added'] = 'The category &quot;' . $name . '&quot; has been added';
	header('Location: Files');
}





function show_edit_page($err) {
	$query = 'SELECT name FROM file_categories WHERE category_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	if (mysqli_num_rows($result) != 1)
		trigger_error('Edit: Incorrect number of categories match ID', E_USER_ERROR);
	$row = mysqli_fetch_assoc($result);
	
	global $body_onload;
	$body_onload = 'document.forms[\'editFileCategory\'].name.focus()';
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	page_header('Edit File Category');
	echo <<<HEREDOC
      <h1>Edit File Category</h1>
      $err
      <form id="editFileCategory" method="post" action="{$_SERVER['REQUEST_URI']}">
      <table class="spacious">
        <tr>
          <td>Category Name:</td>
          <td><input type="text" id="name" name="name" value="{$row['name']}" size="25" maxlength="100"/></td>
        </tr><tr>
          <td></td>
          <td>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
            <input type="submit" name="do_edit_file_category" value="Change"/>
            &nbsp;&nbsp;<a href="Files">Cancel</a><br /><br /><br />
          </td>
        </tr><tr>
          <td>Delete Category:&nbsp;&nbsp;</td>
          <td>
            <a href="Edit_File_Category?Delete&amp;ID={$_GET['ID']}&amp;xsrf_token={$_SESSION['xsrf_token']}" class="b">DELETE</a>
          </td>
        </tr>
      </table>
      </form>
    </div>
HEREDOC;
}





function do_edit() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$name = htmlentities($_POST['name']);
	if (strlen($name) > 100)
		trigger_error('Edit: length of name > 100', E_USER_ERROR);
	
	if ($name == '') {
		show_add_page('Category Name cannot be blank');
		return;
	}
	
	$query = 'UPDATE file_categories SET name="' . mysqli_real_escape_string(DB::get(),$name)
		. '" WHERE category_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	$_SESSION['FILE_category_edited'] = 'The category &quot;' . $name . '&quot; has been edited';
	header('Location: Files');
}





function do_delete() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$query = 'SELECT name FROM file_categories WHERE category_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	if (mysqli_num_rows($result) != 1)
		trigger_error('Delete: Incorrect number of categories match ID', E_USER_ERROR);
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	
	$query = 'UPDATE files SET category="0" WHERE category="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	DB::queryRaw($query);
	
	$query = 'DELETE FROM file_categories WHERE category_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	$_SESSION['FILE_category_deleted'] = 'The category &quot;' . $name . '&quot; has been deleted';
	header('Location: Files');
}

?>