<?php
/*
 * LMT/Backstage/Post_LMT.php
 * LHS Math Club Website
 *
 * Super-secret page. Upgrades everything across the LMT thing to the next year, doing all necessary archiving.
 * Specifically:
 *   - Generate and post an archive page called {year}_Archive [based on the date currently in Status]
 *   - Move the LMT database to LMT_{year} and create a new empty LMT database
 *   - Reset status info
 */


//Standard stuff.
require_once '../../.lib/lmt-functions.php';
restrict_access('A');

$upyear_secret_code = 'hellofromLMT';

if(@$_POST['upyear']){
	$good=true;
	
	if(@!$_POST['code']||$_POST['code']!=$upyear_secret_code){$good=false;alert('Incorrect code',-1);}
	
	if(@!$_POST['yrfrom']){$good=false;alert('No year-from',-1);}
	if(@!$_POST['yrto']){$good=false;alert('No year-to',-1);}
	
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$nowyr=intval(date('Y'));
	$yrfrom=intval($_POST['yrfrom']);
	if(!$yrfrom||abs($yrfrom-$nowyr)>5){$good=false;alert('Weird year-from',-1);}
	$yrto=intval($_POST['yrto']);
	if(!$yrto||abs($yrto-$nowyr)>5){$good=false;alert('Weird year-to',-1);}
	if($yrfrom>=$yrto){$good=false;alert('Weird year-from/year-to',-1);}
	
	if(map_value('year')!=$yrfrom){$good=false;alert('The year-from doesn\'t match the year currently listed in Map (see Status page)',-1);}
	
	if($good){
		global $show_debug_backtrace;$show_debug_backtrace=true;
		insert_archive_page($yrfrom,$yrto);
		archive_lmt_db($_POST['uname'],$_POST['passw'],$yrfrom,$yrto);
		reset_map_data($yrfrom,$yrto);//should be pretty much last
		alert("Successfully upgraded year from $yrfrom to $yrto.",1);
	}
}
show_form();



function show_form(){
	lmt_page_header('Post-LMT');
?>
	<h1>Post-LMT</h1>
	<p>This page is for upgrading things across the LMT website to reflect the next year's information,
	and archiving the last year's information. If you're not an admin, you <b>should not be here</b>.</p>
	<br>
	<b>Before doing this:</b>
  <ul>
    <li style="color:red">You MUST download a <a href='<?=URL::lmt()?>/Backstage/Database/Backup.php' target='_blank'>backup</a> of the database and upload it to the Dropbox.</li>
    <li>On <a href="<?=URL::lmt()?>/Backstage/Status" target='_blank'>Status</a>, make sure scoring is frozen, registration is closed, and backstage is closed to regular members.</li>
  </ul>
	<br>
	<h3>Form</h3>
	<form id='upyearform' autocomplete='off' method="POST" onsubmit="return confirm('Are you sure?');" >
		<input type='hidden' name='xsrf_token' value='<?=$_SESSION['xsrf_token']?>'/>
		<table>
			<tr><td>Webmaster Secret Code (see PHP code):<td><input type="password" name="code" />
			<tr><td>PMA Username:<td> <input type="text" name="uname" /><br>
			<tr><td>PMA Password:<td> <input type="password" name="passw" /><br>
			<tr><td>Year upgrading from:<td> <input type="text" name="yrfrom" value="" length=4/><br>
			<tr><td>Year upgrading to:<td> <input type="text" name="yrto" value="" length=4 />
		</table>
		<input type="submit" name="upyear" value="Upgrade Year" />
		<div style='color:#f00'>This is a very complicated operation, and CANNOT be undone. Please be careful that you only run this once, and that you enter the correct inputs.</div>
	</form>
	<b>After this, you also need to...</b>
	<ul>
		<li>Change any necessary general information in <a href="Status" target="_blank">Status</a></li>
    <br>
		<li>Depending whether you have already manually created an Archive page, you may have to delete the old one (<a href="<?=URL::lmt()?>/Backstage/Pages/List" target='_blank'>Website</a>)</li>
		<li>Verify that the archive page has the right stuff (e.g. if you broke any ties manually, they will not be shown accurately), and add a "Stats" section (getting accurate participant counts is difficult, so ask the webmaster).</li>
		<li>Link the flickr album on the archive page (<a href="<?=URL::lmt()?>/Backstage/Pages/List" target='_blank'>Website</a>)</li>
		<li>Put all problems, solutions, and the full zip file into the LMT Dropbox folder</li>
    <br>
    <li>Send the mass "Thanks for coming to LMT!" email</li>
    <li><a href="<?=URL::lmt()?>/Backstage/Results/Email" target='_blank'>Send individual results emails</a></li>
	</ul>
<?php
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
	
	//Insert it
	$order_num=3000-$yrfrom;//specially determined formula for ordering in reverse, yet never overflowing. Not for 900 years.
	DB::insert('pages',array('name'=>"$yrfrom Archive",'content'=>$content,'order_num'=>$order_num));
}


function reset_map_data($yrfrom,$yrto){
	map_set('date','TBD');
	map_set('year',strval($yrto));
	map_set('scoring','0');
	map_set('registration','0');
	map_set('backstage','0');
}

function archive_lmt_db($uname,$passw,$yrfrom,$yrto){
	$yrfrom = intval($yrfrom);
	$yrto = intval($yrto);
	
	//Reconnect with the new username/password with more privileges
	$adminDB = new MeekroDB(NULL,$uname,$passw);
	
	//create new db
	//probably triggers error if already exists
	$adminDB->query("CREATE DATABASE  `lmt-$yrfrom` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");
	$adminDB->useDB('lmt-'.$yrfrom);
	
	//copy db info to new db
	//This can be done dynamically using SHOW TABLES but this is easier.
	$tables=array('guts','individuals','map','pages','schools','teams');
	foreach($tables as $table){
		$adminDB->query("CREATE TABLE  `lmt-$yrfrom`.`$table` LIKE `lmt`.`$table`");
		$adminDB->query("INSERT `lmt-$yrfrom`.`$table` SELECT * FROM `lmt`.`$table`");
	}
	
	//truncate necessary fields in LMT db, since it's already archived.
	$tables_truncate=array('guts','individuals','schools','teams');
	foreach($tables_truncate as $table)
		$adminDB->query("TRUNCATE TABLE `lmt`.`$table`");
}

?>
