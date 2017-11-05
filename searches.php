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
<!-- </msdropdown> -->

<link rel="stylesheet" type="text/css" href="css/skin2.css" />
<link rel="stylesheet" type="text/css" href="css/flags.css" />
<!--flag end-->
<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/event.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen" />



</head>

<body>
<?php 
    session_start();
	header("Cache-Control", "no-cache, no-store, must-revalidate");
	require_once("includes/utilities/database_utilities/database_connection.php");
	include("Query.php");
	require_once("includes/utilities/database_utilities/queries.php");
	
	include("user.php");
	require_once("includes/user_classes/company_representative.php");
	require_once("includes/user_classes/visitor.php");
	
	$db_obj = new Database();
	$db_obj->connect_to_the_server(); // Consider using a singleton
	$db_obj->create_database();
	$db_obj->select_database();
	$db_obj->create_tables();	     
	$selection_obj = new SelectQuery();
	$insertion_obj = new InsertionQuery();
?>

<!--header start-->	
  <?php  require_once "includes/header.php"; ?>
<!--end header-->

<div class="clear"></div>
<div class="wreper">
<div class="content">
<h2>Search results</h2>
<div id="tab1" class="tab_content">
 <?php 
   if(isset($_GET["search"])){ 
      $search_string = $_GET["search"];
	  $search_words = explode(" ", $search_string);
	  $specific_search = $_GET['specific_search'];
	  
	  //print_r($search_words);
	  if(isset($specific_search) && strtolower($specific_search) == "everything"){
			  $x = 0; 
			  $construct = " ";
			  foreach($search_words as $word){
					  $x++;
					  if( $x == 1 )
						 $construct .= "title LIKE '%$word%' OR page_content LIKE '%$word%' ";
					  else
						 $construct .= "AND title LIKE '%$word%' OR page_content LIKE '%$word%'";
			  }
			  $search_query = $selection_obj->search_engine($construct);
			  $count = mysql_num_rows($search_query);
			  
			  if($count == 0){
					 $search_string_display = (sizeof($search_words)>45) ? substr($search_string, 0, 100)."..." : $search_string;
					 echo "<br />Sorry, there are no search results found for the term <b>\"".$search_string_display."\"</b>";
			  }else{
				   echo "Found ".$count." results<br /><br />";
				   while($row = mysql_fetch_array($search_query)){
					 $url = $row['page_url'];
					 $content = substr($row['page_content'], 0, 100);
					 $title = substr($row['title'], 0, 40);
					 echo "<a href='$url'><b>".$title."</b></a> <br>$content<br><a href='$url'>$url</a><p>";
				   }
			   }
	  
	  } // if searching for specific categories
	  else{
	      if(strtolower($specific_search) == "location"){
			  $y = 0; 
			  $construct = " ";
			  foreach($search_words as $word){
					  $y++;
					  if( $y == 1 ){
						 $construct .= "country LIKE '%$word%' OR city LIKE '%$word%' OR street LIKE '%$word%' OR block LIKE '%$word%'";
					  }else{
						 $construct .= " AND country LIKE '%$word%' OR city LIKE '%$word%' OR street LIKE '%$word%' OR block LIKE '%$word%'";
					  }
			  }
		      $factory_address = $selection_obj->search_by_factory_address($construct);
			  $event_address = $selection_obj->search_by_event_address($construct);	
			  $count = mysql_num_rows($factory_address) + mysql_num_rows($event_address);
			  
			  if($count == 0){
					 $search_string_display = (sizeof($search_words)>45) ? substr($search_string, 0, 100)."..." : $search_string;
					 echo "<br />Sorry, there are no search results found for the term <b>\"".$search_string_display."\"</b>";
			  }else{
				   echo "Found ".$count." results <br /><br />";
				   while($row = mysql_fetch_array($factory_address)){
						 $factory_id = $row['factory_id'];
						 $branch_id = $row['branch_id'];
						 $factory_name = $selection_obj->get_a_factory_name($factory_id, $branch_id);
						 $country = $row['country'];
						 $city = $row['city'];
						 $street = $row['street'];
						 $post_code = $row['postal_code'];
						 $content = $factory_name.", ".$country.", ".$post_code." ".$city.", ".$street;
						 echo "<a href='factory.php?factory_id=$factory_id&&branch_id=$branch_id'><b>".$factory_name."</b></a>".
							  "<br><a href='factory.php?factory_id=$factory_id&&branch_id=$branch_id'>$content<br><p>";
				   }
				   while($row = mysql_fetch_array($event_address)){
						 $event_id = $row['event_id'];
						 $event_query = mysql_query($selection_obj->select_a_factory_event($event_id)) or die("Event results: ".mysql_error());
						 $event = mysql_fetch_array($event_query);
						 $branch_id = $event['branch_id'];
						 $factory_id = $event['factory_id'];
						 $event_title = $event['event_title'];
						 $factory_name = $selection_obj->get_a_factory_name($factory_id, $branch_id);
						 $country = $row['country'];
						 $city = $row['city'];
						 $street = $row['street'];
						 $content = $factory_name.", ".$event_title." ".$country.", ".$city.", ".$street;
						 echo "<a href='unique_event.php?event_id=$event_id'><b>".$factory_name."</b></a> <br>$content<br><p>";
				   }
			   }			  
			  	  
		  }elseif(strtolower($specific_search) == "sector"){
		      $y = 0; 
			  $construct = " ";
			  foreach($search_words as $word){
					  $y++;
					  if( $y == 1 ){
						 $construct .= "sector LIKE '%$word%' OR sub_sector LIKE '%$word%' OR name LIKE '%$word%'";
					  }else{
						 $construct .= " AND sector LIKE '%$word%' OR sub_sector LIKE '%$word%' OR name LIKE '%$word%'";
					  }
			  }
		     $sector_query = $selection_obj->search_by_sector($construct);
			 while($row = mysql_fetch_array($sector_query)){
			        $factory_id = $row['factory_id'];
					$branch_id = $row['branch_id'];
					$factory_name = $row['name'];
					$logo = $row['logo']; //use it at a latter stage
					$content = $factory_name;
			        echo "<a href='factory.php?factory_id=$factory_id&&branch_id=$branch_id'><b>".$factory_name."</b></a>".
							  "<br><a href='factory.php?factory_id=$factory_id&&branch_id=$branch_id'>$content<br><p>";
			 }
			 
		  }elseif(strtolower($specific_search) == "events"){
		      $y = 0; 
			  $construct = " ";
			  foreach($search_words as $word){
					  $y++;
					  if( $y == 1 ){
						 $construct .= "event_title LIKE '%$word%' OR wwwb LIKE '%$word%'  OR wwwp LIKE '%$word%'  OR wwwd LIKE '%$word%' OR notes LIKE '%$word%'";
					  }else{
						 $construct .= " AND event_title LIKE '%$word%' OR wwwb LIKE '%$word%'  OR wwwp LIKE '%$word%'  OR wwwd LIKE '%$word%' OR notes LIKE '%$word%'";
					  }
			  }
		     $event_query = $selection_obj->search_by_event($construct);
			 while($row = mysql_fetch_array($event_query)){
				     $event_id = $row['event_id'];
					 $branch_id = $row['branch_id'];
					 $factory_id = $row['factory_id'];
					 $event_title = $row['event_title'];
					 $factory_name = $selection_obj->get_a_factory_name($factory_id, $branch_id);
					 $content = "<a href='factory.php?factory_id=$factory_id&&branch_id=$branch_id'>".$factory_name."</a>, ".
					            "<a href='unique_event.php?event_id=$event_id'>".$event_title."</a>";
					 echo "<a href='unique_event.php?event_id=$event_id'><b>".$event_title."</b></a> <br>$content<br><p>";			    
			 }
		  }
	  
	  }
	  
	  
   }
?>
           <h3>Results</h3>
           
          
        </div>

</div>
</div>
<div class="clear"></div>



<!--footer start-->
<?php require_once "includes/footer.php"; ?>  
<!--footer end-->
</div>

</body>

</html>
