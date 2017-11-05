<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visit my Factory</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/drop_menu.css" />
<script src="js/image_uploader.js" type="text/javascript"></script>
<!--for flag-->

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<!-- </msdropdown> -->

<link rel="stylesheet" type="text/css" href="css/skin2.css" />
<link rel="stylesheet" type="text/css" href="css/flags.css" />
<!--flag end-->
<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />

<link rel="stylesheet" href="css/auth.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/event.css" type="text/css" media="screen" />

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

 <script>
function printpage() {
    window.print();
}
</script>
</head>

<body class="black_bg">

<div class="confirm_back">
<div class="top">
<div class="logo"><a href="index.html"><img  src="images/visit_my_factory_logo.png" alt="Visit my Factory -logo" width="120px"/></a>
</div>
<div class="Exit_link"><a href="index.html">Home</a> | <a onclick="printpage()" style="cursor:pointer">Print</a></div>
</div>
<div class="clear"></div>
<div class="lft_conf">
<div style="float:left; width:80px; margin-top:20px"> <img src="images/icon/check_icon.png" /></div><h2>Great ! your booking is confirmed.</h2>


<table width="100%" cellspacing="10">
<tr>
<td colspan="2"><div class="border"></div></td>
</tr>
<tr>
<td width="20%"><h3>Date</h3></td>
<td><h3>12-May-2017</h3></td>
</tr>
<tr>
<td><h3>Time</h3></td>
<td><h3>10:00 to 12:00</h3></td>
</tr>
<tr>
<td><h3>Guest</h3></td>
<td><h3>2</h3></td>
</tr>
<tr>
<td><h3>Total Pay</h3></td>
<td><h3>200 Kr</h3></td>
</tr>
<tr>
<td>
<h3>Address</h3>
</td>
<td>12A street Name,   
Area Name 1234,
Denmark

</td>
</tr>
<tr>

<td><h3>Note</h3></td>
<td>Description in detail what is required during visit. (Come with your Id card, camara is not allowed inside the factory) </td>
</tr>

</table>

</div>

<div class="rgt_conf">
<img src="images/gallery/gallery2.jpg" alt="visit_my_factory" width="550px" height="330px">
</div>
<div class="clear"></div>








</div>
</div>
<div class="clear"></div>
</body>

</html>
