<?php
//signup.php
include 'connectvars.php';
include 'header.php';

echo '<h3>Sign up</h3>';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo '<form method="post" action="">
 	 	Username: <input type="text" name="username" /><br />
 		Password: <input type="password" name="password"> <br />
		Password again: <input type="password" name="checkpassword"> <br />
		E-mail: <input type="email" name="email"><br />
 		<input type="submit" value="Register" />
 	 </form>';
}
else
{
	$errors = array();
	
	if(isset($_POST['username']))
	{
		if(!ctype_alnum($_POST['username']))
		{
			$errors[] = 'The username can only contain letters and digits.';
		}
		if(strlen($_POST['username']) > 30)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field must not be empty.';
	}
	
	
	if(isset($_POST['password']))
	{
		if($_POST['password'] != $_POST['checkpassword'])
		{
			$errors[] = 'The two passwords did not match.';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty.';
	}
	
	if(!empty($errors)) 
	{
		echo 'Uh-oh.. a couple of fields are not filled in correctly..';
		echo '<ul>';
		foreach($errors as $key => $value) 
		{
			echo '<li>' . $value . '</li>'; 
		}
		echo '</ul>';
	}
	else
	{
		$sql = "INSERT INTO
					Users(username, password, email ,creationdate, userleague)
				VALUES('" . mysql_real_escape_string($_POST['username']) . "',
					   '" . sha1($_POST['password']) . "',
					   '" . mysql_real_escape_string($_POST['email']) . "',
						NOW(),
						0)";
						
		$result = mysql_query($sql);
		if(!$result)
		{
			echo 'Something went wrong while registering. Please try again later.';
		}
		else
		{
			echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
		}
	}
}

include 'footer.php';
?>
	