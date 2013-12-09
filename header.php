<!DOCTYPE html>

<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<title>League of Legends Forum</title>
	<link rel="stylesheet" href="css/style.css" type="text/css"> 
	</head>
	
	
	<body>
	<h1>Forum Title</h1>
	<div id = "wrapper">
		<div id = "nav">
		
		<?php  
		echo '<div id="userbar">';  
		    if($_SESSION['signed_in'])  
		    {  
		        echo 'Hello' . $_SESSION['username'] . '. Not you? <a href="signout.php">Sign out</a>';  
		    }  
		    else  
		    {  
		        echo '<a href="login.php">Sign in</a> or <a href="signup.php">create an account</a>.';  
		    }  
		echo '</div>'; 
		?>
		
		</div>
		
		
		<div id =  "content">
		
