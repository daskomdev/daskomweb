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
    $result = $conn->query($sql);
    echo "\n".$result."\n";
 //for ($dbsoal=1; $dbsoal<7; $dbsoal++){ 
    //FITB
    $sql = "SELECT soal__fitbs.soal FROM soal__fitbs WHERE soal__fitbs.modul_id = ".$modul_id;
	$result = $conn->query($sql);
    echo "FITB:"; 
    echo "\n".$result."\n";
    //jurnal
    $sql = "SELECT soal__jurnals.soal FROM soal__jurnals WHERE soal__jurnals.modul_id = ".$modul_id;
	$result = $conn->query($sql);
    echo "Jurnal:"; 
    echo "\n".$result."\n";	
    //mandiri
    $sql = "SELECT soal__mandiris.soal FROM soal__mandiris WHERE soal__mandiris.modul_id = ".$modul_id;
	$result = $conn->query($sql);
    echo "Mandiri:"; 
    echo "\n".$result."\n";	
    //TA
    $sql = "SELECT soal__tas.pertanyaan, soal__tas.jawaban_benar FROM soal__tas WHERE soal__tas.modul_id = ".$modul_id;
	$result = $conn->query($sql);
    echo "Tes Awal (TA):"; 
    echo "\n".$result."\n";	

	
	/*if ($result->num_rows > 0) {
		$rating = 0;
		$nama;
	    while($row = $result->fetch_assoc()) {
	        $nama = $row["nama"];
	        $rating += $row["rating_asisten"];
	    }
	    $rating /= $result->num_rows;
            echo "(".$asisten_id.") ".$nama." = ".$rating."\n";
	    if($bestRating < $rating){
		$bestRating = $rating;
	    	$bestAsisten = $nama." ".$rating;
	    }
	}*/
}
//}

//echo "\nBest Asisten = ".$bestAsisten;

$conn->close();
?> 