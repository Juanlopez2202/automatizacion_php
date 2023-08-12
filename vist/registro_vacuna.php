<?php
require_once("../bd/conexion.php"); // Asegúrate de tener el archivo de conexión a la base de datos
$db = new database();
$conectar = $db->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_mascota = $_POST["id_mascota"];
    $veterinario = $_POST["veterinario"];
    $nombre = $_POST["nombre"];
    $fecha_aplicacion = $_POST["fecha_aplicacion"];

    // Calcular la fecha de vencimiento sumando un año a la fecha de aplicación
    $fecha_vencimiento = date('Y-m-d', strtotime('+1 year', strtotime($fecha_aplicacion)));

    $query = "INSERT INTO vacuna (id_mascota, veterinario, nombre, fecha_aplicacion, fecha_vencimiento)
              VALUES (:id_mascota, :veterinario, :nombre, :fecha_aplicacion, :fecha_vencimiento)";

    $stmt = $conectar->prepare($query);
    $stmt->bindParam(':id_mascota', $id_mascota);
    $stmt->bindParam(':veterinario', $veterinario);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':fecha_aplicacion', $fecha_aplicacion);
    $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento);

    if ($stmt->execute()) {
        echo "Vacuna registrada con éxito";
    } else {
        echo "Error al registrar la vacuna";
    }
}
?>
