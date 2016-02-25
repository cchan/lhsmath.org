<?php
require_once '../.lib/functions.php';
restrict_access('A');
?>
<h1>LHSMATH Mailings BCC List</h1>
All Math Team mailing list email addresses:
<textarea style="display:block;width:100%;height:20em;">
<?php
foreach(get_bcc_list() as $email=>$name)
	echo $email."\n";
?>
</textarea>
