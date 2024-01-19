<?php
    $conn = mysqli_connect("10.0.104.93", "admin", "admin", "db_sekolah_m");

    if($conn->connect_error){
        die("Cannot to connect database:").$conn->connect_error;
    }
?>