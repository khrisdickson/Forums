<?php
include 'connectvars.php';
include 'header.php';

$members = "SELECT username FROM Users";

$result = mysql_query($members);

if(mysql_num_rows($result) == 0)
{
	echo 'This category does not exist.';
}
else
{
	//display category data
	while($row = mysql_fetch_assoc($result))
	{
		echo $row["username"] . '<br />';
		/*if($_SESSION['admin'] == 1)
		{
			echo ' <a href = "createadmin.php">make admin </a><br />';
		}
		else 
		{
			echo '<br />';
		}*/
	}
	 
}

include 'footer.php';
?>