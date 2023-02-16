<?php
/**
 * MASTER LOGIN SYSTEM
 * @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
 * June 2013
 *
 */

include "inc/init.php";

$page->title = "Welcome to ". $set->site_name;

$presets->setActive("home"); // we highlith the home link


include 'header.php';


echo "
<div class=\"container\">

<div class=\"hero-unit\">
    <h1>Welcome ".$user->filter->username." </h1>
    <p>
	This is an internal web application designed for employees to view their profile details and also, allow them to export their details to PDF.<br>
	Roles and access controls are implemented for Administrators to access the Admin Panel. <br>
	V2 is generally more secured and has better functionalities compared to V1.
    </p>";
if(!$user->islg()) {
    echo "<p>
        <a class=\"btn btn-large\" href=\"login.php\">Login</a>
        <a class=\"btn btn-large\" href=\"registration.php\">Register</a>
    </p>";

}

echo "</div></div> <!-- /container -->";
include 'footer.php';
