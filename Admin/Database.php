<?php
/*
 * Admin/Database.php
 * LHS Math Club Website
 *
 * Allows Admins to back up and optimize the database
 */

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');

page_title('Database');


if (isSet($_POST['do_backup']))
	do_backup();
else if (isSet($_POST['do_optimize']))
	do_optimize();
else if (isSet($_POST['do_zip']))
	do_zip();
else if (isSet($_POST['do_verify']))
	do_verify();
else
	show_page('');





function show_page($check_results) {
	global $PHP_MY_ADMIN_LINK, $use_rel_external_script;
	$use_rel_external_script = true;
	
	echo <<<HEREDOC
      <h1>Database</h1>
      <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_optimize" value="Optimize Tables"/>
        <input type="submit" name="do_verify" value="Integrity Check"/>
        <input type="submit" name="do_backup" value="Generate Backup"/>
        <input type="submit" name="do_zip" value="Download All Content"/>
        &nbsp;<a href="{$PHP_MY_ADMIN_LINK}" rel="external">phpMyAdmin</a>
      </div></form>
HEREDOC;
	
	if ($check_results != '')
		echo "\n      \n      <br />" . $check_results;
	
	admin_page_footer('Database');
}





function do_backup() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	// By David Walsh
	$return = 'CREATE DATABASE `lhsmath-bak` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;' . "\n" .  'USE `lhsmath-bak`;' . "\n\n\n";
	$tables = array();
	$result = DB::queryRaw('SHOW TABLES');
	while($row = mysqli_fetch_row($result))
		$tables[] = $row[0];
	
	foreach($tables as $table) {
		$result = DB::queryRaw('SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return .= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysqli_fetch_row(DB::queryRaw('SHOW CREATE TABLE '.$table));
		$return .= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	// LMT, also
	global $DB_DATABASE, $LMT_DB_DATABASE;
	DB::useDB($LMT_DB_DATABASE);
	
	$return .= 'CREATE DATABASE `lmt-bak` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;' . "\n" .  'USE `lmt-bak`;' . "\n\n\n";
	$tables = array();
	$result = DB::queryRaw('SHOW TABLES');
	while($row = mysqli_fetch_row($result))
		$tables[] = $row[0];
	
	foreach($tables as $table) {
		$result = DB::queryRaw('SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return .= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysqli_fetch_row(DB::queryRaw('SHOW CREATE TABLE '.$table));
		$return .= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	DB::useDB($DB_DATABASE);	// switch back database
	
	//save file
	$filename = 'db-backup-' . time() . '-' . generate_code(4) . '.sql';
	file_put_contents($filename,$return);
	
	$order = 1 + DB::queryFirstField('SELECT MAX(order_num) FROM files WHERE category=%i',$category_id);
	$display_name = 'Database Backup: ' . date('Y-m-d');
	
	DB::insert('files',array('name'=>$display_name,'filename'=>$filename,'permissions'=>'A','category'=>'0','order_num'=>$order));
	
	alert('The file &quot;' . $display_name . '&quot; has been added',1);
	header('Location: Database');
}





function do_optimize() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$result = DB::queryRaw('SHOW TABLES') or trigger_error('Cannot get tables', E_USER_ERROR);
 	while($table = mysqli_fetch_row($result))
		DB::queryRaw('OPTIMIZE TABLE ' . $table[0]) or trigger_error('Cannot optimize ' . $table[0], E_USER_ERROR);
	
	alert('The database has been optimized',1);
	location('Database');
}





function do_zip() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$zip = new ZipArchive();
	
	$filepath = '../.content/tmp/Content-Backup-' . generate_code(10) . '-' . date('Y-m-d_His') . '.zip';
	if ($zip->open($filepath, ZIPARCHIVE::CREATE) !== TRUE)
		trigger_error('Cannot open Zip', E_USER_ERROR);
	add_dir_to_zip($zip, '../.content/');
	$zip->close();
	
	download($filepath);
}




function add_dir_to_zip($zip, $dir_path) {
	$print_dir = preg_replace('#\.\.\/\.content[\/]*#', '', $dir_path);
	if ($print_dir != '')
		$print_dir .= '/';
	
	if ($print_dir == 'tmp/')
		return;
	
	$zip->addEmptyDir($print_dir);
	$nodes = glob($dir_path . '/*');
	foreach ($nodes as $node) {
		if (is_dir($node))
			add_dir_to_zip($zip, $node);
		else if (is_file($node))
			$zip->addFile($node, $print_dir . pathinfo($node, PATHINFO_BASENAME));
	}
}





function do_verify() {
	$output = '';
	
	// All users have a valid name
	$new_output = '';
	$query = 'SELECT name FROM users WHERE name NOT REGEXP "^[A-Za-z ]{6,25}$"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . '&quot; does not have a valid name</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have a valid name</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Check for duplicate emails
	$new_output = '';
	$query = 'SELECT email FROM users GROUP BY email HAVING COUNT(*) > 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		if ($row['email'] != '')
			$new_output .= '      <span style="color: #a00;">Duplicate email: &lt;' . htmlentities($row['email']) . '&gt;</span><br />' . "\n";
			$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">No duplicate email addresses</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All users have an email address
	$new_output = '';
	$query = 'SELECT name FROM users WHERE email="" AND permissions!="T"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . '&quot; does not have an email address</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have email addresses</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All users have a password
	$new_output = '';
	$query = 'SELECT name FROM users WHERE passhash NOT REGEXP "^[0-9a-fA-F]{128}$" AND permissions!="T"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . '&quot; does not have a valid password hash</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have valid password hashes</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All users have valid cell phone information
	$new_output = '';
	$query = 'SELECT name FROM users WHERE cell NOT REGEXP "^[0-9]{10}$" AND cell!="None" AND permissions!="T"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . '&quot; has invalid cell phone information</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have valid cell phone information</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All users have a valid YOG
	$new_output = '';
	$query = 'SELECT name FROM users WHERE yog NOT REGEXP "^[0-9]{4}$" AND permissions!="T"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . '&quot; has an invalid YOG</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have a valid YOG</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All users have valid permissions
	$new_output = '';
	$query = 'SELECT name FROM users WHERE permissions!="C" AND permissions!="A" AND permissions!="R" AND permissions!="L" AND permissions!="T"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . '&quot; has an invalid permission state</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have valid permission states</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All users have valid approval states
	$new_output = '';
	$query = 'SELECT name FROM users WHERE approved!="1" AND approved!="0" AND approved!="-1"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . '&quot; has an invalid approval state</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have valid approval states</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All users have a valid email verification status
	$new_output = '';
	$query = 'SELECT name FROM users WHERE email_verification NOT REGEXP "^[0-9a-fA-F]{5}$" AND email_verification!="1" AND permissions!="T"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . '&quot; has an invalid email verification state</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have valid email verification states</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All users have a valid password reset status
	$new_output = '';
	$query = 'SELECT name FROM users WHERE password_reset_code NOT REGEXP "^[0-9a-fA-F]{5}$" AND password_reset_code!="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">User &quot;' . htmlentities($row['name']) . 'quot; has an invalid password reset state</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All users have valid password reset states</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All test scores match a test
	$new_output = '';
	$query = 'SELECT score_id FROM test_scores WHERE NOT EXISTS (SELECT * FROM tests WHERE tests.test_id = test_scores.test_id)';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Score entry #' . htmlentities($row['score_id']) . ' is not associated with a real test</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All score entries are associated with a real test</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All test scores match a user
	$new_output = '';
	$query = 'SELECT score_id FROM test_scores WHERE NOT EXISTS (SELECT * FROM users WHERE users.id = test_scores.user_id)';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Score entry #' . htmlentities($row['score_id']) . ' is not associated with a real user</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All score entries are associated with a real user</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All test scores are under the maximum
	$new_output = '';
	$query = 'SELECT score_id FROM test_scores WHERE score < 0 OR EXISTS (SELECT * FROM tests WHERE tests.test_id = test_scores.test_id AND test_scores.score > tests.total_points)';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Score entry #' . htmlentities($row['score_id']) . ' has an invalid score</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All score entries have valid scores</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// No file_category ID 0
	$query = 'SELECT * FROM file_categories WHERE category_id="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	if ($row)
		$output .= '<span style="color: #a00;">The file category &quot;' .$row['name'] . '&quot; has an ID of 0</span><br />' . "\n" . '      <br />' . "\n";
	else
		$output .= '<span style="color: #0a0;">No file categories have an ID of 0</span><br />' . "\n" . '      <br />' . "\n";
	
	// All files have a valid category
	$new_output = '';
	$query = 'SELECT name FROM files WHERE category!="0" AND NOT EXISTS (SELECT * FROM file_categories WHERE file_categories.category_id = files.category)';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">The file &quot;' . $row['name'] . '&quot; is not in a real category</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All files are in real categories</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All files have valid permissions
	$new_output = '';
	$query = 'SELECT name FROM files WHERE permissions!="A" AND permissions!="M" AND permissions!="P"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">The file &quot;' . $row['name'] . '&quot; has an invalid permission state</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All files have valid permission states</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All files exist on disk
	$new_output = '';
	$query = 'SELECT name, filename FROM files';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		if (!file_exists('../.content/uploads/' . $row['filename']))
			$new_output .= '      <span style="color: #a00;">The file &quot;' . $row['name'] . '&quot; [' . htmlentities($row['filename']) .'] does not exist on disk</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All files exist on disk</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// No duplicate orders
	$new_output = '';
	$query = 'SELECT name FROM file_categories WHERE EXISTS (SELECT * FROM files WHERE files.category=file_categories.category_id GROUP BY order_num HAVING COUNT(*) > 1)';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">The file category &quot;' . $row['name'] . '&quot; has multiple files with the same order number</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	$query = 'SELECT * FROM files WHERE files.category="0" GROUP BY order_num HAVING COUNT(*) > 1';
	$result = DB::queryRaw($query);
	if (mysqli_num_rows($result) == 1)
		$new_output .= '      <span style="color: #a00;">The file category &quot;Miscellaneous&quot; has multiple files with the same order number</span><br />' . "\n";
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All files have valid order numbers</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	$output .= '      <a href="Database" class="small">[Clear]</a>';
	
	show_page($output);
}

?>