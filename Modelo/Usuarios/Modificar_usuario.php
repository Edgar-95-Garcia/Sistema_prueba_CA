<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $sexo = $_POST['sexo'];
    $id = $_POST['id'];

    try {
        include_once('../../Modelo/Conexion/conect.php');
        $c = new conect();
        $stmt = $c->connect()->prepare("UPDATE usuarios set NOMBRE = '$nombre', NACIMIENTO = '$fecha', SEXO = '$sexo' WHERE ID = '$id'");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo 0;
        } else {
            echo 1;
        }
    } catch (PDOException $e) {
        echo 1;
    }
}