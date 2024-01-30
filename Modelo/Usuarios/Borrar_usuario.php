<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    try {
        include_once('../../Modelo/Conexion/conect.php');
        $c = new conect();
        $stmt = $c->connect()->prepare("DELETE FROM usuarios WHERE ID = '$id'");
        $stmt->execute();
        header('Content-Type: application/json');
        if ($stmt->execute())
            echo json_encode(array('result' => 1));
        else
            echo json_encode(array('result' => 0));
    } catch (PDOException $e) {
        echo 1;
    }
}