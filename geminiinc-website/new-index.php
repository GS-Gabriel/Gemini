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


$page->title = "General Settings";

$presets->setActive("adminpanel");

$instr1 = ("hostname");
$instr2 = ("date");
$instr3 = ("ssh -V");
$instr4 = ("apachectl -v | grep version");
$results = shell_exec($instr1);
$results2 = shell_exec($instr2);
$results3 = shell_exec($instr3);
$results4 = shell_exec($instr4);

include "header.php";

?>
<div class="container"><div class='span6'>
<?php
echo "
  <form class='form-horizontal well' action='#' method='post'>
      <fieldset>

      <legend>General Settings</legend>
      ".$extra_content."

            <div class='control-group'>
              <label class='control-label' for='hostname'>Hostname</label>
                <div class='controls'>
                  <input type='text' class='input-xlarge' name='hostname' id='hostname' disabled='true' value='$results'>
                </div>
            </div>

            <div class='control-group'>
              <label class='control-label' for='date'>Date</label>
                <div class='controls'>
                  <input type='text' class='input-xlarge' name='date' id='date' disabled='true' value='$results2'>
                </div>
            </div>

            <div class='control-group'>
              <label class='control-label' for='apachev'>SSH Version</label>
                <div class='controls'>
                  <input type='text' class='input-xlarge' name='sshv' id='sshv' disabled='true' value='$results3'>
                </div>
            </div>

            <div class='control-group'>
              <label class='control-label' for='ftpuser'>Apache Version</label>
                <div class='controls'>
                  <input type='text' class='input-xlarge' name='apachev' id='apachev' disabled='true' value='$results4'>
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
