<?php
include 'connectvars.php';
include 'header.php';

$sql = "SELECT
			categoryid,
			categoryname,
			categorydescription
		FROM
			Category";

$result = mysql_query($sql);

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		//prepare the table
		echo '<table border="1">
			  <tr>
				<th>Category</th>
				<th>Last topic</th>
			  </tr>';	
			
		while($row = mysql_fetch_assoc($result))
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3><a href="viewcategory.php?id=' . $row['categoryid'] . '">'. $row['categoryname'] . '</a></h3>' . $row['categorydescription'];
				echo '</td>';
				echo '<td class="rightpart">';
							echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
				echo '</td>';
			echo '</tr>';
		}
	}
}

include 'footer.php';
?>
	