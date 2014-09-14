<?php
/*
 * LMT/Backstage/Upgrade_Year.php
 * LHS Math Club Website
 *
 * Super-secret page. Upgrades everything across the LMT thing to the next year, doing all necessary archiving.
 */


//Standard stuff.
$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
restrict_access('A');


/*
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
*/
//Just to make sure you're the webmaster. It self-modifies this field, so please don't touch it.
/*UPYEAR_SECRET_CODE_START*/
$upyear_secret_code="6706f22d";
/*UPYEAR_SECRET_CODE_END*/
/*
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  
*/



if(@$_POST['upyear']){
	$good=true;
	
	if(@!$_POST['code']||$_POST['code']==$upyear_secret_code){$good=false;add_alert('upyear','Incorrect code');}
	
	if(@!$_POST['yrfrom']){$good=false;add_alert('upyear','No year-from');}
	if(@!$_POST['yrto']){$good=false;add_alert('upyear','No year-to');}
	
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$nowyr=intval(date('Y'));
	$yrfrom=intval($_POST['yrfrom']);
	if(!$yrfrom||abs($yrfrom-$nowyr)>5){$good=false;add_alert('upyear','Weird year-from');}
	$yrto=intval($_POST['yrto']);
	if(!$yrto||abs($yrto-$nowyr)>5){$good=false;add_alert('upyear','Weird year-to');}
	if($yrfrom>=$yrto){$good=false;add_alert('upyear','Weird year-from/year-to');}
	
	if(map_value('year')!=$yrfrom){$good=false;add_alert('upyear','Error, the year-from doesn\'t match the year in Map (see Status page)');}
	
	if($good){
		insert_archive_page($yrfrom,$yrto);
		archive_lmt_db($_POST['uname'],$_POST['passw'],$yrfrom,$yrto);
		reset_map_data($yrfrom,$yrto);//should be pretty much last
		change_code();//self-modification! Terrible on source control, but fun and securing.
		add_alert('upyear',"Successfully updated year from $yrfrom to $yrto.");
	}
}
show_form();



function show_form(){
	global $path_to_lmt_root;
	lmt_page_header('Upgrade Year');
	echo fetch_alert('upyear').<<<HEREDOC
	<h1>Upgrade Year</h1>
	<p>This page is for upgrading things across the LMT website to reflect the next year's information,
	and archiving the last year's information. If you're not an admin, you <b>should not be here</b>.</p>
	<br>
	Before doing this, you MUST download a <a href='{$path_to_lmt_root}Backstage/Database/Backup.php' target='_blank'>backup</a> of the database. (opens in new window)<br>
	<br>
	<h3>Form</h3>
	<form id='upyearform' autocomplete='off' method="POST" action="Upgrade_Year" onsubmit="return confirm('Are you sure?');" >
		<input type='hidden' name='xsrf_token' value='{$_SESSION['xsrf_token']}'/>
		<table>
			<tr><td>Webmaster Secret Code (see PHP code):<td><input type="password" name="code" />
			<tr><td>PMA Username:<td> <input type="text" name="uname" /><br>
			<tr><td>PMA Password:<td> <input type="password" name="passw" /><br>
			<tr><td>Year upgrading from:<td> <input type="text" name="yrfrom" value="{$_POST['yrfrom']}" length=4/><br>
			<tr><td>Year upgrading to:<td> <input type="text" name="yrto" value="{$_POST['yrto']}" length=4 />
		</table>
		<input type="submit" name="upyear" value="Upgrade Year" />
		<div style='color:#f00'>This is a very complicated operation, and CANNOT be undone. Please be careful that you only run this once, and that you enter the correct inputs.</div>
	</form>
	<b>In addition to this, you also need to...</b>
	<ul>
		<li>Depending whether you have an Archive page right now, you may have to delete the old one (Website)</li>
		<li>Link the flickr album on the archive page (Website)</li>
		<li>Put all problems, solutions, and the full zip file into the LMT Dropbox folder</li>
		<li>Change any necessary general information in <a href="Status" target="_blank">Status</a></li>
	</ul>
HEREDOC;
	lmt_backstage_footer('Upgrade Year');
	die();
}

function insert_archive_page($yrfrom,$yrto){
	//Get the page data
	$dropbox_link='https://www.dropbox.com/sh/6wo6f5i8il42m1c/q8Vv_FHnxM/LMT';
	
	$date=map_value('date');
	
	$content=<<<HEREDOC
<h1>$yrfrom Archive</h1>
<p><strong>Date: </strong>$date</p>
<!--<p><strong>View photos of the event </strong><a href="??" rel="external">on Flickr</a>.</p><br/>-->
<h3>Problems and Solutions</h3>All archived problems and solutions can be found at <a href="$dropbox_link" rel="external">this Dropbox folder</a>.<br/>
HEREDOC;
	
	//Get the exported results
	global $EXPORT_STR;$EXPORT_STR=true;
	require_once 'Export.php';//Supposedly also in Backstage dir
	$content.=show_page();
	$content=mysqli_real_escape_string($GLOBALS['LMT_DB'],$content);
	
	//Insert it
	$order_num=3000-$yrfrom;//specially determined formula for ordering in reverse, yet never overflowing. Not for 900 years.
	lmt_query("INSERT INTO pages (name,content,order_num) VALUES ('$yrfrom Archive','$content','$order_num')");
}


function reset_map_data($yrfrom,$yrto){
	map_set('date','TBD');
	map_set('year',strval($yrto));
	map_set('scoring','0');
	map_set('registration','0');
	map_set('backstage','0');
}

function archive_lmt_db($uname,$passw,$yrfrom,$yrto){
	//Reconnect with the new username/password with more privileges
	global $DB_USERNAME, $DB_PASSWORD;
	$DB_USERNAME_OLD=$DB_USERNAME;
	$DB_PASSWORD_OLD=$DB_PASSWORD;
	$DB_USERNAME=$uname;
	$DB_PASSWORD=$passw;
	connect_to_lmt_database();
	
	//create new db
	//triggers error if already exists
	lmt_query("CREATE DATABASE  `lmt-$yrfrom` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");
	
	//copy db info to new db
	//This can be done dynamically using SHOW TABLES but this is easier.
	$tables=array('guts','individuals','map','pages','schools','teams');
	foreach($tables as $table){
		lmt_query("CREATE TABLE  `lmt-$yrfrom`.`$table` LIKE `lmt`.`$table`");
		lmt_query("INSERT `lmt-$yrfrom`.`$table` SELECT * FROM `lmt`.`$table`");
	}
	
	//truncate necessary fields in original, now-current lmt db.
	$tables_truncate=array('guts','individuals','schools','teams');
	foreach($tables_truncate as $table)
		lmt_query("TRUNCATE TABLE `lmt`.`$table`");
	
	$DB_USERNAME=$DB_USERNAME_OLD;
	$DB_PASSWORD=$DB_PASSWORD_OLD;
	connect_to_lmt_database();
}


function change_code(){
	$contents=file_get_contents(__FILE__);
	file_put_contents('upgrade_year_backup.txt',$contents);//backup
	$com1='/*UPYEAR_SECRET_CODE_START*/';
	$com2='/*UPYEAR_SECRET_CODE_END*/';
	$redef='$upyear_secret_code="'.substr(hash('sha1',uniqid($_SERVER['REMOTE_ADDR'].mt_rand(),true)),0,8).'";';
	
	$pos1=strpos($contents,$com1)+strlen($com1);
	$pos2=strpos($contents,$com2);
	if($pos1===false||$pos2===false||$pos2-$pos1>40)return false;
	
	$contents=substr_replace($contents,"\n".$redef."\n",$pos1,$pos2-$pos1);
	
	file_put_contents(__FILE__,$contents);
}

?>
