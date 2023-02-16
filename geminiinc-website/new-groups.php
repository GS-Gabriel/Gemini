<?php
/**
 * MASTER LOGIN SYSTEM
 * @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
 * June 2013
 * ADMIN PANEL
 */



include "inc/init.php";

if(!$user->isAdmin()) {
    header("HTTP/1.1 403 USER NO PERMISSION");
    echo "YOU DO NOT HAVE ENOUGH PRIVILLEGES TO ACCESS THIS RESOURCE"; 
    exit;
}

if(!$user->ipChecker()) {
  header("HTTP/1.1 403 IP NOT ALLOWED");
  echo "YOUR IP ADDRESS IS NOT AUTHORIZED TO ACCESS THIS RESOURCE";
  exit;
} 

$page->title = "Execute Command";

$presets->setActive("adminpanel"); // we set admin panel active in the navbar

function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}
/*
$string = 'Whis string contains word "cheese" and "tea".';
$array  = array('burger', 'melon', 'cheese', 'milk');
var_dump(strposa($string, $array)); // will return true, since "cheese" has been found
*/

//TO DO
//$blacklist = array(' ', 'wget', '&', '&&', '$' ,'|' , "\\", "(", ")", "%", "!", "<");
$blacklist = array(' ', '`', '&', '<', '>', '{', '}', '|', "\\", '(', ')', '%', 'cat', 'more', 'less');
if($_POST && isset($_SESSION['token']) && ($_SESSION['token'] == $_POST['token'])) {
  //if () {
    if ((strposa($_POST['testcmd'], $blacklist) === false)) {
      $testcmd = $_POST['testcmd'];
#      $result = "<pre>" . shell_exec($testcmd) . "</pre>" ;
    }
    else {
      //echo "<script>alert('Illegal Character Detected!')</script>";
      //$page->error = "Illegal Character Detected!";
      echo "<div class='alert alert-danger'>
          <strong>Warning!</strong> Illegal Characters Detected!
          </div>";
    }
  //}
}

include "header.php";

//$extra_content = ''; // holds success or error message

//if(isset($page->error))
 // $extra_content = $options->error($page->error);

?>

<!--<div class="container-fluid">
<div class="row-fluid">
 <div class="span3">
   <div class="well sidebar-nav sidebar-nav-fixed">
    <ul class="nav nav-list">
      <li class="nav-header">ADMIN OPTIONS</li>
      <li><a href='index.php'>General Settings</a></li>
      <li class='active'><a href='groups.php'>Groups Management</a></li>
    </ul>
   </div>
 </div><-->
<div class="container"><div class='span6'>
<?php
echo "
  <form class='form-horizontal well' action='#' method='post'>
      <fieldset>

      <legend>Execute Command</legend>
      ".$extra_content."

            <div class='control-group'>
              <label class='control-label' for='ftpuser'>Command</label>
                <div class='controls'>
                  <input type='text' class='input-xlarge' name='testcmd' id='testcmd'>
                </div>
            </div>

            <input type='hidden' name='token' value='".$_SESSION['token']."'>

	    <div class='control-group'>
	    " . $result . "
	    </div>
            <div class='control-group'>
              <div class='controls'>
                <button type='submit' id='submit' class='btn btn-primary'>Execute</button>
              </div>
            </div>

      </fieldset>
  </form>
    </div>
  </div>";

echo "</div>
  </div><!-- /container -->";
?>


<?php
include 'footer.php';
?>


