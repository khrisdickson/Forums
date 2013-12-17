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
	while($row = mysql_fetch_assoc($result))
	{
		echo $row["username"] . '<br />';
	}
	 
}

include 'footer.php';
?>