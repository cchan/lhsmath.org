<?php
/*
 * Download.php
 * LHS Math Club Website
 *
 * Downloads the specified file
 */


require_once 'lib/functions.php';

cancel_templateify();
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
			. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
		$result = DB::queryRaw($query);
		if (mysqli_num_rows($result) != 1)
			trigger_error('Incorrect number of categories match ID', E_USER_ERROR);
		$row = mysqli_fetch_assoc($result);
		
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
		cancel_templateify();
		ob_clean();
		readfile($file);
		flush();
	}
	else
		trigger_error('File does not exist', E_USER_ERROR);
}

?>