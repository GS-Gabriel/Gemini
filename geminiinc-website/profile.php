<?php

/**
 * MASTER LOGIN SYSTEM
 * @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
 * June 2013
 *
 */
include 'inc/init.php';

if(!$user->islg()){
  header("HTTP/1.1 403");
  exit;
}
//$uid = $user->data->userid;
//header("Location: http://$_SERVER[HTTP_HOST]/profile.php?u=$uid");
if(!isset($_GET["u"])) {
	$u = $user->data->userid;
}
else {
	$u = $_GET["u"];
}

if(!($u = $db->getRow("SELECT * FROM `".MLS_PREFIX."users` WHERE `userid`= ?i", $u))){
        $page->error = "User doesn't exists or it was deleted !";
        $u = new stdClass();
        $u->username = 'Guest';
}

/*
if(!isset($_GET["u"]) || !($u = $db->getRow("SELECT * FROM `".MLS_PREFIX."users` WHERE `userid`= ?i", $_GET["u"]))){
	$page->error = "User doesn't exists or it was deleted !";
	$u = new stdClass();
	$u->username = 'Guest';
}
*/
/*
if(!isset($_GET["u"])) {
	$u = $user->data->userid;
	if (!($u = $db->getRow("SELECT * FROM `".MLS_PREFIX."users` WHERE `userid`= ?i", $u))) { 
        	$page->error = "User doesn't exists or it was deleted !";
        	$u = new stdClass();
        	$u->username = 'Guest';
	}
}
*/
$page->title = "Profile of ". $options->html($u->username);

include 'header.php';


if(isset($page->error)) 
  $options->fError($page->error);

$show_actions = ''; // holds the actions links

if(($user->data->userid == $u->userid) || ($user->group->canedit && $user->hasPrivilege($u->userid)))
	$show_actions .= "<li><a href='user.php?id=$u->userid'><i class='icon-pencil'></i> Edit profile</a></li>";

if(($user->data->userid == $u->userid) || ($user->group->canedit && $user->hasPrivilege($u->userid)))
	$show_actions .= "<li><a href='export.php'><i class='icon-pencil'></i> Export profile</a></li>";


$tooltip = ''; // holds the tooltip data

if($user->data->userid == $u->userid) {
	$tooltip = " rel='tooltip' title='change avatar'";
}


// show data based on privacy
$extra_details = '';


$privacy  = $db->getRow("SELECT * FROM `".MLS_PREFIX."privacy` WHERE `userid` = ?i", $u->userid);
$group  = $db->getRow("SELECT * FROM `".MLS_PREFIX."groups` WHERE `groupid` = ?i", $u->groupid);

if($privacy->email == 1 || $user->isAdmin())
	$extra_details .= "<b>Email:</b> ". $options->html($u->email)."<br/>";





echo "<div class='container'>
	<h3 class='pull-left'>Profile of ".$options->html($u->username)."</h3>";

if($show_actions != '')
echo "<div class='btn-group pull-right'>
  		<a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
    		Actions
    		<span class='caret'></span>
  		</a>
  		<ul class='dropdown-menu'>

  			$show_actions
  		
  		</ul>
  	</div>";

echo "  	
  	<div class='clearfix'></div>
	<hr>
	<div class='row'>	
		<div class='span3'>
				 <img src='".$user->getAvatar($u->userid, 240)."' width='240' class='img-polaroid' alt='".$options->html($u->username)."'>
			</a>
			<div style='text-align:center;'><b>".$user->showName($u->userid)." (".$options->html($u->username).") </b></div>
		</div>
		<div class='span7 well' style='margin:10px;'> 
			<b>Rank:</b> ".$options->html($group->name)."<br/>
			<b>Last seen:</b> ".$options->tsince($u->lastactive)."<br/>
			<!-- <b>Password:</b> ".$options->html($u->password)."<br/> -->
			$extra_details
		</div>

	</div>
</div>";


include 'footer.php';
