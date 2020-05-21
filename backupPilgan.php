<?php
$servername = "localhost";
$username = "root";
$password = "D3vk0mtelu!";
$dbname = "daskomdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
for ($modul_id=1; $modul_id <25; $modul_id++)
{
    $sql = "SELECT moduls.judul,moduls.id FROM moduls WHERE moduls.id = ".$modul_id;
    $result = $conn->query($sql)->fetch_assoc()['judul'];
    echo "\n".$result."\n--------------------------\n";
    echo "\n Test awal: \n";
    $sql = "SELECT soal__tas.pertanyaan, soal__tas.jawaban_benar,soal__tas.id FROM soal__tas WHERE soal__tas.modul_id = ".$modul_id;
    if ($hasil = $conn->query($sql))
    {
        while ($row = $hasil->fetch_array())
        {
            $soal=$row['pertanyaan'];
            $jawaban=$row['jawaban_benar'];
            echo "\nPertanyaan: ".$soal."\n Jawaban Benar: ".$jawaban;
        }
        $hasil->free();
    }
    echo "\n Test Akhir: \n";
    $sql = "SELECT soal__tks.pertanyaan, soal__tks.jawaban_benar,soal__tks.id FROM soal__tks WHERE soal__tks.modul_id = ".$modul_id;
    if ($hasil = $conn->query($sql))
    {
        while ($row = $hasil->fetch_array())
        {
            $soal=$row['pertanyaan'];
            $jawaban=$row['jawaban_benar'];
            echo "\nPertanyaan: ".$soal."\n Jawaban Benar: ".$jawaban;
        }
        $hasil->free();
    }

}
$conn->close();
?> 