<?php
include 'connectvars.php';
include 'header.php';

$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			Topic
		WHERE
			topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = mysql_fetch_assoc($result))
		{
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';
			
			
			$posts_sql = "SELECT
						post_topic,
						content,
						post_created,
						post_creator,
						userid,
						username
					FROM
						Posts
					LEFT JOIN
						Users
					ON
						Posts.post_creator = Users.userid
					WHERE
						post_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = mysql_query($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{
					echo '<tr class="topic-post">
							<td class="user-post">' . $posts_row['username'] . '<br/>' . date('d-m-Y', strtotime($posts_row['post_created'])) . '</td>
							<td class="post-content">' . htmlentities(stripslashes($posts_row['content'])) . '</td>
						  </tr>';
				}
				
			}
			
			
			if(!$_SESSION['signed_in'])
			{
				echo 'You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				echo '<tr><td colspan="2"><h2>Reply:</h2><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					</form></td></tr>';
				
			}
			
		}
		
	}
	
}

include 'footer.php';
?>