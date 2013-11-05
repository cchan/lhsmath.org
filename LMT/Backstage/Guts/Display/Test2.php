<?php
/*
 * LMT/Backstage/Guts/Display/Test.php
 * LHS Math Club Website
 */


header('X-LMT-Guts-Data: 42');

echo <<<HEREDOC
<meta http-equiv="refresh" content="10">
<style type="text/css">.school {font-style:italic;} .score{font-weight:bold;text-align:center;} .currProb{text-align:center;}</style>
<center>
<img src="../../../../res/lmt/header.png" alt="LMT" width="525" height="110">
<h2>Guts Round</h2><br><br>
<table border="0" cellspacing="5">
<tr><th></th><th>Team</th><th>School</th><th>Score</th><th>Current Set</th></tr>
<tr><td>1.</td><td class="team">Clockers</td><td class="school">Ashland Middle School</td><td class="score">102</td><td class="currProb">12</td></tr>
<tr><td>2.</td><td class="team">Oak Hill</td><td class="school">Oak Hill Middle School</td><td class="score">64</td><td class="currProb">9</td></tr>
<tr><td>3.</td><td class="team">Individual 1</td><td class="school">Unaffiliated</td><td class="score">12</td><td class="currProb">9</td></tr>
<tr><td>4.</td><td class="team">** IMPORTANT NOTE **</td><td class="school">THIS IS A TEST PAGE!!</td><td class="score">0</td><td class="currProb">0</td></tr>
</table></center>
HEREDOC;

?>