<?php
/*
 * LMT/Backstage/Scoring/Refrigerator.php
 * LHS Math Club Website
 *
 * Allows staff to freeze scoring
 */

require_once '../../../lib/lmt-functions.php';
backstage_access();

if (isSet($_POST['lmt_freeze_scoring']))
	do_freeze_scoring();
else if (isSet($_POST['lmt_enable_scoring']))
	do_enable_scoring();
else
	show_page('');





function show_page($err) {
	lmt_page_header('Refrigerator');
	
	if (scoring_is_enabled()) {
		$scoring_status = 'Enabled';
		$scoring_action = 'lmt_freeze_scoring';
		$scoring_action_name = 'Freeze';
	}
	else {
		$scoring_status = 'Frozen';
		$scoring_action = 'lmt_enable_scoring';
		$scoring_action_name = 'Enable';
	}
	
	echo <<<HEREDOC
      <h1><span class="dontMess">*</span>Refrigerator</h1>
      
      <div class="text-centered">
        <span class="b red">WARNING: The only person who should use this page is the Scoring Czar!</span>
        <div class="halfbreak"></div>
        Before printing results, disable score entry using this feature.
        <div class="halfbreak"></div>
        If you need to re-enable scoring, first destroy all printed copies of the results list,<br />
        and make sure to re-freeze scoring and refresh your browser before viewing it again!
        <br /><br />
        <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
          <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
          <input type="submit" name="$scoring_action" value="$scoring_action_name" />
        </div></form>
      </div>
HEREDOC;
	die;
}





function do_freeze_scoring() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	map_set('scoring', '0');
	
	header('Location: Refrigerator');
}





function do_enable_scoring() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	map_set('scoring', '1');
	
	header('Location: Refrigerator');
}

?>