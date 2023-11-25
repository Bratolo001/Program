<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';

    // Validación de datos (puedes agregar más validaciones según tus necesidades)
    if (strlen($usuario) >= 1 && strlen($contrasena) >= 1) {
        // Buscar el usuario en la base de datos
        $buscar_usuario = "SELECT * FROM clientes WHERE nombre = '$usuario'";
        $resultado = mysqli_query($conectar, $buscar_usuario);

        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);

            // Verificar la contraseña
            if (password_verify($contrasena, $fila['contrasena_hash'])) {
                // Credenciales correctas, redirigir a la página.html
                header("Location: ../pagina.html");
                exit();
            } else {
                echo "<script>alert('Contraseña incorrecta.');</script>";
            }
        } else {
            echo "<script>alert('Error al buscar el usuario en la base de datos: " . mysqli_error($conectar) . "');</script>";
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos correctamente.');</script>";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conectar);
?>
