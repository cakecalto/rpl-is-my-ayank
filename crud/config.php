<?php
    $db=mysqli_connect("localhost", "Krisadell", "Kr1s4nd1_03", "nofly");
    if( !$db )
    {
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }
?>