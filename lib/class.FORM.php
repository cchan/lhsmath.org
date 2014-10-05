<?php //JQuery-style :)
	class FORM{
		protected $name, $method, $action, $xhr, $attribs;
		protected $inputs;
		public function __construct($name,$method=NULL,$action=NULL,$attribs=array()){
			$this->name = strval($name);//$name is required.
			$method = strtolower(strval($method));
			switch($method){
				//case 'xhrget': $this->method = 'get';$xhr = true; break; //XHR not yet supported!
				//case 'xhrpost': $this->method = 'post';$xhr = true; break;
				case 'get': $this->method = 'get';$xhr = false; break;
				case 'post': default: $this->method = 'post';$xhr = false; break;
			}
			if($action===NULL || !is_string($action))$this->action = $_SERVER['REQUEST_URI'];
			else $this->action = strval($action);
		}
		public function createForm($name,$method=NULL,$action=NULL,$attribs=array()){
			return new FORM($name,$method,$action,$attribs);
		}
		public function attribsToString($attribs){
			$str = ' ';
			foreach($attribs as $field=>$val){
				switch($field){//Specials and Aliases
					case 'prompt': case 'sub': continue;//Special cases handled higher up.
					case 'hint': $field = 'placeholder'; break;//can I integrate compatibility for nonHTML5?
				}
				$str .= "{$field}='{$val}' ";
			}
			return $str;
		}
		public function HTML(){
			$html="<form id='{$this->name}' name='{$this->name}' method='{$this->method}' action='{$this->action}' ".attribsToString($this->attribs)." >";
			$html.='<table cellspacing="5px">'
			foreach($inputs as $attribs){
				if($attribs==''){$html.="<tr><td colspan='2'>&nbsp;</td></tr>";continue;}//blank spacer
				
				switch($attribs['type']){//HTML will ignore extraeneous attributes such as 'type' and 'value'
					case 'textarea':
						$inputhtml = '<textarea '.attribsToString($attribs).'>'.$attribs['value'].'</textarea>';
						break;
					//case 'select': $inputhtml = $attribs; break;//Not sure how to implement this.
					default:
						$inputhtml = '<input '.attribsToString($attribs).'/>';
				}
				
				if($attribs['prompt'] && !empty($attribs['prompt']))//if no prompt, spans two columns of table, else has a prompt there
					$html.="<tr><td>{$attribs['prompt']}</td><td>{$inputhtml}</td></tr>";
				else
					$html.="<tr><td colspan='2'>{$inputhtml}</td></tr>";
			}
			$html.='</table></form>';
			return $html;
		}
		public function text($name,$prompt='',$hint='',$attribs=array()){
			$attribs['type']='text';
			$attribs['name']=$name;
			$attribs['prompt']=$prompt;
			$attribs['hint']=$hint;
			$this->inputs[]=$attribs;
		}
		public function textarea($name,$prompt='',$hint='',$attribs=array()){
			$attribs['type']='textarea';
			$attribs['name']=$name;
			$attribs['prompt']=$prompt;
			$attribs['hint']=$hint;
			$this->inputs[]=$attribs;
		}
		public function email($name,$prompt='Email Address:',$hint='',$attribs=array()){
			$attribs['type']='email';
			$attribs['name']=$name;
			$attribs['prompt']=$prompt;
			$attribs['hint']=$hint;
			$this->inputs[]=$attribs;
		}
		public function pass($name,$prompt='Password:',$attribs=array()){
			$attribs['type']='password';
			$attribs['name']=$name;
			$attribs['prompt']=$prompt;
			$this->inputs[]=$attribs;
		}
		public function blank(){//Adds a blank line
			$this->inputs[]='';
		}
	}
	
	/*
	//----------PROPOSED USAGE----------//
	$form = FORM::createForm('login','post')//can also xhrpost. default action is this page ($_SERVER['REQUEST_URI'])
		->format('tabled')//other stuff?
		->email('email',{'prompt'=>'Email Address:','name'=>'email'})->focus()//by default focuses on last-added one, else focuses on supplied name
		->pass('Password:','pass')//,$hint_value
		->note('<a href="Password_Reset" class="small">Forgot your password?</a>')
		->submit('Sign In')
		->onsubmit(function($values){})//passes associative array of field name=>value to it, returns true or false.
		->onsuccess(function(){alert('Successfully logged in.');})//If onsubmit returns false it will do something.
		->onfailure(function(){echo $this->HTML();});//if onsubmit returns false it will do something else.
	*/
?>