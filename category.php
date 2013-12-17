<?php  
include 'connectvars.php';  
include 'header.php';   
  
if($_SERVER['REQUEST_METHOD'] != 'POST')  
{  
    echo '<form method="post" action="">  
        Category name: <br /><input type="text" name="categoryname" />  <br />
        Category description: <br /><textarea name="categorydescription" /></textarea> <br />
        <input type="submit" value="Add category" />  
     </form>'; 
} 
else
{ 
	if($_SESSION['admin'] == 1){
    $sql = "INSERT INTO Category(categoryname, categorydescription) 
       VALUES('" . mysql_real_escape_string($_POST['categoryname']) . "',  
             '" . mysql_real_escape_string($_POST['categorydescription']) . "')";  
    $result = mysql_query($sql);  
	}
    if(!$result)  
    {  
        echo 'Error' . mysql_error();  
    }  
    else  
    {  
        echo 'Category has been added.';  
    }  
}

include 'footer.php';
?>  