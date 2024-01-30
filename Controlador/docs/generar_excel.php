<?php
header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=reporte.xls');

include_once("../../Modelo/Usuarios/Consultar_usuario.php");
$obj_usuarios = new Consultar_usuario();
$datos_usuario = $obj_usuarios->selectAllUsers_docs();
?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Sexo</th>
        <th>Edad</th>
    </tr>
    <?php


    foreach ($datos_usuario as $datos) {
        $id = $datos['ID'];
        $nombre = $datos['NOMBRE'];
        $nacimiento = $datos['NACIMIENTO'];
        $sexo = $datos['SEXO'];

        //Calculos para obtener la edad
        $fecha_nacimiento = new DateTime($nacimiento);
        $fecha_Actual = new DateTime();
        $edad = $fecha_Actual->diff($fecha_nacimiento);
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $nombre ?></td>
            <td><?php echo $nacimiento?></td>
            <td><?php echo $sexo ?></td>
            <td><?php echo $edad->y ?></td>
        </tr>
        <?php
    }
    ?>
</table>