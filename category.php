<?php  
include 'connectvars.php';  
include 'header.php';   
  
if($_SERVER['REQUEST_METHOD'] != 'POST')  
{  
    //the form hasn't been posted yet, display it  
    echo '<form method="post" action="">  
        Category name: <br /><input type="text" name="categoryname" />  <br />
        Category description: <br /><textarea name="categorydescription" /></textarea> <br />
        <input type="submit" value="Add category" />  
     </form>'; 
} 
else
{ 
	if($_SESSION['admin'] == 1){
    //the form has been posted, so save it 
    $sql = "INSERT INTO Category(categoryname, categorydescription) 
       VALUES('" . mysql_real_escape_string($_POST['categoryname']) . "',  
             '" . mysql_real_escape_string($_POST['categorydescription']) . "')";  
    $result = mysql_query($sql);  
	}
    if(!$result)  
    {  
        //something went wrong, display the error  
        echo 'Error' . mysql_error();  
    }  
    else  
    {  
        echo 'New category successfully added.';  
    }  
}

include 'footer.php';
?>  