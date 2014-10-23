<?php
/*
 * Admin/Dashboard.php
 * LHS Math Club Website
 *
 * The front page of the Admin control panel
 */

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');

if(isSet($_POST['do_download_errors'])) download($path_to_root.'.content/Errors.txt');

page_title('Admin Dashboard');
admin_page_footer('Admin Dashboard');

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


//Version checking
global $path_to_root;
$included_files = get_included_files();
foreach($included_files as $f)if(strpos($f,'meekro')){$meekro_file=$f;break;}
preg_match('@meekrodb\.([0-9\.]+)\.class.php$@i',$meekro_file,$matches);
if(!empty($matches))$meekro_version = $matches[1];
else $meekro_version = '(ERROR)';

try{
	require_once $path_to_root."lib/swiftmailer/classes/Swift.php";
	$swift_version = Swift::VERSION;
}
catch(Exception $e){$swift_version = '(ERROR)';}

//Output
?>
  <h1>Admin Dashboard</h1>
  
  <h3 style="margin-bottom:0px;">Info</h3>
  
  <style>#info-table td{width:33%;}</style>
  <table cellspacing="10px" id="info-table">
	<tr>
	  <td>
		<h4>Library Versions</h4>
		<ul>
			<li><a href="http://blog.swiftmailer.org/">SwiftMailer</a> <?=$swift_version?></li>
			<li><a href="http://www.meekro.com/updates.php">MeekroDB</a> <?=$meekro_version?></li>
			<li><a href="https://jquery.com/download/">jQuery</a> <span onclick="this.innerHTML=jQuery.fn.jquery"><small><b>(click)</b></small></span></li>
			<li><a href="http://php.net/">PHP</a> <?=phpversion()?> (this is updated on the <a href="https://members.nearlyfreespeech.net/lhsmath/sites">NFSN control panel</a>)</li>
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
		  <li><span class="b"><?=$num_banned?></span> banned users</li>
		  
		  <li><span class="b"><?=count(get_bcc_list())?></span> users on mailing list [Gmail SMTP limit 500]</li>
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
		<h4>Errors</h4>
		<ul>
		  <li>Size of <span class="monospace">Errors.txt</span>: <?=filesize($path_to_root.".content/Errors.txt")?>. <a href="?do_download_errors=1">Download</a></li>
		</ul>
	  </td>
	</tr>
  </table>
  
  <br><br>
  <h3>Some things to do regularly:</h3>
  <ul>
	<li>Update libraries (making sure that updating them doesn't break things).</li>
	<li>DB: <a href="Database">Optimize tables, check integrity, generate a backup, or download <span class="monospace">.content</span>.</a> (~1x/month)</li>
	<li>Download (via FTP), look at, and clear the error log (<span class="monospace">.content/Errors.txt</span>).</li>
	<li>Clean out the <span class="monospace">.content/uploads</span> directory, uploading old files to Dropbox and getting rid of older DB backups.</li>
	<li>Checkup on NFSN hosting - most especially the <a href="https://members.nearlyfreespeech.net/lhsmath/accounts">$ in the account</a> (it should also email you when it gets low).</li>
	<li>Look at the <a href="https://bitbucket.org/lhsmath/lhsmath/issues?status=new&status=open">Git repository's issue tracking</a>.</li>
	<li>Test out random pages on the main website and in LMT. If you catch it before it breaks for someone else, huzzah.</li>
  </ul>