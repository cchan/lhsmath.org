<?php
/*
 * Admin/Dashboard.php
 * LHS Math Club Website
 *
 * The front page of the Admin control panel - lots of administrative information.
 */

require_once '../.lib/functions.php';
restrict_access('A');

if(isSet($_REQUEST['do_download_errors'])){
	download(PATH::errfile());
	die;
}
if(isSet($_REQUEST['do_clear_errors'])){
	download(PATH::errfile());
	file_put_contents(PATH::errfile(),'');
	die;
}

page_title('Admin Dashboard');

//Fetch data


//Accounts
$num_members = DBExt::queryCount('users','approved="1"');
$num_captains = DBExt::queryCount('users','permissions="C"');
$num_other_admins = DBExt::queryCount('users','permissions="A"');
$num_alumni = DBExt::queryCount('users','permissions="L"');
$num_pending_approval  = DBExt::queryCount('users','approved="0"');//aka permissions == 'E' or 'P'
$num_banned = DBExt::queryCount('users','approved="-1"');//aka permissions == 'B'

//Tests
$num_tests = DBExt::queryCount('tests','archived="0"');
$num_old_tests = DBExt::queryCount('tests','archived="1"');

//Calendar
//Anything from 3 days ago to 7 days ahead is considered "current".
$num_past_events = DBExt::queryCount('events',DBExt::timeInInterval('date','','-3d'));
$num_future_events = DBExt::queryCount('events',DBExt::timeInInterval('date','+7d',''));
$num_current_events = DBExt::queryCount('events',DBExt::timeInInterval('date','-3d','+7d'));

//Files
$num_member_files = DBExt::queryCount('files','permissions="M"');
$num_public_files = DBExt::queryCount('files','permissions="P"');
$num_admin_files = DBExt::queryCount('files','permissions="A"');

$errors_file_size='File does not exist.';
if(file_exists(PATH::errfile()))$errors_file_size = filesize(PATH::errfile());


//Version checking
//--MeekroDB
$included_files = get_included_files();
foreach($included_files as $f)if(strpos($f,'meekro')){$meekro_file=$f;break;}
preg_match('@meekrodb\.([0-9\.]+)\.class.php$@i',$meekro_file,$matches);
if(!empty($matches))$meekro_version = $matches[1];
else $meekro_version = '(ERROR)';
//--SwiftMail
try{
	require_once PATH::lib()."/swiftmailer/classes/Swift.php";
	$swift_version = Swift::VERSION;
}
catch(Exception $e){$swift_version = '(ERROR)';}

//Output
?>
  <h1>Admin Dashboard</h1>
  
  <style>#info-table td{width:33%;table-layout:fixed;word-wrap:break-word;}li{font-size:0.8em;}</style>
  
  <table cellspacing="10px" id="info-table">
	<tr>
	  <td>
		<h4>Library/Software Versions</h4>
		<ul>
			<li><a href="http://blog.swiftmailer.org/">SwiftMailer</a> <?=$swift_version?> (<a href="https://github.com/swiftmailer/swiftmailer">zip download</a>)</li>
			<li><a href="http://www.meekro.com/updates.php">MeekroDB</a> <?=$meekro_version?></li>
			<li><a href="https://jquery.com/download/">jQuery</a> <span onclick="this.innerHTML=jQuery.fn.jquery"><small><b>(click)</b></small></span></li>
			<li><a href="http://php.net/">PHP</a> <?=phpversion()?> (in the <a href="https://members.nearlyfreespeech.net/lhsmath/sites">NFSN control panel</a> &gt; Server Type)</li>
			<li><a href="https://httpd.apache.org/">Apache</a> [unknown] (also in NFSN Server Type)</li>
			<li><b>Updates often break things. Update carefully.</b></li>
		</ul>
	  </td>
	  <td>
		<h4>Accounts</h4>
		<ul>
		  <li><span class="b"><?=$num_members?></span> members</li>
		  <li><span class="b"><?=$num_captains?></span> captains</li>
		  <li><span class="b"><?=$num_other_admins?></span> other admins</li>
		  <li><span class="b"><?=$num_alumni?></span> alumni<br /><br /></li>
		  
		  <li><span class="b"><?=$num_pending_approval?></span> users pending approval</li>
		  <li><span class="b"><?=$num_banned?></span> banned users<br /><br /></li>
		  
		  <li><span class="b"><?=count(get_bcc_list())?></span> users on mailing list [Mandrill SMTP limit 12000 emails / month, 250 emails / hr.]</li>
		</ul>
	  </td>
	  <td>
		<h4>Tests</h4>
		<ul>
		  <li><span class="b"><?=$num_tests?></span> current tests</li>
		  <li><span class="b"><?=$num_old_tests?></span> archived tests</li>
		</ul>
	  </td>
	</tr>
	<tr>
	  <td>
		<h4>Calendar</h4>
		<ul>
		  <li><span class="b"><?=$num_current_events?></span> <a href="../Calendar">close events</a></li>
		  <li><span class="b"><?=$num_past_events?></span> past events</li>
		  <li><span class="b"><?=$num_future_events?></span> future events</li>
		</ul>
	  </td>
	  <td>
		<h4>Files</h4>
		<ul>
		  <li><span class="b"><?=$num_member_files?></span> member files</li>
		  <li><span class="b"><?=$num_public_files?></span> public files</li>
		  <li><span class="b"><?=$num_admin_files?></span> admin files</li>
		</ul>
	  </td>		  
	  <td>
		<h4>Error Log</h4>
		<ul>
		  <li>Size of <span class="monospace"><?=PATH::errfile()?></span>: <?=$errors_file_size?>. <a href="?do_download_errors">[Download]</a> <a href="?do_clear_errors" onclick="window.location.reload()">[Download & clear]</a></li>
		  <li>Also check via FTP <span class="monospace">/home/logs/*</span>.</li>
		</ul>
	  </td>
	</tr>
  </table>
  
  <br><br>
  <h3>Some things to do regularly:</h3>
  <ul>
	<li>DB: <a href="Database">Optimize tables, check integrity, generate a backup, or download <span class="monospace">.content</span>.</a> (~1x/month)</li>
	<li>Clean out the <span class="monospace">.content/uploads</span> directory, uploading old files to Dropbox and getting rid of older DB backups.</li>
	<li>Checkup on NFSN hosting - most especially the <a href="https://members.nearlyfreespeech.net/lhsmath/accounts">$ in the account</a> (it should also email you when it gets low).</li>
	<li>Look at the <a href="https://bitbucket.org/lhsmath/lhsmath/issues?status=new&status=open">Git repository's issue tracking</a>.</li>
	<li>Test out random pages on the main website and in LMT. If you catch it before it breaks for someone else, huzzah.</li>
  </ul>