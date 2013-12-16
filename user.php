<!-- this page after clicking on the edit link in edit_user.php
 will allow the user to adjust their desired information -->

<html>
<body>
<?php
session_start();

include 'connectvars.php';
include 'header.php';



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
$username = $_GET['username'];
$email = $_GET['email'];

	//selects the database from the row that was clicked in edit user.php by using userid
	$sql = "SELECT * FROM Users WHERE userid = '" . mysql_real_escape_string($_POST['id']) . "'"; 
    
    //if the connection fails the error query database will be seen                
  	$result = mysqli_query($conn, $sql) or die('Error querying database.');

  // grabs current information from the database to display it in its 
  while ($row = mysqli_fetch_array($result)) {
	//$id = $row['userid'];
	$username = $row['username'];
	$email = $row['email'];

  } 

 

	

}

?>

//form used to update information
<form method="post" action="update_user.php">
<div>
	<label>username</label>
	<input name="username" value="<?php echo $username;?>" />
</div>

<div>
	<label>Email</label>
	<input name="email" value="<?php echo $email;?>" />
</div>


<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="submit" value="Save" />

</form>
</body>

</html>
