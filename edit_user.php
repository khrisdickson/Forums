<html>
<body>

<?php
include 'connectvars.php';  
include 'header.php';

(isset($_SESSION['userid']));

$conn = mysqli_connect('localhost', 'db100083097','871124','db100083097') or die('Error connecting to MySQL server.');

$sql = "SELECT * FROM Users";
$result = mysqli_query($conn, $sql);

echo '<table border="1"><tr><th>User Name</th><th>Password</th><th>Email</th><td>Edit</th></tr>';
  
while ($row = mysqli_fetch_array($result)) {
    echo '<tr><td>' . $row['username'] . '</td><td>' . $row['password'] . '</td><td>' .$row['email'] . '</td>
    <td><a href="user.php?id=' . $row['userid'] . '">Edit</a></td></tr>';
    
}

echo '</table>';






?>
click <a href="index.php">here</a> enter admin menu

</body>
</html>
