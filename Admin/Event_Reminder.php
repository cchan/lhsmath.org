<?php
/*
 * Admin/Event_Reminder.php
 * LHS Math Club Website
 *
 * A page to be run as a cron job which reminds captains of any events coming up.
 */
 
//Currently run every Sunday by https://members.nearlyfreespeech.net/lhsmath/sites/lhsmath/cron

//Next steps: Add a field "remind_when" that indicates a time to remind at. Can specify multiple comma-separated, I suppose.
//auto_remind will then hold the number of notifications that have so far been sent through this.

$path_to_root = '../';
require_once '../lib/functions.php';
cancel_templateify();

$current_events = DB::query('SELECT * FROM events WHERE auto_remind = 0 AND %l',DBExt::timeInInterval('date','','+17d'));
$count = count($current_events);
if($count == 0)die();

$email_bb = '';
foreach($current_events as $event){
	$description = $event["description"];
	if(empty(trim($description)))$description = "[no description]";
	$email_bb.="[subheading][i]{$event["title"]}[/i] on {$event["date"]}[/subheading]{$description}\n\n";
}
$email_bb = <<<HEREDOC
Hi captains!

This is a reminder that [b]{$count}[/b] events are coming up within a couple of weeks:
{$email_bb}
Thanks!
Your friendly LHS Math Club Mailbot

P.S. An event reminder will be sent every Sunday.
HEREDOC;

if($count > 1)
	$subject = $count." Events coming up";
else
	$subject = "'".$current_events[0]["title"]."' coming up";

$status = send_email(array("captains@lhsmath.org"),$subject,$email_bb,"captains@lhsmath.org","[LHS Math Club Captains]",NULL);
if($status !== true)die("Error: $status");

$ids=DBHelper::verticalSlice($current_events,'event_id');
DB::update('events',array('auto_remind'=>DB::sqleval('auto_remind + 1')),'event_id in %li',$ids);
?>