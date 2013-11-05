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
<tr><td>1.</td><td class="team">Clockers</td><td class="school">Ashland Middle School</td><td class="score">300</td><td class="currProb">12</td></tr>
<tr><td>2.</td><td class="team">Oak Hill</td><td class="school">Oak Hill Middle School</td><td class="score">252</td><td class="currProb">12</td></tr>
<tr><td>3.</td><td class="team">Individual 1</td><td class="school">Unaffiliated</td><td class="score">243</td><td class="currProb">12</td></tr>
<tr><td>4.</td><td class="team">Mixed Clarke</td><td class="school">Jonas Clarke Middle School</td><td class="score">229</td><td class="currProb">13</td></tr>
<tr><td>5.</td><td class="team">The Sage School</td><td class="school">The Sage School</td><td class="score">201</td><td class="currProb">12</td></tr>
<tr><td>6.</td><td class="team">ASMA</td><td class="school">Advanced Math and Science Academy</td><td class="score">176</td><td class="currProb">11</td></tr>
<tr><td>7.</td><td class="team">Bigelow</td><td class="school">Bigelow Middle School</td><td class="score">155</td><td class="currProb">11</td></tr>
<tr><td>8.</td><td class="team">ASMA++</td><td class="school">Advanced Math and Science Academy</td><td class="score">155</td><td class="currProb">10</td></tr>
<tr><td>9.</td><td class="team">Abacus</td><td class="school">Boston Latin School</td><td class="score">143</td><td class="currProb">9</td></tr>
<tr><td>10.</td><td class="team">Diamond Team 1</td><td class="school">William Diamond Middle School</td><td class="score">120</td><td class="currProb">10</td></tr>
<tr><td>11.</td><td class="team">Waltham Beta</td><td class="school">Waltham Middle School</td><td class="score">103</td><td class="currProb">9</td></tr>
<tr><td>12.</td><td class="team">Leftovers</td><td class="school">Ashland Middle School</td><td class="score">94</td><td class="currProb">8</td></tr>
<tr><td>13.</td><td class="team">New Clarke</td><td class="school">Jonas Clarke Middle School</td><td class="score">93</td><td class="currProb">9</td></tr>
<tr><td>14.</td><td class="team">Diamond's BFFL</td><td class="school">William Diamond Middle School</td><td class="score">86</td><td class="currProb">9</td></tr>
<tr><td>15.</td><td class="team">Individual 3</td><td class="school">Unaffiliated</td><td class="score">77</td><td class="currProb">8</td></tr>
<tr><td>16.</td><td class="team">Old Clarke</td><td class="school">Jonas Clarke Middle School</td><td class="score">71</td><td class="currProb">7</td></tr>
<tr><td>17.</td><td class="team">RJ Grey</td><td class="school">RJ Grey Middle School</td><td class="score">64</td><td class="currProb">6</td></tr>
<tr><td>18.</td><td class="team">PEA Red</td><td class="school">Peabody School</td><td class="score">48</td><td class="currProb">5</td></tr>
<tr><td>19.</td><td class="team">Waltham Gamma</td><td class="school">Waltham Middle School</td><td class="score">42</td><td class="currProb">4</td></tr>
<tr><td>20.</td><td class="team">Individual 2</td><td class="school">Blah</td><td class="score">13</td><td class="currProb">3</td></tr>
<tr><td>21.</td><td class="team">Phillips Exeter</td><td class="school">Phillips Exeter</td><td class="score">10</td><td class="currProb">2</td></tr>
<tr><td>22.</td><td class="team">*()Q#RJOSDI89</td><td class="school">Annoying School With A Really, Really Long Name</td><td class="score">5</td><td class="currProb">1</td></tr>
<tr><td>23.</td><td class="team">** IMPORTANT NOTE **</td><td class="school">THIS IS A TEST PAGE!!</td><td class="score">0</td><td class="currProb">0</td></tr>
</table></center>
HEREDOC;

?>