$(document).ready(function () {
    $(".borrar_registro").on("click", function (e) {
        e.preventDefault();
        borrar_proceso(e);
    });

    async function borrar_proceso(elementClicked) {
        try {
            const id_proceso = elementClicked.target.dataset.id;
            var URL = "";
            const tipoProceso = elementClicked.target.attributes.tipo.value;

            if (tipoProceso == "dependencia") {
                URL = "modelos/modelo-proceso-dependencia.php";
            } else if (tipoProceso == "area") {
                URL = "modelos/modelo-proceso.php";
            } else {
                URL = "modelos/modelo-proceso-subarea.php";
            }
            
            var data = new FormData();
            data.append("id_proceso",id_proceso);
            data.append("registro","eliminar");
            const response = await fetch(URL, {
                method: "POST",
                body: data
            });

            const responseJson = await response.json();
            mostrarRespuesta(responseJson);
        } catch (error) {
            alert(error);
        }
    }

    function mostrarRespuesta(resultado){
        if ( resultado.estado != "ok" ){
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'No se ha podido guardar el registro, vuelva a intentarlo'
            })
        } else {
            Swal.fire({
                type: 'success',
                title: 'éxito',
                text: 'Se he eliminado el proceso'
            });
            setTimeout(() => {location.reload()},2000);
        }
    }
});


