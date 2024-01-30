$("#formulario_registro").submit(function(e) {
    e.preventDefault();

    var nombre = $("#nombres").val();
    var fecha = $("#fecha").val();
    var sexo = $('#sexo :selected').text();

    $.ajax({
        type: "POST",
        url: "Modelo/Usuarios/Insertar_usuario.php",
        data: {
            nombre: nombre,
            fecha: fecha,
            sexo: sexo
        },
        success: function(response) {
            if (response == 0) {
                Swal.fire({
                    title: '¡Exito!',
                    text: 'Registro realizado',
                    icon: 'success',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Aquí puedes poner la URL a la que deseas redireccionar
                        window.location.href = "index.php";
                    }
                });
            } else {
                console.log(JSON.stringify(response));
            }
        },
        error: function(error) {
            // Manejar errores (puedes agregar más lógica aquí)
            console.log(JSON.stringify(error));
        }
    });
})