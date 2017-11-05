<?php

/**
* This class will be a Singleton
* There will only be one instance of this class
* at any one point during the execution of the
* scripts
*/
  class MenuItem{
     private $start;
     private $notifications;
	 private $inbox;
	 private $dashboard;
	 private $visitation_profile;
	 private $visit_requests;
	 private $events;
	 private $users;
	 private $settings;
	 private $registration;
	 private $profile;
	 private $factory_profile;
	 private $factory_gallery;
	 private $activity;
	 private $reports;
	 private $approvals;
	 private $items = array();
	 
	 public function __construct(){
	      $this->start = "Start";
	      $this->notifications = "Notifications";
		  $this->inbox = "Mail";
		  $this->dashboard = "Dashboard";
		  $this->visitation_profile = "Visitation profile";
		  $this->visit_requests = "Visit Requests";
		  $this->events = "Events";
		  $this->users = "Users";
		  $this->registration = "Registration";
		  $this->profile = "Personal profile";
		  $this->factory_profile = "Factory profile";
		  $this->factory_gallery = "Factory gallery";
		  $this->activity = "Activity";
		  $this->reports = "Reports";
		  $this->approvals = "Approvals";
		  $this->settings = "Settings";
		  $this->items[0] = $this->start;
	      $this->items[1] = $this->notifications; 
		  $this->items[2] = $this->inbox; 
		  $this->items[3] = $this->dashboard; 
		  $this->items[4] = $this->visitation_profile;
		  $this->items[5] = $this->visit_requests; 
		  $this->items[6] = $this->events; 
		  $this->items[7] = $this->users; 
		  $this->items[8] = $this->registration;
		  $this->items[9] = $this->profile; 
		  $this->items[10] = $this->factory_profile;
		  $this->items[11] = $this->factory_gallery; 
		  $this->items[12] = $this->activity;
		  $this->items[13] = $this->reports;
		  $this->items[14] = $this->approvals; 
		  $this->items[15] = $this->settings;
	 }
	 
	 public function __toString(){
	    return "";
	 }
	 
	 public function get_items(){
	    return $this->items;
	 }
  }

?>