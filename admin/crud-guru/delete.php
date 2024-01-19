<?php
    include "../../database/connection.php";
    $id = $_GET['ID'];
    $sql = "DELETE FROM `guru` WHERE `ID_GURU`=$id";

    if($conn->query($sql) === true){
        header("Location: crud_guru.php");
    }else{
        $conn->connect_error;
    }
?>