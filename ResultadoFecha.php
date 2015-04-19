<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">


        <title>Smart Golf - Las Brisas de Santo Domingo</title>

    <link href="bootstrap-3.2.0-dist/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-3.2.0-dist/bootstrap-3.2.0-dist/css/normalize.css" rel="stylesheet">
    <link href="bootstrap-3.2.0-dist/bootstrap-3.2.0-dist/css/dashboard.css" rel="stylesheet">
  </head>
<body>
<div class="col-md-12">
    <div class='row'>
        <div class='col-md-2'>
            Jugador
        </div>
        <div class='col-md-1'>
            Hoyos
        </div>
        <div class='col-md-1'>
            Puntos
        </div>
        <div class='col-md-2'>
            Modificar
        </div>
    </div>
<?php

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
    while($row = $result->fetch_assoc()) {
        echo "<div class='row'> <div class='col-md-2'>". $row['Jugador']."</div>";
        echo "<div class='col-md-1'>".$row['Hoyos']."</div>";
        echo "<div class='col-md-1'>".$row['Puntos']."</div>";
        echo "<div class='col-md-2'><form action='ResultadoFechaJugador.php' method='post' class='form-inline' role='form'><div class='form-group'><input type='hidden' name='IdJugador' value='".$row['IdJugador']."'><input type='hidden' name='IdFecha' value='".$row['IdFecha']."'><input class='btn btn-default' type='submit' value='modificar'> </div></form></div></div>";   
    }
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
</div>
</body>