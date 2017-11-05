<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visit my Factory</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/drop_menu.css" />

<!--for flag-->

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<!-- </msdropdown> -->

<link rel="stylesheet" type="text/css" href="css/skin2.css" />
<link rel="stylesheet" type="text/css" href="css/flags.css" />
<!--flag end-->
<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/login.css" />
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />

<!--for tab-->
<script type="text/javascript">

    $(document).ready(function () {

        //Default Action
        $(".tab_content").hide(); //Hide all content
        $("ul.tabs li:first").addClass("active").show(); //Activate first tab
        $(".tab_content:first").show(); //Show first tab content

        //On Click Event
        $("ul.tabs li").click(function () {
            $("ul.tabs li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content").hide(); //Hide all tab content
            var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            $(activeTab).fadeIn(); //Fade in the active content
            return false;
        });

    });
</script>

 
</head>

<body>

  <?php 
    session_start();
	require_once "query.php";
	require_once "includes/utilities/database_utilities/database_connection.php";
	require_once "includes/utilities/database_utilities/queries.php";
    require_once "includes/utilities/validators/field_validator.php";
	require_once "includes/utilities/country.php";
	require_once "includes/authentication/login.php";
    require_once "user.php";
	require_once 'includes/libraries/Mobile_Detect_2_8_24/Detect_Device.php';
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
<h2>Frequently asked questions:</h2>
<div class="column_left">
<ul class="tabs"> 
        <li><a href="#tab1">What is VisitmyFactory.com?</a></li>
      <li><a href="#tab2">Is VisitmyFactory.com only about factories?</a></li>
      <li><a href="#tab3">Is my contract with VisitmyFactory.com or with the Factory?</a></li>
      <li><a href="#tab4">Can Factories ask additional payment during the visit?</a></li>     
<li><a href="#tab5">What if my visit is cancelled by the Factory or is not as advertised?</a></li>     
<li><a href="#tab6">Can I modify or cancel a booking?</a></li>     
<li><a href="#tab7">Are visits open for children?</a></li>     
<li><a href="#tab8">Is there a discount for children?</a></li>     
<li><a href="#tab9">Is there a discount for groups?</a></li>
<li><a href="#tab10">Is it safe to visit a Factory?</a></li>
<li><a href="#tab11">Are there rules to follow during the visit?</a></li>

    </ul>
    </div>
<div class="column_right">
<div class="tab_container">
        <div id="tab1" class="tab_content">
           
           <p>VisitmyFactory.com is a platform that connects Factories and Visitors. It allows Factories to advertise their visit events to a large public, and Visitors to find and smoothly book visits of their interests.</p>
  						 
        </div>
        <div id="tab2" class="tab_content">
        <p>The primary objective of VisitmyFactory.com is to open the doors of the places in which a production process happens. It is mainly about factories, but is also open to farms and more intangible production as long as there is something exciting to see and discover.</p>          </div>
        <div id="tab3" class="tab_content">
         <p>VisitmyFactory.com offers the platform to handle the booking but the visit contract is directly between the Factory and you the Visitors. VisitmyFactory.com has thus no direct responsibility in the visits, but we of course try our best to provide you exciting opportunities.</p>								
        </div>
        <div id="tab4" class="tab_content">
           <p>The payment on VisitmyFactory.com covers the visit with the description advertised in the visit page. No additional payment can be requested from the Visitors for the visit itself.</p>
<p>Factories however have the possibility to offer optional additional products for sale to the Visitors during the visit (e.g. gift shop, drinks).
</p>						
                                           </div>
       <div id="tab5" class="tab_content">
           <p>It can happen on an exceptional basis that a Factory must cancel a visit. You will be fully refunded providing that you had a valid reservation through VisitmyFactory.com.</p>
<p>If you are very disappointed with the visits because it doesn’t correspond to how it was described, you can create a claim case within 48h of the end of the visit. The payment of the visit to the Factory will be on hold until you can find an agreeable solution with the Factory or if VisitmyFactory.com statutes in the case in the last resort. We try to handle all the claims as quickly and fairly as possible.

</p>						
                                           </div>
       <div id="tab6" class="tab_content">
           <p>Bookings on VisitmyFactory.com are non-refundable if Visitors are not able to attend the booked visit due to reasons not in the responsibility of the Factory.</p>
<p>At their discretion and on a case by case basis, Factories might allow visitors to modify the date of their visit. The request has to be done to the factory through VisitmyFactory.com.


</p>						
                                           </div>
        <div id="tab7" class="tab_content">
           <p>It depends on the Factory. Some visits are fully family friendly whereas age restrictions apply on others. Age restrictions are clearly stated on the visit page and under the sole responsibility of the Factory.</p>
<p>If open to children, Visitors under 18 years old must be accompanied by adults. Adult Visitors have the responsibility to supervise their children and ensure that they follow the safety instructions.

</p>						
                                           </div>  
         <div id="tab8" class="tab_content">
           <p>VisitmyFactory.com offers the possibility to Factories to setup a discounted price to children, but the choice remains at the Factory’s discretion.

</p>						
                                           </div>
         <div id="tab9" class="tab_content">
           <p>We currently do not offer an automatized discount for groups, but as a rule of thumb, you can contact us for more information if you plan to come with more than 10 persons.</p>						
</div>   

<div id="tab10" class="tab_content">
           <p>Factories must ensure to offer safe visit conditions to their visitors. For that purpose, Factories might have to put restrictions on the audience to ensure the visitors are safe (e.g. age limits or non-availability for disabled people). Visitors will be refunded if they are turned down at the Factory on the basis of a restriction related to safety that wasn’t communicated on the booking description page.</p>
           <p>However, Visitors must keep in mind that some machine equipment might be dangerous. It is therefore critical that Visitors follow the safety instructions given by the Factories.  Factories can at their discretion and in the last resort, ask Visitors to leave a visit with no refund if they are deliberately not following the safety instructions or intentionally making troubles.</p>

<p>Visitors are strongly advised to have a personal insurance coverage. VisitmyFactory.com is only offering the booking platform and cannot be held liable in case of incident.
</p>						
                                           </div>
                                                                                                                                                             <div id="tab11" class="tab_content">
           <p>As mentioned above, it very important for Visitors to follow the safety instructions provided by the Factories.</p>
<p>Factories can at their discretion and in the last resort, ask Visitors to leave a visit with no refund if they are deliberately not following the safety instructions or intentionally making troubles.


</p>						
                                           </div>            
    </div>
</div>


</div>
</div>
<div class="clear"></div>



    <!--footer-->
    <?php  require_once "includes/footer.php"; ?>
    <!--end footer-->
</div>



<!-- OVERLAY FOR THE USER TO LOGIN -->
     <?php 
	   include("includes/forms/login_form.php");
	 ?>
<!--  END OF THE LOGIN OVERLAY -->

</body>
</html>
