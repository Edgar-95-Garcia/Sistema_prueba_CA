function eliminar(id) {
    Swal.fire({
        title: 'Confirmar eliminación de usuario',
        showDenyButton: true,
        confirmButtonText: 'Confirmar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                datatype: "json",
                type: "POST",
                url: "Modelo/Usuarios/Borrar_usuario.php",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.result == 1) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Eliminación realizada',
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
                            icon: 'warning',
                        })
                    }
                },
                error: function(error) {
                    // Manejar errores (puedes agregar más lógica aquí)
                    console.log(JSON.stringify(error));
                }
            });
        }
    })
}