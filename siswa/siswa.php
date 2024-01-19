<?php
    session_start();
    include "../database/connection.php";
    $_SESSION['NIS'] = 1;
    $kelas = $conn->query("SELECT `NAMA_KELAS` FROM `siswa` WHERE `NIS`={$_SESSION['NIS']}");
    $kelas = $kelas->fetch_assoc();
    $kelas = $kelas['NAMA_KELAS'];
     
    $rhari = $conn->query("SELECT * FROM `hari`");    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>
    <form id="form-jadwal" action="siswa.php" method="post">
        <?php echo "<h3>{$kelas}</h3>";?>
        <select name="hari" id="hari">
            <option value="null">Pilih Jadwal Hari</option>
            <?php
                while($hari = $rhari->fetch_assoc()){
                    $nama_hari = $hari['HARI'];
                    $id_hari = $hari['ID_HARI'];
                    echo "<option value='{$id_hari}'>{$nama_hari}</option>";
                }
            ?>
        </select>         
    </form>
        <script>
            document.getElementById('hari').addEventListener('change', function() {
                document.getElementById('form-jadwal').submit();
            });
        </script>
</body>

    <?php
    
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $hari = $_POST['hari'];
            $qhari = $conn->query("SELECT * FROM `hari` WHERE `ID_HARI`=$hari");
            $nhari = $qhari->fetch_assoc();
            $nhari = $nhari['HARI'];
            echo "<h3>{$nhari}</h3>";
            $Rjadwal = $conn->query("SELECT * FROM `jadwal` WHERE `ID_HARI`=$hari AND `NAMA_KELAS`='$kelas'");
            $num = 1;
            echo "<table border='1'>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>MAPEL</th>
                <th>RUANG</th>
            </tr>
            ";

            while($jadwal = $Rjadwal->fetch_assoc()){

                $nama = $conn->query("SELECT NAMA FROM `guru` WHERE `ID_GURU`={$jadwal['ID_GURU']}");
                $nama = $nama->fetch_assoc();
                $nama = $nama['NAMA'];  
                
                $pelajaran = $conn->query("SELECT `NAMA_PELAJARAN` FROM `pelajaran` WHERE `ID_MAPEL`={$jadwal['ID_MAPEL']}");
                $pelajaran = $pelajaran->fetch_assoc();
                $pelajaran = $pelajaran['NAMA_PELAJARAN'];     

                $ruang = $conn->query("SELECT NAMA_RUANG FROM `ruang` WHERE `ID_RUANG`={$jadwal['ID_RUANG']}");
                $ruang = $ruang->fetch_assoc();
                $ruang = $ruang['NAMA_RUANG'];            
                echo "
                <tr>
                    <td>{$num}</td>
                    <td>{$nama}</td>
                    <td>{$pelajaran}</td>
                    <td>{$ruang}</td>
                </tr>";
            }
            echo "</table>";
        }
    ?>

    <?php
        $sql = $conn->query("SELECT * FROM `presensi_siswa` WHERE `ID_SISWA`={$_SESSION['NIS']}");
        $num = 1;
        echo "<table>";
        echo "
        <tr>
            <th>NO</th>
            <th>MAPEL</th>
            <th>TANGGAL</th>
            <th>STATUS</th>
            <th>KETERANGAN</th>
        </tr>";
        while($presensi = $sql->fetch_assoc()){
            $id_jadwal = $presensi['ID_JADWAL'];
            $sql = $conn->query("SELECT `ID_MAPEL` FROM `jadwal` WHERE `ID_JADWAL`=$id_jadwal");
            $id_mapel = $sql->fetch_assoc();
            $id_mapel  = $id_mapel['ID_MAPEL'];

            $sql = $conn->query("SELECT `NAMA_PELAJARAN` FROM `pelajaran` WHERE `ID_MAPEL`=$id_mapel");
            $mapel = $sql->fetch_assoc();
            $mapel = $mapel['NAMA_PELAJARAN'];

            $tgl = $presensi['TGL'];
            $status = $presensi['STATUS'];
            $keterangan = $presensi['KETERANGAN'];

            echo "
            <tr>
                <td>{$num}</td>
                <td>{$mapel}</td>
                <td>{$tgl}</td>
                <td>{$status}</td>
                <td>{$keterangan}</td>
            </tr>";

            $num ++;
        }
        echo "</table>";
    ?>

</html>