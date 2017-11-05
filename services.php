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
<h2>Services</h2>
<div class="column_left">

<img src="images/icon/services_icon.png" class="icon"/>
<div class="column_txt">
<h3>Services1</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>

</div>

</div>
<div class="column_right">
<img src="images/icon/services_icon.png" class="icon"/>
<div class="column_txt">
<h3>Services2</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
</div>
</div>
<div class="column_left">

<img src="images/icon/services_icon.png" class="icon"/>
<div class="column_txt">
<h3>Services3</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
</div>
</div>
<div class="column_right">
<img src="images/icon/services_icon.png" class="icon"/>
<div class="column_txt">
<h3>Services4</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
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
