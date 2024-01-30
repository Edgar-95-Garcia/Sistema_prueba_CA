<?php
class Consultar_usuario
{
    function selectAllUsers()
    {
        try {
            $result = "";
            require_once("./Modelo/Conexion/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectAllUsers_docs()
    {
        try {
            $result = "";
            require_once("../../Modelo/Conexion/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}
