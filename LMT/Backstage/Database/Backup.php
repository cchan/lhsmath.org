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
	
	echo 'CREATE DATABASE `lmt-bak` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;' . "\n" .  'USE `lmt-bak`;' . "\n\n\n";
	$tables = array();
	$result = DB::queryRaw('SHOW TABLES');
	while($row = mysqli_fetch_row($result))
		$tables[] = $row[0];
	
	foreach($tables as $table) {
		$result = DB::queryRaw('SELECT * FROM '.$table);
		$num_fields = mysqli_field_count($result);
		
		echo 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysqli_fetch_row(DB::queryRaw('SHOW CREATE TABLE '.$table));
		echo "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysqli_fetch_row($result))
			{
				echo 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					if (!isset($row[$j]) || is_null($row[$j]))
						echo 'NULL';
					else {
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("\n","\\n",$row[$j]);
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