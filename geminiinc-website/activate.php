<?php
/**
 * MASTER LOGIN SYSTEM
 * @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
 * June 2013
 *
 */


include "inc/init.php";

$page->title = "Activation ". $set->site_name;


if($_POST && isset($_SESSION['token']) && ($_SESSION['token'] == $_POST['token'])) {
$userid = $_POST['userid'];
$activation_code = $_POST['activation_code'];
    if(!($usr = $db->getRow("SELECT `userid` FROM `".MLS_PREFIX."users` WHERE `userid` = ?s AND `activation_code` = ?s", $userid, $activation_code)))
        header("HTTP/1.1 403 INVALID VALUE");
    else {
    	$db->query("UPDATE `".MLS_PREFIX."users` SET `validated` = 1 WHERE `userid` = ?i", $userid);
        header("Location: /");
        exit;
    }
    
} 
else {
      header("HTTP/1.1 403 INVALID TOKEN");
}


$_SESSION['token'] = sha1(rand()); // random token

  echo "<div class='container'>
  <div class='row'>
    <div class='span3 hidden-phone'></div>
      <div class='span6' id='form-login'>";

echo "<form class='form-horizontal well' action='?' method='post'>
        <fieldset>
            <legend>Activation Form</legend>
            <div class='control-group'>
              <div class='control-label'>
                <label>User ID</label>
              </div>
              <div class='controls'>
                <input type='text' placeholder='enter user id' name='userid' class='input-large'>
              </div>
            </div>

            <div class='control-group'>
              <div class='control-label'>
                <label>Activation Code</label>
              </div>
              <div class='controls'>
                <input type='password' placeholder='enter activation code' name='activation_code' class='input-large'>
              </div>
              

            </div>
  

            <input type='hidden' name='token' value='".$_SESSION['token']."'>

            <div class='control-group'>
              <div class='controls'>

              <button type='submit' id='submit' class='btn btn-primary'>Activate Account</button>

              </div>
            </div>
          </fieldset>";
      
echo "  </form>
      </div>
</div>";
