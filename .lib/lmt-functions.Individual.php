<?php

if (isSet($_POST['lmtDataIndividual_changeName']))
	do_change_name();
else if (isSet($_POST['lmtDataIndividual_changeGrade']))
	do_change_grade();
else if (isSet($_POST['lmtDataIndividual_changeEmail']))
	do_change_email();
else if (isSet($_POST['lmtDataIndividual_changeAttendance']))
	do_change_attendance();
else if (isSet($_POST['lmtDataIndividual_changeTeam']))
	do_change_team();
else if (isSet($_POST['lmtDataIndividual_changeIndividualRound']))
	do_change_individual_round();
else if (isSet($_POST['lmtDataIndividual_changeThemeRound']))
	do_change_theme_round();
else if (isSet($_POST['lmtDataIndividual_delete']))
	do_confirm_delete();
else if (isSet($_POST['lmtDataIndividual_reallyDelete']))
	do_delete();
else
	display_individual('', '');

//deleteConfirmer class
//EditableClass - when provided a class, displays an html form that allows editing of that class

abstract class UserAccount{
	public function validateName($val,$length = 30){
		
	}
	public function validateEmail($val,$length = 40){
		
	}
	public function validateOptions($val,$arrayOfOptions){
		return array_search($val, $arrayOfOptions) !== false;
	}
}

class Individual extends UserAccount{
	private $name;
	private $grade;
	private $email;
	private $attendance;
	private $team;
	private $individual_round;
	private $theme_round;
	
	private $properties = ['name','grade','email','attendance','team','individual_round','theme_round'];
	//same as db entries
	
	public name($new = null){
		if(is_null($new))
			return $name;
		else{
			$name = $new;
		}
	}
	
	public attendance($new = null){
		
	}
	
	public function delete(){
		
	}
}

?>
