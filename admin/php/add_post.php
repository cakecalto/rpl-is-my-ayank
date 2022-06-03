<?php

session_start();

if(!isset($_SESSION['admin']))
{
  header("Location: http://localhost/nofly/login.php");
}

    $db = mysqli_connect("localhost", "Krisadell", "Kr1s4nd1_03", "dramakost");
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);
    $pass = hash('sha512', $pass);
    $query = "INSERT INTO admin (Username, Email, Password) VALUES ('$username', '$email','$pass')";

    $result = mysqli_query($db, $query);

    header("Location: http://localhost/DRAMAKOST/admin/insert_post.php");

?>