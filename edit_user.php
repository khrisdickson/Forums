<html>
<body>

<?php

session_start();
if (empty($_SESSION['userid'])) {
	header('location:login.html');
}
else {
$conn = mysqli_connect ('webdesign4.georgianc.on.ca','db100083097 ','871124','db100083097') or die('Error connecting to MySQL server');


$sql = "SELECT * FROM Users WHERE userid = $id;";
$result = mysqli_query($conn, $sql) or die('Error querying database.');

echo '<table border="1"><tr><th>User Name</th><th>Password</th><th>Email</th><td>Edit</th></tr>';
  
while ($row = mysqli_fetch_array($result)) {
    echo '<tr><td>' . $row['username'] . '</td><td>' . $row['password'] . '</td><td>' .$row['email'] . '</td>
    <td><a href="user.php?id=' . $row['id'] . '">Edit</a></td></tr>';
    
}

echo '</table>';

mysqli_close($conn);
}



?>
click <a href="index.php">here</a> enter admin menu

</body>
</html>
