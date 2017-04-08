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
    cancel_templateify();

    header('X-LMT-Guts-Data: 42'); //:)
    ?>
    <html>
    <head>
        <style type="text/css">
            body{
                font-family:"Georgia";
                zoom:0.9;
                text-align: center;
            }
            #scoreboxes{
                opacity: 0;
                transition: opacity 2s;
            }
            .box{
                vertical-align:top;
                border: solid 2px #000;
                border-radius: 10px;
                height: 50px;
                width: 340px;
                display: inline-block;
                margin: 5px;
                padding: 10px;
                text-align:left;
                position: relative;
            }
            .box .place{
                font-size: 1.4em;
                padding-right: 0.5em;
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
            }
            .box .set{
                font-size: 1.2em;
                position: absolute;
                bottom: 0;
                left: 50%;
                height: 0.2em;
                width: 12em;
                margin-left:-7em;
                display: inline-block;
                border-left: solid 1em #000;
                border-right: solid 1em #000;
            }
            .box .set span{
                position: absolute;
                bottom: 0;
                left: 0;
                height: 0.2em;
                width: 12em;
                display: inline-block;
                background-color: gray;
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
            main{
                position: relative;
            }
            #suspense{
                font-size: 3em;
                transition: opacity 2s;
                opacity: 0;
                position: absolute;
                top: 0; left: 0; right: 0;
            }
        </style>
    </head>
    <body>
    <h1>
        <img src="../../../../res/lmt/header.png" alt="LMT" width="525" height="110">
        Guts Round!
        <span id="timer">--:--:--</span>
    </h1>

    <main>
        <div id="suspense"><br><br><br>Boxes hidden for awards ceremony suspense. ;)</div>
        <div id="scoreboxes"></div>
    </main>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.min.js" integrity="sha256-iaqfO5ue0VbSGcEiQn+OeXxnxAMK2+QgHXIDA5bWtGI=" crossorigin="anonymous"></script>
    <script>
        var GUTS_LENGTH = 90; //minutes
        var SUSPENSE_TIME = 5; //minutes
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
        var targetTime = <?=map_value("guts-timer-target")?>;
        function updateTime(){
            var currTime = (new Date()).getTime()/1000;
            if(targetTime - currTime > GUTS_LENGTH*60){
                timerOut(formatSeconds(targetTime-currTime-GUTS_LENGTH*60)+" <small style='display:block;font-size:0.4em;'>before start</small>");
            }
            if(targetTime - currTime <= GUTS_LENGTH*60){
                timerOut(formatSeconds(targetTime-currTime));
            }
            if(targetTime - currTime <= 0){
                timerOut("END!");
            }
            if(targetTime - currTime <= SUSPENSE_TIME*60){
                $("#scoreboxes").css({opacity: 0});
                $("#suspense").css({opacity: 1});
            }
            else{
                $("#scoreboxes").css({opacity: 1});
                $("#suspense").css({opacity: 0});
            }

            setTimeout(updateTime, 300);
        }
        function timerOut(a){
            document.getElementById("timer").innerHTML=a;
        }
        //Avoiding a brief whiteout on every update is hard. But I think this works!
        //It updates each box in sequence, replacing it with a new document.createElement.
        function renderData(data){
            var html = '';
            for(var i = 0; i < data.length; i++){
                var elem = document.createElement('div');
                elem.className = 'box';
                elem.id = 'box' + i;
                elem.innerHTML =
                    '<span class="place">'+data[i].place+'</span>'+
                    '<span class="score">'+data[i].score+'</span>'+
                    '<span class="team">'+data[i].team+'</span><br>'+
                    '<span class="school">'+data[i].school+'</span>'+
                    '<span class="set"><span style="width:'+Math.floor(data[i].set)+'em"></span></span>';
                var old = $('#box' + i);

                //Account for the initial empty case, and also allow for addition of new teams
                if(old.length)
                    old.replaceWith(elem);
                else
                    $('#scoreboxes').append(elem);
            }
            //Allow removal of teams
            $('#scoreboxes .box').slice(data.length).remove();
        }
        $(function(){
            updateTime();

            $.getJSON('JSON', renderData);
            setInterval(function(){
                $.getJSON('JSON', renderData);
            }, 4000);
        });
    </script>
    </body>
    </html>
    <?php
}
?>