<?php

$arreglo = explode (',',$_POST["id"]);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartgolf";

try {

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE puntuacion SET Golpes = ".$_POST["golpes"]." WHERE IdJuego= ".$arreglo[0]." AND IdHoyo = ".$arreglo[1];
$result = $conn->query($sql);

header('Location: ' . 'http://'.$_SERVER['HTTP_HOST'].'/smartGolf/ResultadoFecha.php');
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
?>