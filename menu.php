<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visit my Factory</title>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/view.css"/>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" type="text/css" href="css/drop_menu.css" />
<!--for flag-->

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<script src="js/visits.js"></script>
<script src="js/start-item.js"></script>
<script src="js/settings.js"></script>
<script src="js/message.js"></script>
<!-- </msdropdown> -->

<link rel="stylesheet" type="text/css" href="css/skin2.css" />
<link rel="stylesheet" type="text/css" href="css/flags.css" />
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" href="css/messages.css" />
<!--flag end-->
<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/event.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/styles_leftmenu.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />

</head>

<body onload="showEvents()">

<?php
	session_start();
    require_once("includes/utilities/database_utilities/database_connection.php");
	include("query.php");
	require_once("includes/utilities/database_utilities/queries.php");
	require_once("includes/utilities/validators/field_validator.php");
	require_once("includes/utilities/validators/validator.php");
	
	include("user.php");
	require_once("includes/user_classes/company_representative.php");
	require_once("includes/user_classes/visitor.php");
	
    require_once("menu_item.php");
	include("privileges.php");
	require_once("includes/utilities/sector.php");
	require_once("includes/utilities/booking.php");
	require_once "includes/utilities/date_time.php";
	require_once "includes/utilities/country.php";
	
	$db_obj = new Database();
	$db_obj->connect_to_the_server(); // Consider using a singleton
	$db_obj->create_database();
	$db_obj->select_database();
	$db_obj->create_tables();
		
	$selection_obj = new SelectQuery();
	$delete_obj = new DeleteQuery();
	$update_obj = new UpdateQuery();
	$insertion_obj = new InsertionQuery();
	
?>


<!--start header-->	
<?php  require_once "includes/header.php";  ?>
<!--end header-->


<div class="clear"></div>

<!-- OUTERMOST DIV (OPEN)-->
<div id="outermost_menu_div">



  <!-- MAIN PANEL DIV (OPEN) -->
  <div id="main_panel">
  
<?php   
  $query = $selection_obj->select_user_data($_SESSION['email'], $_SESSION['password']);
  
  $user_category = "";
  while($row = mysql_fetch_array($query)){
	 $user_category = $row['category'];
  }
  
  $check_factory_data_availability = false;
  if(strtoupper($_SESSION['category']) == "COMPANY_USER"){
     $check = mysql_query($selection_obj->select_factory_user_map($_SESSION['user_id'])) or die();
     $row = mysql_fetch_array($check);
	 if(!empty($row['user_id'])) 
	   $check_factory_data_availability = true;
	 else 
	   $check_factory_data_availability = false;
  }
  
  $privilege_obj = Privilege::Instance();
  $returned_privileges = $privilege_obj::get_privileges($_SESSION['category']);
  
  //Messages
  $unread_messages_count = $selection_obj->count_messages($_SESSION['user_id'], "UNREAD");
  $count_string = ($unread_messages_count>0)? "(".$unread_messages_count.")" : " ";
?>  
  
  <!-- MENU ITEM DIV (OPEN) -->
  <div id='cssmenu'>
<ul>
    
   <?php if(strtoupper($_SESSION['category']) == "COMPANY_USER" && $check_factory_data_availability == false){ ?>
     <li><a href='menu.php?item=Start' class = 'item_links'><span>Start</span></a></li>
   <?php }elseif(strtoupper($_SESSION['category']) != "COMPANY_USER"){ ?>
      <li><a href='menu.php?item=Start' class = 'item_links'><span>Start</span></a></li>
   <?php }?>
   <li class='active has-sub'><a href='#'><span>Notifications</span></a>
      <ul>
        <li><a href='menu.php?item=Notifications&&category=general'><span>General</span></a>
         <ul>
           <li><a href='#'><span>Sub cat</span></a></li>
           <li class='last'><a href='#'><span>Sub cat</span></a></li>
          </ul>
        </li>
       <li><a href='menu.php?item=Notifications&&category=subscriptions'><span>Subscriptions</span></a></li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Messages&nbsp;<?= $count_string ?></span></a>
      <ul>
         <li><a href='menu.php?item=messages&&category=all'><span>All&nbsp;<?= $count_string ?></span></a></li>
         <li><a href='menu.php?item=messages&&category=read'><span>Read</span></a></li>
         <li><a href='menu.php?item=messages&&category=unread'><span>Unread&nbsp;<?= $count_string ?></span></a></li>
         <li><a href='menu.php?item=messages&&category=sent'><span>Sent</span></a></li>
      </ul>
   </li>
   
   <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
     <li><a href='menu.php?item=conversations'><span>Conversations</span></a></li>
   <?php } ?>
   
  <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
    <li class='active has-sub'><a href='#'><span>Dashboard</span></a>
      <ul>
          <li><a href='menu.php?item=Dashboard&&for=visits'><span>Visits</span></a></li>
          <li><a href='menu.php?item=Dashboard&&for=signups'><span>Sign ups</span></a></li>
          <li><a href='menu.php?item=Dashboard&&for=inquiries'><span>Inquiries</span></a></li>
          <!--<li><a href='menu.php?item=Dashboard#'><span>User activity</span></a></li>-->
          <li><a href='menu.php?item=Dashboard&&for=site coverage'><span>Site coverage</span></a></li>
          <li><a href='menu.php?item=Dashboard&&for=access media'><span>Access media</span></a></li>
          <!--<li><a href='menu.php?item=Dashboard#'><span>Multimedia content</span></a></li>-->
          <!--<li><a href='menu.php?item=Dashboard#'><span>Login statistics</span></a></li>-->
          <!--<li><a href='menu.php?item=Dashboard#'><span>Overall</span></a></li>
          <li><a href='menu.php?item=Dashboard#'><span>Page statistics</span></a></li>-->
      </ul>
     </li>
    <?php } ?>
    
    
    <?php if((strtoupper($_SESSION['category']) == "COMPANY_USER" && $check_factory_data_availability != false) 
	          || 
			  strtoupper($_SESSION['category']) == "VISITOR_USER"){ ?>
     <li class='active has-sub'><a href='#'><span>Visit requests</span></a>
    
     <ul>
     <?php if(strtoupper($_SESSION['category']) == "VISITOR_USER"){ ?>
         <li><a href='menu.php?item=Visit Requests&&selection=my requests#'><span>Your requests</span></a></li>
     <?php  
	       }else{ 
	 ?>
      <li><a href='menu.php?item=Visit Requests&&selection=request#'><span>Requests</span></a></li>
      <li><a href='menu.php?item=Visit Requests&&selection=unsolicited#'><span>Unsolicited requests</span></a></li>
	  <?php  } ?>
     </ul>
   </li>
   <?php } ?>
   
   <?php if(strtoupper($_SESSION['category']) == "VISITOR_USER"){ ?>
     <li><a href='menu.php?item=Visitation profile'><span>Visitation profile</span></a></li>
   <?php } ?>
   
   <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER" 
            || 
		   (strtoupper($_SESSION['category']) == "COMPANY_USER" && $check_factory_data_availability != false)){ ?>
   <li class='active has-sub'><a href='#'><span>Events</span></a>
      <ul>
       <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
         <li><a href='menu.php?item=Events&action=vae'><span>View all events</span></a></li>
         <li><a href='menu.php?item=Events&&action=bue'><span>Blocked events</span></a></li>
       <?php } ?>
       <?php if(strtoupper($_SESSION['category']) == "COMPANY_USER"){ ?>
         <li><a href='menu.php?item=Events&&action=caet'><span>Event templates</span></a></li>
         <li><a href='menu.php?item=Events&&action=cae'><span>Create Events</span></a></li>
         <li><a href='menu.php?item=Events&&action=fse'><span>Your events</span></a></li>
       <?php } ?>
       <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
         <li><a href='menu.php?item=Events&&action=vce'><span>Event history</span></a></li>
       <?php } ?>
      </ul>
   </li>
   <?php } ?>
   
   <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
   <li class='active has-sub'><a href='#'><span>Finance</span></a>
      <ul>
         <li><a href='menu.php?item=finance&&exac=commission'><span>Commission</span></a></li>
         <li><a href='menu.php?item=finance&&exac=tax'><span>Tax</span></a></li>
      </ul>
   </li>
   <?php } ?>
   
   <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
   <li class='active has-sub'><a href='#'><span>Users</span></a>
   <ul>
     <li class='active has-sub'><a href='#'><span>Factories</span></a>
       <ul>
        <li><a href='menu.php?item=Users&action=aaf'><span>Add a factory</span></a></li>
        <li><a href='menu.php?item=Users&action=raa'><span>Remove a factory</span></a></li>
        <li><a href='menu.php?item=Users&action=bsaf'><span>Block/Suspend factory</span></a></li>
        <li><a href='menu.php?item=Users&action=vaf'><span>View all factories</span></a></li>
        <li><a href='menu.php?item=Users&action=aafbu'><span>Add by upload</span></a></li>
       </ul>
     </li>
   
     <li class='active has-sub'><a href='#'><span>Site Users</span></a>
       <ul>
         <li><a href='menu.php?item=Users&action=aau'><span>Add a user</span></a></li>
         <li><a href='menu.php?item=Users&action=aasu'><span>Approve a user</span></a></li>
         <li><a href='menu.php?item=Users&action=vbosu'><span>Block/Suspend user</span></a></li>
         <li><a href='menu.php?item=Users&action=rasu'><span>Remove a user</span></a></li>
       </ul>
     </li>
   
     <li class='active has-sub'><a href='#'><span>Visitors</span></a>
       <ul>
         <li><a href='menu.php?item=Users&action=ravu'><span>Remove a user</span></a></li>
         <li><a href='menu.php?item=Users&action=vbosvu'><span>Block/Suspend user</span></a></li>
         <li><a href='menu.php?item=Users&action=vavu'><span>View all users</span></a></li>
       </ul>
     </li>
   
    </ul>
   </li>
   <?php } ?>
   
   <li><a href='menu.php?item=Personal profile'><span>Personal profile</span></a></li>
   
   <?php if(strtoupper($_SESSION['category']) == "COMPANY_USER" && $check_factory_data_availability != false){ 
      $factory_details = mysql_fetch_array($selection_obj->select_factory_user_map2($_SESSION['user_id']));
	  $factory_id = $factory_details['factory_id']; 
	  $branch_id = $factory_details['branch_id'];
   ?>
      <li class='active has-sub'><a href='#'><span>Factory profile</span></a>
        <ul>
         <li><a href='menu.php?item=Factory profile&&action=view'><span>View profile</span></a></li>
         <li><a href='menu.php?item=Factory profile&&action=edit&&fid=<?= $factory_id?>&&bid=<?= $branch_id ?>'><span>Edit profile</span></a></li>
       </ul>       
      </li>
      <!--<li><a href='#'><span>Factory gallery</span></a></li>-->
   <?php } ?>
   
   <?php if(strtoupper($_SESSION['category']) == "COMPANY_USER"  || strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
   <!--<li><a href='#'><span>Reports</span></a></li>-->
   <?php } ?>
   <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
     <li><a href='#'><span>Approvals</span></a></li>
     
     <li class='active has-sub'><a href='#'><span>Searches</span></a>
       <ul>
         <li><a href='menu.php?item=searches&action=as'><span>Add searches</span></a></li>
         <li><a href='menu.php?item=searches&action=vs'><span>Your searches</span></a></li>
         <li><a href='menu.php?item=searches&action=es'><span>Edit searches</span></a></li>
       </ul>
     </li>
     
     <li class='active has-sub'><a href='#'><span>Preferences</span></a>
       <ul>
         <li><a href='menu.php?item=preferences&action=ap'><span>Add preferences</span></a></li>
         <li><a href='menu.php?item=preferences&action=ep'><span>Edit Preferences</span></a></li>
       </ul>
     </li>
     
   <?php } ?>
    <li class='active has-sub'><a href='#'><span>Settings</span></a>
     <ul>
       <li><a href='menu.php?item=Settings&&type=account'><span>Account</span></a></li>
	   <?php if(strtoupper($_SESSION['category']) == "ADMIN_USER"){ ?>
          <li><a href='menu.php?item=Settings'><span>Location</span></a></li>
          <li><a href='menu.php?item=Settings'><span>Visit requests</span></a></li>
          <li><a href='menu.php?item=Settings'><span>Uploads</span></a></li>
          <li><a href='menu.php?item=Settings'><span>Payments</span></a></li>
          <li><a href='menu.php?item=Settings'><span>Events</span></a></li>
          <li><a href='menu.php?item=Settings'><span>Multimedia</span></a></li>  
       <?php } ?>
     </ul>
    </li>
  </ul>
</div>

  
  
  <!-- MENU ITEM CONTENTS DIV (OPEN) -->
  <div class="menu_item_content_display" id="menu_item_contents">
  
   <?php 
  if(isset($_GET['item']) && $_GET['item'] == "Start"){
     include("includes/service_items/start_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Notifications"){
     include("includes/service_items/notification_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "messages"){
     include("includes/service_items/message_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "conversations"){
     include("includes/service_items/conversation_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Dashboard"){
     include("includes/service_items/dashboard.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Visitation profile"){
     include("includes/service_items/visitation_profile_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Events"){
     include("includes/service_items/event_item.php");
  }
  
  elseif(isset($_GET['item']) && $_GET['item'] == "finance"){
    if($_GET['exac'] == "commission"){
       include("includes/service_items/commission_item.php");
	}elseif($_GET['exac'] == "tax"){
	   include("includes/service_items/tax_item.php");
	}
  }
  
  elseif(isset($_GET['item']) && $_GET['item'] == "Visit Requests"){
     include("includes/service_items/visitation_request_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Users"){
     include("includes/service_items/user_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Personal profile"){
     include("includes/service_items/personal_profile_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Factory profile"){
     include("includes/service_items/company_profile_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Factory gallery"){
     include("service_items/factory_gallery_item.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "searches"){
     include("includes/service_items/searches.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "preferences"){
     include("includes/service_items/preferences.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Approvals"){
     include("includes/service_items/approvals.php");
  }
  elseif(isset($_GET['item']) && $_GET['item'] == "Settings"){
     include("includes/service_items/settings_item.php");
  }
?>
 


 </div>

  <!-- MENU ITEM CONTENTS DIV (CLOSE) -->
  </div>  
  
  
  
  <!-- MAIN PANEL DIV(CLOSE)-->
 </div>
  
 <!--</div>-->
 
<div class="clear"></div>
<!--footer start-->
<?php require_once "includes/footer.php"; ?>  
<!--footer end-->
<!-- OUTERMOST div (CLOSE) -->  




</body>
</html>