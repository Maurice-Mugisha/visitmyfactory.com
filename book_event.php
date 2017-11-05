<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visit my Factory</title>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/drop_menu.css" />

<!--for flag-->

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<!-- </msdropdown> -->

<link rel="stylesheet" type="text/css" href="css/skin2.css" />
<link rel="stylesheet" type="text/css" href="css/flags.css" />
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<!--flag end-->
<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="css/event.css" type="text/css" media="screen" />
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
	$db_obj = new Database();
	$db_obj->connect_to_the_server(); // Consider using a singleton
	$db_obj->create_database();
	$db_obj->select_database();
	$db_obj->create_tables();
	
	$selection_obj = new SelectQuery();
	$insertion_obj = new InsertionQuery();
	$deletion_obj = new DeleteQuery ();
	$validator_obj = new Validator();
	$date_obj = new DateTimePicker();
	
?>

<!--header start-->	
  <?php  require_once "includes/header.php";   ?>
<!--end header-->

<div class="clear"></div>

<?php 
    if(isset($_GET['tmp_booking_number'])){
	   $get_based_event_id = $validator_obj->clean_get_number($_GET['event_id']);
	   $booking_number = $validator_obj->clean_get_number($_GET['tmp_booking_number']); //check for injections at this point, and that this booking number belongs to this user
	   $event_id = $selection_obj->select_an_event_id($booking_number);
	   if($get_based_event_id != $event_id)
	       header("Location: index.php");
	   $check_permission = $selection_obj->check_a_booking_number($_SESSION['user_id'], $booking_number, $event_id);
	   if($check_permission == false)
	      header("Location: unique_event.php?event_id=$event_id");
		  
	   $query = mysql_query($selection_obj->select_a_factory_event($event_id));
	   $user = mysql_fetch_array($selection_obj->select_user_by_id($_SESSION['user_id']));

       // get the factory's fixed and variable commission
	   $factory_query = mysql_query($selection_obj->select_a_factory_event($event_id));
	   $factory = mysql_fetch_array($factory_query);
	   
	   $factory_id = $factory['factory_id']; 
	   $branch_id = $factory['branch_id']; 
	   $fixed_commission_date = $selection_obj->current_commission_date($factory_id, $branch_id, "FIXED");
	   $variable_commission_date = $selection_obj->current_commission_date($factory_id, $branch_id, "VARIABLE");
	   
	   $fixed_commission = $selection_obj->commission($factory_id, $branch_id, "FIXED", $fixed_commission_date);
	   $variable_percentage = $selection_obj->commission($factory_id, $branch_id, "VARIABLE", $variable_commission_date);
	   $country_code = $selection_obj->select_factory_country($factory_id, $branch_id);
	   $tax_date = $selection_obj->current_tax_date($country_code);
	   $tax_rate = $selection_obj->tax_rate($country_code, $tax_date);
	   
	   //add everything to the amount that the user has got to pay.
	   
	   $amount = $selection_obj->calculat_total_charge($booking_number);
	   
	   ///////This is the final amount to be charge from the user
	   $variable_commission = ($variable_percentage/100) * $amount;
	   $total_commission = ($variable_commission + $fixed_commission);
	   $tax = ($tax_rate/100) * $total_commission;
	   $total = round(($total_commission + $tax + $amount), 2); //the customer pays our taxes?!
	   $total = floatval(str_replace(',', '.', $total));
/* 	   echo "<br /> Factory id: ".$factory_id;
	   echo "<br />Branch id: ".$branch_id;
	   echo "<br /> Fixed commission date : ".$fixed_commission_date;
	   echo "<br /> Variable commission date: ".$variable_commission_date;
	   echo "<br /> Fixed commission: ".$fixed_commission;
	   echo "<br /> Variable commission: ".$variable_percentage."%";
	   echo "<br />Country code: ".$country_code;
	   echo "<br /> Tax rate: ".$tax_rate;
	   echo "<br /> Total payment to be displayed: ".$total; */
	   
	   while($row = mysql_fetch_array($query)){
	      
		  $address_query = $selection_obj->select_factory_event_address($event_id);
		  $address = mysql_fetch_array($address_query);
?>

<div class="wreper">
<div class="content">

    <div class="left_book_event" style="width:60%;">
    <h2>Book your visit</h2>

     <table width="100%" cellspacing="10">
        <tr>
        <td colspan="2"><div class="border"></div></td>
        </tr>
        <tr>
        <td></td>
        </tr>
        <tr>
        <td><h3>What we’ll do</h3></td>
        <td><?= $row['wwwd'] ?></td>
        </tr>
        
        <tr>
        <td><h3>What I’ll provide</h3></td>
        <td><?= $row['wwwp'] ?></td>
        </tr>
        <tr>
        <td><h3>Where we’ll be</h3></td>
        <td><?= $address['block'] ?> &nbsp; <?= $address['street'] ?>,   
        <?= $address['postcode'] ?>  &nbsp; <?= $address['city'] ?>.
        <?= $address['country'] ?>. <br />
        <?= $row['wwwb'] ?>
        </td>
        </tr>
        <tr>
        <td width="30%"><h3>Age</h3></td>
        <td>All ages between <strong><?= $row['min_age'] ?></strong> and <strong><?= $row['max_age'] ?></strong></td>
        </tr>
        <tr>
        <td><h3>Government ID</h3></td>
        <td><strong>You’ll need to come with your ID</strong>.</td>
        </tr>
        <tr>
        <td><h3>Terms of service</h3></td>
        <td>When you book, you agree to the <a href="#">factory's Additional Terms of Service</a>, Guest Release and Waiver, and Cancellation Policy.
        </td>
        </tr>
        <tr>
        <td></td>
        </tr>
        
        <tr>
        <td colspan="2"><div class="border"></div></td>
        </tr>
        
        <tr>
         <td colspan="2">
              <div  style="text-align:center; margin-left:auto; margin-right:auto;" >
               <?php require_once 'stripe/init.php'; ?>
                <form action=" " method="POST">
                    <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button button"
                      data-key="<?= $stripe['publishable'] ?>"
                      data-amount="<?= round($total, 2) ?>"
                      data-name="Pay for "
                      data-description="<?= $row['event_title'] ?>"
                      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                      data-locale="auto"
                      data-currency="dkk"
                      data-email="<?= $user['email'] ?>"
                      data-zip-code="false">
                    </script>
                </form>
              </div>
         </td>
        </tr>
        
        </table>
   </div>

   <div class="rgt_book_event">
     <table cellpadding="10px;" width="100%">
      <tr>
        <td><h3>Date</h3></td>
        <td>
        <h3><?= $date_obj->getReadableDate($row['start_date']) ?></h3>
        <?php if($row['start_date'] != $row['end_date']) { ?>
        to 
        <h3><?= $date_obj->getReadableDate($row['end_date']) ?></h3>
        <?php } ?>
        </td>
       </tr>
       <tr>
        <td><h3>Time</h3></td>
        <td><h3><?= $date_obj->formatTime($row['start_time']) ?> to <?= $date_obj->formatTime($row['end_time']) ?></h3></td>
        </tr>
       <tr>
        <td><h3>Language</h3></td>
        <td><h3>Offered in <?= $row['host_language'] ?></h3></td>
        </tr>
       <tr>
        <td class="border" colspan="2"></td>
       </tr>
        <?php 
              $charges = $selection_obj->select_charges($event_id);
              while($row2 = mysql_fetch_array($charges)):
                  $category = $row2['category'];
                  $unit_price = round($row2['unit_price'], 2);
                  $count = $selection_obj->count_a_users_tickets($booking_number, $category);
        ?>
        <tr>
           <td><h3><?= $unit_price ?> kr x <?= $count ?> <?= ucwords($category)?></h3></td>
           <td><h3><?= ($count * $unit_price) ?> kr</h3></td>
        </tr>
        <?php 
            endwhile;
        ?>
        <tr>
           <td><h3>Service fee</h3></td>
           <td><h3><?= $total_commission ?> kr</h3></td>
        </tr>
        <tr>
           <td><h3>Tax (<?= $tax_rate ?>% of <?= $total_commission ?>)</h3></td>
           <td><h3><?= $total_commission ?> kr</h3></td>
        </tr>
        <tr>
          <td><h3>Total</h3></td>
          <td><h3><?= round($total, 2) ?> kr</h3></td>
        </tr>
      </table>
    </div>

  </div>
</div>

 <?php include("stripe/charge.php"); ?>

<?php 
       } 
    }
?>
<div class="clear"></div>
<?php require_once "includes/footer.php"; ?> 
</div>



</body>
</html>
