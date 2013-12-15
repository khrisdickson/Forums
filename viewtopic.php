<?php
include 'connectvars.php';
include 'header.php';

//first select the category based on $_GET['cat_id']
$sql = "SELECT  
    topic_id,  
    topic_subject  
FROM  
    Topic 
WHERE topic_id = " . mysql_real_escape_string($_GET['id']) ;

$result = mysql_query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		//display category data
		while($row = mysql_fetch_assoc($result))
		{
			echo '<h2>Topics in ' . $row['categoryname'] . ' category</h2>';
		}
	
		//do a query for the topics
$sql = "SELECT  
post_topic,  
content,  
post_created,  
post_creator,  
    Users.userid,  
    Users.username  
FROM  
    Posts  
LEFT JOIN  
    Users  
ON  
    Posts.post_creator = Users.userid WHERE  
    Posts.post_topic = " . mysql_real_escape_string($_GET['id']) ;
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			echo 'The posts could not be displayed, please try again later.';
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				echo 'There are no topics in this category yet.';
			}
			else
			{
				//prepare the table
				echo '<table border="1">
					  <tr>
						<th>Topic</th>
						<th>Created at</th>
					  </tr>';	
					
				while($row = mysql_fetch_assoc($result))
				{				
					echo '<tr>';
						echo '<td class="leftpart">';
							echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo date('d-m-Y', strtotime($row['post_created']));
						echo '</td>';
					echo '</tr>';
				}
			}
		}
	}
}

include 'footer.php';
?>
	