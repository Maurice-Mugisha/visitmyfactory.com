<?php ob_start(); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visit my Factory</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
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
      auto: 2, wrap: 'last', initCallback: mycarousel_initCallback
  });

  });
</script>



<!--for flag-->







<!-- <msdropdown> -->



<link rel="stylesheet" type="text/css" href="css/dd.css" />



<script src="js/msdropdown/jquery.dd.js"></script>



<!-- </msdropdown> -->



<link rel="stylesheet" type="text/css" href="css/menu.css" />



<link rel="stylesheet" type="text/css" href="css/skin2.css" />



<link rel="stylesheet" type="text/css" href="css/flags.css" />



<!--flag end-->
<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/styles_leftmenu.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/tabs.css" />

<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>

<!--jCarousel skin stylesheet-->
<link rel="stylesheet" type="text/css"  href="css/skin.css" />
<link rel="stylesheet" type="text/css" href="css/login.css" />


</head>







<body>


 <?php 
    session_start();

    error_reporting(E_ALL);
	include("query.php");
    require_once("includes/utilities/database_utilities/database_connection.php");
    require_once("includes/utilities/database_utilities/queries.php");
    include("includes/utilities/validators/field_validator.php");
	include("includes/utilities/validators/validator.php");
    include("includes/utilities/country.php");
    include("includes/authentication/login.php");
    include("user.php");
    require_once 'includes/libraries/Mobile_Detect_2_8_24/Detect_Device.php';
    require_once "includes/utilities/date_time.php";
    $selection_obj = new SelectQuery();
    $date_time_obj = new DateTimePicker();
 ?>


   <!--start header-->
   <?php 
      if(isset($_SESSION['user_id'])){
         require_once "includes/header.php"; 
      }else{
         require_once "includes/header_b.php";
      }
   ?>
   <!--end header-->



<div class="clear"></div>





<div class="wreper">
  <div class="content">
  
  <h1><span class="title">Come! </span>See Behind the Scenes</h1>
 
  <!--search form-->
  <div class="contact_form">
  <form id="contact-form" action="" method="get" class="form-validate">
    <fieldset>
     <div class="row-fluid">
       <div class="span4">
        <label class="hasTooltip required" title="Enter your Destination here">Where<span class="star"></span></label>					
        <div class="controls"><input type="text" name="destination"  value=""   placeholder="Destination, City, Address" /></div>
       </div>
       <div class="span4">
         <label class="hasTooltip required" title="Enter your date for visit">When<span class="star"></span></label>					
         <div class="controls"><input type="date" name="date" value=""    placeholder="Visiting date"/></div>
       </div>
       <div class="span4">
         <label class="hasTooltip required" title="Enter visiters here">Visitors</label>	
         <div class="controls"><input type="text" name="visitor"  value=""   placeholder="1 visitor" /></div>
       </div>
       <div class="controls" style="float:right;">
         <button class="button validate btn-primary pull-right" type="submit" name="search">Search</button>
       </div>
      </div>
     </fieldset>
    </form>
    </div>
    <!--search form end-->






    <!--banner-->
    <div class="banner">
     <ul id="mycarousel" class="jcarousel-skin-tango">
      <?php 
       // default display of events based on the date
       $current_date = $date_time_obj->getDate();
       $events_query = $selection_obj->select_first_ten_factory_events($current_date);
       $count = mysql_num_rows($events_query);
       $e = 0;
       while($row = mysql_fetch_array($events_query)):
           $e++;
           $event_id = $row['event_id'];
           $event_title = $row['event_title'];
           $primary_image = $selection_obj->select_primary_event_photo($event_id);
       ?>
           <?php if($e%5 == 0):  ?>
               <li>
                 <a href="unique_event.php?event_id=<?= $event_id ?>">
                    <img  src="images/events/<?= $primary_image ?>"  alt="<?= $event_title ?>" />
                 </a>
               </li>
           <?php else: ?>
               <li>
                <a href="unique_event.php?event_id=<?= $event_id ?>">
                 <img  src="images/events/<?= $primary_image ?>" width="260" height="200" alt="<?= $event_title ?>" />
                </a>
                <div class="clear"></div>
               </li>
           <?php endif; ?>
       <?php endwhile; ?>
      </ul>
     </div>
  <!--end banner-->

  </div><!--end wrepper-->
 </div><!--end content-->



<div>
 <div class="content">
  <div>
   <div style="display:block;">
  <?php 
     if(isset($_GET['search'])){
           $date = $_GET['date'];
           $destination = $_GET['destination'];
           $visitor = $_GET['visitor'];
           $events_query = $selection_obj->select_factory_events_by_location($destination, get_country($destination), $date, $visitor);
           $count = mysql_num_rows($events_query);
           
		   if($count > 0):
		   
           while($row = mysql_fetch_array($events_query)):
              $event_id = $row['event_id'];
              $children_charge = $selection_obj->get_category_charge($event_id, "CHILDREN");
              $adults_charge = $selection_obj->get_category_charge($event_id, "ADULTS");
              $primary_image = $selection_obj->select_primary_event_photo($event_id);
   ?>
             <div style="display:inline-block">
               <a href="unique_event.php?event_id=<?= $event_id ?>">
                <div class = "event-instance event_col" style="margin: 10px;">
                  <img src="images/events/<?= $primary_image ?>"  width="260px" height="200px" />
                  <p><span class="prize"><?= $adults_charge ?> - <?= $children_charge ?> Kr</span><?= $row['event_title'] ?></p>
                </div>
               </a>
             </div>
        <?php
             endwhile;
			 // else there are no events, what do we do now if we cannot find any events at the moment? ask the factory for a visit!
          else:  
        ?>
            <center> 
              <label id="design-me-smita>" style="font-size:26px; font-weight:bold;">No events have been found that match your search terms</label>
            </center>
            <center>
              <label id="design-me-smita>" style="font-size:16px; font-weight:800;"> You can imporve your search by: <br /></label>
            </center>
        
            <ul style="margin-left: 40%; margin-right:30%;">
              <li>Checking your spellings and date</li>
              <li>Check other cities and destinations</li>
              <li>Start unsolicited visit request to factories</li>
            </ul>
        <?php  endif; ?>
        <?php } ?>
    </div>
   </div>
 </div>
</div>



<div class="clear"></div>
<?php 
  //returns a single country if any, otherwise none.
  function get_country($destination){
     $validator_obj = new Validator();
     $destinations = explode(" ", $validator_obj->clean_search_term($destination));
	 $country_obj = new Country();
     $countries = $country_obj->get_countries();
	 for($x = 0; $x<sizeof($destinations); $x++){
        foreach($countries as $key => $value) {
		  $destination = trim($destinations[$x]);
		  if(strtoupper($value) == strtoupper($destination) && strlen($destination) > 0){
		     echo $value;
		     return $key;
		   }
	    }
	 }
    return " ";
  }
?>



<div class="gray_box">
  <div class="content">
  <div class="gray_content">
      <h2 style="text-align:center">About us</h2>
      <p class="center">Have you ever wondered how products you see in your daily life are made? 
                        Do you want to assess with your own eyes the quality applied for their preparation?
      </p>
      <p class="center">Visit my Factory ApS has been created by curious consumers and citizens, 
                        willing to open the doors of factories and production facilities to a larger public.
      </p>
    
      <div class="button" style="text-align:center; margin-left:auto; margin-right:auto; margin-top:30px; width:90px"><a href="about.php">Read more</a></div>
      <div class="clear"></div>
  </div>
  </div>
</div>






<div class="clear"></div>


<!--footer-->
  <?php  require_once "includes/footer.php"; ?>
<!--end footer-->


</div>





<!-- OVERLAY FOR THE USER TO LOGIN -->
     <?php include("includes/forms/login_form.php");?>
     <?php include_once("includes/authentication/login_with_gmail.php"); ?>
<!--  END OF THE LOGIN OVERLAY -->



</body>


</html>