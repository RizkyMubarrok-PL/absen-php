<?php
    session_start();
    include "../../database/connection.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $password = $_POST['password']; 
        $tingkat = $_POST['tingkat'];
        $kelas = $_POST['kelas'];        
        $tgl = date_create($_POST['tgl_lahir']);
        $tgl_lahir = date_format($tgl, "Y-m-d");     
                
        
        if(empty($nis) || empty($nama) || empty($password) || empty($tgl_lahir)){
            echo "<script>alert('Lengkapi form dahulu');</script>";
        }else{
            $sql = "INSERT INTO `siswa` (`NIS`,`NAMA`,`PASSWORD`, `NAMA_KELAS`, `TGL_LAHIR`) VALUES ($nis, '$nama', '$password', '$tingkat$kelas', '$tgl_lahir')";
            var_dump($sql);
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
    <title>CRUD Siswa</title>
</head>
<body>
    <form action="" method="post">
        <h3>Add Form</h3>
        <label for="">NIS : </label>
        <input type="text" name="nis" id="" placeholder="4 Number lenght"><br>

        <label for="">Nama : </label>
        <input type="text" name="nama" id="" placeholder="Ex. John Doe"><br>

        <label for="">Password : </label>
        <input type="password" name="password" id="" placeholder="8 Character"><br>

        <label for="">Kelas : </label>
        <select name="tingkat" id="">
            <option value="X-">X</option>
            <option value="XI-">XI</option>
            <option value="XII-">XII</option>
        </select>
        <select name="kelas" id="">
            <option value="RPL-1">RPL-1</option>
            <option value="RPL-2">RPL-2</option>
            <option value="DKV-1">DKV-1</option>
            <option value="DKV-2">DKV-2</option>
            <option value="DKV-3">DKV-3</option>
        </select><br>

        <label for="">Tanggal Lahir : </label>
        <input type="date" name="tgl_lahir" id=""><br>

        <input type="submit" value="ADD">
        <input type="reset" value="RESET">
    </form>

    <?php
    $sql = "SELECT * FROM siswa";
    $result = $conn->query($sql);
                    
    
    if(empty($result->num_rows)){
        echo "Data Siswa Kosong";
    }else{
        echo "
            <table>
                <h3>Data Siswa</h3>

                <tr>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>TANGGAL LAHIR</th>
                    <th>NAMA KELAS</th>
                </tr>";
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                    <td>{$row['NIS']}</td>
                    <td>{$row['NAMA']}</td>
                    <td>{$row['TGL_LAHIR']}</td>        
                    <td>{$row['NAMA_KELAS']}</td>
                    <td><button value=''><a href='update.php?NIS={$row['NIS']}'>Update</button></td>
                    <td><button value=''><a href='delete.php?NIS={$row['NIS']}'>Delete</button></td>
                </tr>
                ";
            }

            echo "</table>";
    }            
    ?>
    
</body>
</html>