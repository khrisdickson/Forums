<?php 
session_start(); 
date_default_timezone_set('US/Eastern');
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<title>League of Legends Forum</title>
	<link rel="stylesheet" href="css/style.css" type="text/css"> 
	</head>
	
	
	<body>
	<div id="Logo"><img src="/~100083097/year2/web/forum/images/LLF.jpg"></div>
	<div id = "wrapper">
		<div id = "nav">
		<li><a href="index.php">Forums</a></li>
      <li><a href="members.php">Members</a></li>
      <li><a href="edit_user.php">Edit Profile</a></li>
      <li><a href="signup.php">Join Now!</a></li>
		

		<div id="userbar">
		<?php
		if($_SESSION['signed_in'])
		{
			echo htmlentities($_SESSION['username']) . ' <a href="logout.php">Logout</a>';
		}
		else
		{
			echo '<a href="login.php">Sign in</a> or <a href="signup.php">create an account</a>';
		}
		?>
		</div>
		
		</div>
		
		
		<div id = "content">
		
