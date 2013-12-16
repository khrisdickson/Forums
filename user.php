<?php
include 'connectvars.php';
include 'header.php';

session_start();

/*
	this is so if some one were to type the link into the url they would still
	not be able to change information on an account
*/
if (!isset($_SESSION['userid'])) {
	echo 'You must log in to see this page.  Click <a href="login.php">Login</a> to enter your credentials.';
}

else {

$conn = mysqli_connect ('webdesign4.georgianc.on.ca','db100083097','871124','db100083097') or die('Error connecting to MySQL server');

$id = $_GET['userid'];

  $sql = "SELECT username, email FROM Users WHERE userid = $id";
  $result = mysqli_query($conn, $sql) or die('Error querying database.');

  while ($row = mysqli_fetch_array($result)) {
	$id = $row['userid'];
	$username = $row['username'];
	$email = $row['email'];

  } 

  mysqli_close($conn);

	echo '<a href="Logout.php">Log Out</a>';

}

?>


<form method="post" action="update_user.php">
<div>
	<label>username</label>
	<input name="username" value="<?php echo $username;?>" />
</div>

<div>
	<label>Email</label>
	<input name="email" value="<?php echo $email;?>" />
</div>


<input type="hidden" name="userid" value="<?php echo $id;?>" />
<input type="submit" value="Save" />

</form>
</body>

</html>
