<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // Cambiar si es necesario
$user = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos
$dbname = 'abm_formulario';

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Conexión a la base de datos (ajusta según tus datos de conexión)
$conn = new mysqli('localhost', 'root', '', 'abm_formularios');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $DNI = intval($_POST['DNI']);  // Convertir DNI a entero
    $email = $conn->real_escape_string($_POST['email']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $localidad = $conn->real_escape_string($_POST['localidad']);
    $provincia = $conn->real_escape_string($_POST['provincia']);
    $pais = $conn->real_escape_string($_POST['pais']);
    $carrera = $conn->real_escape_string($_POST['carrera']);

    if ($DNI === 0) {
        die("El DNI proporcionado no es válido.");
    }

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO persona (nombre, apellido, email, direccion, localidad, provincia, pais, carrera, DNI) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssssi', $nombre, $apellido, $email, $direccion, $localidad, $provincia, $pais, $carrera, $DNI);

    if ($stmt->execute()) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();


    if ($conn->query($sql) === TRUE) {
        echo "<div class='message'>Registro exitoso.</div>";
    } else {
        echo "<div class='message'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

// Cerrar conexión
$conn->close();
?>
