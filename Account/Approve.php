<?php
/*
 * Account/Approve.php
 * LHS Math Club Website
 *
 * When a user has completed registration, this page prompts them to print
 * out an information page and give it to a captain to approve their
 * account.
 */


require_once '../.lib/functions.php';
restrict_access('P');


show_page();

function show_page() {
	$query = 'SELECT * FROM users WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	$cell = format_phone_number($row['cell']);
	if ($cell == '')
		$cell = 'None';
	
	page_title('Approve');
?>
<h1>Account Approval</h1>

Your account has been verified, but it must be approved by a captain. Please print this page and bring it to practice.<br />
<br />
<div class="scrhide">
	<span class="b">ID: </span><?=$row['id']?><br />
	<span class="b">Name: </span><?=$row['name']?><br />
	<span class="b">Cell: </span><?=$cell?><br />
	<span class="b">Email: </span><?=$row['email']?><br />
	<span class="b">YOG: </span><?=$row['yog']?><br />
	<span class="b">Account Type: </span><?=$row['permissions']?>
</div>
<?php
}

?>