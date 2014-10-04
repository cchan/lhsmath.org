<?php
/*
 * LMT/Backstage/Pages/Edit.php
 * LHS Math Club Website
 *
 * ID: the ID of the page to edit
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
restrict_access('A');

if (isSet($_POST['lmt_do_edit_page']))
	do_edit_page();
else
	show_form('');





function show_form($err) {
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	lmt_page_header('Edit Page');
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$name = htmlentities($_POST['name']);
	$content = htmlentities($_POST['content']);
	
	// Fetch data if this is the first time the form has been shown
	if ($name == '' || $content == '') {
		$row = DB::queryFirstRow('SELECT name, content FROM pages WHERE page_id="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"');
		
		if ($name == '')
			$name = htmlentities($row['name']);
		if ($content == '')
			$content = htmlentities($row['content']);
	}
	
	echo <<<HEREDOC
      <h1>Edit Page</h1>
      $err
      <form id="lmtAddPage" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table class="spacious">
          <tr>
            <td>Title:</td>
            <td><input type="text" name="name" value="$name" size="25" maxlength="25" /></td>
          </tr><tr>
            <td>Content:&nbsp;</td>
            <td>
              <textarea name="content" rows="25" cols="80" class="code">$content</textarea>
              <div class="small">Please write XHTML-compliant code.<br />
              Links marked with rel=&quot;external&quot; open in a new window. Links are relative to /LMT.</div><br />
            </td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmt_do_edit_page" value="Save Changes" />
              &nbsp;&nbsp;<a href="List">Cancel</a><br /><br /><br />
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	lmt_backstage_footer('');
	die;
}





function do_edit_page() {
	if ((int)$_GET['ID'] == -1)
		trigger_error('Cannot edit Registration page', E_USER_ERROR);
	
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$name = $_POST['name'];
	$content = $_POST['content'];
	
	if ($name == '')
		show_form('Please choose a name for the page');
	
	if (strlen($name) > 25)
		show_form('The page name may not be longer than 25 characters');
	
	str_replace($content,"{INDIVCOST}",map_value());
	
	if (strlen($content) > 20000)
		show_form('The content may not be longer than 20,000 characters');
	
	// ** VALIDATION COMPLETE ** \\
	
	DB::queryRaw('UPDATE pages SET name="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$name)
		. '", content="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$content)
		. '" WHERE page_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	
	header('Location: View?ID=' . $_GET['ID']);
}

?>