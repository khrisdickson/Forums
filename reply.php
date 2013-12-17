<?php
include 'connectvars.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	echo 'This file cannot be called directly.';
}
else
{
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		$sql = "INSERT INTO Posts(content, post_created, post_topic, post_creator) VALUES ('" . $_POST['reply-content'] . "', NOW(), " . mysql_real_escape_string($_GET['id']) . ", " . $_SESSION['userid'] . ")";
						
		$result = mysql_query($sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			echo 'Your reply has been saved, check out <a href="viewtopic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
		}
	}
}

include 'footer.php';
?>