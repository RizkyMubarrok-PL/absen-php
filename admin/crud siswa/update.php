<?php
    include "../../database/connection.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){        
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $tingkat = $_POST['tingkat'];
        $kelas = $_POST['kelas']; 
        $tgl = date_create($_POST['tgl_lahir']);
        $tgl_lahir = date_format($tgl, "Y-m-d");

        $sql = "UPDATE `siswa` SET  `NIS`=$nis, `NAMA`='$nama', `PASSWORD`='$password', `NAMA_KELAS`='$tingkat$kelas', `TGL_LAHIR`='$tgl_lahir' WHERE `NIS`={$_GET['NIS']}";
        if($conn->query($sql) === true){

            header("Location: crud_siswa.php");
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
    <?php
        $sql = "SELECT * FROM `siswa` WHERE `NIS`={$_GET['NIS']}";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            echo "
            <table>
                <tr>
                    <td>NIS : </td>
                    <td>{$row['NIS']}</td>
                </tr>

                <tr>
                    <td>NAMA : </td>
                    <td>{$row['NAMA']}</td>
                </tr>

                <tr>
                    <td>PASSWORD : </td>
                    <td>{$row['PASSWORD']}</td>
                </tr>

                <tr>
                    <td>KELAS : </td>
                    <td>{$row['NAMA_KELAS']}</td>
                </tr>

                <tr>
                    <td>TANGGAL LAHIR : </td>
                    <td>{$row['TGL_LAHIR']}</td>
                </tr>
            </table>";
        }
    ?>
    <form action="" method="post">
        <h3>Update Form</h3>
        <label for="">NIS : </label>
        <input type="text" name="nis" id=""><br>
        <label for="">NAMA : </label>
        <input type="text" name="nama" id=""><br>
        <label for="">PASSWORD : </label>
        <input type="text" name="password" id=""><br>
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
        <label for="">TANGGAL LAHIR : </label>
        <input type="date" name="tgl_lahir" id=""><br>
        <input type="submit" name="Update" value="Update">
    </form>
</body>
</html>