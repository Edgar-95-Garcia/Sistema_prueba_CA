<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    try {
        include_once('../../Modelo/Conexion/conect.php');
        $c = new conect();
        $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE ID = $id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $datos = array(
            "ID" => $result[0]['ID'],
            "NOMBRE" => $result[0]['NOMBRE'],
            "FECHA" => $result[0]['NACIMIENTO'],
            "SEXO" => $result[0]['SEXO'],
        );
        header('Content-Type: application/json');
        echo json_encode($datos);
    } catch (PDOException $e) {
        echo $e;
    }
}