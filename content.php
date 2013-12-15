<?php
session_start();

if (empty($_SESSION['userid'])) {
	header('location:login.html');
}
?>

<?php
$conn = mysqli_connect('localhost', 'db100083097','871124','db100083097') or die('Error connecting to MySQL server.');

$sql= "SELECT * FROM website";
$result = mysqli_query($conn ,$sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>

</head>

<body>
<div id="contain">
<div id="header">
<h1> Welcome to my Page..</h1>
</div>
<div id="menus">
<a href="index.php" target="_self">Home</a>

<?php
$conn = mysqli_connect('localhost', 'db200233635', '97526', 'db200233635') or die('Error connecting to MySQL server.');

/*
Displaying List of Categories from the Table - Category and that is limited to 6
*/

$sql= "SELECT * FROM website LIMIT 0, 6";
$result = mysqli_query($conn ,$sql);

while($row=mysqli_fetch_array($result))
{
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=articles.php?cat=".$row['content'].">".$row['content']."</a>

&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>
</div>

<div id="l_space">
<h2>Topic </h2>
<?php

$conn = mysqli_connect('localhost', 'db200233635', '97526', 'db200233635') or die('Error connecting to MySQL server.');

if(isset($_GET['id']))
{
$id=$_GET['id'];
$sql= "SELECT * FROM website WHERE id=$id";
$result = mysqli_query($conn ,$sql);

                /* Fetching data from the field "title" */
               
while($row=mysqli_fetch_array($result))
{
echo "<h2>".$row['title']."</h2>";
echo "<img src=".$row['image']." />";
echo "<p>".$row['content']."</p>";
}
}

/*
based on the page name received from index.php file the last added content is displayed
*/
if(isset($_GET['page']))
{
//echo $_GET['page'];
$page=$_GET['page'];

$sql= "SELECT * FROM website WHERE page='$page' order by page DESC LIMIT 0, 1";
$result = mysqli_query($conn ,$sql);

                /* Fetching data from the field "title" */
while($row=mysqli_fetch_array($result))
{
echo "<h2>".$row['title']."</h2>";
echo "<img src=".$row['image']." />";
echo "<p>".$row['content']."</p>";
}
}

?>

</div>

 

  <div id="r_space">
<h2>More</h2>
<?php
/*
based on the id received from index.php through url, the content of the particular page is determined
*/
$conn = mysqli_connect('localhost', 'db100083097','871124','db100083097') or die('Error connecting to MySQL server.');

$sql= "SELECT page FROM website WHERE id='$id'";
$result = mysqli_query($conn ,$sql);




if(isset($_GET['id']))
{
$id=$_GET['id'];
$sql= "SELECT page FROM website WHERE id='$id'";
$result = mysqli_query($conn ,$sql);
/* Fetching data from the field "title" */
$row=mysqli_fetch_array($result);
$page=$row['page'];

/*
once the content of the page is determined this section is used to display the title of all the content belonging to the page
*/ 
$sql= "SELECT * FROM website WHERE page='$page' order by content DESC";
$result = mysqli_query($conn ,$sql);

while($row=mysqli_fetch_array($result))
{
//echo $row['title'];
echo "<li><a href=content.php?id=".$row['id'].">".$row['title']."</a></li>";
}
}

/*
based on the content name received from index.php file title names of all the page belong to the content is displayed with hyperlinks
*/           
if(isset($_GET['page']))
{
$page=$_GET['page'];


$sql= "SELECT * FROM content WHERE page='$page' order by content DESC";
$result = mysqli_query($conn ,$sql);

while($row=mysql_fetch_array($result))
{
echo "<li><a href=content.php?id=".$row['id'].">".$row['title']."</a></li>";
}

}
?>
</div>

<div id="footer">
<div align="center"><strong>Copyright @ 2011 - All Rights Reserved</strong></div>

</body>
</html>
