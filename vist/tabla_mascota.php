<?php
require_once("../bd/conexion.php");
$db = new Database();
$conectar = $db->conectar();
date_default_timezone_set('America/Bogota');

$consulta = $conectar->prepare("
    SELECT v.id_vacuna, v.nombre, v.fecha_aplicacion, v.fecha_vencimiento, v.veterinario, m.nombre AS nombre_mascota, m.especie, m.raza
    FROM vacuna v
    JOIN mascota m ON v.id_mascota = m.id_mascota
");

$fecha_actul=date('Y-m-d');
$consulta->execute();
$vacunas = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <caption><label>Información de Vacunas</label></caption>
    <tr>
        <td>Referencia</td>
        <td>Nombre de la Vacuna</td>
        <td>Fecha de Aplicación</td>
        <td>Fecha de Vencimiento</td>
        <td>Veterinario</td>
        <td>Nombre de la Mascota</td>
        <td>Especie</td>
        <td>Raza</td>
    </tr>

    <?php foreach ($vacunas as $vacuna) { ?>
        <?php
      $fecha_vencimiento = strtotime($vacuna['fecha_vencimiento']);
     
      $fecha_sistema = strtotime(date('Y-m-d' )); // Convertir la fecha del sistema a timestamp
      $color = 'inherit';
      $mensaje = '';

      
      
      if ($fecha_vencimiento < $fecha_sistema) {
          $color = 'red';
          $mensaje = 'Debe volver a aplicar la vacuna';
      } elseif ($fecha_vencimiento == $fecha_sistema) {
          $color = 'orange';
          $mensaje = 'La vacuna se vence hoy';
      } elseif ($fecha_vencimiento > $fecha_sistema) { 
          $color = 'green';
          $mensaje = 'La vacuna tiene vigencia';
      }

        ?>
     
            <td><?php echo $vacuna['id_vacuna']; ?></td>
            <td><?php echo $vacuna['nombre']; ?></td>
            <td><?php echo $vacuna['fecha_aplicacion']; ?></td>
            <td style="color: <?php echo $color;?>"><?php echo $vacuna['fecha_vencimiento']; ?></td>
            <td><?php echo $vacuna['veterinario']; ?></td>
            <td><?php echo $vacuna['nombre_mascota']; ?></td>
            <td><?php echo $vacuna['especie']; ?></td>
            <td><?php echo $vacuna['raza']; ?></td>
        
        <tr style="color: <?php echo $color; ?>">
            <td colspan="8"><?php echo $mensaje; ?></td>
        </tr>
    <?php } ?>
</table>
