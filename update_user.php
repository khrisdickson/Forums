<!-- this execute the information that the user want to changefrom user.php 
and updates the database with the new information that was added-->

<html>
<body>

<?php
include 'connectvars.php';
include 'header.php';

//sets variable to connect to database
$conn = mysqli_connect ('webdesign4.georgianc.on.ca','db100083097','871124','db100083097') or die('Error connecting to MySQL server');
	
	//pulls attribute of the <input> tag from the last form
	$id = $_POST['userid'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	
	// opens a sesssion if the user has logged in $sql will run if they have not logged it tell them they are invalid and to log in
	if (isset($_SESSION['userid'])) {
		
		//updates database with new information
		$sql = "UPDATE Users SET username = '$username',  email = '$email' WHERE userid = '" . mysql_real_escape_string($_POST['userid']) . "'";
	$result = mysqli_query($conn, $sql) or die('Error updating database.');

		
  
		header('Location: index.php');
		//desired location ^^^^^^^ header('Location: index.php');
	}
	else {
		//if user had not logged in they will see this error message
		echo 'Invalid user ID.  Click <a href="javascript:history.go(-1)">HERE</a> to go back.';
	}
?>
</body>
</html>
