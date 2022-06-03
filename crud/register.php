<?php

include("config.php");

if(isset($_POST['submit'])) {

    $username = strtolower(stripslashes($_POST['username']));
    $pass = mysqli_real_escape_string($db, $_POST['password']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // cek username dan email sudah ada atau belum
    $check = mysqli_query($db, "SELECT username FROM customer WHERE username = '$username'");
    if( mysqli_fetch_assoc($check) ) {
        echo "<script>
            alert('username sudah terdaftar!')
        </script>";
        return false;
    }

    $check = mysqli_query($db, "SELECT email FROM customer WHERE email = '$email'");
    if( mysqli_fetch_assoc($check) ) {
        echo "<script>
            alert('email sudah terdaftar!')
        </script>";
        return false;
    }
        
    $pass = hash('sha512', $pass);
        
    // tambahkan user baru ke database
    $query = "INSERT INTO customer (username, email, password) VALUES ('$username', '$email', '$pass')";
    $result = mysqli_query($db, $query);

    if ($result) {
        header("Location: http://localhost/RPL/RPLori/dashboard.php");
    }
    else {
        header("Location: http://localhost/RPL/RPLori/signup.php");
    }
}
else {
    die("Akses dilarang...");
}

?>