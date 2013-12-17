<?php
include 'connectvars.php';
include 'header.php';

echo '<h2>Create a topic</h2>';
if($_SESSION['signed_in'] == false)
{
	echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}
else
{	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		$sql = "SELECT categoryid, categoryname, categorydescription FROM Category";
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				if($_SESSION['admin'] == 1)
				{
					echo 'You have not created categories yet.';
				}
				else
				{
					echo 'Before you can post a topic, you must wait for an admin to create some categories.';
				}
			}
			else
			{
		
				echo '<form method="post" action="">
					Topic: <input type="text" name="topic_subject" /> <br />
					Category:'; 
				
				echo '<select name="topic_category">';
					while($row = mysql_fetch_assoc($result))
					{
						echo '<option value="' . $row['categoryid'] . '">' . $row['categoryname'] . '</option>';
					}
				echo '</select> <br />';	
					
				echo 'Post: <textarea name="post_content" /></textarea> <br />
					<input type="submit" value="Create topic" />
				 </form>';
			}
		}
	}
	else
	{
		$query  = "BEGIN WORK;";
		$result = mysql_query($query);
		
		if(!$result)
		{
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else
		{
	
			$sql = "INSERT INTO Topic(topic_subject, topic_created, topic_category, topic_poster) VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "', NOW(), " . mysql_real_escape_string($_POST['topic_category']) . ", " . $_SESSION['userid'] . " )";
					 
			$result = mysql_query($sql);
			if(!$result)
			{
				echo 'An error occured while inserting your data. Please try again later.' . mysql_error();
				$sql = "ROLLBACK;";
				$result = mysql_query($sql);
			}
			else
			{
				$topicid = mysql_insert_id();
				
				$sql = "INSERT INTO
							Posts(content,
								  post_created,
								  post_topic,
								  post_creator)
						VALUES
							('" . mysql_real_escape_string($_POST['content']) . "',
								  NOW(),
								  " . $topicid . ",
								  " . $_SESSION['userid'] . "
							)";
				$result = mysql_query($sql);
				
				if(!$result)
				{
					echo 'An error occured while inserting your post. Please try again later.' . mysql_error();
					$sql = "ROLLBACK;";
					$result = mysql_query($sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysql_query($sql);
					
					echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
				}
			}
		}
	}
}

include 'footer.php';
?>	
	