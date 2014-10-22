<?php //JQuery-style :)
	function hashEquals($a,$b){//Compares the *hashes* of two variables to mess with timing attacks. Because PHP hash_equals is inadequate.
		if(!val('s',$a,$b))return false;
		$m=microtime();
		$str1 = sha1($a.$m.$b);
		$str2 = sha1($b.$m.$a);
		return hash_equals($str1, $str2);
	}
	function genRandStr($length=NULL){
		if(!$length)$length=mt_rand(64,96);
		$c = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';$cl = strlen($c);
		$s = '';
		for($i=0;$i<$length;$i++)$s.=$c[mt_rand(0,$cl-1)];
		return $s;
	}
	function csrfVerify(){//Checks CSRF code validity, and returns whether to proceed. The return value is static. Erases 'ver'.
		static $valid=NULL;
		if(is_null($valid)){
			if($_SESSION['ver'] && hashEquals($_POST['ver'],$_SESSION['ver']))$valid=true;
			unset($_POST['ver'],$_SESSION['ver']);
		}
		return $valid;
	}
	function csrfCode(/*$forceNew*/ /*$ver_name*/){//Returns randomly generated CSRF code. The return value is static.
		static $code='';
		if($_SESSION['ver']&&$code===$_SESSION['ver'])return $code;
		
		return ($code=$_SESSION['ver']=genRandStr());
	}
	
	
	class FormElement{
		public $attribs;
		public $prompt;
		public $type;
		public $value;
		public $validator;
		public function FormElement($attribs){
			$this->attribs = $attribs;
		}
		public function HTML(){
				if($attribs=='')return "&nbsp;"//blank spacer
				
				if($this->type == 'textarea')
					return '<textarea '.attribsToString($this->attribs).'>'.$this->value.'</textarea>';
				// elseif($this->type == 'select')
					// $inputhtml = $attribs;//Not sure how to implement this
				else{
					return '<input '.attribsToString($this->attribs).'/>';
				}
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
	}
	
	class Form{
		protected $name, $method, $action, $xhr;
		protected $validators;
		protected $inputs;
		public function __construct($name,$method=NULL,$action=NULL,$attribs=array()){
			$this->name = strval($name);//$name is required.
			$method = strtolower(strval($method));
			switch($method){
				//case 'xhrget': $this->method = 'get';$xhr = true; break; //XHR not yet supported!
				//case 'xhrpost': $this->method = 'post';$xhr = true; break;
				case 'get': $this->method = 'get'; $xhr = false; 
					if(isSet($_GET[$name]));
					
					break;
				case 'post': default: $this->method = 'post'; $xhr = false;
					
					break;
			}
			if($action===NULL || !is_string($action))$this->action = $_SERVER['REQUEST_URI'];
			else $this->action = strval($action);
			
			$this->validator(function($values){
				if($_SESSION['ver'] && hashEquals($values['ver'],$_SESSION['ver'])){
					unset($values['ver'],$_SESSION['ver']);
					return true;
				}
				else{
					return 'Error! Did you submit the same form twice?';
				}
			});
		}
		public function createForm($name,$method=NULL,$action=NULL,$attribs=array()){
			return new FORM($name,$method,$action,$attribs);
		}
		public function HTML(){
			$html="<form id='{$this->name}' name='{$this->name}' method='{$this->method}' action='{$this->action}' ".attribsToString($this->attribs)." >";
			$html.='<table cellspacing="5px">'
			foreach($inputs as $input){
				if(!empty($input->prompt))//if no prompt, spans two columns of table, else has a prompt there
					$html.="<tr><td>{$input->prompt}</td><td>{$input->HTML()}</td></tr>";
				else
					$html.="<tr><td colspan='2'>{$input->HTML()}</td></tr>";
			}
			$html.='</table>';
			$html.='<input type="hidden" name="ver" value="'.csrfCode().'" />';
			$html.='</form>';
			return $html;
		}
		public function text($name,$attribs=array()){
			$attribs['type']='text';
			$attribs['name']=$name;
			$this->inputs[]=$attribs;
		}
		public function textarea($name,$attribs=array()){
			$attribs['type']='textarea';
			$attribs['name']=$name;
			$this->inputs[]=new FormElement($attribs);
		}
		public function email($name,$attribs=array()){
			$attribs['type']='email';
			$attribs['name']=$name;
			if(@!$attribs['prompt'])$attribs['prompt']='Email Address:';
			$this->inputs[]=(new FormElement($attribs))
				->validator(function($value){if(val('e',$value))return true;else return 'Invalid email.';});
		}
		public function pass($name,$attribs=array()){
			$attribs['type']='password';
			$attribs['name']=$name;
			if(@!$attribs['prompt'])$attribs['prompt']='Password:';
			$this->inputs[]=new FormElement($attribs);
		}
		public function blank(){//Adds a blank line
			$this->inputs[]=new FormElement('');
		}
		public function validator($func){
			$validators[]=$func;
		}
		public function focus(){//Adds "focus" class to last input
			@$inputs[count($inputs)-1]->attribs['class'].=' focus';
		}
	}
	//----------PROPOSED USAGE----------//
	$form = new Form('login','post')//can also xhrpost. default action is this page ($_SERVER['REQUEST_URI'])
		//->format('tabled')//other stuff?
		->email('email',{'prompt'=>'Email Address:','name'=>'email'})->focus()//by default focuses on last-added one, else focuses on supplied name
		->pass('pass',{})
		->note('<a href="Password_Reset" class="small">Forgot your password?</a>')
		->submit('Sign In')
		//->validator()
		->validator(function($values){
			$id = DB::queryFirstField('SELECT id FROM users WHERE LOWER(email)=%s AND passhash=%s LIMIT 1',$email,hash_pass($values['pass']));
			
			if (is_null($id)) {
				log_attempt($email, false);
				show_login_form($email);
				alert('Incorrect email address or password',-1);
				return;
			}
			alert('Invalid username or password.',-1);
			return false;
		});//passes associative array of field name=>value to it
	
	/*
	
	Old one:
	generateForm(array('action'=>'login.php','method'=>'POST','autocomplete'=>'off'),array(
		'<h2>Sign Up</h2>',
		array('prompt'=>'Email:','name'=>'s_email','value'=>isSet($signup_success)?'':POST('s_email'),'autofocus'=>'autofocus'),
		array('prompt'=>'Password:','name'=>'s_pass','type'=>'password'),
		array('prompt'=>'Again:','name'=>'s_confpass','type'=>'password'),
		'Captcha:<br>'.getCaptcha(),
		array('name'=>'signup','type'=>'submit','value'=>'Sign Up')
	))
	
	*/
	
?>