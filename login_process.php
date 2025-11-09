<?php
session_start();
include("db.php");

$username = $_POST['username'];
$password = md5($_POST['password']); // encrypt entered password

$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $_SESSION['admin'] = $username;
  header("Location: admin_home.php");
} else {
  echo "Invalid login!<br><a href='login.html'>Try Again</a>";
}
$conn->close();
?>
