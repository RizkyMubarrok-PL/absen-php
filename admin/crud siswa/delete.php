<?php
    include "../../database/connection.php";
    $nis = $_GET['NIS'];
    $sql = "DELETE FROM `siswa` WHERE `NIS`=$nis";

    if($conn->query($sql) === true){
        header("Location: crud_siswa.php");
    }else{
        $conn->connect_error;
    }
?>