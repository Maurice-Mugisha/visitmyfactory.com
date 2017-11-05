<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visit my Factory</title>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script src="js/number_input.js"></script>
<link rel="stylesheet" type="text/css" href="css/drop_menu.css" />

<!--for flag-->

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
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
<link rel="stylesheet" type="text/css" href="css/login.css" />
<link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css"  href="css/skin.css" />
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/booking.js"></script>
<!-- gallery-->
 <link href="css/galleria.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.galleria.pack.js"></script>
	<script type="text/javascript">

	    jQuery(function ($) {

	        $('.gallery_demo_unstyled').addClass('gallery_demo'); // adds new class name to maintain degradability
	       
	        $('ul.gallery_demo').galleria({
	            history: true, // activates the history object for bookmarking, back-button etc.
	            clickNext: true, // helper for making the image clickable
	            insert: '#main_image', // the containing selector for our main image
	            onImage: function (image, caption, thumb) { // let's add some image effects for demonstration purposes

	                // fade in the image & caption
	                if (!($.browser.mozilla && navigator.appVersion.indexOf("Win") != -1)) { // FF/Win fades large images terribly slow
	                    image.css('display', 'none').fadeIn(1000);
	                }
                       caption.css('display', 'none').fadeIn(1000);

	                // fetch the thumbnail container
	                var _li = thumb.parents('li');

	                // fade out inactive thumbnail
	                _li.siblings().children('img.selected').fadeTo(500, 0.5);

	                // fade in active thumbnail
	                thumb.fadeTo('fast', 1).addClass('selected');

	                // add a title for the clickable image
	                image.attr('title', 'Next image >>');
	            },


	            onThumb: function (thumb) { // thumbnail effects goes here

	                // fetch the thumbnail container
	                var _li = thumb.parents('li');

	                // if thumbnail is active, fade all the way.
	                var _fadeTo = _li.is('.active') ? '1' : '0.5';

	                // fade in the thumbnail when finnished loading
	                thumb.css({ display: 'none', opacity: _fadeTo }).fadeIn(1500);

	                // hover effects
	                thumb.hover(
					function () { thumb.fadeTo('fast', 1); },
					function () { _li.not('.active').children('img').fadeTo('fast', 0.5); } // don't fade out if the parent is active
				)
	            }
	        });

	       
           	    });
	</script>
    
</head>

<body>


<?php 
    session_start();
	require_once("includes/utilities/database_utilities/database_connection.php");
	include("query.php");
	require_once("includes/utilities/database_utilities/queries.php");
	require_once("includes/utilities/validators/field_validator.php");
	include("includes/utilities/validators/validator.php");
	require_once "includes/utilities/date_time.php";
	require_once "includes/utilities/country.php";
	
	$db_obj = new Database();
	$db_obj->connect_to_the_server(); // Consider using a singleton
	$db_obj->create_database();
	$db_obj->select_database();
	$db_obj->create_tables();
	
	$selection_obj = new SelectQuery();
	$insertion_obj = new InsertionQuery();
	$date_obj = new DateTimePicker();
	$validator_obj = new Validator();
	$country_obj = new Country();
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


<?php 
   function formatTime($time_string){
		 $hrs_and_mins = explode(":", $time_string);
		 $new_string = "";
		 if(strlen($hrs_and_mins[0]) == 1)
		   $new_string .= "0".$hrs_and_mins[0];
		 elseif(strlen($hrs_and_mins[0]) == 0){
		   $new_string .= "00";
		 }
		 elseif(strlen($hrs_and_mins[0]) == 2){
		   $new_string .= $hrs_and_mins[0];
		 }
		 $new_string .= ":";
		 if(strlen($hrs_and_mins[1]) == 1){
		   $new_string .= "0".$hrs_and_mins[1];
		 }elseif(strlen($hrs_and_mins[1]) == 0){
		   $new_string .= "00";
		 }
		 elseif(strlen($hrs_and_mins[1]) == 2){
		   $new_string .= $hrs_and_mins[1];
		 }
		 
		 if( (strlen($hrs_and_mins[0]) + strlen($hrs_and_mins[1])) == 4)
		   $new_string = $time_string;
		 return $new_string;
   }
?>

<?php 
    
  $event_id = "";
  $address = "";
  $event_title = "";
  $start_date = "";
  $end_date = "";
  $start_time = "";
  $end_time = "";
  $host_language = "";
  $wwwd = "";
  $wwwp = "";
  
  $maximum = "";
  $bookings = "";
  $percentage = "";
  $remaining = "";
  $country_name = "";
  
  if(isset($_GET['event_id'])){
	   
	   $event_id = $validator_obj->clean_get_number($_GET['event_id']); //checked for injections at this point
	   $query = mysql_query($selection_obj->select_a_factory_event($event_id));
	   
	  while($row = mysql_fetch_array($query)){
	      
		  $address_query = $selection_obj->select_factory_event_address($event_id);
		  $address = mysql_fetch_array($address_query);
		  $event_title = $row['event_title'];
		  $start_date = $date_obj->getReadableDate($row['start_date']);
		  $end_date = $date_obj->getReadableDate($row['end_date']);
		  $start_time = $row['start_time'];
		  $end_time = $row['end_time'];
		  $host_language = $row['host_language'];
		  $wwwd = $row['wwwd'];
		  $wwwp = $row['wwwp'];
		  
		  $maximum = $selection_obj->count_allowed_bookings($event_id);
		  $bookings = $selection_obj->count_event_bookings($event_id);
		  $percentage = round(($bookings/$maximum)*100, 2);
		  $remaining = $selection_obj->check_remaining_tickets($event_id);
		  $country_name = $country_obj->get_country_name($address['country']);
?>


<div class="wreper">
<div class="content">
   <div class="column_left">
        <h2><?= $event_title ?></h2>
        <table width="100%" cellspacing="10">
           <tr>
            <td colspan="2"><div class="border"></div></td>
            </tr>
           <tr>
            <td><img src="images/icon/date_icon.jpg" /></td>
            <td><h3><?= $start_date ?></h3></td>
          </tr>
            <tr>
            <td><img src="images/icon/time_icon.jpg" /></td>
            <td><h3><?= formatTime($start_time); ?> to <?= formatTime($end_time); ?></h3></td>
           </tr>
            <tr>
            <td><img src="images/icon/talk_icon.jpg" /></td>
            <td><h3>Offered in <?= $host_language ?></h3></td>
           </tr>
           <tr>
            <td colspan="2"><div class="border"></div></td>
           </tr>
           <tr>
            <td colspan="2"><h3>What we’ll do</h3></td>
           </tr>
           <tr>
            <td colspan="2"><?= $wwwd ?></td>
           </tr>
           <tr>
            <td colspan="2"><h3>What I’ll provide</h3></td>
           </tr>
           <tr>
            <td colspan="2"><?= $wwwp ?></td>
           </tr>
           <tr>
            <td colspan="2"><h3>Where we’ll be</h3></td>
           </tr>
           <tr>
            <td colspan="2">
            <?= $address['street'] ?> &nbsp; <?= $address['block'] ?>,   
            <?= $address['postcode'] ?> &nbsp; <?= $address['city'] ?>,
            <?= $country_name ?>.<br />
            <?= $row['wwwb'] ?>
            </td>
           </tr>
           
           <tr>
            <td colspan="2"><h3>Notes</h3>
			<?= $row['notes'] ?>
            </td>
           </tr>
           <!--<tr>
            <td colspan="2"><img  src="images/map_icon.jpg"/> consider using the longitude and lattitude information right here with google maps
            <a href="#"><h3>Get Direction</h3></a>
            </td>
           </tr>-->
           </table>
    </div><!-- column_left -->

</div> <!--content-->


<?php 
    $event_gallery = $selection_obj->select_event_photos($event_id);
	$primary_image = $selection_obj->select_primary_event_photo($event_id);
?>
<div class="column_right">
    <div class="demo">
    
      <div id="main_image"></div>
      
      <ul class="gallery_demo_unstyled">
        <?php $i = 0; ?>
        <?php while($image = mysql_fetch_array($event_gallery)): ?>
            <?php if(!empty($primary_image)){  ?>
              <?php if(strtoupper($image['type']) == "PRIMARY"){ ?>
              <li class="active"><img src="images/events/<?= $primary_image ?>" alt="visit_my_factory" width="550px" height="330px" style="width:550px; height:330px"></li>
              <?php }else{ ?>
                 <li><img src="images/events/<?= $image['image_name'] ?>" alt="visit_my_factory" width="550px" height="330px" style="width:550px; height:330px"></li>
              <?php  } ?>
            <?php } elseif(empty($primary_image)){ ?>
				<?php if($i == 0){ ?>
                 <li class="active"><img src="images/events/<?= $image['image_name'] ?>" alt="visit_my_factory" width="550px" height="330px" style="width:550px; height:330px"></li>               <?php } else{ ?>
                  <li><img src="images/events/<?= $image['image_name'] ?>" alt="visit_my_factory" width="550px" height="330px" style="width:550px; height:330px"></li>
                <?php } ?>
            <?php } ?>
            
        <?php $i++; endwhile; ?>
       </ul>
       
       <?php if($i > 1):  ?>
       <p class="nav"><a href="#" onclick="$.galleria.prev(); return false;">&laquo; previous</a> | <a href="#" onclick="$.galleria.next(); return false;">next &raquo;</a></p>
       <?php else: ?>
         <p class="nav"><div class="clear"></div></p>
       <?php endif; ?>
       
    </div>
    
 <?php 
      $charges = $selection_obj->select_charges($event_id);
	  $children = 0;
	  $adults = 0;
	  $accept_children = false;
	  while($row2 = mysql_fetch_array($charges)){
	      $category = $row2['category'];
	      $unit_price = round($row2['unit_price'], 2);
		  
		  if(strtoupper($category) == "CHILDREN"){
		      $children = $unit_price;
			  $accept_children = true;
		  }elseif(strtoupper($category) == "ADULTS"){
		      $adults = $unit_price;
		  }
	  }
 ?>
  
    <?php $redirection = $selection_obj->select_event_redirect_link($event_id); ?>
    <?php if($redirection == ""): ?>
    <table cellpadding="10px;">
      <tr>
        <td><h3 style="width:50px; float:left"><?= $adults ?> Kr</h3> Per Person<br /></td>
        <td>
		 <?php if($accept_children == true){ ?>
            <h3 style="width:50px; float:left"><?= $children ?> Kr</h3> Per Child
		 <?php } else{ ?>
            <img src="images/icon/children_not_allowed.png" alt="No children allowed." style="width:35px; height:35px" title="Children are not allowed">
		 <?php }?>
        </td>
        <td>
          <a href="unique_event.php?event_id=<?= $event_id ?>&&book">
           <div class="button" style="text-align:center; margin-left:auto; margin-right:auto;  width:90px" >
            See Dates
           </div>
          </a>
        </td>
      </tr>
    </table>
    <?php else: ?>
    <table cellpadding="10px;">
      <tr>
        <td><h3 style="width:50px; float:left"><?= $adults ?> Kr</h3> Per Person<br /></td>
        <td>
		<?php if($accept_children == true){ ?>
           <h3 style="width:50px; float:left"><?= $children ?> Kr</h3> Per Child
		<?php } else{ ?>Children are not allowed<?php }?>
        </td>
        <td>
          <div class="button" style="text-align:center; margin-left:auto; margin-right:auto;  width:90px" >
           <a href="<?= $redirection ?>" id="myBtn">Continue to book</a>
          </div>
        </td>
      </tr>
    </table>
    <?php endif; ?>
    
</div><!--column right-->




<?php if(isset($_REQUEST['book'])): ?>

<div id="myModal" class="msg_details">
  <!-- Modal content -->
  <div class="msg-content" style="background:#FFFFFF">
     
     <!--<span class="close">&times;</span>-->
     <a href="unique_event.php?event_id=<?= $event_id ?>"><span class="close"><div onclick="close_message_overlay()">&times;</div></span></a>
     <h2>When do you want to go?</h2>
     
     <div class="all_dates">
     
        <div class="dates">
           <h3>
		    <?= $start_date ?>
			<?php if($start_date != $end_date){ echo " - ".$end_date; } ?></h3>
           <h3><?= formatTime($start_time); ?> to <?= formatTime($end_time); ?></h3>
           <p>Only <?= $remaining ?> spot(s) left (<?= (100 - $percentage) ?>%)</p>
        </div>
        
        <form method="post" action="">
        <div class="select_visitor">
          
            <table>
             <tr>
                <td>Adults</td>
                <td>
                <input type="hidden"  name="event_id" value="<?= $event_id ?>"  />
                <input type='button' id="minus_a" value='-' class='qtyminus' name="minus[]" onclick="reduce('adults')" />
                <input type='text' id="adults" name='adults' value='0' class='qty' onkeypress="return isNumberAndInRange(event, this.id, <?= $remaining ?>)" style="width:100px" />
                <input type='button' id="plus_a" value='+' class='qtyplus' name="plus[]" onclick="add('adults', <?= $remaining ?>)" />
                </td>
              </tr>
              <?php if($accept_children == true){ ?>
                  <tr>
                    <td>Children<br />(Ages 2 - 14)</td>
                    <td> 
                    <input type='button' id="minus_c" value='-' class='qtyminus' onclick="reduce('chilren')" />
             <input type='text' id="chilren" name='children' value='0' class='qty' onkeypress="return isNumberAndInRange(event, this.id, <?= $remaining ?>)"  style="width:100px" />
                    <input type='button' id="plus_c" value='+' class='qtyplus' onclick="add('chilren', <?= $remaining ?>)" />
                    </td>
                  </tr>
              <?php } ?>
              <tr>
                <td></td>
                <td align="center"><a href="#" style="font-size:16px; font-weight:bold">Apply</a></td>
              </tr>
            </table>
           
        </div><!-- select_visitor -->
        <div class="book">
          <div style="text-align:center; margin-left:auto; margin-right:auto; margin-top:30px; width:40px">
           <input type="submit" name="reserve" value="Book" class="button" />
          </div>
        </div><!--book-->
        </form>

     </div><!-- all dates -->
    
    <div class="clear"></div>
    <div class="clear"></div>

    <div class="all_dates">
 <?php 
     if(isset($_POST['reserve'])):
	 
	      $event_id = $_POST['event_id'];
		  $children = isset($_POST['children'])? $_POST['children'] : 0;
		  $adults = isset($_POST['adults']) ? $_POST['adults'] :0;
		  $date = $date_obj->getDate();
		  $time = $date_obj->getTime();
		  
		  $other_details = "";
		  $number_of_tickets = 0;
		  $other_details = "children:".$children.",adults:".$adults;
		  $number_of_tickets = ($children + $adults);
		  
		  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : NULL;
		  
		  $remaining = $selection_obj->check_remaining_tickets($event_id);
		  
		  if( isset($_SESSION['user_id']) ){
		          if(($number_of_tickets <= $remaining) && ($number_of_tickets > 0)){
						$insertion_obj->booking($event_id, $user_id, $date, $time, $number_of_tickets, $other_details);
						$booking_number = $selection_obj->select_a_booking_number($user_id, $date, $time, $event_id);
						header("Location: book_event.php?tmp_booking_number=".$booking_number."&&event_id=".$event_id);
				  }
				  if(($number_of_tickets > $remaining) && ($remaining > 0)){
						echo "<center>Sorry, only ".$remaining." tickets are available.</center>";
				  }
				  if($remaining == 0){
		                echo "<center>Sorry, all tickets have been sold.</center>";
		          }
				  if($number_of_tickets == 0){
		                echo "<center>You must book at least one ticket!</center>";
		          }
		  }
		  
		  else{
		       echo "<center>Sorry, you need to login or register to be able to book</center>";
		  }
		  
	 endif;
 ?>  
     </div><!-- all dates -->
   
    
  </div><!--modal-content-->
</div><!--myModal-->
<?php endif; /* if a book request is made */?>


<?php 
       }   /* while loop */
    }      /* isset() */
?>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>




<?php require_once "includes/footer.php"; ?> 


<!-- OVERLAY FOR THE USER TO LOGIN -->
     <?php include("includes/forms/login_form.php");?>
<!--  END OF THE LOGIN OVERLAY -->

</div>

</body>
</html>