<?php
/*
 * Admin/Uptime.php
 * LHS Math Club Website
 *
 * Reports on the website's uptime
 */

require_once '../.lib/functions.php';
restrict_access('A');

page_title('Uptime Report');
?>
<h1>Uptime Report</h1>

<img src="<?=$PINGDOM_UPTIME_BANNER?>" alt=""/>
<img src="<?=$PINGDOM_RESPONSE_BANNER?>" alt="" class="right"/>
<br />
<br />
<br />
<object id="pingdomreport" data="<?=$PINGDOM_REPORT?>" type="text/html"></object>
