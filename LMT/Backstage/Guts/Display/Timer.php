<?php
/*
 * LMT/Backstage/Guts/Display/Timer.php
 * LHS Math Club Website
 *
 * Sets the timer for the Guts display.
 */

$path_to_lmt_root = '../../../';
require_once $path_to_lmt_root . '../.lib/lmt-functions.php';
backstage_access();

lmt_page_header('Guts Timer Target');

// Yes, the str_replace thing is sketchy af. Just don't use this for Javascripted attributes please.
function input($label, $attrs, $cb){
  if(!is_array($attrs))
    $attrs = [];
  
  if(array_key_exists("name", $attrs))
    $name = $attrs["name"];
  else
    $name = hash('md5', $label); //If not explicitly set, the name attribute is the md5 hash of the $label.
  
  if(!array_key_exists("type", $attrs))
    $attrs["type"] = "text";
  
  $msg = "";
  if(posted($name)){
    try{
      $msg = "<div style='color:green'>" . $cb($_POST[$name]) . "</div>";
    }catch(Exception $e){
      $msg = "<div style='color:red'>" . $e->getMessage() . "</div>";
    }
  }
  $out = "<form method='POST'><label>" . $label . "<input name='" . str_replace("'", "\'", $name) . "' value='" . POST($name) . "'";
  foreach($attrs as $key => $value)
    $out .= " " . $key . "='" . str_replace("'", "\'", $value) . "'";
  return $out . "/>" . $msg . "</label></form>";
}
?>

<h1>Set Guts Timer Target</h1>
<?=input("Guts Timer Target, as any unambiguous date-time string: ",
  ["placeholder" => "3:10pm April 8 2017"],
function($formval){
  $timestamp = strtotime($formval);
  if($timestamp !== false && $timestamp !== -1){ //-1 in case we're using PHP < 5.1.0?
    map_set("guts-timer-target", $timestamp);
    return "Success.";
  }
  else
    throw new Exception("Unable to parse the date-time string given.");
})?>
<p>Currently set to <b><?=map_value("guts-timer-target")?></b>, which is <b><?=date("H:i:s, F jS, Y", intval(map_value("guts-timer-target")))?></b>.</p>
