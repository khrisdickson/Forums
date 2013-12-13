<?php
include 'connectvars.php';
include 'header.php';

$category = "SELECT * FROM Category";

$result = mysql_query($category);

if(mysql_num_rows($result) == 0)  
    {  
        echo 'This category does not exist.';  
    }  
    else  
    {  
        //display category data  
        while($row = mysql_fetch_assoc($result))  
        {  
            echo '<h2>' . $row["categoryname"] . '<br />' . '</h2>';  
            echo $row["categorydescription"] . '<br />';
        }  
        	
    }

    echo '<a href = "category.php"> Add Category </a>';
include 'footer.php';

?>