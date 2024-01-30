<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./Static/CSS/estilos.css">
</head>

<body>
    <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
        <div class="card-body">

            <div class="card">
                <h5 class="card-header">USUARIOS REGISTRADOS</h5>
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistro">
                    Registrar nuevo usuario
                </button>
                <br>
                <table class="table table-striped" id="tabla_inicio">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha de nacimiento</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("Modelo/Usuarios/Consultar_usuario.php");
                        $contador = 1;
                        $obj_usuarios = new Consultar_usuario();
                        $datos_usuarios = $obj_usuarios->selectAllUsers();
                        if (empty($datos_usuarios)) {
                            ?>
                            <tr>
                                <td colspan="5">No hay datos registrados</td>
                            </tr>
                            <?php

                        } else {
                            foreach ($datos_usuarios as $usuario) {
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $contador; ?>
                                    </th>
                                    <td>
                                        <?php echo $usuario['NOMBRE'] ?>
                                    </td>
                                    <td>
                                        <?php echo $usuario['NACIMIENTO'] ?>
                                    </td>
                                    <td>
                                        <?php echo $usuario['SEXO'] ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" style="width: 100%;"
                                            onclick="modificar(<?php echo $usuario['ID'] ?>)">Modificar</button>
                                        <br><br>
                                        <button class="btn btn-danger" style="width: 100%;"
                                            onclick="eliminar(<?php echo $usuario['ID'] ?>)">Eliminar</button>
                                    </td>

                                </tr>
                                <?php
                                $contador++;
                            }
                        }
                        ?>
                    </tbody>
                </table>                
            </div>
            <br>
            <?php
                if ($contador > 1) {
                    ?>
                    <button type="button" class="btn btn-secondary" onclick="generar_documentos()">
                        Descargar
                    </button>
                    <?php
                }
                ?>
            <br>
        </div>
    </div>
</body>

</html>
<!-- MODAL REGISTRO -->
<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="modalRegistro"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistro">Registrar nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card text-center" style="width:80%;height:100%; position:relative;left:10%">
                    <div class="card-body">
                        <form id="formulario_registro" method="POST" enctype="multipart/form-data">
                            <p class="card-text">
                                NOMBRE<br><br><input name="nombres" id="nombres" type="text" required> <br><br>
                                FECHA DE NACIMIENTO<br><br><input name="fecha" id="fecha" type="date" required> <br><br>
                                SEXO<br><br><select name="sexo" id="sexo">
                                    <option value="masculino">Masculino</option>
                                    <option value="masculino">Femenino</option>
                                </select><br><br>
                                <input type="submit" class="btn btn-success" style="width: 60%;" value="Aceptar"
                                    name="Aceptar">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Modal Modificar -->

<div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="modalModificar"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModificar">Modificar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card text-center" style="width:80%;height:100%; position:relative;left:10%">
                    <div class="card-body">
                        <form id="formulario_modificacion" method="POST" enctype="multipart/form-data">
                            <p class="card-text">
                                <input name="id_edit" id="id_edit" type="hidden" required>
                                NOMBRE<br><br><input name="nombres_edit" id="nombres_edit" type="text" required>
                                <br><br>
                                FECHA DE NACIMIENTO<br><br><input name="fecha_edit" id="fecha_edit" type="date"
                                    required> <br><br>
                                SEXO<br><br><select name="sexo_edit" id="sexo_edit">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select><br><br>
                                <input type="submit" class="btn btn-success" style="width: 60%;" value="Aceptar"
                                    name="Aceptar">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script src="./Controlador/usuarios/insertar_usuario.js"></script>
<script src="./Controlador/usuarios/modificar_usuario.js"></script>
<script src="./Controlador/usuarios/eliminar_usuario.js"></script>
<script src="./Controlador/docs/generar_docs.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>