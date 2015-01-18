<?php
/*
 * Admin/Super_Admin.php
 * LHS Math Club Website
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('+');


if (isSet($_POST['do_superadmin_elevate']))
	process_form();
else
	show_page('');





function show_page($err) {
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	page_header('Super-Admin');
	echo <<<HEREDOC
      <h1>Super-Admin</h1>
      
      If you accidentally lose access to all the Admin accounts, create a new account,
      log in as LHSMATH, and make the new account an Admin (you'll need the ID from
      the page that you're supposed to print).<br />
      <br />$err
      <span class="b">Elevate Account</span>
      <form method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>ID:</td>
            <td><input type="text" name="account_id" size="5"/></td>
          </tr><tr>
            <td/>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_superadmin_elevate" value="Elevate"/>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
}





function process_form() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token']) {
		show_page('Huh? ERROR: big kablooie');
		return;
	}
	
	$query = 'SELECT id, name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_POST['account_id']) . '"';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1) {
		show_page('Nonexistent ID');
		return;
	}
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	$name = $row['name'];
	
	// ** FORM VALIDATED AT THIS POINT **
	
	// perform elevation
	$query = 'UPDATE users SET permissions="A", approved="1" WHERE id="' . $id . '" LIMIT 1';
	DB::queryRaw($query);
	
	// show confirmation page
	page_header('Super-Admin');
	echo <<<HEREDOC
      <h1>Super-Admin</h1>
      
      <span class="b">$name</span> was approved and elevated. Now clear the Super-Admin password.
HEREDOC;
	$names[0] = 'Super-Admin';
	$pages[0] = '';
	page_footer($names, $pages);
}