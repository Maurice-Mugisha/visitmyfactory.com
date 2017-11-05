<?php

final class Privilege{


  
  private static $visitor_privileges = array('START', 'NOTIFICATIONS', 'MAIL', 'VISITATION PROFILE', 
                              'EVENTS', 'PERSONAL PROFILE', 'SETTINGS');
  
  private static $group_privileges = array("START", "NOTIFICATIONS", "MAIL", "VISITATION PROFILE", 
                              "EVENTS", "PERSONAL PROFILE", "SETTINGS");
  
  private static $institution_privileges = array("START", "NOTIFICATIONS", "MAIL", "VISITATION PROFILE", 
                              "EVENTS", "PERSONAL PROFILE", "COMPANY PROFILE", "SETTINGS");
							  
  private static $company_user_privileges = array("START", "NOTIFICATIONS", "MAIL", "DASHBOARD", 
                                   "VISIT REQUESTS", "EVENTS", "PERSONAL PROFILE", "FACTORY PROFILE", "FACTORY GALLERY", "SETTINGS");
  
  private static $site_user_privileges = array("START", "NOTIFICATIONS", "MAIL", "DASHBOARD", "VISITATION PROFILE", 
                                   "VISIT REQUEST", "EVENTS", "USERS", "REGISTRATION", "PERSONAL PROFILE", 
								   "COMPANY PROFILE", "APPROVALS", "SETTINGS");
  private static $admin_user_privileges = array("START", "NOTIFICATIONS", "MAIL", "DASHBOARD", "VISITATION PROFILE", 
                                   "VISIT REQUEST", "EVENTS", "USERS", "REGISTRATION", "PERSONAL PROFILE", 
								   "COMPANY PROFILE", "APPROVALS", "REPORTS", "SETTINGS");
  
  
  private function __construct(){
  }
  
  
  public static function Instance(){
     $instance = null;
     if($instance == null)
	    $instance = new Privilege();
	 return $instance;
   }
   
   
  
  public static function get_privileges($user_category){
     $privilege = array();
	  if(strtoupper($user_category) == "VISITOR_USER"){
	    $privilege = Privilege::$visitor_privileges;
	  }
	  else if(strtoupper($user_category) == "GROUP_USER"){
	    $privilege = Privilege::$group_privileges;
	  }
	  else if(strtoupper($user_category) == "INSTITUTION_USER"){
	    $privilege = Privilege::$institution_privileges;
	  }
	  else if(strtoupper($user_category) == "COMPANY_USER"){
	    $privilege = Privilege::$company_user_privileges;
	  }
	  else if(strtoupper($user_category) == "SITE_USER"){
	    $privilege = Privilege::$site_user_privileges;
	  }
	  else if(strtoupper($user_category) == "ADMIN_USER"){
	    $privilege = Privilege::$admin_user_privileges;
	  }
	 return $privilege;
  }
  
  
  
  
  
}

?>