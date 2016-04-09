<?php
/*
 * LMT/Backstage/Guts/Display/Display.php
 * LHS Math Club Website
 *
 * New display thing :)
 */

$path_to_lmt_root = '../../../';
require_once $path_to_lmt_root . '../.lib/lmt-functions.php';

show_page();





function show_page() {
	score_guts();
	
	cancel_templateify();
	
	header('X-LMT-Guts-Data: 42'); //:)
?>
<meta http-equiv="refresh" content="7">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<style type="text/css">
body{
	font-family:"Georgia";
}

.box{
	vertical-align:top;
	border: solid 2px #000;
	border-radius: 10px;
	height: 50px;
	width: 270px;
	display: inline-block;
	margin: 5px;
	padding: 10px;
	text-align:left;
	display:none;
}
.box .place{
	font-size: 1.4em;
}
.box .team{
	font-weight: bold;
	font-size: 1.2em;
}
.box .school{
	font-size: 0.8em;
}
.box .score{
	float: right;
	font-size: 2.3em;
	position:relative;
	top:-30px;
}
.box .set{
	
}

h1{
 font-size: 3.2em;
 position:relative;
 top:-30px;
	margin-bottom: -10px;
}
h1 img{
	position:relative;
	top:30px;
}
h1 #timer{
	width: 400px;
	min-height: 1.2em;
	border: solid 1px #000;
	display: inline-block;
}
.suspense{
	font-size: 3em;
}
</style>
<script>
console.log((new Date()).getTime());
function formatSeconds(secs){
	var h = Math.floor(secs / (60*60));
	var m = Math.floor((secs % 3600) / 60);
	var s = Math.floor(secs % 60);
	h=h.toString();
	m=m.toString();
	s=s.toString();
	while(h.length < 2) h = "0"+h;
	while(m.length < 2) m = "0"+m;
	while(s.length < 2) s = "0"+s;
	
	return h+":"+m+":"+s;
}
var targetTime = 1460180400 + 90 * 60 + 12 * 60 * 60 + 10 * 60;
function updateTime(){
	var currTime = (new Date()).getTime()/1000;
	if(targetTime - currTime > 90*60){
		timerOut(formatSeconds(targetTime-currTime-90*60)+" <small style='display:block;font-size:0.4em;'>before start</small>");
	}
	if(targetTime - currTime <= 90*60){
		timerOut(formatSeconds(targetTime-currTime));
	}
	if(targetTime - currTime <= 0){
		timerOut("END!");
	}
	if(targetTime - currTime <=300){
		$(".box").fadeOut();
		$(".suspense").fadeIn();
	}
	else{
		$(".box").css("display","inline-block");
		$(".suspense").hide();
	}
	
	setTimeout(updateTime,300);
}
function timerOut(a){
	document.getElementById("timer").innerHTML=a;
}
</script>
<center>

<h1>
<img src="../../../../res/lmt/header.png" alt="LMT" width="525" height="110">
Guts Round
<span id="timer">(timer here)</span>
</h1>

<div class="suspense"><br><br><br>Boxes hidden for awards ceremony suspense. ;)</div>

<?php
	
	$result = DB::queryRaw('SELECT name, guts_ans_a, (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name, '
		. '(SELECT MAX(problem_set) FROM guts WHERE team=team_id) AS current_problem, score_guts FROM teams WHERE deleted="0" ORDER BY score_guts DESC');
	
	$n = 1;
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$place = htmlentities($n++);
		$team = htmlentities($row['name']);
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = 'Individuals';
		$score = htmlentities($row['score_guts']);
		$curr = htmlentities($row['current_problem']);
		if ($curr == '')
			$curr = '0';
		if (!is_null($row['guts_ans_a']))
			$curr = '12';
		?>
<div class="box">
	<span class="place">[<?=$place?>]</span>
	<span class="team"><?=$team?></span>
	<span class="set">(<?=$curr?>/12)</span><br>
	<span class="school"><?=$school?></span>
	<span class="score"><?=$score?></span>
</div>
<?php
		$row = mysqli_fetch_assoc($result);
	}

?>
<script>
$(function(){
updateTime();
});
</script>
<?php
}
?>