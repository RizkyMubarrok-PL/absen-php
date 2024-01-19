<?php
    include "../../database/connection.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){        
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $tgl = date_create($_POST['tgl_lahir']);
        $tgl_lahir = date_format($tgl, "Y-m-d");

        $sql = "UPDATE `guru` SET  `ID_GURU`=$id, `NAMA`='$nama', `PASSWORD`='$password', `TGL_LAHIR`='$tgl_lahir' WHERE `ID_GURU`={$_GET['ID']}";
        if($conn->query($sql) === true){

            header("Location: crud_guru.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <form action="" method="post">
        <h3>Update Form</h3>
        <label for="">ID : </label>
        <input type="text" name="id" id=""><br>
        <label for="">NAMA : </label>
        <input type="text" name="nama" id=""><br>
        <label for="">PASSWORD : </label>
        <input type="text" name="password" id=""><br>
        <label for="">TANGGAL LAHIR : </label>
        <input type="date" name="tgl_lahir" id=""><br>
        <input type="submit" name="Update" value="Update">
    </form>
</body>
</html>