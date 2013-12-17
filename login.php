<?php  
session_start();
include 'connectvars.php';  
include 'header.php';  

  
echo '<h3>Sign in</h3>';  
  
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)  
{  
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';  
}  
else  
{  
    if($_SERVER['REQUEST_METHOD'] != 'POST')  
    {  

        echo '<form method="post" action="">  
            Username: <input type="text" name="username" />  
            Password: <input type="password" name="password">  
            <input type="submit" value="Sign in" />  
         </form>'; 
    } 
    else 
    { 

        $errors = array(); 
          
        if(!isset($_POST['username']))  
        {  
            $errors[] = 'The username field must not be empty.';  
        }  
          
        if(!isset($_POST['password']))  
        {  
            $errors[] = 'The password field must not be empty.';  
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

            $sql = "SELECT userid, username, userleague, admin FROM Users WHERE 
                    username = '" . mysql_real_escape_string($_POST['username']) . "' 
                    AND 
                    password = '" . sha1($_POST['password']) . "'";  
                          
            $result = mysql_query($sql);  
            if(!$result)  
            {  
                echo 'Something went wrong while signing in. Please try again later.'; 
            } 
            else 
            { 
                if(mysql_num_rows($result) == 0) 
                { 
                    echo 'You have supplied a wrong user/password combination. Please try again.'; 
                } 
                else 
                { 
                    $_SESSION['signed_in'] = true; 
                     
                    
                    while($row = mysql_fetch_assoc($result)) 
                    { 
                        $_SESSION['userid']    = $row['userid']; 
                        $_SESSION['username']  = $row['username']; 
                        $_SESSION['userleague'] = $row['userleague']; 
                        $_SESSION['admin'] = $row['admin'];
                    } 
                     
                    echo 'Welcome, ' . $_SESSION['username'] . '. <a href="index.php">Proceed to the forum overview</a>.'; 
                } 
            } 
        } 
    } 
} 
 
include 'footer.php';  
?>         