<?php
/*
 * Download.php
 * LHS Math Club Website
 *
 * Downloads the specified file
 */

$path_to_root = '';
require_once 'lib/functions.php';

do_download();





function do_download() {
	if (isSet($_GET['Backup'])) {
		restrict_access('A');
		
		$time = (int)$_GET['Backup'];
		$code = $_GET['Code'];
		if (!preg_match('#[a-z0-9]{4}#', $code))
			trigger_error('Invalid backup', E_USER_ERROR);
		
		$name = 'db-backup-' . $time . '-' . $code . '.sql';
		$file = './.content/backups/' . $name;
	}
	else {
		$query = 'SELECT filename, permissions FROM files WHERE file_id="'
			. mysql_real_escape_string($_GET['ID']) . '"';
		$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
		if (mysql_num_rows($result) != 1)
			trigger_error('Incorrect number of categories match ID', E_USER_ERROR);
		$row = mysql_fetch_assoc($result);
		
		if ($row['permissions'] == 'P')
			restrict_access('XLRA');
		else if ($row['permissions'] == 'M')
			restrict_access('LRA');
		else	// 'A'
			restrict_access('A');
		
		if ($row['permissions'] == 'C' && !isSet($_SESSION['is_captain'])) {
			page_header('Download');
			echo <<<HEREDOC
      <h1>Access Blocked</h1>
      
      <div>The captains have requested that you not view this file.</div>
HEREDOC;
			go_home_footer();
			die;
		}
		
		$name = $row['filename'];
		$file = './.content/uploads/' . $name;
	}
	
	if (file_exists($file)) {
		$encoding = 'application/octet-stream';
		if (preg_match('#\.pdf$#', $name))
			$encoding = 'application/pdf';
		
		header('Content-Description: File Transfer');
		header('Content-Type: ' . $encoding);
		header('Content-Disposition: inline; filename="' . $name . '"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
	}
	else
		trigger_error('File does not exist', E_USER_ERROR);
}

?>