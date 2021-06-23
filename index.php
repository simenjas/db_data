<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_biodata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM data";
$result = $conn->query($sql);

$data = null;
$profile = null;
$sekolah = null;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "ada";
    $data = $row;
    $profile = json_decode($data['profile']);
    $hobi = json_decode($data['hobi']);
    $sekolah = json_decode($data['pendidikan']);
  }
} else {
  echo "Data tidak di temukan";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata</title>
</head>
<body>
    <p>Nama : <?= $data['nama'] ?></p>
    <p>Tempat Tanggal Lahir : <?= $profile->ttl ?></p>
    <p>Agama : <?= $profile->agama ?></p>
    <p>Alamat : <?= $profile->alamat ?></p>
    <p>status : <?= $profile->status ?></p>
    <div>
        <div style="display: flex; flex-direction: row;">
            <p>Pendidikan : </p>
            <ul>
                <?php foreach ($sekolah as $h) { ?>
                    <li><?= $h ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</body>
</html>