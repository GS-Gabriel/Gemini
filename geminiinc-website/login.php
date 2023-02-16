<?php
/**
 * MASTER LOGIN SYSTEM
 * @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
 * June 2013
 *
 */


include "inc/init.php";
require_once 'Cryptopost.class.php';
$crypto = new Cryptopost(1024, 'openssl.cnf');

if($user->islg()) { // if it's alreadt logged in redirect to the main page 
  header("Location: /");
  exit;
}


$page->title = "Login to ". $set->site_name;


if(isset($_POST)) {
    if(isset($_GET['forget'])) {
    
        /*$email = $_POST['email'];
        
        if(!$options->isValidMail($email)) 
            $page->error = "Email address is not valid.";   
        
        if(!isset($page->error) && !($usr = $db->getRow("SELECT `userid` FROM `".MLS_PREFIX."users` WHERE `email` = ?s", $email)))
            $page->error = "This email address doesn't exist in our database !";


        if(!isset($page->error)) {
            $activation_code = sha1(rand());
           
            $db->query("UPDATE `".MLS_PREFIX."users` SET `activation_code` = ?s WHERE `userid` = ?i", $activation_code, $usr->userid);
           
            $link = $set->url."/login.php?activation_code=".$activation_code."&userid=".$usr->userid;

            $from ="From: not.reply@".$set->url;
            $sub = "New Password !";
            $msg = "Hello,<br> You requested for a new password. To confirm <a href='$link'>click here</a>.<br>If you can't access copy this to your browser<br/>$link  <br><br>Regards<br><small>Note: Dont reply to this email. If you got this email by mistake then ignore this email.</small>";
            if($options->sendMail($email, $sub, $msg, $from))
                $page->success = "An email with instructions was sent !";
        }*/

    } else if(isset($_GET['activation_code'])) {
        /*if($_GET['activation_code'] == '0') {
            header("Location: $set->url");
            exit;
        }
        if($usr = $db->getRow("SELECT `userid` FROM `".MLS_PREFIX."users` WHERE `activation_code` = ?s", $_GET['activation_code'])) {
            if($db->query("UPDATE `".MLS_PREFIX."users` SET `password` = ?s WHERE `userid` = ?i", sha1($_POST['password']), $usr->userid)) {
                $db->query("UPDATE `".MLS_PREFIX."users` SET `activation_code` = '0' WHERE `userid` = ?i", $usr->userid);
                $page->success = "Password was updated !";
            }

        }*/

    } else {
        if (isset($_POST['cryptoPost'])) {
            $cryptedPost = $_POST;              // Save crypted data for debug
            $formId = $crypto->decodeForm();    // Decrypt $_POST contents
            $name = $_POST['name'];
            $password = $_POST['password'];
            if(!($usr = $db->getRow("SELECT `userid` FROM `".MLS_PREFIX."users` WHERE `username` = ?s AND `password` = ?s", $name, sha1($password))))
                $page->error = "Username or Password is Incorrect!";
            else {
              if($_POST['r'] == 1){
                  $path_info = parse_url("/");
                  setcookie("user", $name, time() + 3600 * 24 * 30, $path_info['path']); // set
                  setcookie("pass", sha1($password), time() + 3600 * 24 * 30, $path_info['path']); // set
              }

            $_SESSION['user'] = $usr->userid;
            header("Location: /");
            exit;
            }   
        }
      }
} 
else if($_POST)
    $page->error = "Invalid request !";

include 'header.php';

$_SESSION['token'] = sha1(rand()); // random token

  echo "<div class='container'>
  <div class='row'>
    <div class='span3 hidden-phone'></div>
      <div class='span6' id='form-login'>";


if(isset($page->error))
  $options->error($page->error);
else if(isset($page->success))
  $options->success($page->success);


if(isset($_GET['forget'])) {
    
/*    echo "<form class='form-horizontal well' action='#' method='post'>
        <fieldset>
            <legend>Recover</legend>
            <div class='control-group'>
              <div class='control-label'>
                <label>Email</label>
              </div>
              <div class='controls'>
                <input type='text' placeholder='john.doe@domain.com' name='email' class='input-large'>
              </div>
            </div>
            
            <input type='hidden' name='token' value='".$_SESSION['token']."'>

            <div class='control-group'>
              <div class='controls'>
              <button type='submit' id='submit' class='btn btn-primary'>Recover</button>
              </div>
            </div>
          </fieldset>";*/

} else if(isset($_GET['activation_code']) && !isset($page->success)) { 
    /*if($_GET['activation_code'] == '0') {
        echo "<div class=\"alert alert-error\">Error !</div>";
        exit;
    }
    if($usr = $db->getRow("SELECT `userid` FROM `".MLS_PREFIX."users` WHERE `activation_code` = ?s AND `userid` = ?i", $_GET['activation_code'], $_GET['userid'])) {
    echo "<form class='form-horizontal well' action='#' method='post'>
        <fieldset>
            <legend>Reset</legend>
            <div class='control-group'>
              <div class='control-label'>
                <label>New password</label>
              </div>
              <div class='controls'>
                <input type='password' name='password' class='input-large'>
              </div>
            </div>

            <input type='hidden' name='token' value='".$_SESSION['token']."'>

            <div class='control-group'>
              <div class='controls'>
              <button type='submit' id='submit' class='btn btn-primary'>Save</button>
              </div>
            </div>
          </fieldset>";


    } else {
        echo "<div class=\"alert alert-error\">Error bad key !</div>";
    }*/

}else {
    echo "<form id='form1' class='form-horizontal well' action='?' method='post' onsubmit='return cryptoPost.encrypt(\"form1\")'>
        <fieldset>
            <meta name='sessionkey' content='".$_SESSION['RSA_Public_key']."'>
            <legend>Login Form</legend>
            <div class='control-group'>
              <div class='control-label'>
                <label>Username</label>
              </div>
              <div class='controls'>
                <input type='text' placeholder='john.doe' name='name' class='input-large'>
              </div>
            </div>

            <div class='control-group'>
              <div class='control-label'>
                <label>Password</label>
              </div>
              <div class='controls'>
                <input type='password' placeholder='type your password' name='password' class='input-large'>
              </div>
              

            </div>
            <div class='control-group'>            
              <div class='control-label'>
                <label for='r'>Remember Me</label>
              </div>
              <div class='controls'>              
                <input type='checkbox' name='r' value='1' id='r'>
              </div>
            </div>

            <input type='hidden' name='token' value='".$_SESSION['token']."'>

	    <div class='control-group' style='text-align:center;'>
	    <label>Dont Have An Account? <a href='registration.php'>Registration</a> </label>
	    </div>

            <div class='control-group'>
              <div class='controls'>

              <button type='submit' name='submit' id='submit' class='btn btn-primary' value='Submit'>Sign in</button>

              </div>
            </div>
          </fieldset>";
}          
echo "  </form>
      </div>
</div>";

if (isset($encrypted)) {
  echo "<script>cryptoPost.decrypt('$encrypted');</script>";
}
/*
echo "
 <meta name='sessionkey' content='".$_SESSION['RSA_Public_key']."'>
 <form id='form1' method='POST' action='login.php' onsubmit='return cryptoPost.encrypt(\"form1\")'>
            Username: <input type='text' name='username' value='' /><br />
            Password: <input type='text' name='password' value='' /><br />
            <br />
            <input type='submit' name='submit' value='Submit' />
        </form>                                           
";
*/
/*
            echo '<h2>Session keys:</h2>';
            if (isset($_SESSION['RSA_Public_key'])){
                echo 'RSA public key (hex) = '. $_SESSION['RSA_Public_key'];
                echo '<br /><br />';
            }
            if (isset($_SESSION['aesKey'])){
                echo 'AES key (hex) = '. bin2hex($_SESSION['aesKey']);
                echo '<br />';
            }
            if (isset($cryptedPost)){
                echo '<h2>Received POST data:</h2><pre>';
                var_dump($cryptedPost);
                echo '</pre><br />';
                echo '<h2>Decrypted POST data:</h2><pre>';
                var_dump($_POST);
                echo '</pre><br />';
            }
*/
include "footer.php";
