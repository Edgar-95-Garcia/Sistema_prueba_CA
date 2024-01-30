<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $sexo = $_POST['sexo'];

    try {
        include_once('../../Modelo/Conexion/conect.php');
        $c = new conect();
        $stmt = $c->connect()->prepare("INSERT INTO usuarios(ID, NOMBRE, NACIMIENTO, SEXO) values (?,?,?,?)");
        $stmt->execute(array(null, $nombre, $fecha, $sexo));
        echo $result = 0;
    } catch (PDOException $e) {
        echo $e;
    }
}