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
<link rel="stylesheet" href="css/event.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />

</head>

<body>

  <?php 



		session_start();



		require_once "query.php";



		require_once "includes/utilities/database_utilities/database_connection.php";



		require_once "includes/utilities/database_utilities/queries.php";



		require_once "includes/utilities/validators/field_validator.php";

        require_once "includes/utilities/validators/validator.php";

		require_once "includes/utilities/country.php";



		require_once "includes/utilities/date_time.php";



		require_once "includes/authentication/login.php";



		require_once "user.php";



		require_once 'includes/libraries/Mobile_Detect_2_8_24/Detect_Device.php';



		$selection_obj = new SelectQuery();



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

<h2>Contact us</h2>

<div class="lft_box">

<h4 style="color:#333333;">Visit my Factory</h4>

<!--<div class="contact_cnt">



<img src="images/icon/address_icon.png" style="width:20px; float:left; margin-right:10px;"/>



12A street Name,   



Area Name 1234,



Denmark



</div>



<div class="contact_cnt">



<img src="images/icon/call_contact.jpg" style="width:20px; float:left; margin-right:10px;"/>



1234567890  



</div>

-->

<div class="contact_cnt">



<img src="images/icon/email_contact.jpg" style="width:20px; float:left; margin-right:10px;"/>



contact@visitmyfactory.com  



</div>



</div>


<div class="rgt_box">



<div class="form">



<h1>Contact Form</h1>



	<form id="contact-form" action="" method="post" class="form_tbl">



		<fieldset>



			<p><i class="muted">Send an email. All fields with an * are required.</i></p>



			<div class="clearfix"></div>



            <table width="100%" cellpadding="5px" cellpadding="0" class="contact">



                 <tr>



                   <td>Name*</td>



                   <td>Email*</td>



                 </tr>



                  <tr>



                    <td>



                    <input type="text" name="name" id="jform_contact_name" value=""  aria-required="true" required />



                    </td>



                    <td>



                    <input type="email" name="email" id="jform_contact_email" value="" aria-required="true" required />



                    </td>



                  </tr>

                  <tr>



                     <td>Contact No.</td>



                     <td>Subject</td>



                  </tr>



 



                  <tr>



                     <td>



                     <input type="text"  name="mobile" id="jform_contact_emailmsg" value="" required /></td>



                     <td>



                     <input type="text" name="subject" id="jform_contact_subject" value="" required /></td>



                  </tr>







                  <tr>



                    <td colspan="2">Message*</td>



                  </tr>



                  



                  <tr>



                    <td colspan="2"><textarea name="inquiry" id="jform_contact_message" cols="50" rows="10" aria-required="true" required ></textarea></td>



                  </tr>



 
            <tr>



                    <td colspan="2"><button class="button" type="submit" name="submit_enquiry">Send Email</button></td>



                  </tr>



               </table>



         </fieldset>



     </form>







</div>

</div>

<div class="clear"></div>


</div>

</div>

<div class="clear"></div>


    <!--footer-->



    <?php  require_once "includes/footer.php"; ?>



    <!--end footer-->



    



</div>











<?php 



    

       $validator_obj = new Validator();

	   if(isset($_POST['submit_enquiry'])){



	      $name = $validator_obj->clean_input_string($_POST['name']);

          $email = $_POST['email'];

          $mobile = $validator_obj->clean_number($_POST['mobile']);

          $subject = $_POST['subject'];

          $inquiry = "Name: ".$name."<br />"."Telephone: ".$mobile."<br />".($_POST['inquiry']);

          $when_obj = new DateTimePicker();

          $time  = $when_obj->getTime();

          $date  = $when_obj->getDate();

          $id_generator_obj = new IDGenerator();

          $inquiry_id = $id_generator_obj->generateInquiryId();

          $no_reply_email = Email::getNoReplyEmail();
		  $admin_email = Email::getAdminEmail();
		  $contacts_email = Email::getContactUsEmail();


          mail($admin_email, "$subject", $inquiry, "From:" . $email);
          mail($contacts_email, "$subject", $inquiry, "From:" . $email);
          $response = "Dear ".$name."<br />Your inquiry has been received, and we will get back to you as soon as possible.<br /> Thank you.";
          mail($email, "$subject", $response, "From:" . $no_reply_email);
          $insertion_obj = new InsertionQuery();
          $insertion_obj->inquiry($inquiry_id, $date, $time, $email, $mobile, $name,  $subject, mysql_real_escape_string($inquiry));
          thankYouMessage($name);

	   }







?>



<!--THANK YOU MESSAGE OVERLAY-->

<?php 

   function thankYouMessage($name){

?>

<div id="myModal" class="msg_details" >

  <div class="msg-content" style="width:600px">
 <a href="contact.php"><span class="close"><div onclick="close_message_overlay()">&times;</div></span></a>

 
  
 <h1 class="message_hd">Thank you <span class="message_title"> <?= $name ?></span></h1>    

    <p> Thank you for contacting us, your inquiry has been forwarded to our team and we promise to get back to you as soon as we can.</p>
    <h3  style="text-align:right">Get in touch with us</h3>
    <div class="social_orange">

      <ul>

          <li><a href="https://www.facebook.com/VisitmyFactory" target="_blank"><img src="images/icon/facebook_icon_orange.png"/ alt="visit my factory"></a></li>

          <li><a href="https://twitter.com/visitmyfactory" target="_blank"><img src="images/icon/twitter_icon_orange.png"/ alt="visit my factory"></a></li>

          <li><a href="#"><img src="images/icon/linkdin_icon_orange.png"/ alt="visit my factory"></a></li>

          <li><a href="https://www.instagram.com/visitmyfactory" target="_blank"><img src="images/icon/instagram_icon_orange.png"/ alt="visit my factory"></a></li>

      </ul>

     </div>
 

  </div>

  <div class="clear"></div>

</div>

<?php } ?>

<!--END OF THANK YOU MESSAGE OVERLAY-->







<!-- OVERLAY FOR THE USER TO LOGIN -->

     <?php 



	   include("includes/forms/login_form.php");



	 ?>

<!--  END OF THE LOGIN OVERLAY -->







</body>



</html>



