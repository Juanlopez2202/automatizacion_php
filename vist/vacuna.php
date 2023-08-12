<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vacuna</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Registro de Vacuna</h1>
        <form action="registro_vacuna.php" method="POST">
            <div class="mb-3">
                <label for="id_mascota" class="form-label">Mascota</label>
                <select class="form-select" id="id_mascota" name="id_mascota" required>
                    <?php
                    require_once("../bd/conexion.php"); // Asegúrate de tener el archivo de conexión a la base de datos
                    $db = new Database();
                    $conectar = $db->conectar(); 
                    $query_mascotas = "SELECT id_mascota, nombre FROM mascota";
                    $mascotas = $conectar->prepare($query_mascotas);
                    $mascotas->execute();

                    while ($row_mascota = $mascotas->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=\"" . $row_mascota["id_mascota"] . "\">" . $row_mascota["nombre"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Veterinario</label>
                <input type="text" class="form-control" id="nombre" name="veterinario" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Vacuna</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="fecha_aplicacion" class="form-label">Fecha de Aplicación</label>
                <input type="date" class="form-control" id="fecha_aplicacion" name="fecha_aplicacion" required   value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Registrar Vacuna</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
