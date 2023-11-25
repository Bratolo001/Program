<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $colegio = isset($_POST['colegio']) ? trim($_POST['colegio']) : '';
    $edad = isset($_POST['edad']) ? intval($_POST['edad']) : 0;
    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';

    // Validación de datos (puedes agregar más validaciones según tus necesidades)
    if (
        strlen($nombre) >= 1 &&
        strlen($colegio) >= 1 &&
        $edad >= 1 &&
        strlen($sexo) >= 1 &&
        strlen($contrasena) >= 1
    ) {
        // Hash de la contraseña (asegúrate de utilizar una técnica segura como bcrypt)
        $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Insertar los datos en la base de datos sin el campo de foto
        $insertar = "INSERT INTO clientes (nombre, colegio, edad, sexo, contrasena_hash)
                     VALUES ('$nombre', '$colegio', $edad, '$sexo', '$contrasena_hash')";

        $query = mysqli_query($conectar, $insertar);

        if ($query) {
            echo "<script>alert('Los datos se han insertado correctamente en la base de datos.');</script>";
            header("Location: ../pagina.html");
            exit();
        } else {
            echo "<script>alert('Error al insertar los datos en la base de datos: " . mysqli_error($conectar) . "');</script>";
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos correctamente.');</script>";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conectar);
?>
