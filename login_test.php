<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

session_start();


require_once 'includes/libraries/FBsrc/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1782556968708417',
  'app_secret' => 'f7619c359d92181a1dfd881d60733bd3',
  'default_graph_version' => 'v2.10',
  'persistent_data_handler' => 'session'
  ]);
	 
	$helper = $fb->getRedirectLoginHelper();
	 
	$permissions = []; // Optional information that your app can access, such as 'email'
	$loginUrl = $helper->getLoginUrl('https://www.visitmyfactory.com/test/', $permissions);
	 
	echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook</a>';
?>

</body>
</html>
