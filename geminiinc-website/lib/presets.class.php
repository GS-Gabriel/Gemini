<?php
/**
 * Presets class
 * generates some presets for different portions of the site.
 */
 
class presets {
  
  var $active = '';

  /**
   * generates the items inside the top navbar
   */
  function GenerateNavbar() {
      global $set, $user;
      $var = array();
      $var[] = array("item" ,
                      array("href" => "/",
                            "name" => "Home",
                            "class" => $this->isActive("home")),
                      "id" => "home");

      $var[] = array("item" ,
                      array("href" => "logs.php",
                            "name" => "PDF Logs",
                            "class" => $this->isActive("pdflogs")),
                      "id" => "pdflogs");

      $var[] = array("item",
                      array("href" => "users_list.php",
                            "name" => "User List",
                            "class" => $this->isActive("userslist")),
                      "id" => "userslist");
      /*
      if($user->group->type == 3) // we make it visible for admins only
      $var[] = array("item",
                      array("href" => "/admin",
                            "name" => "Admin Panel",
                            "class" => $this->isActive("adminpanel")),
                      "id" => "adminpanel");
      */
      if($user->group->type == 3) // we make it visible for admins only
      $var[] = array("dropdown",
                      array(  array("href" => "new-index.php",
                                       "name" => "<i class=\"icon-user\"></i> General Settings",
                                       "class" => 0),
                              array("href" => "new-groups.php",
                                       "name" => "<i class=\"icon-cog\"></i> Execute Command",
                                       "class" => 0),
                          ),
                      "class" => 0,
                      "style" => 0,
                      "name" => "Admin Panel",
                      "id" => "adminpanel");

      // keep this always the last one or edit hrader.php:8
      $var[] = array("dropdown",
                      array(  array("href" => "profile.php?u=".$user->data->userid,
                                       "name" => "<i class=\"icon-user\"></i> My Profile",
                                       "class" => 0),
                              array("href" => "user.php",
                                       "name" => "<i class=\"icon-cog\"></i> Account settings",
                                       "class" => 0),

                              array("href" => "logout.php",
                                         "name" => "LogOut",
                                         "class" => 0),
                          ),
                      "class" => 0,
                      "style" => 0,
                      "name" => $user->filter->username,
                      "id" => "user");



          

      return $var;
  }

  function setActive($id) {
    $this->active = $id;
  }

  function isActive($id) {
    if($id == $this->active)
      return "active";
    return 0;
  }

}
