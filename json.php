<?php
class dato {
    public $nombre;
    public $hoyos;
    public $puntos;
}
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

$sql = "SELECT ju.id IdJugador,j.IdFecha IdFecha,  Concat(concat(ju.Nombre,' '),ju.Apellidos) Jugador, Count(*) Hoyos, sum(g.Golpes - h.Par) Puntos  
from puntuacion g 
left join Hoyo h on g.IdHoyo = h.Id
left join juego j on j.id = g.IdJuego
Left join jugardor ju on ju.Id = j.IdJugador
Left join cancha c on c.id = h.idCancha
group by ju.Nombre
order by Puntos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $arreglo = array();
    $x=0;
    while($row = $result->fetch_assoc()) {
        $arreglo[$x] = new dato;
        $arreglo[$x]->nombre= $row['Jugador'];
        $arreglo[$x]->hoyos = $row['Hoyos'];
        $arreglo[$x]->puntos =$row['Puntos'];
        $x++;
    }
    echo $_GET['callback'].'('.json_encode($arreglo).')';
} else {
    echo "0 results";
}
$conn->close();    

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>