<?php
session_start();

if (empty($_SESSION['userid'])) {
	header('location:login.html');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control Panel</title>
<link href="admin_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="hold">
<div id="top">
<h2 align="center">ADMINISTRATION MANAGEMENT</h2>
</div>
<div id="log">
<?php
echo "Welcome ".$_SESSION['userid'];
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href=logout.php>Logout</a>";
?>
</div>
<div id="left">
<a href=new_page.php >Create New Page</a><br/>
<a href=remove_page.php >Remove a Page</a><br/>


<a href="user_admin_table.php"> Admin.Users</a><br/>
<b>Pages by Content</b>
<?php
$conn = mysqli_connect ('webdesign4.georgianc.on.ca','db100083097','871124','db100083097') or die('Error connecting to MySQL server');
$sql = "SELECT * FROM website";
$result = mysqli_query($conn, $sql) or die('Error querying database.');

/* Fetching data from the field "title" */
while($row=mysqli_fetch_array($result))
{
echo "<li><a href=admin_panel.php?cat=".$row['page'].">".$row['page']."</a></li>";
}
?>
</div>
<div id="right">

<?php


$conn = mysqli_connect ('webdesign4.georgianc.on.ca','db100083097','871124','db100083097') or die('Error connecting to MySQL server');


$sql = "SELECT * FROM website order by content";
$result = mysqli_query($conn, $sql) or die('Error querying database.');


echo '<table border="1"><tr><th>Title</th><th>Edit</th><th>Delete</th></tr>';
/* Fetching data from the field "title" */
while($row=mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><a href=content.php?id=".$row['id'].">".$row['title']."</a></td>";
echo "<td><a href=edit_content.php?id=".$row['id'].">edit</a></td>";
echo "<td><a href=delete_content.php?id=".$row['id'].">delete</a></td>";
echo "</tr>";
}
echo "</table>";

?>
<?php

	$conn = mysqli_connect ('webdesign4.georgianc.on.ca','db100083097','871124','db100083097') or die('Error connecting to MySQL server');


	$sql = "SELECT * FROM website WHERE page='$page' ";
	$result = mysqli_query($conn, $sql) or die('Error querying database.');

	
	if(isset($_GET['page'])){
	$sql = "SELECT * FROM website WHERE page='$page' ";
	$page=$_GET['page'];
	$result=mysqli_query($conn, $sql) or die('Error querying database.');
if(!$result)
{
die("Query Failed: ". mysqli_error());
}
echo "<table>";
while($row=mysqli_fetch_array($result))
{
//echo $row['title'];
echo "<tr>";
echo "<td><a href=content.php?id=".$row['id'].">".$row['title']."</a></td>";
echo "<td><a href=edit_content.php?id=".$row['id'].">edit</a></td>";
echo "<td><a href=delete_content.php?id=".$row['id'].">delete</a></td>";
echo "</tr>";
}
echo "</table>";
}

?>
</div>
</div>
</body>
</html>
