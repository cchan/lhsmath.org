<?php
/*
 * Home.php
 * LHS Math Club Website
 *
 * Displays the homepage. Admins can edit the content of the
 * homepage, which is stored in a separate file.
 */

$path_to_root = '';
require_once 'lib/functions.php';
restrict_access('XRLA');


show_page();





function show_page() {
	$welcome_msg = '';
	if (isSet($_SESSION['HOME_welcome'])) {
		$welcome_msg = "\n        <div class=\"alert\">{$_SESSION['HOME_welcome']}</div><br />\n";
		unset($_SESSION['HOME_welcome']);
	}
	$new_address_msg = '';
	if (isSet($_SESSION['HOME_newAddress'])) {
		$new_address_msg = "\n        <div class=\"alert\">{$_SESSION['HOME_newAddress']}</div><br />\n";
		unset($_SESSION['HOME_newAddress']);
	}
	
	global $use_rel_external_script;
	$use_rel_external_script = true;
	page_header('Home');
	echo <<<HEREDOC
      <h1>Home</h1>$welcome_msg$new_address_msg

HEREDOC;
}

?>

<h2>Welcome</h2>
Welcome to the website of the Lexington High School Math Club!<br>
<br>
Events that are coming up:<br>
<div>
<?php
$current_events = DB::query('SELECT * FROM events WHERE %l',DBExt::timeInInterval('date','+0d','+20d'));
$count = count($current_events);
if($count > 0){
	foreach($current_events as $event){
		$date = date("F j",strtotime($event["date"]));
		echo "<a href='View_Event?ID={$event["event_id"]}'><b>{$event["title"]}</b> on $date</a><br>";
	}
}
//else echo "[no events]";
echo "<a href='http://calcbee.org'><b>CalcBee</b> on January 10, MIT 1-190</a><br>";
?>
</div>

<h2>LMT</h2>
If you are looking for the Lexington Math Tournament website, visit <a href="/LMT/About">http://www.lhsmath.org/LMT</a>.
