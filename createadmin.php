<?php
include 'connectvars.php';
include 'header.php';

$query = "UPDATE Users SET admin = 1";

/*if($_SESSION['admin'] == 1 && $_SESSION['signed_in'] == true)
{
	$result = mysql_query($query);
}*/
header('Location: members.php');
exit();

include 'footer.php';
?>