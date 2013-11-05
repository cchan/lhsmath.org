<?php
/*
 * LMT/Backstage/Guts/Display/Home.php
 * LHS Math Club Website
 *
 * Provides instructions to start the Guts Display
 */

$path_to_lmt_root = '../../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	lmt_page_header('Guts Display');
	echo <<<HEREDOC
      <h1>Guts Display</h1>
      
      <h3>LMT Display Application</h3>
      <div class="indented">
        <script src="http://www.java.com/js/deployJava.js" type="text/javascript"></script>
        <script type="text/javascript">
          var dir = location.href.substring(0, location.href.lastIndexOf('/')+1);
          var url = dir + "lmtdisplay.jnlp";
          deployJava.createWebStartLaunchButton(url, '1.5.0');
        </script>
      </div>
      
      <h3>Debugging Tips</h3>
      <span class="i">Did you remember to...</span>
      <ul>
        <li>Edit the jnlp</li>
        <li>Set the MIME type</li>
        <li>Upload lmtdisplay.jnlp and Icon.png</li>
        <li>Upload lmtdisplay.jar and /lib/* AGAIN after rebuilding</li>
      </ul>
      
      <h3>Direct Links</h3>
      <ul>
        <li><a href="lmtdisplay.jnlp">lmtdisplay.jnlp</a></li>
        <li><a href="Data">Data Page</a></li>
        <li><a href="Test">Test Page</a></li>
        <li><a href="Test2">Another Test Page</a></li>
      </ul>
HEREDOC;
	lmt_backstage_footer('Guts Display');
}

?>