function generar_documentos() {
    $.ajax({
        type: "GET",
        url: "Controlador/docs/generar_pdf.php",
        success: function(response) {
            window.open("Controlador/docs/" + response.url);
            //para el archivo excel
            $.ajax({
                type: "GET",
                url: "Controlador/docs/generar_excel.php",
                success: function(response) {
                    window.open("Controlador/docs/generar_excel.php");
                    // Redirigir a la URL del PDF generado

                },
                error: function(error) {
                    // Manejar errores (puedes agregar más lógica aquí)
                    console.error("Error en la solicitud AJAX:", error);

                }
            });

        },
        error: function(error) {
            console.error("Error en la solicitud AJAX:", error);

        }
    });
}