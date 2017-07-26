<!--use a google form-->

<style>
form{
	display:block;
	margin:60px auto 0px auto;
	width:50%;
	text-align:center;
	background-color:black;
	padding:50px;
	color:white;
	font-family:Georgia;
}
form h1{
	font-size: 2.5em;
	margin: 0.1em;
}
form h2{
	font-size: 1.5em;
	margin: 0.1em;
}
form input, form label, form button{
	font-size: 1.5em;
	padding:0.2em;
	margin: 0.2em;
}
form label:hover{
	cursor: pointer;
}
form input[type=text]{
	width:20em;
}
form input[type=email]{
	width:25em;
}
form input[type=radio]{
	height: 15px;
	width: 15px;
}
form input[type=radio]:hover{
	cursor: pointer;
}
form button{
	border: solid 5px white;
	background-color: black;
	color:white;
	transition: background-color 0.5s, width 0.5s, height 0.5s;
	border-radius: 5px;
}
form button:hover{
	cursor:pointer;
}
</style>

<form target="hiddenFrame" action="https://docs.google.com/forms/d/15ddL-G-XJhkKZsL8Y90-WL1KTfuUWnlYU80BqVy2cls/formResponse" method="POST" id="ss-form" target="_self" onsubmit="" autocomplete="off">
	<h1 style="line-height:0.75em;width:1em;height:1em;border:solid 1px white;border-radius:10px;margin:0 auto;font-size:4em;margin-bottom:20px;">&pi;</h1>
	<h1>LHS Math Club</h1>
	<h2>Club Fair Signup 2015-2016</h2>
	
	<div>
		<input type="text" name="entry.1416096901" value="" placeholder="Name" required aria-required="true">
	</div>

	<div>
		<label><input type="radio" name="entry.1123720244" value="9" required aria-required="true">9</label>
		<label><input type="radio" name="entry.1123720244" value="10" required aria-required="true">10</label>
		<label><input type="radio" name="entry.1123720244" value="11" required aria-required="true">11</label>
		<label><input type="radio" name="entry.1123720244" value="12" required aria-required="true">12</label>
	</div>

	<div>
		<input type="email" name="entry.494551155" placeholder="email@email.com" title="Must be a valid email address" required aria-required="true">
	</div>

	<div>
		<button id="submitbtn" name="submit"><span style="display:inline-block;">Submit</span></button>
	</div>
</form>

<!--https://stackoverflow.com/a/30666118/1181387-->
<iframe id="hiddenFrame" name="hiddenFrame" style="display: none;"></iframe>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	var lockColor = false;
	var hovering = false;
	function rewidth(){$("#submitbtn").width($("#submitbtn span").width());}
	$("#submitbtn").mouseenter(function(){hovering = true;if(!lockColor)$(this).css({"background-color":"white","color":"black"});});
	$("#submitbtn").mouseleave(function(){hovering = false;if(!lockColor)$(this).css({"background-color":"black","color":"white"});});
	$("#ss-form").on("submit", function () {
		$("#submitbtn span").text("Sending response...");
		$("#submitbtn").css({"background-color":"red","color":"white"});
		rewidth();
		lockColor=true;
		$("#hiddenFrame").load(function(){
			$("#ss-form").trigger("reset");
			$("#submitbtn span").html("Success!<br>Thanks for signing up!");
			$("#submitbtn").css("background-color","green");
			rewidth();
			setTimeout(function(){
				$("#submitbtn span").text("Submit");
				$("#submitbtn").css("background-color","black");
				rewidth();
				lockColor=false;
				if(hovering)
					$("#submitbtn").mouseenter();
			},2000);
		});
    });
</script>

