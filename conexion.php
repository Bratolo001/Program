<?php
$host = "localhost";
$user = "root";
$clave = "1023957195Bra.";
$bd  = "brandon";

// Crear una conexión a la base de datos
$conectar = mysqli_connect($host, $user, $clave, $bd);

// Verificar la conexión
if (!$conectar) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa"; // Agrega un mensaje de éxito aquí
}
?>
