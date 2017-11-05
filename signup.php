<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visit my Factory</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/signin.js"></script>
<link rel="stylesheet" type="text/css" href="css/drop_menu.css" />

<!--for flag-->


<link rel="stylesheet" type="text/css" href="css/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<script src="js/password_checker.js"></script>
<link rel="stylesheet" type="text/css" href="css/skin2.css" />
<link rel="stylesheet" type="text/css" href="css/flags.css" />

<!--flag end-->
<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />

<link rel="stylesheet" href="css/login.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/signup.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />  
  
  <!--VALIDATIONS ... -->  
  <script>
   function validate_a() {
        var password = document.getElementById("first_password_field_a").value;
        var confirmPassword = document.getElementById("second_password_field_a").value;
		var missMatchMessage = document.getElementById("invalid_text_a");
		var submitButton = document.getElementById("submit_a");
        if (password != confirmPassword && password.length > 0) {
            missMatchMessage.style.display="block";
			submitButton.style.disabled = true;
        }else{
		    missMatchMessage.style.display="none";
			submitButton.style.disabled = false;
		}
    }

   function validate_b() {
        var password = document.getElementById("first_password_field_b").value;
        var confirmPassword = document.getElementById("second_password_field_b").value;
		var missMatchMessage = document.getElementById("invalid_text_b");
        if (password != confirmPassword && password.length > 0) {
            missMatchMessage.style.display="block";
        }else{
		    missMatchMessage.style.display="none";
		}
    }
	
	function wait_validating(){
	     var missMatchMessage = document.getElementById("invalid_text_b");
		 missMatchMessage.style.display="none";
	}
  </script>
  <!--END-->


</head>

<body>


  <?php 
		session_start();
		include("query.php");
		require_once("includes/utilities/database_utilities/database_connection.php");
		require_once("includes/utilities/database_utilities/queries.php");
		include("includes/utilities/validators/field_validator.php");
		include("includes/utilities/country.php");
		include("includes/utilities/country_phone_codes.php");
		include("includes/authentication/login.php");
		include("user.php");
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
<div id="index_items">
          <div id="signup_types">
          <table border="0" cellspacing="20px" align="center" width="100%" class="signup_cat">
            <tr>
             <td  id="signup_visitor" onclick="signUpCatOne()">
                <img src="images/icon/signup_visitor_icon.png" class="signup_icon" />  <h3>Sign up Visitor</h3>
             </td>
             <td id="signup_company" onclick="signUpCatTwo()">
               <img src="images/icon/signup_company_icon.png" class="signup_icon" />  <h3> Sign up  Company</h3>
             </td>
            </tr>
           </table>
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
<!--end main container-->

    <!-- OVerlay for user login -->
    <?php include("includes/forms/login_form.php"); ?>
    <!--  End of the login overlay -->
    
    <!-- Overlay for the user to signin-->
    <?php 
          include("includes/utilities/date_time.php");
          include("includes/forms/signup_form.php");
		  //include("includes/welcome.html");
		  
          include("includes/signup/signup_handler.php");
     ?>
    <!--  End of the login overlay-->


</body>

</html>
