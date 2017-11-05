<?php ob_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Factory profile</title>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/view.css"/>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" type="text/css" href="css/drop_menu.css" />

<script type="text/javascript">
   function mycarousel_initCallback(carousel) {
        // Disable autoscrolling if the user clicks the prev or next button.
        carousel.buttonNext.bind('click', function () {
            carousel.startAuto(0);
        });

        carousel.buttonPrev.bind('click', function () {
            carousel.startAuto(0);
        });

        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function () {
            carousel.stopAuto();
        }, function () {
            carousel.startAuto();
        });
    };

    jQuery(document).ready(function () {
        jQuery('#mycarousel').jcarousel({
            auto: 2,
            wrap: 'last',
            initCallback: mycarousel_initCallback
        });
    });
</script>

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<script src="js/visits.js"></script>
<script src="js/start-item.js"></script>
<script src="js/message.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<!-- </msdropdown> -->

<!--flag-->
<link rel="stylesheet" type="text/css" href="css/skin2.css" />
<link rel="stylesheet" type="text/css" href="css/flags.css" />
<!--flag end-->

<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/event.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/styles_leftmenu.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css"  href="css/skin.css" />

</head>



<body class="black_bg">

<?php 
    session_start();
	require_once("includes/utilities/database_utilities/database_connection.php");
	include("Query.php");
	require_once("includes/utilities/database_utilities/queries.php");
	require_once("includes/utilities/validators/field_validator.php");
	require_once("includes/utilities/validators/validator.php");
	
	include("user.php");
	require_once("includes/user_classes/company_representative.php");
	require_once("includes/user_classes/visitor.php");
	
    include("menu_item.php");
	include ("privileges.php");
	require_once "includes/utilities/country.php";
	require_once "includes/utilities/sector.php";
	require_once "includes/utilities/booking.php";
	require_once "includes/utilities/emailer.php";
	include("includes/utilities/date_time.php");
	
	$db_obj = new Database();
	$db_obj->connect_to_the_server(); // Consider using a singleton
	$db_obj->create_database();
	$db_obj->select_database();
	$db_obj->create_tables();	     
	$selection_obj = new SelectQuery();
	$insertion_obj = new InsertionQuery();
	
	$validator_obj = new Validator();
	$country_obj = new Country(); 
?>


  <div class="clear"></div>
  
  <div class="event_create">
  
     <?php 
	     
		 $date_time_obj = new DateTimePicker();
		 $factory_id = $validator_obj->clean_get_number($_GET['factory_id']);  //  check for injections 
		 $branch_id = $validator_obj->clean_get_number($_GET['branch_id']);    //  check for injections
		 
		 $query = $selection_obj->select_factory_data2($factory_id, $branch_id);
		 if(mysql_num_rows($query) == 0){
		    header("Location: menu.php?item=Start");
		 }
		 $address_query = $selection_obj->select_factory_address($factory_id, $branch_id);
		 $visit_purpose_query = $selection_obj->select_factory_visit_purpose($factory_id, $branch_id);
		 $visit_type_query = $selection_obj->select_factory_visit_type($factory_id, $branch_id);
		 $gallery_query = mysql_query($selection_obj->select_factory_photos2($factory_id, $branch_id)) or die(mysql_error());
		 $subscription = "";
		 if(isset($_SESSION['user_id'])){
		   $subscription = $selection_obj->check_a_user_subscription($_SESSION['user_id'], $factory_id, $branch_id);
		 }
		 
		 $date = $date_time_obj->getDate();
		 $time = $date_time_obj->getTime();
		 $event_query = mysql_query($selection_obj->select_upcoming_factory_event($factory_id, $branch_id, $date, $time)) or die(mysql_error());
		 
		 while($row = mysql_fetch_array($query)){
		    $address = mysql_fetch_array($address_query);
			$type = mysql_fetch_array($visit_type_query);
			$sector = $row['sector'];
			$country_name = "N/A";
			foreach($country_obj->get_countries() as $key => $value){
			    if($key == $address['country']){
				   $country_name = $value;
			    }
		    }
	   ?>
  
     <h2><?= $row['name'] ?></h2>
     <div class="border"></div>
     
     <div class="column_left2"> 
           <table width="100%" cellspacing="10" class="profile_tbl">
                 <tr>
                   <td><h3>Address:</h3></td>
                   <td>street <?= $address['street'] ?>,&nbsp;<?= $address['postal_code'] ?>&nbsp;<?= $address['city'] ?>,&nbsp;<?= $country_name ?></td>
                 </tr> 
             <?php if(isset($address['block'])){ ?>
                 <tr>
                   <td><h3>Block:</h3></td>
                   <td><?= $address['block'] ?></td>
                 </tr>
             <?php } ?> 
             <?php if(isset($address['block']) && isset($address['floor'])){ ?>
                 <tr>
                   <td><h3>Floor:</h3></td>
                   <td><?= $address['floor'] ?></td>
                 </tr> 
             <?php } ?>     
                 <tr>
                  <td><h3>Acceptable visit purposes</h3></td>
                  <td>
                    <ul>
                    <?php  while($purpose = mysql_fetch_array($visit_purpose_query)){ ?>
                    <li><?= $purpose['visit_purpose'] ?></li>
                    <?php } ?>
                    </ul>
                  </td>
                 </tr>           
                      
                 <tr>
                  <td><h3>Acceptable visit types</h3></td>
                  <td>
                    <ul><?php while($type = mysql_fetch_array($visit_type_query)){ ?>
                     <li><?= $type['visit_type'] ?></li>
                      <?php } ?>
                    </ul>
                  </td>
                 </tr>
             </table>
     </div><!-- column_left2 -->
    
     <div class="column_right2">
     <div class="banner2">
     <?php 
	  $count = mysql_num_rows($event_query);
	  if($count > 0){ ?>
       <h3>Upcoming events <?php $count ?></h3>
       <ul id="mycarousel" class="jcarousel-skin-tango1" >
     <?php 
      while($event = mysql_fetch_array($event_query)){
		 $event_id = $event['event_id'];
		 $pricing = $selection_obj->select_charges($event_id);
		 $event_title = $event['event_title'];
		 $start_time = $event['start_time'];
		 $end_time = $event['end_time'];
		 $start_date = $event['start_date'];
		 $end_date = $event['end_date'];
		 $primary_image = $selection_obj->select_primary_event_photo($event_id);
		 $directory = "images/gallery/";
		 $image_src = $directory."".$primary_image;
		 
		 $charge = "";
		 while($price = mysql_fetch_array($pricing)){ 
		   $charge = round($price['unit_price'], 2)."Kr ".ucwords($price['category'])."<br />";
		 }
		 $count++;
	  ?>
      <li>
       <a href="unique_event.php?event_id=<?= $event_id ?>"><img src="<?= $image_src ?>" width="300" height="270" alt="" /><span><?= $event_title ?></span></a>
      </li>
      <?php } ?>
   </ul>      
   <?php }/* No upcoming events */ ?>
   
   <?php if($count < 1){ /* Show a gallery instead */?> 
    <h3>Gallery</h3>
    <ul id="mycarousel" class="jcarousel-skin-tango1" >
    <?php 
	  while($gallery = mysql_fetch_array($gallery_query)){
		  $directory = "images/gallery/";
		  $image_name = $gallery['image_name'];
		  $image_src = $directory."".$image_name;
	?>
      <li><a href="#"><img src="<?= $image_src ?>" width="300" height="270" alt="Default" /><span>Gallery</span></a></li>
      <?php } ?>
      <li><a href="#"><img  src="images/visit_my_factory_slider2.jpg" width="300" height="270" alt="" /><span>Gallery</span></a></li>
    </ul> 
    <?php } ?> 
       
  </div>
  <!--end banner2-->
             
   <?php if(isset($_SESSION['user_id']) && mysql_num_rows($event_query) < 1){ $col_count = 2; ?>
       <div class="sendmessage"><!--sendmessage-->
       <table width="100%" cellspacing="2" border="0" class="profile_tbl">
          <tr>
            <td>
              <div class="send_button" id="send_message_button" onclick="showMessageWritingArea()"><img src="images/icon/message_icon.png" title="Send us a message"/></div>
            </td>
		<?php if($subscription == false): $col_count++; ?>
            <td>
             <a href="factory.php?factory_id=36&&branch_id=1&&subscription=accept"><button class="send_button" type="submit">Subscribe to events</button></a>
            </td>
	   <?php endif; ?>
       <?php $col_count++; ?>
           <td>
            <button class="send_button" style="display:block" type="button" onclick="showMessageWritingArea2()">Request an unsolicited visit</button>
           </td>
         </tr>
         
         <tr>
            <td colspan="<?= $col_count ?>">
              <div id="send_message_div" style="display:none">
              <?php  include "includes/service_action/send_message.php"; ?>
              </div>
            </td>
          </tr>
       </table>
      </div><!--sendmessage-->
       <?php } ?>
    </div>

    <?php } /* outermost while loop */ ?>
    
    <div class="clear"></div>  
    </div> 
    
    
       <?php 
	       if(isset($_GET['subscription']) && strtolower($_GET['subscription']) == "accept"){
		   
		        $insertion_obj->user_subscriptions($factory_id, $branch_id, $_SESSION['user_id'], 0); // Actual thread of messages begins here.
				$factory_email = $selection_obj->get_factory_email($factory_id, $branch_id);
				
				$subscribers_info = $selection_obj->select_user_by_id($_SESSION['user_id']);
		        $subscribers_row = mysql_fetch_array($subscribers_info);
		        $subscribers_email = $subscribers_row['email'];
				
				$factory_name = $selection_obj->get_a_factory_name($factory_id, $branch_id);
				
				$no_reply_email = Email::getNoReplyEmail();
				$admin_email = Email::getAdminEmail();
				$contact_us_email = Email::getContactUsEmail();
				
				// the subcriber and the one subscribed to will each get notified.
				$subject = "A subcription has been made.";
			    $message = "A user has subscribed to your events, and news letters, this means that every time you add events, users will be notified.";
			    mail($factory_email, "$subject", $message, "From:" . $no_reply_email);
				
			    /*echo  "<script>alert(\" $subscribers_email , $factory_email , $no_reply_email, $admin_email , $contact_us_email \");</script>";*/
				
			    $message = "You have subscribed to $factory_name events.";
			    mail($subscribers_email, "$subject", $message, "From:" . $no_reply_email);
				
				//Maybe we will tell the admins about this as well, maybe not :)
				$message = "A user has subscribed to $factory_name events.";
				mail($admin_email, "$subject", $message, "From:" . $no_reply_email);
				mail($contact_us_email, "$subject", $message, "From:" . $no_reply_email);

			    header("Location: factory.php?factory_id=$factory_id&&branch_id=$branch_id");
		  }
	   ?>
   


</body>
</html>
