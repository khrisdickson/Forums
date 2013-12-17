<?php
include 'connectvars.php';
include 'header.php';

$sql = "SELECT
			categoryid,
			categoryname,
			categorydescription
		FROM
			Category
		WHERE
			categoryid = " . mysql_real_escape_string($_GET['id']);

$result = mysql_query($sql);

if(!$result)
{
	echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		while($row = mysql_fetch_assoc($result))
		{
			echo '<h2>Topics in ' . $row['categoryname'] . ' category</h2>';
		}
	
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_created,
					topic_category
				FROM
					Topic
				WHERE
					topic_category = " . mysql_real_escape_string($_GET['id']);
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			echo 'The topics could not be displayed, please try again later.';
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				echo 'There are no topics in this category yet.';
			}
			else
			{
				echo '<table border="1">
					  <tr>
						<th>Topic</th>
						<th>Created at</th>
					  </tr>';	
					
				while($row = mysql_fetch_assoc($result))
				{				
					echo '<tr>';
						echo '<td class="leftpart">';
							echo '<h3><a href="viewtopic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo date('d-m-Y', strtotime($row['topic_created']));
						echo '</td>';
					echo '</tr>';
				}
			}

			echo '</table>';
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to create a topic. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				echo '<a href = "topic.php">Create new topic</a>';
			}
		}
	}
}

include 'footer.php';
?>
	