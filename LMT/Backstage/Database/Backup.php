<?php
/*
 * LMT/Backstage/Database/Backup.php
 * LHS Math Club Website
 *
 * Produces a database backup every 15 minutes
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_GET['Download']))
	do_download();
else
	show_page();





function show_page() {
	global $meta_refresh;
	$meta_refresh = '900; URL=Backup';
	lmt_page_header('Backup');
	
	echo <<<HEREDOC
      <h1>Backup</h1>
      
      <div class="text-centered b">
        This page will generate a database backup and refresh every 15 minutes.
      </div>
      
      <iframe src="Backup?Download" style="display: none;">
      </iframe>
HEREDOC;
	lmt_backstage_footer('Backup');
}





function do_download() {
	$backup_name = 'LMT Backup ' . time() . '.sql';
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . $backup_name . '"');
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	ob_clean();
	flush();
	
	global $DB_DATABASE, $LMT_DB_DATABASE;
	mysql_select_db($LMT_DB_DATABASE) or trigger_error(mysql_error(), E_USER_ERROR);
	
	echo 'CREATE DATABASE `lmt-bak` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;' . "\n" .  'USE `lmt-bak`;' . "\n\n\n";
	$tables = array();
	$result = mysql_query('SHOW TABLES');
	while($row = mysql_fetch_row($result))
		$tables[] = $row[0];
	
	foreach($tables as $table) {
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		echo 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		echo "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysql_fetch_row($result))
			{
				echo 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					if (!isset($row[$j]) || is_null($row[$j]))
						echo 'NULL';
					else {
						$row[$j] = addslashes($row[$j]);
						$row[$j] = ereg_replace("\n","\\n",$row[$j]);
						echo '"'.$row[$j].'"' ;
					}
					if ($j<($num_fields-1)) { echo ','; }
				}
				echo ");\n";
			}
		}
		echo "\n\n\n";
	}
}

?>