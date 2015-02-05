<?php
/*
 * LMT/Backstage/Guts/Enter_Scores.php
 * LHS Math Club Website
 *
 * A page where Guts Round staff enter scores
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();
scoring_access();

show_page();





function show_page() {
	global $javascript;
	$javascript = <<<HEREDOC
      window.onbeforeunload = function (evt) {
        return "If you navigate away from this page, you will have to re-select your teams!";
      }
HEREDOC;
	
	lmt_page_header('Guts Round');
	echo <<<HEREDOC
      <h1>Guts Round</h1>
      
      <table id="gutsTable">
        <tr>
          <td><object class="gutsFrame" data="Embed" type="text/html"></object></td>
          <td><object class="gutsFrame" data="Embed" type="text/html"></object></td>
        </tr><tr>
          <td><object class="gutsFrame" data="Embed" type="text/html"></object></td>
          <td><object class="gutsFrame" data="Embed" type="text/html"></object></td>
        </tr><tr>
          <td><object class="gutsFrame" data="Embed" type="text/html"></object></td>
          <td><object class="gutsFrame" data="Embed" type="text/html"></object></td>
        </tr>
      </table>
HEREDOC;
}

?>