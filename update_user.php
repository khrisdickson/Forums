<html>
<body>

<?php
include 'connectvars.php';
include 'header.php';

$conn = mysqli_connect ('webdesign4.georgianc.on.ca','db100083097','871124','db100083097') or die('Error connecting to MySQL server');

	$id = $_POST['userid'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	
	if (isset($_SESSION['userid'])) {
		
		$sql = "UPDATE Users SET username = '$username',  email = '$email' WHERE userid = '" . mysql_real_escape_string($_POST['username']) . "'";
	$result = mysqli_query($conn, $sql) or die('Error updating database.');

		
  
		header('Location: index.php');
		//desired location ^^^^^^^ header('Location: index.php');
	}
	else {
		echo 'Invalid user ID.  Click <a href="javascript:history.go(-1)">HERE</a> to go back.';
	}
?>
</body>
</html>
