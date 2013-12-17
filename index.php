<?php
//create_cat.php
include 'connectvars.php';
include 'header.php';

$sql = "SELECT categoryid, categoryname, categorydescription FROM Category LEFT JOIN Topic ON Topic.topic_id = Category.categoryid GROUP BY categoryname, categorydescription, categoryid";

$result = mysql_query($sql);

if(!$result)
{
	echo 'Error displaying results.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'Nothing created yet.';
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
				echo '<td>';
					echo '<h3><a href="viewcategory.php?id=' . $row['categoryid'] . '">' . $row['categoryname'] . '</a></h3>' . $row['categorydescription'];
				echo '</td>';
				echo '<td>';
				
				//fetch last topic for each cat
					$topics = "SELECT topic_id, topic_subject, topic_created, topic_category FROM Topic WHERE topic_category = " . $row['categoryid'] . " ORDER BY topic_created DESC LIMIT 1";
								
					$result2 = mysql_query($topics);

					if(!$result2)
					{
						echo 'Last topic could not be displayed.';
					}
					
					else
					{
						if(mysql_num_rows($result2) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($row2 = mysql_fetch_assoc($result2))
							
							echo '<a href="viewtopic.php?id=' . $row2['topic_id'] . '">' . $row2['topic_subject'] . '</a> at ' . date('d-m-Y', strtotime($row2['topic_created']));
							
						}
						
						echo '</td>';
						echo '</tr>';
						
						
					}
					
					

			
		}
		if(!$_SESSION['signed_in'])
		{
			echo 'You must be <a href="signin.php">signed in</a> to create a topic. You can also <a href="signup.php">sign up</a> for an account.';
		}
		if($_SESSION['admin'] == 1)
		{
			echo '<a href = "category.php">Create new Category</a>';
		}
		
	}
}
include 'footer.php';
?>
