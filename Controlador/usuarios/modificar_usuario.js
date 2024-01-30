function modificar(id) {
    $.ajax({
        datatype: "json",
        type: "POST",
        url: "Modelo/Usuarios/Consultar_usuario_ajax.php",
        data: {
            id: id
        },
        success: function(response) {
            $('#modalModificar').modal('show')
            $("#nombres_edit").val(response.NOMBRE);
            $("#fecha_edit").val(response.FECHA);
            $("#id_edit").val(response.ID);
            if (response.SEXO == "Femenino") {
                $('[id="sexo_edit"]').val("Femenino");
            } else {
                $('[id="sexo_edit"]').val("Masculino");
            }
        },
        error: function(error) {
            // Manejar errores (puedes agregar más lógica aquí)
            console.log(JSON.stringify(error));
        }
    });
}

$("#formulario_modificacion").submit(function(e) {
    e.preventDefault();
    var nombre = $("#nombres_edit").val();
    var fecha = $("#fecha_edit").val();
    var id = $("#id_edit").val();
    var sexo = $('#sexo_edit :selected').text();

    $.ajax({
        type: "POST",
        url: "Modelo/Usuarios/Modificar_usuario.php",
        data: {
            nombre: nombre,
            fecha: fecha,
            sexo: sexo,
            id: id
        },
        success: function(response) {
            if (response == 0) {
                Swal.fire({
                    title: '¡Exito!',
                    text: 'Modificación realizada',
                    icon: 'success',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Aquí puedes poner la URL a la que deseas redireccionar
                        window.location.href = "index.php";
                    }
                });
            } else {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Ha habido un error',
                    icon: 'error',
                })
            }
        },
        error: function(error) {
            // Manejar errores (puedes agregar más lógica aquí)
            console.log(JSON.stringify(error));
        }
    });
})