<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // Cambiar si es necesario
$user = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos
$dbname = 'abm_formularios';

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $email = $conn->real_escape_string($_POST['email']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $localidad = $conn->real_escape_string($_POST['localidad']);
    $provincia = $conn->real_escape_string($_POST['provincia']);
    $pais = $conn->real_escape_string($_POST['pais']);
    $carrera = $conn->real_escape_string($_POST['carrera']);

    // Insertar en la tabla `personas`
    $sql = "INSERT INTO personas (nombre, apellido, email, direccion, localidad, provincia, pais, carrera) 
            VALUES ('$nombre', '$apellido', '$email', '$direccion', '$localidad', '$provincia', '$pais', '$carrera')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='message'>Registro exitoso.</div>";
    } else {
        echo "<div class='message'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Cerrar conexión
$conn->close();
?>
