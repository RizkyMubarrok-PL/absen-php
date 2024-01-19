<?php
    session_start();
    include "../../database/connection.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nis = $_POST['id'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];        
        $tgl = date_create($_POST['tgl_lahir']);
        $tgl_lahir = date_format($tgl, "Y-m-d");

        if(empty($nis)){
            echo "<script>alert('Gagal Menambahkan Data, Isikan NIS Dahulu');</script>";
        }elseif(empty($nama)){
            echo "<script>alert('Gagal Menambahkan Data, Isikan Nama Dahulu');</script>";
        }elseif(empty($password)) {
            echo "<script>alert('Gagal Menambahkan Data, Isikan Password Dahulu');</script>";
        }elseif(empty($tgl_lahir)){
            echo "<script>alert('Gagal Menambahkan Data, Isikan Tanggal Lahir Dahulu');</script>";
        }else{
            $sql = "INSERT INTO `guru` (`ID_GURU`,`NAMA`,`PASSWORD`, `TGL_LAHIR`) VALUES ($id, '$nama', '$password', '$tgl_lahir')";
            if($conn->query($sql)){
                echo "<script>alert('Berhasil Menambahkan Data');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Guru</title>
</head>
<body>
    <form action="" method="post">
        <h3>Add Form</h3>
        <label for="">ID : </label>
        <input type="text" name="id" id="" placeholder="4 Number lenght"><br>

        <label for="">Nama : </label>
        <input type="text" name="nama" id="" placeholder="John Doe"><br>

        <label for="">Password : </label>
        <input type="password" name="password" id="" placeholder="8 Character"><br>

        <label for="">Tanggal Lahir : </label>
        <input type="date" name="tgl_lahir" id=""><br>

        <input type="submit" value="ADD">
        <input type="reset" value="RESET">
    </form>

    <?php
    $sql = "SELECT * FROM guru  ";
    $result = $conn->query($sql);
                    
    
    if(empty($result->num_rows)){
        echo "Data Guru Kosong";
    }else{
        echo "
            <table>
                <h3>Data Guru</h3>

                <tr>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>TANGGAL LAHIR</th>
                </tr>";
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                    <td>{$row['ID_GURU']}</td>
                    <td>{$row['NAMA']}</td>
                    <td>{$row['TGL_LAHIR']}</td>
                    <td><button value=''><a href='update.php?ID={$row['ID_GURU']}'>Update</button></td>
                    <td><button value=''><a href='delete.php?ID={$row['ID_GURU']}'>Delete</button></td>
                </tr>
                ";
            }

            echo "</table>";
    }            
    ?>
    
</body>
</html>