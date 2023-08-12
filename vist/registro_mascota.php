<?php
require_once("../bd/conexion.php"); 
$db = new database();
$conectar = $db->conectar(); // Asegúrate de tener el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $especie = $_POST["especie"];
    $raza = $_POST["raza"];
    $fechaNacimiento = $_POST["fecha_nacimiento"];
    $propietario = $_POST["propietario"];

    $query = "INSERT INTO mascota (nombre, especie, raza, fecha_nacimiento, propietario)
              VALUES (:nombre, :especie, :raza, :fechaNacimiento, :propietario)";

    $stmt = $conectar->prepare($query);
    $stmt->bindValue(':nombre', $nombre);
    $stmt->bindValue(':especie', $especie);
    $stmt->bindValue(':raza', $raza);
    $stmt->bindValue(':fechaNacimiento', $fechaNacimiento);
    $stmt->bindValue(':propietario', $propietario);

    if ($stmt->execute()) {
        echo '<script>alert("Mascota registrada");</script>';
        echo '<script>window.location="mascota.php"</script>';
    } else {
        echo "Error al registrar la mascota";
    }

    
}
?>
